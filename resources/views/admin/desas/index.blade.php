<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Daftar Desa') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <!-- Tombol Tambah Desa -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('desas.create') }}" class="btn btn-success">
                Tambah Desa
            </a>
        </div>

        <!-- Tabel Daftar Desa -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Desa</th>
                        <th>Kecamatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($desas as $desa)
                        <tr>
                            <td>{{ $desa->name }}</td>
                            <td>{{ $desa->kecamatan->name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('desas.edit', $desa) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('desas.destroy', $desa) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus desa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
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
</x-app-layout>
