@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="mb-4">
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" 
                         alt="{{ $book->title }}"
                         class="img-fluid rounded mb-3" style="max-height: 350px;">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                         style="height: 300px;">
                        <i class="bi bi-book display-1 text-muted"></i>
                    </div>
                @endif
                
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
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
                <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Detail Buku</h5>
            </div>
            <div class="card-body">
                <h2 class="mb-1">{{ $book->title }}</h2>
                <p class="text-muted mb-4">oleh {{ $book->author }}</p>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted" width="130">ISBN</td>
                                <td><strong>{{ $book->isbn }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Kategori</td>
                                <td>
                                    <a href="{{ route('categories.show', $book->category) }}">
                                        <span class="badge bg-secondary">{{ $book->category->name }}</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Penerbit</td>
                                <td>{{ $book->publisher ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted" width="130">Tahun Terbit</td>
                                <td>{{ $book->publication_year ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Stok Tersedia</td>
                                <td>
                                    <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                                        {{ $book->stock }} eksemplar
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($book->description)
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Deskripsi</h6>
                        <p>{{ $book->description }}</p>
                    </div>
                @endif
                
                <hr>
                
                <div class="row text-center">
                    <div class="col-6">
                        <small class="text-muted">Ditambahkan</small>
                        <p class="mb-0">{{ $book->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Terakhir Diupdate</small>
                        <p class="mb-0">{{ $book->updated_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
