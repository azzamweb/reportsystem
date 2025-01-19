<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Jenis Laporan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <a href="{{ route('jenis_laporans.create') }}" class="btn btn-primary mb-3">Tambah Jenis Laporan</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Laporan</th>
                    <th>Keterangan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisLaporans as $jenis)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jenis->nama_laporan }}</td>
                        <td>{{ $jenis->keterangan }}</td>
                        <td>
                            @if ($jenis->gambar)
                                <img src="{{ asset('storage/' . $jenis->gambar) }}" alt="Gambar" width="100">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('jenis_laporans.edit', $jenis->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('jenis_laporans.destroy', $jenis->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
