@extends('layouts.app')

@section('title', 'Peminjaman Baru')

@section('content')
<div class="mb-4">
    <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Peminjaman Buku</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('borrowings.store') }}" method="POST" id="borrowingForm">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="member_id" class="form-label">Pilih Anggota <span class="text-danger">*</span></label>
                        <select class="form-select @error('member_id') is-invalid @enderror" 
                                id="member_id" name="member_id" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->member_code }} - {{ $member->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                        <p class="text-muted small">Centang buku yang ingin dipinjam</p>
                        
                        @error('books')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <div class="row" id="bookList">
                            @foreach($books as $book)
                                <div class="col-md-6 mb-2">
                                    <div class="form-check border rounded p-3">
                                        <input class="form-check-input book-checkbox" type="checkbox" 
                                               name="books[]" value="{{ $book->id }}" id="book{{ $book->id }}"
                                               {{ in_array($book->id, old('books', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label w-100" for="book{{ $book->id }}">
                                            <strong>{{ $book->title }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $book->author }}</small>
                                            <br>
                                            <span class="badge bg-secondary">{{ $book->category->name }}</span>
                                            <span class="badge bg-success">Stok: {{ $book->stock }}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($books->count() === 0)
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Tidak ada buku yang tersedia untuk dipinjam saat ini.
                            </div>
                        @endif
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" {{ $books->count() === 0 ? 'disabled' : '' }}>
                            <i class="bi bi-check-lg me-1"></i>Proses Peminjaman
                        </button>
                        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h6 class="mb-0"><i class="bi bi-cart me-2"></i>Ringkasan</h6>
            </div>
            <div class="card-body">
                <div id="summary">
                    <p class="text-muted text-center">Pilih buku untuk melihat ringkasan</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Total Buku:</span>
                    <strong id="totalBooks">0</strong>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-white">
                <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Maksimal peminjaman sesuai stok tersedia
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Dapat meminjam lebih dari 1 buku sekaligus
                    </li>
                    <li>
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Tanggal peminjaman: {{ now()->format('d/m/Y') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.book-checkbox');
    const summary = document.getElementById('summary');
    const totalBooks = document.getElementById('totalBooks');
    
    function updateSummary() {
        const selected = document.querySelectorAll('.book-checkbox:checked');
        let html = '';
        
        if (selected.length === 0) {
            html = '<p class="text-muted text-center">Pilih buku untuk melihat ringkasan</p>';
        } else {
            html = '<ul class="list-unstyled mb-0">';
            selected.forEach(checkbox => {
                const label = checkbox.closest('.form-check').querySelector('strong').textContent;
                html += `<li class="mb-2"><i class="bi bi-book text-primary me-2"></i>${label}</li>`;
            });
            html += '</ul>';
        }
        
        summary.innerHTML = html;
        totalBooks.textContent = selected.length;
    }
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSummary);
    });
    
    updateSummary();
});
</script>
@endpush
