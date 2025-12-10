<x-layouts.app.sidebar :title="$title ?? null">
    @stack('styles')
    <flux:main>
        {{ $slot }}
    </flux:main>
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.17.0-beta.1/mapbox-gl.js"></script>
    @stack('scripts')
    <script>
        document.addEventListener('livewire:navigated', () => {
            if (typeof window.initMapbox === 'function') {
                window.initMapbox();
            }
        });
    </script>
</x-layouts.app.sidebar>
