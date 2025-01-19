<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Edit Jenis Laporan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white">
                        <h5 class="mb-0">Form Edit Jenis Laporan</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('jenis_laporans.update', $jenisLaporan->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nama Jenis Laporan -->
                            <div class="mb-3">
                                <label for="nama_laporan" class="form-label">Jenis Laporan</label>
                                <input type="text" name="nama_laporan" id="nama" value="{{ old('nama', $jenisLaporan->nama_laporan) }}"
                                    class="form-control @error('nama_laporan') is-invalid @enderror" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan"
                                    class="form-control @error('keterangan') is-invalid @enderror" rows="3" required>{{ old('keterangan', $jenisLaporan->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gambar -->
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Upload Gambar (Opsional)</label>
                                <input type="file" name="gambar" id="gambar"
                                    class="form-control @error('gambar') is-invalid @enderror">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($jenisLaporan->gambar)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $jenisLaporan->gambar) }}" alt="Gambar Jenis Laporan"
                                            class="img-fluid rounded" style="max-height: 150px;">
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('jenis_laporans.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-warning text-white">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
