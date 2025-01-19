<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Upload Laporan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Form Upload Laporan</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('laporans.store') }}" enctype="multipart/form-data">
                            @csrf

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
                                <input type="text" name="nama_kk_penerima" id="nama_kk_penerima"
                                    class="form-control @error('nama_kk_penerima') is-invalid @enderror" required>
                                @error('nama_kk_penerima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- No KK Penerima -->
                            <div class="mb-3">
                                <label for="no_kk_penerima" class="form-label">Nomor KK Penerima</label>
                                <input type="text" name="no_kk_penerima" id="no_kk_penerima"
                                    class="form-control @error('no_kk_penerima') is-invalid @enderror" required>
                                @error('no_kk_penerima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Alamat Penerima -->
                            <div class="mb-3">
                                <label for="alamat_penerima" class="form-label">Alamat Penerima</label>
                                <textarea name="alamat_penerima" id="alamat_penerima"
                                    class="form-control @error('alamat_penerima') is-invalid @enderror" rows="3"
                                    required></textarea>
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
                                    @foreach($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                                    @endforeach
                                </select>
                                @error('kecamatan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Desa -->
                            <div class="mb-3">
                                <label for="desa_id" class="form-label">Desa</label>
                                <select name="desa_id" id="desa_id"
                                    class="form-select @error('desa_id') is-invalid @enderror" required>
                                    <option value="">Pilih Desa</option>
                                </select>
                                @error('desa_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Foto -->
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" name="foto" id="foto"
                                    class="form-control @error('foto') is-invalid @enderror" required>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Titik Koordinat -->
<div class="mb-3">
    <label for="titik_koordinat" class="form-label">Titik Koordinat</label>
    <div class="input-group">
        <!-- Input untuk mengisi koordinat secara manual -->
        <input type="text" name="titik_koordinat" id="titik_koordinat"
            class="form-control @error('titik_koordinat') is-invalid @enderror" required>
        
        <!-- Tombol untuk mendapatkan lokasi otomatis -->
        <button type="button" class="btn btn-outline-primary" id="getLocationButton">Dapatkan Lokasi</button>
    </div>
    <small class="form-text text-muted">
        Anda dapat mengisi koordinat secara manual atau klik "Dapatkan Lokasi" untuk menggunakan GPS perangkat Anda.
    </small>
    @error('titik_koordinat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                            <!-- Jenis Laporan -->
                            <div class="mb-3">
    <label for="jenis_laporan_id" class="form-label">Jenis Laporan</label>
    <select name="jenis_laporan_id" id="jenis_laporan_id" class="form-select @error('jenis_laporan_id') is-invalid @enderror" required>
        <option value="">Pilih Jenis Laporan</option>
        @foreach ($jenisLaporans as $jenis)
            <option value="{{ $jenis->id }}" {{ old('jenis_laporan_id') == $jenis->id ? 'selected' : '' }}>
                {{ $jenis->nama_laporan }}
            </option>
        @endforeach
    </select>
    @error('jenis_laporan_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('laporans.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-success">Upload Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('kecamatan_id').addEventListener('change', function() {
            var kecamatanId = this.value; // Ambil ID kecamatan yang dipilih
            var desaDropdown = document.getElementById('desa_id'); // Dropdown desa

            // Kosongkan dropdown desa
            desaDropdown.innerHTML = '<option value="">Pilih Desa</option>';

            // Jika kecamatan dipilih, ambil daftar desa
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

        // Ambil lokasi GPS
        document.getElementById('getLocationButton').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('titik_koordinat').value =
                        position.coords.latitude + ',' + position.coords.longitude;
                }, function(error) {
                    alert('Tidak dapat mengambil lokasi: ' + error.message);
                });
            } else {
                alert('Geolocation tidak didukung oleh browser Anda.');
            }
        });
    </script>
</x-app-layout>
