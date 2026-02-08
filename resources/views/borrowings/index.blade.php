@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">
        <i class="bi bi-arrow-left-right me-2"></i>Daftar Peminjaman
    </h1>
    <a href="{{ route('borrowings.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Peminjaman Baru
    </a>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('borrowings.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Cari Anggota</label>
                <input type="text" name="search" class="form-control" 
                       placeholder="Nama atau kode anggota..." 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="borrowed" {{ request('status') === 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search me-1"></i>Filter
                </button>
                <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($borrowings->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Anggota</th>
                            <th>Buku Dipinjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th width="120">Status</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowings as $index => $borrowing)
                            <tr>
                                <td>{{ $borrowings->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $borrowing->member->name }}</strong>
                                    <br><small class="text-muted">{{ $borrowing->member->member_code }}</small>
                                </td>
                                <td>
                                    @foreach($borrowing->borrowingDetails as $detail)
                                        <span class="badge bg-light text-dark mb-1">{{ $detail->book->title }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                <td>{{ $borrowing->return_date?->format('d/m/Y') ?? '-' }}</td>
                                <td>
                                    @if($borrowing->status === 'borrowed')
                                        <span class="badge bg-warning">Dipinjam</span>
                                    @else
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('borrowings.show', $borrowing) }}" 
                                       class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $borrowings->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <p class="mt-3 text-muted">Tidak ada data peminjaman.</p>
                <a href="{{ route('borrowings.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>Peminjaman Baru
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
