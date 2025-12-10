<?php $__env->startPush('styles'); ?>
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.17.0-beta.1/mapbox-gl.css" rel="stylesheet">
<?php $__env->stopPush(); ?>
<div>
    <div class="relative flex flex-row gap-3" x-data="mapboxComponent()" x-init="initMap($wire.entangle('offlineLayers'))"
        x-on:mounted.window="
    alert('offline event diterima');
" x-on:sync-finished.window="refreshOfflineMap()"
        x-on:offline-layers-updated.window="loadOfflineFromLivewire($event.detail.layers)">
        <div class="w-6/12 bg-gray-800 rounded-lg">
            <div class="p-3">
                <h2 class="text-2xl font-semibold dark:text-white">Peta MapBox</h2>
            </div>
            
            <div id="legend"
                class="absolute top-20 left-4 bg-white shadow-xl rounded-md p-3 z-50 text-sm border border-gray-200">
                <h3 class="font-semibold mb-2 dark:text-slate-900">Legenda</h3>
                <div id="legend-items" class="dark:text-slate-900"></div>
            </div>

            
            <div id="map" class="w-full h-[100vh] overflow-hidden" wire:ignore></div>
        </div>
        <div class="w-1/12 flex items-center justify-center">
            <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['icon' => 'arrow-path','xOn:click' => 'startSync']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'arrow-path','x-on:click' => 'startSync']); ?>Sync <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
            <div x-show="loading" x-cloak class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
                style="backdrop-filter: blur(2px);">
                <div class="bg-white rounded-lg p-6 w-72 shadow-xl text-center">
                    <div
                        class="animate-spin h-10 w-10 border-4 border-gray-300 border-t-blue-600 rounded-full mx-auto mb-4">
                    </div>
                    <p class="font-semibold text-gray-800">Syncing data...</p>
                    <p class="text-gray-500 text-sm mt-1">Harap tunggu sebentar.</p>
                </div>
            </div>
        </div>
        <div class="w-6/12 bg-gray-800 rounded-lg">
            <div class="p-3">
                <h2 class="text-2xl font-semibold dark:text-white">Peta Offline</h2>
            </div>

            <div id="map-offline" class="w-full h-[100vh] overflow-hidden" wire:ignore></div>
        </div>
    </div>

</div>

<script src="https://api.mapbox.com/mapbox-gl-js/v3.17.0-beta.1/mapbox-gl.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('mounted', () => {
            // mapboxComponent('aa').init();
        });
    });

    function mapboxComponent() {
        return {
            hasInit: false,
            map: null,
            mapOffline: null,
            offlineLayers: [],
            center: [100.84915003253047, 0.3313522113222831],
            accessToken: 'pk.eyJ1IjoiZGV2LWNvZGVycyIsImEiOiJja3l4YmM1YnQwZ3VrMndwOGFpcnhobGtpIn0.K-67FDARYgR7zEXLSbR4bg',
            legendItems: [],
            loading: false,

            startSync() {
                this.loading = true;
                this.sync();
            },
            initMap(data) {
                // console.log(data.initialValue)
                this.loadOfflineFromLivewire(data.initialValue);
                Livewire.on('syncFinished', () => {
                    this.loading = false;
                });

                Livewire.on('offlineLayersUpdated', (event) => {
                    this.loadOfflineFromLivewire(event.layers);
                    setTimeout(() => {
                        this.refreshOfflineMap();
                        // this.loading = false;
                    }, 1000);
                });
                this.petaMapbox();
                this.petaOffline();
            },
            petaMapbox() {
                mapboxgl.accessToken = this.accessToken;
                this.map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/dev-coders/cmhdarx9o002n01s9hv5911ha',
                    center: this.center,
                    zoom: 14
                });
                this.map.addControl(new mapboxgl.NavigationControl());

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

                if (!document.getElementById('legend')) {
                    const legendEl = document.createElement('div');
                    legendEl.id = 'legend';
                    legendEl.className = 'absolute top-4 left-4 bg-white shadow-lg rounded-lg p-4 z-50 text-sm';
                    legendEl.innerHTML = '<h3 class="font-semibold mb-2">Legenda</h3><div id="legend-items"></div>';
                    document.body.appendChild(legendEl);
                }

                this.map.on('load', () => {
                    const legendContainer = document.getElementById('legend-items');
                    legendContainer.innerHTML = '';

                    this.legendItems.forEach(item => {
                        const color = this.getLayerColor(this.map, item.id);

                        const displayColor = color || '#cccccc';

                        const styleLayer = this.map.getStyle().layers.find(l => l.id === item.id);
                        const kind = styleLayer ? styleLayer.type : 'fill';
                        const el = document.createElement('div');
                        el.className = 'flex items-center space-x-2 mb-1';
                        console.log(color)

                        if (kind === 'line') {
                            el.innerHTML = `
                                        <span style="display:inline-block;width:28px;height:6px;background:${displayColor};border:1px solid #0003"></span>
                                        <span>${item.label}</span>
                                    `;
                        } else {
                            // default fill / circle
                            el.innerHTML = `
                                        <span style="display:inline-block;width:16px;height:16px;background:${displayColor};border:1px solid #0003;border-radius:3px"></span>
                                        <span>${item.label}</span>
                                    `;
                        }

                        legendContainer.appendChild(el);
                    });
                });
            },
            petaOffline() {
                mapboxgl.accessToken = this.accessToken;
                if (this.mapOffline) {
                    this.mapOffline.remove();
                    this.mapOffline = null;
                }
                this.mapOffline = new mapboxgl.Map({
                    container: 'map-offline',
                    style: 'mapbox://styles/mapbox/standard-satellite',
                    center: this.center,
                    zoom: 14
                });
                this.mapOffline.addControl(new mapboxgl.NavigationControl());

                this.mapOffline.on('load', () => {
                    this.renderOfflineLayers();
                });
            },
            loadOfflineFromLivewire(layers) {
                this.offlineLayers = layers;
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
                });
            },
            refreshOfflineMap() {
                this.petaOffline();
            },
            sync() {

                const allLayers = []
                const layersMapbox = this.map.getStyle().layers;

                layersMapbox.forEach(layer => {
                    // Lewati layer yang tidak punya source atau source-layer
                    if (!layer.source || !layer['source-layer']) return;


                    const vtFeatures = this.map.querySourceFeatures(layer.source, {
                        sourceLayer: layer['source-layer']
                    });

                    if (vtFeatures.length === 0) return;

                    const geojson = {
                        type: 'FeatureCollection',
                        features: vtFeatures.map((f, index) => ({
                            type: 'Feature',
                            id: index + 1,
                            geometry: f.geometry,
                            properties: f.properties
                        }))
                    };

                    const groupedLayers = {
                        layer_id: layer.id,
                        layer_name: layer['source-layer'],
                        layer_type: layer.type,
                        source_name: layer.source,
                        source_layer: layer['source-layer'],
                        paint: layer.paint,
                        features: geojson,
                    }
                    allLayers.push(groupedLayers);

                });
                Livewire.dispatch('petaCreated', {
                    payload: allLayers,
                })
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
<?php /**PATH /var/www/html/resources/views/livewire/admin/peta/index.blade.php ENDPATH**/ ?>