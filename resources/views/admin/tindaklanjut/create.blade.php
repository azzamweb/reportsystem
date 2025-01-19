<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Tambah Tindak Lanjut') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Tambah Tindak Lanjut</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('tindaklanjut.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Tahun Anggaran -->
                    <div class="mb-3">
                        <label for="tahun_anggaran" class="form-label">Tahun Anggaran</label>
                        <select name="tahun_anggaran" id="tahun_anggaran" class="form-select" required>
                            <option value="">Pilih Tahun</option>
                            @for ($year = 2020; $year <= 2025; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Waktu Pengerjaan -->
                    <div class="mb-3">
                        <label for="waktu_pengerjaan" class="form-label">Waktu Pengerjaan</label>
                        <input type="date" name="waktu_pengerjaan" id="waktu_pengerjaan" class="form-control" required>
                    </div>

                    <!-- Biaya -->
                    <div class="mb-3">
                        <label for="biaya" class="form-label">Biaya</label>
                        <input type="number" name="biaya" id="biaya" class="form-control" required>
                    </div>

                    <!-- Sumber Dana -->
                    <div class="mb-3">
                        <label for="sumber_dana_id" class="form-label">Sumber Dana</label>
                        <select name="sumber_dana_id" id="sumber_dana_id" class="form-select" required>
                            <option value="">Pilih Sumber Dana</option>
                            @foreach ($sumberDanas as $sumberDana)
                                <option value="{{ $sumberDana->id }}">{{ $sumberDana->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                  <!-- Laporan -->
<div class="mb-3">
    <label for="laporan_autocomplete" class="form-label">Laporan</label>
    <input type="text" id="laporan_autocomplete" class="form-control" placeholder="Cari laporan..." 
        value="{{ $laporan ? $laporan->nama_kk_penerima . ' (' . $laporan->no_kk_penerima . ' - ' . $laporan->kecamatan->name . ', ' . $laporan->desa->name . ')' : '' }}" 
        {{ $laporan ? 'readonly' : '' }}>
    <input type="hidden" name="laporan_id" id="laporan_id" value="{{ $laporan->id ?? '' }}">
</div>

                    <!-- Pihak Ketiga -->
                    <div class="mb-3">
                        <label for="pihak_ketiga" class="form-label">Pihak Ketiga</label>
                        <input type="text" name="pihak_ketiga" id="pihak_ketiga" class="form-control">
                    </div>

                    <!-- Dokumen Pendukung -->
                    <div class="mb-3">
                        <label for="dokumen_pendukung" class="form-label">Dokumen Pendukung</label>
                        <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" class="form-control">
                    </div>

                    <!-- Foto -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('tindaklanjut.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Autocomplete untuk laporan
        document.getElementById('laporan_autocomplete').addEventListener('input', function () {
    const query = this.value;

    if (query.length > 2) {
        fetch(`/laporan-autocomplete?query=${query}`)
            .then(response => response.json())
            .then(data => {
                const dataList = document.getElementById('laporan_autocomplete_list');
                dataList.innerHTML = '';

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = `${item.nama_kk_penerima} (${item.no_kk_penerima} - ${item.kecamatan}, ${item.desa})`;
                    option.dataset.id = item.id;
                    dataList.appendChild(option);
                });
            });
    }
});

document.getElementById('laporan_autocomplete').addEventListener('change', function () {
    const selectedOption = Array.from(document.getElementById('laporan_autocomplete_list').options)
        .find(option => option.value === this.value);

    if (selectedOption) {
        document.getElementById('laporan_id').value = selectedOption.dataset.id;
    }
});

    </script>
</x-app-layout>
