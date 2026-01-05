@push('styles')
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.17.0-beta.1/mapbox-gl.css" rel="stylesheet">
@endpush

<section class="mt-0 px-2 lg:px-2" x-data="mapOfflineComponent()" x-init="initMap()"
    x-on:successCreated.window="petaOffline()">
    <div class="relative grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2 bg-gray-800 rounded-lg">
            <div class="p-3">
                <h2 class="text-2xl font-semibold dark:text-white">Peta Kolam Ikan</h2>
            </div>
            <div class="absolute top-15 left-2 z-30">
                <flux:button icon="rectangle-group" @click="legendShow = !legendShow" size="sm" />

            </div>

            <div id="legend" x-show="legendShow" x-transition
                class="absolute top-25 left-2 bg-white shadow-xl rounded-md p-3 z-50 text-sm border border-gray-200">
                <h3 class="font-semibold mb-2 dark:text-slate-900">Legenda</h3>
                <div id="legend-items" class="dark:text-slate-900"></div>
                <div class="mt-3 border-t pt-3 text-xs text-gray-600">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-1 bg-red-500"></span> Batas Desa
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-1 bg-[#8007b0]"></span> Batas Dusun
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-4 bg-red-500"></span> Kolam saya
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-4 bg-[#bfe81a]"></span> Kolam saat Ini
                    </div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-6 h-4 bg-green-500"></span> Dipilih
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-4 bg-blue-400"></span> Tersedia
                    </div>
                </div>
            </div>
            <div id="map" class="w-full h-[100vh] overflow-hidden" wire:ignore></div>
        </div>
        <div class="bg-gray-800 rounded-lg p-6">
            <form wire:submit.prevent="store" class="space-y-6">
                <div>
                    <flux:heading size="lg">Update Info Kolam Pemilik</flux:heading>
                </div>
                <flux:field>
                    <flux:label>Nama Kolam</flux:label>
                    <flux:input wire:model="nama_kolam" :disabled="!$this->isReadySubmit" placeholder="kolam 1" />
                    <flux:error name="nama_kolam" />
                </flux:field>
                <flux:field>
                    <flux:label>Panjang Kolam</flux:label>
                    <flux:input wire:model="panjang" :disabled="!$this->isReadySubmit" placeholder="kolam 1" />
                    <flux:error name="panjang" />
                </flux:field>
                <flux:field>
                    <flux:label>Lebar_Kolam</flux:label>
                    <flux:input wire:model="lebar" :disabled="!$this->isReadySubmit" placeholder="kolam 1" />
                    <flux:error name="lebar" />
                </flux:field>
                <flux:field>
                    <flux:label>Kedalaman Kolam</flux:label>
                    <flux:input wire:model="kedalaman" :disabled="!$this->isReadySubmit" placeholder="kolam 1" />
                    <flux:error name="kedalaman" />
                </flux:field>
                <flux:field>
                    <flux:label>Kapasitas Kolam</flux:label>
                    <flux:input wire:model="kapasitas" :disabled="!$this->isReadySubmit" placeholder="kolam 1" />
                    <flux:error name="kapasitas" />
                </flux:field>
                <flux:field>
                    <flux:label>Status Kolam</flux:label>
                    <flux:radio.group wire:model="status" variant="segmented">
                        <flux:radio :disabled="!$this->isReadySubmit" value="Aktif" label="Aktif" />
                        <flux:radio :disabled="!$this->isReadySubmit" value="Rusak" label="Rusak" />
                        <flux:radio :disabled="!$this->isReadySubmit" value="Sewa" label="Sewa" />
                    </flux:radio.group>
                    <flux:error name="status" />
                </flux:field>
                @if (Auth::user()->role == 'Administrator')
                    <flux:field>
                        <flux:label>Pemilik</flux:label>
                        <flux:select wire:model="user_id" :disabled="!$this->isReadySubmit"
                            placeholder="Pilih Pemilik...">
                            <flux:select.option value="" selected>Pilih Pemilik</flux:select.option>
                            @foreach ($dataUser as $list)
                                <flux:select.option value="{{ $list->id }}">{{ $list->name }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        <flux:error name="user_id" />
                    </flux:field>
                @endif
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>
        </div>
    </div>
    <template x-if="loading">
        <div x-cloak class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
            style="backdrop-filter: blur(2px);">
            <div class="bg-white rounded-lg p-6 w-72 shadow-xl text-center">
                <div
                    class="animate-spin h-10 w-10 border-4 border-gray-300 border-t-blue-600 rounded-full mx-auto mb-4">
                </div>
                <p class="font-semibold text-gray-800">Menyimpan data polygon di background service...</p>
                <p class="text-gray-500 text-sm mt-1">Harap tunggu sebentar.</p>
            </div>
        </div>
    </template>
</section>
@push('scripts')
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.17.0-beta.1/mapbox-gl.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js"></script>

    <script>
        function mapOfflineComponent() {
            return {
                mapOffline: null,
                offlineLayers: @json($offlineLayers),
                dbPolygons: @json($savedPolygons),
                center: [100.84915003253047, 0.3313522113222831],
                accessToken: 'pk.eyJ1IjoiZGV2LWNvZGVycyIsImEiOiJja3l4YmM1YnQwZ3VrMndwOGFpcnhobGtpIn0.K-67FDARYgR7zEXLSbR4bg',
                legendItems: [],
                loading: false,
                legendShow: false,
                selectedPolygon: null,

                initMap() {
                    window.addEventListener('offline-layers-updated', e => {
                        this.loadOfflineFromLivewire(e.detail.layers);

                    })
                    Livewire.on('polygon-selected', () => {
                        this.loading = false; // Hide loading setelah Livewire terima data
                    });

                    this.petaOffline();

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
                    let selectedFeature = null;

                    this.offlineLayers.forEach(layer => {

                        // ---- Tambah / update SOURCE ----
                        if (!this.mapOffline.getSource(layer.id)) {
                            this.mapOffline.addSource(layer.id, {
                                type: 'geojson',
                                data: layer.data
                            });
                        } else {
                            this.mapOffline.getSource(layer.id).setData(layer.data);
                        }

                        const basePaint = typeof layer.paint === 'string' ?
                            JSON.parse(layer.paint) :
                            layer.paint;

                        let paint = basePaint;

                        if (layer.type === 'fill') {
                            paint = {
                                ...basePaint,
                                'fill-color': [
                                    'case',
                                    ['==', ['get', 'owned_by_me'], true],
                                    '#ff0000',
                                    ['==', ['get', 'is_registered'], true], '#22c55e',
                                    ['==', ['get', 'selected'], true], '#bfe81a',
                                    '#45e9f2'
                                ],
                            };
                        }
                        // ---- Tambah LAYER ----
                        if (!this.mapOffline.getLayer(layer.id)) {
                            this.mapOffline.addLayer({
                                id: layer.id,
                                type: layer.type,
                                source: layer.id,
                                paint: paint
                            });
                        }

                        // ===========================================
                        // 1️⃣ BUAT CENTROID FEATURE UNTUK TEXT LABEL
                        // ===========================================
                        const centroidFeatures = layer.data.features.map(f => {
                            const center = turf.centroid(f);
                            return {
                                type: "Feature",
                                geometry: center.geometry,
                                properties: {
                                    label: f.properties?.name ?? f.properties?.feature_id ??
                                        "not owned", // pilih label dari properties
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

                        // ---- Temukan polygon yang sedang dipilih (warna hijau) ----
                        layer.data.features.forEach(f => {
                            if (f.properties.selected) {
                                selectedFeature = f;
                            }
                        });

                    });

                    // ---- AUTO ZOOM bila ada selected feature ----
                    if (selectedFeature) {
                        this.selectedPolygon = selectedFeature;
                        this.zoomToFeature(selectedFeature);
                    }
                },
                zoomToFeature(feature) {
                    if (!feature?.geometry?.coordinates) return;
                    const poly = turf.polygon(feature.geometry.coordinates);

                    // 🔥 Tambahkan buffer 10 meter agar tidak terlalu dekat
                    const buffered = turf.buffer(poly, 10, {
                        units: 'meters'
                    });
                    const bbox = turf.bbox(buffered);

                    this.mapOffline.fitBounds(bbox, {
                        padding: 40,
                        animate: true,
                        duration: 1000
                    });
                },
                renderLegendMap() {
                    const legendContainer = document.getElementById('legend-items');
                    legendContainer.innerHTML = '';

                    this.legendItems.forEach(item => {

                        // cek apakah item merupakan layer asli di map
                        const styleLayer = this.mapOffline.getStyle().layers.find(l => l.id === item.id);
                        const isRealLayer = !!styleLayer;

                        // Warna untuk legend
                        const displayColor = item.color || '#cccccc';

                        const el = document.createElement('div');
                        el.className = 'flex items-center space-x-2 mb-1 select-none';
                        el.dataset.layer = item.id;

                        // Jika layer tidak ada di map → tampilkan non-klik
                        if (!isRealLayer) {
                            el.classList.add("opacity-70", "cursor-default");
                        } else {
                            el.classList.add("cursor-pointer");

                            // cek visibility
                            let visibility = this.mapOffline.getLayoutProperty(item.id, 'visibility');
                            if (!visibility) visibility = "visible";

                            if (visibility === 'none') {
                                el.classList.add('opacity-40');
                            }

                            // tambahkan event toggle untuk layer map
                            el.addEventListener("click", () => {
                                const nowVisibility = this.mapOffline.getLayoutProperty(item.id,
                                    'visibility');
                                const newVisibility = nowVisibility === 'visible' ? 'none' : 'visible';

                                this.mapOffline.setLayoutProperty(item.id, 'visibility', newVisibility);

                                if (newVisibility === 'none') {
                                    el.classList.add('opacity-40');
                                } else {
                                    el.classList.remove('opacity-40');
                                }
                            });
                        }

                        // render bentuk legend
                        if (styleLayer?.type === 'line') {
                            el.innerHTML = `
                <span style="display:inline-block;width:28px;height:6px;background:${displayColor};border:1px solid #0003"></span>
                <span>${item.label}</span>
            `;
                        } else {
                            el.innerHTML = `
                <span style="display:inline-block;width:16px;height:16px;background:${displayColor};border:1px solid #0003;border-radius:3px"></span>
                <span>${item.label}</span>
            `;
                        }

                        legendContainer.appendChild(el);
                    });
                },

                clickPolygonMaps() {
                    this.offlineLayers.forEach(layer => {
                        const layerId = layer.id;

                        this.mapOffline.on("click", layerId, (e) => {
                            const feature = e.features?.[0];
                            const props = feature.properties || {};
                            if (!feature) return;

                            // ❌ 1. Disable click jika sudah dimiliki
                            if (props.owned_by_me === true) {
                                console.info("Polygon already owned, click disabled");
                                return;
                            }

                            // ❌ 2. Safety guard: registered tapi bukan milik user
                            if (props.is_registered === true && props.owned_by_me !== true) {
                                console.info("Polygon owned by another user");
                                return;
                            }

                            let featureId = feature.id ?? feature.properties?.feature_id;
                            // =====================================================
                            // 1️⃣ HITUNG DATA GEOMETRI: LUAS, PANJANG, LEBAR
                            // =====================================================
                            const area = turf.area(feature); // meter persegi
                            const bbox = turf.bbox(feature); // [minX, minY, maxX, maxY]
                            const keliling = turf.length(feature, {
                                units: "meters"
                            }); // meter

                            const panjang = turf.distance(
                                [bbox[0], bbox[1]], // (minX, minY)
                                [bbox[2], bbox[1]], // (maxX, minY)
                                {
                                    units: "meters"
                                }
                            );

                            const lebar = turf.distance(
                                [bbox[0], bbox[1]],
                                [bbox[0], bbox[3]], {
                                    units: "meters"
                                }
                            );

                            // =====================================================
                            // 2️⃣ UPDATE WARNA POLYGON 
                            // =====================================================
                            // --- 1. Update warna polygon ---
                            const source = this.mapOffline.getSource(layerId);
                            const data = source._data;
                            // Reset semua polygon ke warna aslinya
                            data.features.forEach(f => {
                                f.properties.is_registered = false;
                            });

                            const clicked = data.features.find(f =>
                                f.id == featureId
                            );
                            if (clicked) {
                                clicked.properties.is_registered = true;
                            }
                            console.log(feature)

                            // Apply kembali ke source
                            this.mapOffline.getSource(layerId).setData(data);
                            this.loading = true;
                            // --- 2. Kirim event ke livewire ---
                            const coordinates = feature.geometry.coordinates;
                            const clickPoint = [e.lngLat.lng, e.lngLat.lat];

                            const polygonData = {
                                feature_id: featureId,
                                polygon: coordinates,
                                clickpoint: clickPoint
                            };
                            @this.set('panjang', panjang.toFixed(2));
                            @this.set('lebar', lebar.toFixed(2));
                            @this.dispatch('dataMapSet', polygonData);
                        });

                        // Cursor hover
                        this.mapOffline.on("mouseenter", layerId, () => {
                            this.mapOffline.getCanvas().style.cursor = "pointer";
                        });

                        this.mapOffline.on("mouseleave", layerId, () => {
                            this.mapOffline.getCanvas().style.cursor = "";
                        });
                    });
                },

                loadOfflineFromLivewire(layers) {
                    this.offlineLayers = layers;
                    this.petaOffline(); // refresh map dengan data terbaru
                },
                rgbaArrayToCss(arr) {
                    // contoh: ['rgba', 255, 0, 0, 0.5] atau ['rgb',255,0,0]
                    if (!Array.isArray(arr) || arr.length < 2) return null;
                    const t = arr[0];
                    if (t === 'rgba' || t === 'rgb') {
                        const nums = arr.slice(1).map(n => Number(n));
                        if (t === 'rgba') return `rgba(${nums[0]}, ${nums[1]}, ${nums[2]}, ${nums[3]})`;
                        return `rgb(${nums[0]}, ${nums[1]}, ${nums[2]})`;
                    }
                    return null;
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

                    console.warn("Tidak bisa baca warna layer:", layerId, val);
                    return null;
                }
            }
        }
    </script>
@endpush
