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
                <a href="{{ route('sumber_dana.create') }}" class="btn btn-light btn-sm">Tambah Sumber Dana</a>
            </div>
            <div class="card-body">
                @if ($sumberDana->isEmpty())
                    <p class="text-center text-muted">Belum ada sumber dana.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Sumber Dana</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sumberDana as $index => $sumberDana)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $sumberDana->nama }}</td>
                                        <td>{{ $sumberDana->deskripsi }}</td>
                                        <td>
                                            <a href="{{ route('sumber_dana.edit', $sumberDana->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('sumber_dana.destroy', $sumberDana->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
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
</x-app-layout>
