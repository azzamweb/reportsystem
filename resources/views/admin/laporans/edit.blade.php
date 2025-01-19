<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Update Laporan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Update Laporan</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('laporans.update', $laporan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Tahun Pengajuan -->
                <div class="mb-3">
                    <label for="tahun_pengajuan" class="form-label">Tahun Pengajuan</label>
                    <select name="tahun_pengajuan" id="tahun_pengajuan" class="form-select @error('tahun_pengajuan') is-invalid @enderror" required>
                        <option value="">Pilih Tahun</option>
                        @for ($year = 2020; $year <= 2025; $year++)
                            <option value="{{ $year }}" {{ old('tahun_pengajuan', $laporan->tahun_pengajuan ?? '') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                    @error('tahun_pengajuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                    <!-- Nama KK Penerima -->
                    <div class="mb-3">
                        <label for="nama_kk_penerima" class="form-label">Nama KK Penerima</label>
                        <input type="text" name="nama_kk_penerima" id="nama_kk_penerima" value="{{ $laporan->nama_kk_penerima }}"
                            class="form-control @error('nama_kk_penerima') is-invalid @enderror" required>
                        @error('nama_kk_penerima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nomor KK -->
                    <div class="mb-3">
                        <label for="no_kk_penerima" class="form-label">Nomor KK</label>
                        <input type="text" name="no_kk_penerima" id="no_kk_penerima" value="{{ $laporan->no_kk_penerima }}"
                            class="form-control @error('no_kk_penerima') is-invalid @enderror" required>
                        @error('no_kk_penerima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat_penerima" class="form-label">Alamat</label>
                        <textarea name="alamat_penerima" id="alamat_penerima" rows="3"
                            class="form-control @error('alamat_penerima') is-invalid @enderror" required>{{ $laporan->alamat_penerima }}</textarea>
                        @error('alamat_penerima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kecamatan -->
                    <div class="mb-3">
                        <label for="kecamatan_id" class="form-label">Kecamatan</label>
                        <select name="kecamatan_id" id="kecamatan_id"
                            class="form-select @error('kecamatan_id') is-invalid @enderror" required>
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}" {{ $laporan->kecamatan_id == $kecamatan->id ? 'selected' : '' }}>
                                    {{ $kecamatan->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('kecamatan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Desa -->
                    <div class="mb-3">
                        <label for="desa_id" class="form-label">Desa</label>
                        <select name="desa_id" id="desa_id" class="form-select @error('desa_id') is-invalid @enderror" required>
                            <option value="">Pilih Desa</option>
                            @foreach ($desas as $desa)
                                <option value="{{ $desa->id }}" {{ $laporan->desa_id == $desa->id ? 'selected' : '' }}>
                                    {{ $desa->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('desa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jenis Laporan -->
                    <div class="mb-3">
    <label for="jenis_laporan_id" class="form-label">Jenis Laporan</label>
    <select name="jenis_laporan_id" id="jenis_laporan_id" class="form-select" required>
        <option value="">Pilih Jenis Laporan</option>
        @foreach ($jenisLaporans as $jenis)
            <option value="{{ $jenis->id }}" {{ old('jenis_laporan_id', $laporan->jenis_laporan_id ?? '') == $jenis->id ? 'selected' : '' }}>
                {{ $jenis->nama_laporan }}
            </option>
        @endforeach
    </select>
</div>


                   <!-- Foto -->
<div class="mb-3">
    <label for="foto" class="form-label">Foto</label>
    @if ($laporan->foto)
        <!-- Tampilkan Foto -->
        <div class="mb-2">
            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan" class="img-fluid rounded" style="max-width: 200px;">
        </div>
        <p class="text-muted">Foto sudah ada. Anda dapat mengganti foto dengan mengunggah file baru, atau biarkan kosong untuk mempertahankan foto saat ini.</p>
    @endif
    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
    @error('foto')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                    

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('laporans.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('kecamatan_id').addEventListener('change', function () {
            var kecamatanId = this.value;
            var desaDropdown = document.getElementById('desa_id');
            desaDropdown.innerHTML = '<option value="">Pilih Desa</option>';

            if (kecamatanId) {
                fetch(`/get-desas/${kecamatanId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(desa => {
                            var option = document.createElement('option');
                            option.value = desa.id;
                            option.textContent = desa.name;
                            desaDropdown.appendChild(option);
                        });
                    });
            }
        });
    </script>
</x-app-layout>
