@push('styles')
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.17.0-beta.1/mapbox-gl.css" rel="stylesheet">
    <style>
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
    <div>
        <section class="mt-25" x-data="petaOfflineComponent()">
            <div id="legend" class="absolute top-18 left-4 bg-white shadow-lg rounded-sm p-2 z-50 text-sm">
                <h3 class="font-semibold mb-2 dark:text-slate-900">Legenda</h3>
                {{-- <div id="legend-items"></div> --}}
                <div class="mt-3 border-t pt-3 text-xs text-gray-600">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-1 bg-red-500"></span> Batas Desa
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-1 bg-[#8007b0]"></span> Batas Dusun
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-4 bg-red-500"></span> Sudah Terdata
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-4 bg-[#bfe81a]"></span> Akan Panen H-3
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-4 bg-[#45e9f2]"></span> Belum Terdata
                    </div>
                </div>
            </div>


            <div x-cloak x-show="modalIsOpen" x-trap.inert.noscroll="modalIsOpen"
                x-on:keydown.esc.window="modalIsOpen = false" class="fixed inset-0 z-40 flex" role="dialog"
                aria-modal="true" aria-labelledby="slideoverTitle">
                <!-- Backdrop -->
                <div x-show="modalIsOpen" x-transition.opacity.duration.200ms x-on:click="modalIsOpen = false"
                    class="fixed inset-0 bg-black/30 backdrop-blur-sm"></div>

                <!-- SlideOver Panel -->
                <div x-show="modalIsOpen" x-transition:enter="transform transition ease-out duration-300"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="relative ml-auto flex h-full w-full max-w-md flex-col border-l border-neutral-300 bg-white text-neutral-700 shadow-xl dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-200">
                    <!-- Header -->
                    <div
                        class="flex items-center justify-between border-b border-neutral-200 px-4 py-3 dark:border-neutral-700">
                        <h3 id="slideoverTitle"
                            class="text-sm font-semibold tracking-wide text-neutral-900 dark:text-white">
                            Detail Kolam
                        </h3>

                        <button x-on:click="closeSlider()" aria-label="Close panel"
                            class="rounded-sm p-1 hover:bg-neutral-100 dark:hover:bg-neutral-800">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                                stroke-width="1.5" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="flex-1 overflow-y-auto px-4 py-6">
                        <!-- 🔽 ISI DETAIL KOLAM DI SINI -->
                        <template x-if="previewData">
                            <div class="flex-1 space-y-6 overflow-y-auto px-4 py-6 text-sm">

                                <!-- ========================= -->
                                <!-- 1️⃣ INFORMASI KOLAM -->
                                <!-- ========================= -->
                                <section class="rounded-lg border border-neutral-200 dark:border-neutral-700">
                                    <div
                                        class=" bg-neutral-50 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-neutral-500 dark:bg-neutral-900 dark:text-neutral-400">
                                        Informasi Kolam <span x-text="previewData.length"></span>
                                    </div>

                                    <div class="divide-y dark:divide-neutral-700">
                                        <div class="flex justify-between px-4 py-2">
                                            <span class="text-neutral-500">Nama Kolam</span>
                                            <span class="font-semibold text-neutral-900 dark:text-white"
                                                x-text="previewData.nama">

                                            </span>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 px-4 py-2">
                                            <div>
                                                <p class="text-neutral-500">Panjang</p>
                                                <p class="font-medium text-neutral-900 dark:text-white"
                                                    x-text="previewData.panjang + ' m'"></p>
                                            </div>
                                            <div>
                                                <p class="text-neutral-500">Lebar</p>
                                                <p class="font-medium text-neutral-900 dark:text-white"
                                                    x-text="previewData.lebar + ' m'"></p>
                                            </div>
                                        </div>

                                        <div class="flex justify-between px-4 py-2">
                                            <span class="text-neutral-500">Kapasitas</span>
                                            <span class="font-medium text-neutral-900 dark:text-white"
                                                x-text="previewData.kapasitas + ' ekor'">
                                                10.000 ekor
                                            </span>
                                        </div>

                                        <div class="flex justify-between px-4 py-2">
                                            <span class="text-neutral-500">Status</span>
                                            <span
                                                class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-700 dark:bg-green-900/30 dark:text-green-300"
                                                x-text="previewData.status">
                                                Aktif
                                            </span>
                                        </div>

                                        <div class="flex justify-between px-4 py-2">
                                            <span class="text-neutral-500">Owner</span>
                                            <span class="font-medium text-neutral-900 dark:text-white"
                                                x-text="previewData.user">
                                                Budi Santoso
                                            </span>
                                        </div>
                                    </div>
                                </section>

                                <!-- ========================= -->
                                <!-- 2️⃣ DATA SEEDING -->
                                <!-- ========================= -->
                                <section class="rounded-lg border border-neutral-200 dark:border-neutral-700">
                                    <div
                                        class="border-b bg-neutral-50 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-neutral-500 dark:bg-neutral-900 dark:text-neutral-400">
                                        Data Seeding
                                    </div>

                                    <!-- Seeding Item -->
                                    <div class="divide-y dark:divide-neutral-700">
                                        <template x-if="previewData.seeding">
                                            <div class="space-y-3 px-4 py-4">
                                                <div class="flex justify-between">
                                                    <span class="text-neutral-500">Tanggal Tebar</span>
                                                    <span class="font-medium text-neutral-900 dark:text-white"
                                                        x-text="previewData.seeding.tanggal">
                                                        12 Januari 2025
                                                    </span>
                                                </div>

                                                <div class="flex justify-between">
                                                    <span class="text-neutral-500">Jenis Benih</span>
                                                    <span class="font-medium text-neutral-900 dark:text-white"
                                                        x-text="previewData.seeding.jenis">
                                                        Patin Siam
                                                    </span>
                                                </div>

                                                <div class="flex justify-between">
                                                    <span class="text-neutral-500">Jumlah Ikan</span>
                                                    <span class="font-medium text-neutral-900 dark:text-white"
                                                        x-text="previewData.seeding.jumlah">
                                                        8.000 ekor
                                                    </span>
                                                </div>

                                                <div class="flex justify-between">
                                                    <span class="text-neutral-500">Estimasi Hari Panen</span>
                                                    <span class="font-medium text-neutral-900 dark:text-white"
                                                        x-text="previewData.seeding.estimasi_day">
                                                        8.000 ekor
                                                    </span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-neutral-500">Estimasi Tanggal Panen</span>
                                                    <span class="font-medium text-neutral-900 dark:text-white"
                                                        x-text="previewData.seeding.estimasi">
                                                        8.000 ekor
                                                    </span>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </section>

                            </div>
                        </template>
                        <template x-if="!previewData ">
                            <div class="flex flex-col items-center justify-center h-full text-center px-6">
                                <!-- Icon -->
                                <div
                                    class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-neutral-100 dark:bg-neutral-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-neutral-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 13h6m-6 4h6M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                    </svg>
                                </div>

                                <!-- Text -->
                                <h3 class="text-sm font-semibold text-neutral-900 dark:text-white">
                                    Data Belum Tersedia
                                </h3>

                                <p class="mt-1 text-xs text-neutral-500 max-w-xs">
                                    Informasi belum tersedia atau belum pernah ditambahkan.
                                    Silakan pilih area lain.
                                </p>
                            </div>
                        </template>


                    </div>

                    <!-- Footer -->
                    <div
                        class="flex justify-end gap-2 border-t border-neutral-200 bg-neutral-50 px-4 py-3 dark:border-neutral-700 dark:bg-neutral-950">
                        <button x-on:click="closeSlider()"
                            class="rounded-sm px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-100 dark:text-neutral-300 dark:hover:bg-neutral-800">
                            Tutup
                        </button>

                    </div>
                </div>
            </div>
            <div id="map"class="mt-17" wire:ignore></div>
            <template x-if="loading">
                <div x-cloak class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
                    style="backdrop-filter: blur(2px);">
                    <div class="bg-white rounded-lg p-6 w-72 shadow-xl text-center">
                        <div
                            class="animate-spin h-10 w-10 border-4 border-gray-300 border-t-blue-600 rounded-full mx-auto mb-4">
                        </div>
                        <p class="font-semibold text-gray-800">Sedang Mengambil Data.....</p>
                        <p class="text-gray-500 text-sm mt-1">Harap tunggu sebentar.</p>
                    </div>
                </div>
            </template>
        </section>

    </div>

    <script>
        function petaOfflineComponent() {
            return {
                mapOffline: null,
                offlineLayers: @json($offlineLayers),
                center: [100.84915003253047, 0.3313522113222831],
                accessToken: 'pk.eyJ1IjoiZGV2LWNvZGVycyIsImEiOiJja3l4YmM1YnQwZ3VrMndwOGFpcnhobGtpIn0.K-67FDARYgR7zEXLSbR4bg',
                legendItems: [],
                targets: [],
                loading: false,
                modalIsOpen: false,
                previewData: null,
                init() {
                    Livewire.on('loadingHide', (data) => {
                        document.getElementById('map').inert = false;
                        this.modalIsOpen = true
                        this.loading = false
                        this.previewData = data[0] ?? null
                    })
                    this.legendItems = [{
                            id: 'datakolamikan',
                            label: 'Kolam Ikan'
                        },
                        {
                            id: 'batasdusun',
                            label: 'Batas Dusun'
                        },
                        {
                            id: 'batasadministrasidesa',
                            label: 'Batas Desa'
                        }
                    ]
                    this.petaOffline();
                },
                closeSlider() {
                    this.modalIsOpen = false
                    this.previewData = []
                },
                petaOffline() {
                    mapboxgl.accessToken = this.accessToken;
                    if (this.mapOffline) {
                        this.mapOffline.remove();
                        this.mapOffline = null;
                    }
                    this.mapOffline = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/mapbox/standard-satellite',
                        center: this.center,
                        zoom: 15
                    });
                    this.mapOffline.addControl(new mapboxgl.NavigationControl());

                    if (!document.getElementById('legend')) {
                        const legendEl = document.createElement('div');
                        legendEl.id = 'legend';
                        legendEl.className = 'absolute top-4 left-4 bg-white shadow-lg rounded-lg p-4 z-50 text-sm';
                        legendEl.innerHTML = '<h3 class="font-semibold mb-2">Legenda</h3><div id="legend-items"></div>';
                        document.body.appendChild(legendEl);
                    }
                    this.mapOffline.on('load', () => {
                        this.renderOfflineLayers();
                        // this.renderLegendMap();
                        this.clickPolygonMaps();
                    });
                },
                renderOfflineLayers() {

                    this.offlineLayers.forEach(layer => {

                        if (this.mapOffline.getSource(layer.id)) return;

                        this.mapOffline.addSource(layer.id, {
                            type: 'geojson',
                            data: layer.data
                        });

                        this.mapOffline.addLayer({
                            id: layer.id,
                            type: layer.type,
                            source: layer.id,
                            paint: {
                                ...JSON.parse(layer.paint),
                                'fill-color': [
                                    'case',

                                    // 🔥 Panen H-3 (urgent)
                                    ['all',
                                        ['==', ['get', 'will_harvest_3_days'], true],
                                        ['==', ['get', 'isSaved'], true]
                                    ],
                                    '#bfe81a',

                                    // 🟥 Kolam tersimpan biasa
                                    ['==', ['get', 'isSaved'], true],
                                    '#ff0000',

                                    // 🔵 Default
                                    '#45e9f2'
                                ],
                            }
                        });
                        // ===========================================
                        // 1️⃣ BUAT CENTROID FEATURE UNTUK TEXT LABEL
                        // ===========================================
                        const centroidFeatures = layer.data.features.map(f => {
                            const center = turf.centroid(f);
                            return {
                                type: "Feature",
                                geometry: center.geometry,
                                properties: {
                                    label: f.properties?.name ??
                                        "", // pilih label dari properties
                                }
                            };
                        });

                        // ===========================================
                        // 2️⃣ TAMBAH SOURCE TEXT SYMBOL
                        // ===========================================
                        const textSourceId = `${layer.id}-label-source`;

                        if (!this.mapOffline.getSource(textSourceId)) {
                            this.mapOffline.addSource(textSourceId, {
                                type: "geojson",
                                data: {
                                    type: "FeatureCollection",
                                    features: centroidFeatures
                                }
                            });
                        }

                        // ===========================================
                        // 3️⃣ TAMBAH LAYER SYMBOL UNTUK TEXT
                        // ===========================================
                        const textLayerId = `${layer.id}-label`;

                        if (!this.mapOffline.getLayer(textLayerId)) {
                            this.mapOffline.addLayer({
                                id: textLayerId,
                                type: 'symbol',
                                source: textSourceId,
                                layout: {
                                    'text-field': ['get', 'label'],
                                    'text-size': 12,
                                    'text-offset': [0, 0.5], // geser sedikit
                                    'text-anchor': 'top'
                                },
                                paint: {
                                    'text-color': '#ffffff',
                                    'text-halo-color': '#000000',
                                    'text-halo-width': 1.5,
                                }
                            });
                        }
                    });


                },
                renderLegendMap() {
                    const legendContainer = document.getElementById('legend-items');
                    legendContainer.innerHTML = '';

                    this.legendItems.forEach(item => {
                        const color = this.getLayerColor(this.mapOffline, item.id);

                        const displayColor = color || '#cccccc';

                        const styleLayer = this.mapOffline.getStyle().layers.find(l => l.id === item.id);
                        const kind = styleLayer ? styleLayer.type : 'fill';
                        const el = document.createElement('div');
                        el.className = 'flex items-center space-x-2 mb-1';
                        let symbol = '';
                        if (kind === 'line') {
                            symbol = `
                                        <span class="inline-block w-7 h-1.5 border border-gray-300"
                                        style="background:${color}"></span>
                                    `;
                        } else {
                            // default fill / circle
                            symbol = `
                                        <span class="inline-block w-4 h-4 rounded-sm border border-gray-300"
                                        style="background:${color}"></span>
                                    `;
                        }
                        el.innerHTML = `
                                    ${symbol}
                                    <span class="text-gray-800">${item.label}</span>
                                `;
                        legendContainer.appendChild(el);
                    })
                },
                showPolygonPopup(feature, lngLat) {
                    const props = feature.properties;
                    const popupContent = `
                        <div class="rounded-lg bg-white dark:bg-neutral-900 p-4 text-sm
                                    text-neutral-800 dark:text-neutral-100 shadow-md min-w-[240px]">

                            <!-- Header -->
                            <h4 class="text-base font-semibold text-neutral-900 dark:text-neutral-100 mb-3">
                                ${props.name ?? 'Kolam'}
                            </h4>

                            <!-- Info -->
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="text-neutral-500 dark:text-neutral-400">Kapasitas</span>
                                    <span class="font-medium">
                                        ${props.kapasitas ?? '-'}
                                    </span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-neutral-500 dark:text-neutral-400">Pemilik</span>
                                    <span class="font-medium">
                                        ${props.pemilik ?? '-'}
                                    </span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-neutral-500 dark:text-neutral-400">Status</span>
                                    <span class="font-medium ${props.isSaved
                                        ? 'text-emerald-600 dark:text-emerald-400'
                                        : 'text-neutral-500 dark:text-neutral-400'}">
                                        ${props.isSaved ? 'Tersimpan' : 'Belum Disimpan'}
                                    </span>
                                </div>
                            </div>

                            <!-- Alert -->
                            ${props.will_harvest_3_days ? `
                                                    <div class="mt-3 rounded-md border border-amber-200 dark:border-amber-800
                                                                bg-amber-50 dark:bg-amber-900/30
                                                                px-3 py-2 text-xs font-medium text-amber-700 dark:text-amber-300">
                                                        ⚠️ Panen dalam 3 hari
                                                    </div>
                                                ` : ''}

                            <!-- Action -->
                            <div class="mt-4" x-show="${props.isSaved}">
                                <button
                                    x-on:click="showDetail('${props.feature_id}')"
                                    class="inline-flex w-full items-center justify-center rounded-md
                                        bg-blue-600 hover:bg-blue-700
                                        text-white text-xs font-medium py-2 transition
                                        dark:bg-blue-500 dark:hover:bg-blue-600">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    `;



                    new mapboxgl.Popup({
                            closeButton: true,
                            closeOnClick: true,
                            maxWidth: '260px'
                        })
                        .setLngLat(lngLat)
                        .setHTML(popupContent)
                        .addTo(this.mapOffline);
                },
                showDetail(featureId) {
                    console.log(featureId); // ✅ BENAR
                    this.loading = true;
                    @this.dispatch('viewDataKolam', {
                        feature_id: featureId,
                    });
                },
                zoomToPolygon(coordinates) {
                    const bounds = new mapboxgl.LngLatBounds();

                    // Polygon
                    if (coordinates.length && typeof coordinates[0][0][0] === 'number') {
                        coordinates[0].forEach(coord => bounds.extend(coord));
                    }
                    // MultiPolygon
                    else {
                        coordinates.forEach(polygon => {
                            polygon[0].forEach(coord => bounds.extend(coord));
                        });
                    }

                    this.mapOffline.fitBounds(bounds, {
                        padding: 80,
                        maxZoom: 18,
                        duration: 800,
                        easing: t => t * (2 - t), // smooth
                    });
                },
                clickPolygonMaps() {
                    // Loop semua layer offline
                    this.offlineLayers.forEach(layer => {
                        const layerId = layer.id;

                        // Tangkap klik pada layer polygon
                        this.mapOffline.on("click", layerId, (e) => {
                            const feature = e.features?.[0];
                            const coordinates = feature.geometry.coordinates;
                            if (!feature) {
                                console.warn("No feature clicked");
                                return;
                            }
                            this.zoomToPolygon(coordinates);
                            this.showPolygonPopup(feature, e.lngLat);

                            let featureId = feature.id ?? feature.properties?.feature_id;

                            // =====================================================
                            // 2️⃣ UPDATE WARNA POLYGON 
                            // =====================================================
                            // --- 1. Update warna polygon ---
                            // const newColor = "#ef4444"; // merah
                            // const source = this.mapOffline.getSource(layerId);
                            // const data = source._data;
                            // // Reset semua polygon ke warna aslinya
                            // const clicked = data.features.find(f =>
                            //     f.id == featureId
                            // );
                            // if (clicked) {
                            //     // clicked.properties.is_kolam = 1;
                            // }

                            // this.loading = true;
                            // @this.dispatch('viewDataKolam', {
                            //     feature_id: featureId,
                            //     polygon: feature.geometry.coordinates,
                            //     clickpoint: e.lngLat
                            // });

                        });


                        // Cursor berubah saat hover
                        this.mapOffline.on("mouseenter", layerId, () => {
                            this.mapOffline.getCanvas().style.cursor = "pointer";
                        });

                        this.mapOffline.on("mouseleave", layerId, () => {
                            this.mapOffline.getCanvas().style.cursor = "";
                        });
                    });
                },
                getLayerColor(map, layerId) {
                    const styleLayer = map.getStyle().layers.find(l => l.id === layerId);
                    if (!styleLayer || !styleLayer.paint) return null;

                    // kandidat properti
                    const keys = [
                        'fill-color',
                        'line-color',
                        'circle-color',
                        'background-color',
                        'fill-outline-color'
                    ];

                    let val = null;
                    for (const key of keys) {
                        if (styleLayer.paint[key] !== undefined) {
                            val = styleLayer.paint[key];
                            break;
                        }
                    }
                    if (!val) return null;

                    // 1. Literal warna string
                    if (typeof val === "string") return val;

                    // 2. rgba/rgb array
                    if (Array.isArray(val) && (val[0] === "rgba" || val[0] === "rgb")) {
                        return rgbaArrayToCss(val);
                    }

                    // 3. match expression => ambil default
                    if (Array.isArray(val) && val[0] === "match") {
                        const last = val[val.length - 1];
                        return typeof last === "string" ? last : null;
                    }

                    // 4. case expression => ambil default
                    if (Array.isArray(val) && val[0] === "case") {
                        const last = val[val.length - 1];
                        return typeof last === "string" ? last : null;
                    }

                    // 5. step / interpolate / zoom-based color → ambil fallback terakhir
                    if (Array.isArray(val)) {
                        const last = val[val.length - 1];
                        if (typeof last === "string") return last;
                        if (Array.isArray(last)) return rgbaArrayToCss(last);
                    }

                    return null;
                }
            }

        }
    </script>
