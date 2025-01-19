<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Tambah Desa') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Form Tambah Desa</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('desas.store') }}">
                            @csrf

                            <!-- Input Nama Desa -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Desa</label>
                                <input type="text" name="name" id="name" placeholder="Masukkan nama desa"
                                    class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Dropdown Kecamatan -->
                            <div class="mb-3">
                                <label for="kecamatan_id" class="form-label">Pilih Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id"
                                    class="form-select @error('kecamatan_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                                    @endforeach
                                </select>
                                @error('kecamatan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-end">
                                <!-- Tombol Cancel -->
                                <a href="{{ route('desas.index') }}" class="btn btn-secondary me-2">
                                    Batal
                                </a>

                                <!-- Tombol Submit -->
                                <button type="submit" class="btn btn-success">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
