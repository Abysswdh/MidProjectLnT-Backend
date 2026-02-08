<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::sum('stock'),
            'total_titles' => Book::count(),
            'total_categories' => Category::count(),
            'total_members' => Member::count(),
            'active_borrowings' => Borrowing::where('status', 'borrowed')->count(),
            'total_borrowed_books' => Borrowing::where('status', 'borrowed')
                ->withCount('borrowingDetails')
                ->get()
                ->sum('borrowing_details_count'),
        ];

        $recent_borrowings = Borrowing::with(['member', 'borrowingDetails.book'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recent_borrowings'));
    }
}
