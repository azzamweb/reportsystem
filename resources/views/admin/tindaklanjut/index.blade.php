<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Tindak Lanjut') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Tindak Lanjut</h5>
                <!-- <a href="{{ route('tindaklanjut.create') }}" class="btn btn-light btn-sm">Tambah Tindak Lanjut</a> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tindaklanjutTable" class="table table-hover table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Laporan</th>
                                <th>Tahun Anggaran</th>
                                <th>Waktu Pengerjaan</th>
                                <th>Biaya</th>
                                <th>Sumber Dana</th>
                                <th>Pihak Ketiga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tindakLanjuts as $index => $tindakLanjut)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $tindakLanjut->laporan->nama_kk_penerima ?? '-' }}</td>
                                    <td>{{ $tindakLanjut->tahun_anggaran }}</td>
                                    <td>{{ $tindakLanjut->waktu_pengerjaan }}</td>
                                    <td>{{ number_format($tindakLanjut->biaya, 0, ',', '.') }}</td>
                                    <td>{{ $tindakLanjut->sumberDana->nama ?? '-' }}</td>
                                    <td>{{ $tindakLanjut->pihak_ketiga ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('tindaklanjut.edit', $tindakLanjut->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('tindaklanjut.destroy', $tindakLanjut->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tindak lanjut ini?')">
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
            </div>
        </div>
    </div>
</x-app-layout>
