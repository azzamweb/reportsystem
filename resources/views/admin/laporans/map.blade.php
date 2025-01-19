<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Peta Sebaran Laporan') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <!-- Filter Dropdown -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="filterKecamatan" class="form-label">Kecamatan</label>
                <select id="filterKecamatan" class="form-select">
                    <option value="">Semua Kecamatan</option>
                    @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="filterDesa" class="form-label">Desa</label>
                <select id="filterDesa" class="form-select">
                    <option value="">Semua Desa</option>
                    @foreach ($desas as $desa)
                        <option value="{{ $desa->id }}">{{ $desa->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="filterJenis" class="form-label">Jenis Laporan</label>
                <select id="filterJenis" class="form-select">
                    <option value="">Semua Jenis</option>
                    @foreach ($jenisLaporans as $jenis)
                        <option value="{{ $jenis->id }}">{{ $jenis->nama_laporan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Peta -->
        <div id="map" style="height: 500px; border-radius: 8px;"></div>
    </div>

    <!-- Tambahkan Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-providers/leaflet-providers.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('map').setView([1.3636904935814762, 102.05547871151775], 10);
        L.tileLayer.provider('Esri.WorldImagery').addTo(map);

        var laporans = @json($laporans);
        var markerGroup = L.layerGroup().addTo(map);

        function addMarkers(filteredLaporans) {
            markerGroup.clearLayers();
            filteredLaporans.forEach(function (laporan) {
                if (laporan.titik_koordinat && laporan.jenis_laporan) {
                    var koordinat = laporan.titik_koordinat.split(',');

                    var customIcon = L.icon({
                        iconUrl: `/storage/${laporan.jenis_laporan.gambar}`,
                        iconSize: [50, 50],
                        iconAnchor: [20, 40],
                        popupAnchor: [0, -40]
                    });

                    var marker = L.marker([parseFloat(koordinat[0]), parseFloat(koordinat[1])], { icon: customIcon })
                        .bindPopup(`
                            <strong>${laporan.nama_kk_penerima}</strong><br>
                            <em>${laporan.kecamatan ? laporan.kecamatan.name : '-'}, ${laporan.desa ? laporan.desa.name : '-'}</em><br>
                            <a href="/laporans/${laporan.id}" class="">Detail</a>
                        `);

                    markerGroup.addLayer(marker);
                }
            });
        }

        addMarkers(laporans);

        function filterData() {
            var kecamatanId = document.getElementById('filterKecamatan').value;
            var desaId = document.getElementById('filterDesa').value;
            var jenisId = document.getElementById('filterJenis').value;

            var filteredLaporans = laporans.filter(function (laporan) {
                return (
                    (!kecamatanId || laporan.kecamatan_id == kecamatanId) &&
                    (!desaId || laporan.desa_id == desaId) &&
                    (!jenisId || laporan.jenis_laporan_id == jenisId)
                );
            });

            addMarkers(filteredLaporans);
        }

        document.getElementById('filterKecamatan').addEventListener('change', function () {
            var kecamatanId = this.value;
            var desaDropdown = document.getElementById('filterDesa');
            desaDropdown.innerHTML = '<option value="">Semua Desa</option>';

            if (kecamatanId) {
                fetch(`/get-desas/${kecamatanId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (desa) {
                            var option = document.createElement('option');
                            option.value = desa.id;
                            option.textContent = desa.name;
                            desaDropdown.appendChild(option);
                        });
                    });
            }

            filterData();
        });

        document.getElementById('filterDesa').addEventListener('change', filterData);
        document.getElementById('filterJenis').addEventListener('change', filterData);
    });
    </script>
</x-app-layout>
