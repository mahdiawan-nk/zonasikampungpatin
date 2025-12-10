@push('styles')
    @stack('styles')
@endpush
<x-layouts.app.landing :title="$title ?? null">
    {{ $slot }}
</x-layouts.app.landing>
@push('scripts')
    @stack('scripts')
@endpush
