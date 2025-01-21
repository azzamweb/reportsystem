<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Daftar Desa') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Desa</h5>
                <!-- Tombol Tambah Desa -->
                <a href="{{ route('desas.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Desa
                </a>
            </div>
            <div class="card-body">
                <!-- Tabel Daftar Desa -->
                <div class="table-responsive">
                    <table id="desaTable" class="table table-hover table-striped table-sm align-middle" style="font-size: 0.875rem;">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Desa</th>
                                <th>Kecamatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($desas as $index => $desa)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $desa->name }}</td>
                                    <td>{{ $desa->kecamatan->name }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('desas.edit', $desa) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('desas.destroy', $desa) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus desa ini?')">
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
            $('#desaTable').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
                },
                pageLength: 10
            });
        });
    </script>
</x-app-layout>
