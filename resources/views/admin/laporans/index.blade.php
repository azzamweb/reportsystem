<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Daftar Laporan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama KK</th>
                        <th>Alamat</th>
                        <th>Jenis Laporan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporans as $laporan)
                        <tr>
                            <td>{{ $laporan->nama_kk_penerima }}</td>
                            <td>{{ $laporan->alamat_penerima }}</td>
                            <td>{{ ucfirst($laporan->jenis_laporan) }}</td>
                            <td>
                                <!-- @if ($laporan->status === 'baru')
                                    <span class="badge bg-warning text-dark">Baru</span>
                                @elseif ($laporan->status === 'sudah ditindak lanjut')
                                    <span class="badge bg-success">Sudah Ditindak Lanjut</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
