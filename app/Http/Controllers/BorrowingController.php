<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    /**
     * Display a listing of borrowings.
     */
    public function index(Request $request)
    {
        $query = Borrowing::with(['member', 'borrowingDetails.book']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by member name or code
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('member', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('member_code', 'like', "%{$search}%");
            });
        }

        $borrowings = $query->latest()->paginate(10)->withQueryString();

        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new borrowing.
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::where('stock', '>', 0)->with('category')->get();
        return view('borrowings.create', compact('members', 'books'));
    }

    /**
     * Store a newly created borrowing in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'books' => 'required|array|min:1',
            'books.*' => 'exists:books,id',
        ]);

        DB::beginTransaction();

        try {
            // Create borrowing record
            $borrowing = Borrowing::create([
                'member_id' => $validated['member_id'],
                'borrow_date' => now(),
                'status' => 'borrowed',
            ]);

            // Add borrowing details and reduce stock
            foreach ($validated['books'] as $bookId) {
                $book = Book::findOrFail($bookId);
                
                if ($book->stock <= 0) {
                    throw new \Exception("Buku '{$book->title}' tidak tersedia (stok habis).");
                }

                BorrowingDetail::create([
                    'borrowing_id' => $borrowing->id,
                    'book_id' => $bookId,
                    'quantity' => 1,
                ]);

                // Reduce stock
                $book->decrement('stock');
            }

            DB::commit();

            return redirect()->route('borrowings.show', $borrowing)
                ->with('success', 'Peminjaman berhasil dicatat!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memproses peminjaman: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified borrowing.
     */
    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['member', 'borrowingDetails.book.category']);
        return view('borrowings.show', compact('borrowing'));
    }

    /**
     * Process book return.
     */
    public function returnBooks(Borrowing $borrowing)
    {
        if ($borrowing->status === 'returned') {
            return redirect()->back()
                ->with('error', 'Peminjaman ini sudah dikembalikan sebelumnya.');
        }

        DB::beginTransaction();

        try {
            // Restore stock for all borrowed books
            foreach ($borrowing->borrowingDetails as $detail) {
                $detail->book->increment('stock', $detail->quantity);
            }

            // Update borrowing status
            $borrowing->update([
                'status' => 'returned',
                'return_date' => now(),
            ]);

            DB::commit();

            return redirect()->route('borrowings.show', $borrowing)
                ->with('success', 'Buku berhasil dikembalikan!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Gagal memproses pengembalian: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified borrowing.
     */
    public function edit(Borrowing $borrowing)
    {
        // Redirect to show page since borrowings shouldn't be directly edited
        return redirect()->route('borrowings.show', $borrowing);
    }

    /**
     * Update is not available for borrowings.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        return redirect()->route('borrowings.show', $borrowing);
    }

    /**
     * Remove the specified borrowing from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status === 'borrowed') {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus peminjaman yang masih aktif. Kembalikan buku terlebih dahulu.');
        }

        $borrowing->borrowingDetails()->delete();
        $borrowing->delete();

        return redirect()->route('borrowings.index')
            ->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
