<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of members.
     */
    public function index(Request $request)
    {
        $query = Member::query();

        // Search by name, email, or member_code
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('member_code', 'like', "%{$search}%");
            });
        }

        $members = $query->withCount(['borrowings' => function ($q) {
            $q->where('status', 'borrowed');
        }])->paginate(10)->withQueryString();

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        $memberCode = Member::generateMemberCode();
        return view('members.create', compact('memberCode'));
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $validated['member_code'] = Member::generateMemberCode();
        $validated['join_date'] = now();

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil didaftarkan!');
    }

    /**
     * Display the specified member.
     */
    public function show(Member $member)
    {
        $member->load(['borrowings' => function ($q) {
            $q->with('borrowingDetails.book')->latest();
        }]);
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Member $member)
    {
        // Check if member has active borrowings
        $activeBorrowings = $member->borrowings()
            ->where('status', 'borrowed')
            ->count();

        if ($activeBorrowings > 0) {
            return redirect()->route('members.index')
                ->with('error', 'Anggota tidak dapat dihapus karena masih memiliki peminjaman aktif!');
        }

        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }
}
