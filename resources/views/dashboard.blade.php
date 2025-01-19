<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Laporan</h5>
                <!-- Tombol Tambah Laporan -->
                <a href="{{ route('laporans.create') }}" class="btn btn-light btn-sm">
                    Tambah Laporan
                </a>
            </div>
            <div class="card-body">
                <!-- Filter Dropdown -->
                <div class="row mb-4 g-3">
                    <div class="col-md-3">
                        <label for="filterTahun" class="form-label">Tahun Pengajuan</label>
                        <select id="filterTahun" class="form-select form-select-sm">
                            <option value="">Semua</option>
                            @for ($year = 2020; $year <= 2025; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterKecamatan" class="form-label">Kecamatan</label>
                        <select id="filterKecamatan" class="form-select form-select-sm">
                            <option value="">Semua</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->name }}">{{ $kecamatan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterDesa" class="form-label">Desa</label>
                        <select id="filterDesa" class="form-select form-select-sm">
                            <option value="">Semua</option>
                            @foreach ($desas as $desa)
                                <option value="{{ $desa->name }}">{{ $desa->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterJenis" class="form-label">Jenis Laporan</label>
                        <select id="filterJenis" class="form-select form-select-sm">
                            <option value="">Semua</option>
                            @foreach ($jenisLaporans as $jenis)
                                <option value="{{ $jenis->nama_laporan }}">{{ $jenis->nama_laporan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="table-responsive mt-4">
                    <table id="laporanTable" class="table table-hover table-sm align-middle" style="font-size: 0.875rem;">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Tahun Pengajuan</th>
                                <th>Nama KK</th>
                                <th>Nomor KK</th>
                                <th>Alamat</th>
                                <th>Kecamatan</th>
                                <th>Desa</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporans as $index => $laporan)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $laporan->tahun_pengajuan ?? '-' }}</td>
                                    <td>{{ $laporan->nama_kk_penerima }}</td>
                                    <td>{{ $laporan->no_kk_penerima }}</td>
                                    <td>{{ $laporan->alamat_penerima }}</td>
                                    <td>{{ $laporan->kecamatan->name ?? '-' }}</td>
                                    <td>{{ $laporan->desa->name ?? '-' }}</td>
                                    <td>{{ $laporan->jenisLaporan->nama_laporan ?? '-' }}</td>
                                    <td>
                                        @if ($laporan->tindakLanjut)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> Complete
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle"></i> Incomplete
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('laporans.show', $laporan->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if (auth()->user()->role === 'admin')
                                                <a href="{{ route('laporans.edit', $laporan->id) }}" class="btn btn-outline-warning btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var table = $('#laporanTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
                },
                "pageLength": 10,
                "responsive": true
            });

            // Filter Tahun Pengajuan
            $('#filterTahun').on('change', function () {
                table.column(1).search(this.value).draw();
            });

            // Filter Kecamatan
            $('#filterKecamatan').on('change', function () {
                table.column(5).search(this.value).draw();
            });

            // Filter Desa
            $('#filterDesa').on('change', function () {
                table.column(6).search(this.value).draw();
            });

            // Filter Jenis Laporan
            $('#filterJenis').on('change', function () {
                table.column(7).search(this.value).draw();
            });
        });
    </script>
</x-app-layout>
