@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="mb-4">
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-folder me-2"></i>Detail Kategori</h5>
            </div>
            <div class="card-body">
                <h3 class="mb-3">{{ $category->name }}</h3>
                <p class="text-muted">{{ $category->description ?? 'Tidak ada deskripsi' }}</p>
                
                <hr>
                
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Total Buku:</span>
                    <span class="badge badge-count rounded-pill">{{ $category->books->count() }} buku</span>
                </div>
                
                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Daftar Buku dalam Kategori Ini</h5>
            </div>
            <div class="card-body">
                @if($category->books->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->books as $book)
                                    <tr>
                                        <td>
                                            <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
                                        </td>
                                        <td>{{ $book->author }}</td>
                                        <td>
                                            <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $book->stock }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-journal-x display-4 text-muted"></i>
                        <p class="mt-3 text-muted">Belum ada buku dalam kategori ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
