@extends('layouts.app')

@section('title', $member->name)

@section('content')
<div class="mb-4">
    <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-person me-2"></i>Profil Anggota</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px;">
                        <i class="bi bi-person text-primary display-4"></i>
                    </div>
                </div>
                
                <h4 class="text-center mb-1">{{ $member->name }}</h4>
                <p class="text-center text-muted mb-4">
                    <code>{{ $member->member_code }}</code>
                </p>
                
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted"><i class="bi bi-envelope me-2"></i>Email</td>
                        <td>{{ $member->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted"><i class="bi bi-telephone me-2"></i>Telepon</td>
                        <td>{{ $member->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted"><i class="bi bi-geo-alt me-2"></i>Alamat</td>
                        <td>{{ $member->address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted"><i class="bi bi-calendar me-2"></i>Bergabung</td>
                        <td>{{ $member->join_date->format('d M Y') }}</td>
                    </tr>
                </table>
                
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('members.edit', $member) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Peminjaman</h5>
            </div>
            <div class="card-body">
                @if($member->borrowings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal Pinjam</th>
                                    <th>Buku</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($member->borrowings as $borrowing)
                                    <tr>
                                        <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                        <td>
                                            @foreach($borrowing->borrowingDetails as $detail)
                                                <span class="badge bg-light text-dark">{{ $detail->book->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($borrowing->status === 'borrowed')
                                                <span class="badge bg-warning">Dipinjam</span>
                                            @else
                                                <span class="badge bg-success">Dikembalikan</span>
                                                <br><small class="text-muted">{{ $borrowing->return_date?->format('d/m/Y') }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-sm btn-outline-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox display-4 text-muted"></i>
                        <p class="text-muted mt-3">Belum ada riwayat peminjaman.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
