<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Detail Laporan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">Detail Laporan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Foto Laporan -->
                    <div class="col-md-6 text-center">
                        <div class="p-2 mb-3 bg-light border rounded">
                            <h5 class="text-primary fw-bold mb-3">Foto Laporan</h5>
                            @if ($laporan->foto)
                                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan" class="img-fluid rounded shadow">
                            @else
                                <p class="text-muted">Tidak ada foto tersedia.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Detail Informasi -->
                    <div class="col-md-6">
                        <div class="p-2 mb-3 bg-light border rounded">
                            <h5 class="text-primary fw-bold mb-3">Detail Informasi</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Tahun Pengajuan</th>
                                        <td>{{ $laporan->tahun_pengajuan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama KK Penerima</th>
                                        <td>{{ $laporan->nama_kk_penerima }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor KK</th>
                                        <td>{{ $laporan->no_kk_penerima }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $laporan->alamat_penerima }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td>{{ $laporan->kecamatan->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Desa</th>
                                        <td>{{ $laporan->desa->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Laporan</th>
                                        <td>{{ $laporan->jenisLaporan->nama_laporan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Titik Koordinat</th>
                                        <td>
                                            {{ $laporan->titik_koordinat }}
                                            <br>
                                            <a href="https://www.google.com/maps?q={{ $laporan->titik_koordinat }}" target="_blank" class="btn btn-sm btn-link text-primary">
                                                Lihat di Google Maps
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Laporan</th>
                                        <td>{{ $laporan->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            @if (auth()->user()->role === 'admin')
                        <a href="{{ route('laporans.edit', $laporan->id) }}" class="btn btn-warning">Edit Laporan</a>
                    @endif
                        </div>
                    </div>
                </div>

                <!-- Detail Tindak Lanjut -->
                <div class="mt-4">
                    <div class="p-2 mb-3 bg-light border rounded">
                        <h5 class="text-primary fw-bold mb-3 text-center">Tindak Lanjut</h5>
                        @if ($laporan->tindakLanjut)
                            <div class="row">
                                <!-- Foto Tindak Lanjut -->
                                <div class="col-md-6 text-center">
                                    @if ($laporan->tindakLanjut->foto)
                                        <!-- <img src="{{ asset('storage/tindaklanjut/foto/' . $laporan->tindakLanjut->foto) }}" alt="Foto Tindak Lanjut" class="img-fluid rounded shadow"> -->
                                        <img src="{{ asset('storage/' . $laporan->tindakLanjut->foto) }}" alt="Foto Tindak Lanjut" class="img-fluid">

                                    @else
                                        <p class="text-muted">Tidak ada foto tersedia.</p>
                                    @endif
                                </div>
                                <!-- Informasi Tindak Lanjut -->
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Tahun Anggaran</th>
                                                <td>{{ $laporan->tindakLanjut->tahun_anggaran }}</td>
                                            </tr>
                                            <tr>
                                                <th>Waktu Pengerjaan</th>
                                                <td>{{ $laporan->tindakLanjut->waktu_pengerjaan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Biaya</th>
                                                <td>Rp {{ number_format($laporan->tindakLanjut->biaya, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Sumber Dana</th>
                                                <td>{{ $laporan->tindakLanjut->sumberDana->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pihak Ketiga</th>
                                                <td>{{ $laporan->tindakLanjut->pihak_ketiga ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Keterangan</th>
                                                <td>{{ $laporan->tindakLanjut->keterangan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Dokumen Pendukung</th>
                                                <td>
                                                    @if ($laporan->tindakLanjut->dokumen_pendukung)
                                                        <a href="{{ asset('storage/' . $laporan->tindakLanjut->dokumen_pendukung) }}" class="btn btn-sm btn-link text-primary" target="_blank">
                                                            Lihat Dokumen
                                                        </a>
                                                    @else
                                                        <p class="text-muted">Tidak ada dokumen pendukung.</p>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Tombol Edit Tindak Lanjut -->
                                    @if (auth()->user()->role === 'admin')
                                        <div class="mt-3 ">
                                            <a href="{{ route('tindaklanjut.edit', $laporan->tindakLanjut->id) }}" class="btn btn-sm btn-warning">
                                                Edit Tindak Lanjut
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            
                        <p class="text-center text-muted">Belum ditindaklanjuti.</p>
                            @if (auth()->user()->role === 'admin')
                                <div class="mt-3 text-center">
                                @if (!$laporan->tindakLanjut)
    <a href="{{ route('tindaklanjut.create', ['laporan_id' => $laporan->id]) }}" class="btn btn-primary">
        Masukkan Tindak Lanjut
    </a>
@endif
                                </div>
                            @endif


                        @endif
                    </div>
                </div>

                <!-- Peta Lokasi -->
                <div class="mt-4">
                    <h5 class="text-primary fw-bold mb-3">Lokasi Laporan</h5>
                    <div id="map" style="height: 400px; border: 1px solid #ccc;"></div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                   
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rawCoordinates = "{{ $laporan->titik_koordinat }}";
            const defaultCoordinates = [-6.200000, 106.816666]; // Default: Jakarta
            const coordinates = rawCoordinates ? rawCoordinates.split(',') : defaultCoordinates;

            if (coordinates.length !== 2 || isNaN(parseFloat(coordinates[0])) || isNaN(parseFloat(coordinates[1]))) {
                console.error('Koordinat tidak valid:', rawCoordinates);
                alert('Titik koordinat tidak valid. Menampilkan peta dengan lokasi default.');
            }

            const lat = parseFloat(coordinates[0]);
            const lng = parseFloat(coordinates[1]);

            const map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles © Esri &mdash; Source: Esri, Maxar, Earthstar Geographics, and the GIS User Community',
                maxZoom: 19,
            }).addTo(map);

            L.marker([lat, lng]).addTo(map)
                .bindPopup('Lokasi Laporan')
                .openPopup();
        });
    </script>
</x-app-layout>
