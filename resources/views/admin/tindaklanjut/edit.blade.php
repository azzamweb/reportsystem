<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Edit Tindak Lanjut') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Edit Tindak Lanjut</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('tindaklanjut.update', $tindaklanjut->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Tahun Anggaran -->
                    <div class="mb-3">
                        <label for="tahun_anggaran" class="form-label">Tahun Anggaran</label>
                        <select name="tahun_anggaran" id="tahun_anggaran" class="form-select" required>
                            <option value="">Pilih Tahun</option>
                            @for ($year = 2020; $year <= 2025; $year++)
                                <option value="{{ $year }}" {{ $tindaklanjut->tahun_anggaran == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Waktu Pengerjaan -->
                    <div class="mb-3">
                        <label for="waktu_pengerjaan" class="form-label">Waktu Pengerjaan</label>
                        <input type="date" name="waktu_pengerjaan" id="waktu_pengerjaan" 
                            class="form-control" value="{{ $tindaklanjut->waktu_pengerjaan }}" required>
                    </div>

                    <!-- Biaya -->
                    <div class="mb-3">
                        <label for="biaya" class="form-label">Biaya</label>
                        <input type="number" name="biaya" id="biaya" class="form-control" 
                            value="{{ $tindaklanjut->biaya }}" required>
                    </div>

                    <!-- Sumber Dana -->
                    <div class="mb-3">
                        <label for="sumber_dana_id" class="form-label">Sumber Dana</label>
                        <select name="sumber_dana_id" id="sumber_dana_id" class="form-select" required>
                            <option value="">Pilih Sumber Dana</option>
                            @foreach ($sumberDanas as $sumberDana)
                                <option value="{{ $sumberDana->id }}" {{ $tindaklanjut->sumber_dana_id == $sumberDana->id ? 'selected' : '' }}>
                                    {{ $sumberDana->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Laporan -->
                    <div class="mb-3">
                        <label for="laporan_autocomplete" class="form-label">Laporan</label>
                        <input type="text" id="laporan_autocomplete" class="form-control" placeholder="Cari laporan..." 
                            value="{{ $tindaklanjut->laporan ? $tindaklanjut->laporan->nama_kk_penerima . ' (' . $tindaklanjut->laporan->no_kk_penerima . ' - ' . $tindaklanjut->laporan->kecamatan->name . ', ' . $tindaklanjut->laporan->desa->name . ')' : '' }}" 
                            readonly>
                        <input type="hidden" name="laporan_id" id="laporan_id" value="{{ $tindaklanjut->laporan_id }}">
                    </div>

                    <!-- Pihak Ketiga -->
                    <div class="mb-3">
                        <label for="pihak_ketiga" class="form-label">Pihak Ketiga</label>
                        <input type="text" name="pihak_ketiga" id="pihak_ketiga" class="form-control" 
                            value="{{ $tindaklanjut->pihak_ketiga }}">
                    </div>

                    <!-- Dokumen Pendukung -->
                    <div class="mb-3">
                        <label for="dokumen_pendukung" class="form-label">Dokumen Pendukung</label>
                        <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" class="form-control">
                        @if ($tindaklanjut->dokumen_pendukung)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $tindaklanjut->dokumen_pendukung) }}" target="_blank">
                                    Lihat Dokumen Pendukung
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Foto -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                        @if ($tindaklanjut->foto)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $tindaklanjut->foto) }}" alt="Foto Tindak Lanjut" 
                                    class="img-fluid rounded" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control">{{ $tindaklanjut->keterangan }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('tindaklanjut.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
