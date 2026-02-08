@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="mb-4">
    <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Info Peminjaman</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted">ID Transaksi</td>
                        <td><code>#{{ str_pad($borrowing->id, 5, '0', STR_PAD_LEFT) }}</code></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>
                            @if($borrowing->status === 'borrowed')
                                <span class="badge bg-warning fs-6">Dipinjam</span>
                            @else
                                <span class="badge bg-success fs-6">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Pinjam</td>
                        <td><strong>{{ $borrowing->borrow_date->format('d M Y') }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Kembali</td>
                        <td>
                            @if($borrowing->return_date)
                                <strong>{{ $borrowing->return_date->format('d M Y') }}</strong>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                </table>
                
                @if($borrowing->status === 'borrowed')
                    <hr>
                    <form action="{{ route('borrowings.return', $borrowing) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin memproses pengembalian buku?')">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-check-circle me-2"></i>Proses Pengembalian
                        </button>
                    </form>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-person me-2"></i>Data Peminjam</h5>
            </div>
            <div class="card-body">
                <h5 class="mb-1">{{ $borrowing->member->name }}</h5>
                <p class="text-muted mb-3"><code>{{ $borrowing->member->member_code }}</code></p>
                
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-muted"><i class="bi bi-envelope me-1"></i></td>
                        <td>{{ $borrowing->member->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted"><i class="bi bi-telephone me-1"></i></td>
                        <td>{{ $borrowing->member->phone ?? '-' }}</td>
                    </tr>
                </table>
                
                <a href="{{ route('members.show', $borrowing->member) }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-eye me-1"></i>Lihat Profil
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Daftar Buku Dipinjam</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th width="80">Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrowing->borrowingDetails as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <a href="{{ route('books.show', $detail->book) }}">
                                            <strong>{{ $detail->book->title }}</strong>
                                        </a>
                                        <br><small class="text-muted">ISBN: {{ $detail->book->isbn }}</small>
                                    </td>
                                    <td>{{ $detail->book->author }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $detail->book->category->name }}</span>
                                    </td>
                                    <td><span class="badge bg-primary">{{ $detail->quantity }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="4" class="text-end"><strong>Total Buku:</strong></td>
                                <td><strong>{{ $borrowing->borrowingDetails->sum('quantity') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        @if($borrowing->status === 'returned')
            <div class="card mt-3 border-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                            Hapus data peminjaman ini?
                        </div>
                        <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini? Aksi ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
