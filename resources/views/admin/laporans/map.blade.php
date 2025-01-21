<x-app-layout>
    <!-- Peta dengan tampilan full width -->
    <div class="container-fluid px-0">
        <!-- Filter Dropdown -->
        <div class="row g-3 px-3 py-2 bg-light filter-dropdown">
            <div class="col-md-3">
                <label for="filterKecamatan" class="form-label">Kecamatan</label>
                <select id="filterKecamatan" class="form-select">
                    <option value="">Semua Kecamatan</option>
                    @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="filterDesa" class="form-label">Desa</label>
                <select id="filterDesa" class="form-select">
                    <option value="">Semua Desa</option>
                    @foreach ($desas as $desa)
                        <option value="{{ $desa->id }}">{{ $desa->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="filterJenis" class="form-label">Jenis Laporan</label>
                <select id="filterJenis" class="form-select">
                    <option value="">Semua Jenis</option>
                    @foreach ($jenisLaporans as $jenis)
                        <option value="{{ $jenis->id }}">{{ $jenis->nama_laporan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="filterStatus" class="form-label">Status Tindak Lanjut</label>
                <select id="filterStatus" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="complete">Complete</option>
                    <option value="incomplete">Incomplete</option>
                </select>
            </div>
        </div>

        <!-- Peta -->
        <div id="map-container" class="row no-gutters" style="height: calc(100vh - 72px);">
            <div id="map" class="col-12 col-lg-12" style="height: 100%;"></div>
        </div>
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
                var status = document.getElementById('filterStatus').value;

                var filteredLaporans = laporans.filter(function (laporan) {
                    return (
                        (!kecamatanId || laporan.kecamatan_id == kecamatanId) &&
                        (!desaId || laporan.desa_id == desaId) &&
                        (!jenisId || laporan.jenis_laporan_id == jenisId) &&
                        (!status || (status === 'complete' ? laporan.tindakLanjut : !laporan.tindakLanjut))
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
            document.getElementById('filterStatus').addEventListener('change', filterData);
        });
    </script>

    <!-- Custom CSS -->
    <style>
        #map {
            border-radius: 0;
        }

        @media print {
            nav, .header {
                display: none !important;
            }

            #map-container {
                display: flex;
                flex-direction: row;
                height: 70vh !important;
            }

            #map {
                height: 100%;
                width: 100% !important;
            }

            footer {
                display: none;
            }
        }
    </style>
</x-app-layout>
