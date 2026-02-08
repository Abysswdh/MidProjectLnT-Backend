@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="page-title">
    <i class="bi bi-speedometer2 me-2"></i>Dashboard
</h1>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="bi bi-journal-text text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h3 class="mb-0">{{ $stats['total_books'] }}</h3>
                        <p class="text-muted mb-0">Total Stok Buku</p>
                        <small class="text-muted">{{ $stats['total_titles'] }} judul</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="bi bi-people text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h3 class="mb-0">{{ $stats['total_members'] }}</h3>
                        <p class="text-muted mb-0">Total Anggota</p>
                        <small class="text-muted">Terdaftar</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="bi bi-arrow-left-right text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h3 class="mb-0">{{ $stats['active_borrowings'] }}</h3>
                        <p class="text-muted mb-0">Peminjaman Aktif</p>
                        <small class="text-muted">{{ $stats['total_borrowed_books'] }} buku dipinjam</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Quick Links -->
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('borrowings.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Peminjaman Baru
                    </a>
                    <a href="{{ route('members.create') }}" class="btn btn-outline-success">
                        <i class="bi bi-person-plus me-2"></i>Daftar Anggota
                    </a>
                    <a href="{{ route('books.create') }}" class="btn btn-outline-info">
                        <i class="bi bi-book me-2"></i>Tambah Buku
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Borrowings -->
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Peminjaman Terbaru</h5>
            </div>
            <div class="card-body">
                @if($recent_borrowings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Anggota</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Buku</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_borrowings as $borrowing)
                                    <tr>
                                        <td>{{ $borrowing->member->name }}</td>
                                        <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                        <td>{{ $borrowing->borrowingDetails->count() }}</td>
                                        <td>
                                            @if($borrowing->status === 'borrowed')
                                                <span class="badge bg-warning">Dipinjam</span>
                                            @else
                                                <span class="badge bg-success">Dikembalikan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox display-4 text-muted"></i>
                        <p class="text-muted mt-3">Belum ada peminjaman.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Category Summary -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-folder me-2"></i>Kategori Buku ({{ $stats['total_categories'] }})</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $categories = \App\Models\Category::withCount('books')->get();
                    @endphp
                    @foreach($categories as $category)
                        <div class="col-md-3 col-6 mb-3">
                            <a href="{{ route('categories.show', $category) }}" class="text-decoration-none">
                                <div class="p-3 border rounded hover-shadow">
                                    <h6 class="mb-1">{{ $category->name }}</h6>
                                    <small class="text-muted">{{ $category->books_count }} buku</small>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
