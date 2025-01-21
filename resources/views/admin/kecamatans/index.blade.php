<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Daftar Kecamatan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Kecamatan</h5>
                <!-- Tombol Tambah Kecamatan -->
                <a href="{{ route('kecamatans.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Kecamatan
                </a>
            </div>
            <div class="card-body">
                <!-- Tabel Daftar Kecamatan -->
                <div class="table-responsive">
                    <table id="kecamatanTable" class="table table-hover table-striped table-sm align-middle" style="font-size: 0.875rem;">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">Nama Kecamatan</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kecamatans as $index => $kecamatan)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $kecamatan->name }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('kecamatans.edit', $kecamatan) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('kecamatans.destroy', $kecamatan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kecamatan ini?')">
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
            $('#kecamatanTable').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
                },
                pageLength: 10
            });
        });
    </script>
</x-app-layout>
