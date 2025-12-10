<?php $__env->startPush('styles'); ?>
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
        <section class="mt-25" x-data="petaOfflineComponent()" x-init="init()">
            <div id="legend" class="absolute top-18 left-4 bg-white shadow-lg rounded-sm p-2 z-50 text-sm">
                <h3 class="font-semibold mb-2 dark:text-slate-900">Legenda</h3>
                <div id="legend-items"></div>
            </div>
            <div id="map"class="mt-17" wire:ignore></div>
            <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
                x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
                class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                <!-- Modal Dialog -->
                <div x-show="modalIsOpen"
                    x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                    x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                    class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                    <!-- Dialog Header -->
                    <div
                        class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                        <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white">
                            Special Offer</h3>
                        <button x-on:click="modalIsOpen = false" aria-label="close modal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Dialog Body -->
                    <div class="px-4 py-8">
                        <p>As a token of appreciation, we have an exclusive offer just for you. Upgrade your account now to
                            unlock premium features and enjoy a seamless experience.</p>
                    </div>
                    <!-- Dialog Footer -->
                    <div
                        class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">
                        <button x-on:click="modalIsOpen = false" type="button"
                            class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:text-neutral-300 dark:focus-visible:outline-white">Remind
                            me later</button>
                        <button x-on:click="modalIsOpen = false" type="button"
                            class="whitespace-nowrap rounded-sm bg-black border border-black dark:border-white px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Upgrade
                            Now</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php $__env->startPush('scripts'); ?>
        <script src="https://api.mapbox.com/mapbox-gl-js/v3.17.0-beta.1/mapbox-gl.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
        <script>
            function petaOfflineComponent() {
                return {
                    mapOffline: null,
                    offlineLayers: <?php echo json_encode($offlineLayers, 15, 512) ?>,
                    center: [100.84915003253047, 0.3313522113222831],
                    accessToken: 'pk.eyJ1IjoiZGV2LWNvZGVycyIsImEiOiJja3l4YmM1YnQwZ3VrMndwOGFpcnhobGtpIn0.K-67FDARYgR7zEXLSbR4bg',
                    legendItems: [],
                    targets: [],
                    loading: false,
                    modalIsOpen: false,
                    init() {
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
                            this.renderLegendMap();
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
                                paint: JSON.parse(layer.paint)
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
                                        label: f.properties?.name ?? f.properties?.feature_id ??
                                            "Polygon", // pilih label dari properties
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
                    clickPolygonMaps() {
                        // Loop semua layer offline
                        this.offlineLayers.forEach(layer => {
                            const layerId = layer.id;

                            // Tangkap klik pada layer polygon
                            this.mapOffline.on("click", layerId, (e) => {
                                const feature = e.features?.[0];

                                if (!feature) {
                                    console.warn("No feature clicked");
                                    return;
                                }
                                this.modalIsOpen = true;

                                let featureId = feature.id ?? feature.properties?.feature_id;

                                // =====================================================
                                // 2️⃣ UPDATE WARNA POLYGON 
                                // =====================================================
                                // --- 1. Update warna polygon ---
                                const newColor = "#ef4444"; // merah
                                const source = this.mapOffline.getSource(layerId);
                                const data = source._data;
                                // Reset semua polygon ke warna aslinya
                                const clicked = data.features.find(f =>
                                    f.id == featureId
                                );
                                if (clicked) {
                                    // clicked.properties.is_kolam = 1;
                                }

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
    <?php $__env->stopPush(); ?><?php /**PATH /var/www/html/resources/views/livewire/website/petazonasi.blade.php ENDPATH**/ ?>