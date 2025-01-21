<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Daftar Sumber Dana') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Sumber Dana</h5>
                <a href="{{ route('sumber_dana.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Sumber Dana
                </a>
            </div>
            <div class="card-body">
                @if ($sumberDana->isEmpty())
                    <p class="text-center text-muted">Belum ada sumber dana.</p>
                @else
                    <div class="table-responsive">
                        <table id="sumberDanaTable" class="table table-hover table-striped table-sm align-middle" style="font-size: 0.875rem;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama Sumber Dana</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sumberDana as $index => $dana)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $dana->nama }}</td>
                                        <td>{{ $dana->deskripsi }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('sumber_dana.edit', $dana->id) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('sumber_dana.destroy', $dana->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sumber dana ini?')" class="d-inline">
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
                @endif
            </div>
        </div>
    </div>

    <!-- Tambahkan JavaScript untuk DataTables -->
    <script>
        $(document).ready(function () {
            $('#sumberDanaTable').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
                },
                pageLength: 10
            });
        });
    </script>
</x-app-layout>
