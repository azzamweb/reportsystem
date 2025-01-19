<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Edit Sumber Dana') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Edit Sumber Dana</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('sumber_dana.update', $sumberDana->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Sumber Dana -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Sumber Dana</label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $sumberDana->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">deskripsi</label>
                        <textarea name="deskripsi" id="keterangan" rows="3"
                            class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $sumberDana->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('sumber_dana.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
