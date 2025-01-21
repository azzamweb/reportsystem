<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Jenis Laporan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Jenis Laporan</h5>
                <a href="{{ route('jenis_laporans.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Jenis Laporan
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="jenisLaporanTable" class="table table-hover table-striped table-sm align-middle" style="font-size: 0.875rem;">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Laporan</th>
                                <th>Keterangan</th>
                                <th>Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenisLaporans as $index => $jenis)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $jenis->nama_laporan }}</td>
                                    <td>{{ $jenis->keterangan }}</td>
                                    <td>
                                        @if ($jenis->gambar)
                                            <img src="{{ asset('storage/' . $jenis->gambar) }}" alt="Gambar" class="img-thumbnail" style="width: 80px; height: auto;">
                                        @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('jenis_laporans.edit', $jenis->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('jenis_laporans.destroy', $jenis->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis laporan ini?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
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

    <!-- Tambahkan JavaScript untuk DataTables -->
    <script>
        $(document).ready(function () {
            $('#jenisLaporanTable').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
                },
                pageLength: 10
            });
        });
    </script>
</x-app-layout>
