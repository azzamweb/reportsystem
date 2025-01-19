<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Tambah Kecamatan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Form Tambah Kecamatan</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('kecamatans.store') }}">
                            @csrf

                            <!-- Input Nama Kecamatan -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Kecamatan</label>
                                <input type="text" name="name" id="name" placeholder="Masukkan nama kecamatan"
                                    class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-end">
                                <!-- Tombol Cancel -->
                                <a href="{{ route('kecamatans.index') }}" class="btn btn-secondary me-2">
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
