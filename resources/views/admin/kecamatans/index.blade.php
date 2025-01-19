<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Daftar Kecamatan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <!-- Tombol Tambah Kecamatan -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('kecamatans.create') }}" class="btn btn-success">
                Tambah Kecamatan
            </a>
        </div>

        <!-- Tabel Daftar Kecamatan -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Kecamatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kecamatans as $kecamatan)
                        <tr>
                            <td>{{ $kecamatan->name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('kecamatans.edit', $kecamatan) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('kecamatans.destroy', $kecamatan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kecamatan ini?')">
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
