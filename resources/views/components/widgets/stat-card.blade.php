@props(['label', 'value', 'icon' => null, 'color' => 'blue', 'sizeIcon' => 6])

<div
    class="p-4 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm transition-colors hover:shadow-md">
    <div class="flex items-center justify-between">

        {{-- Label & Value --}}
        <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $label }}</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">{{ $value }}</h3>
        </div>

        {{-- Icon --}}
        @if ($icon)
            <div @class([
                'p-3 rounded-lg',
                'bg-' .
                $color .
                '-100 text-' .
                $color .
                '-600 dark:bg-' .
                $color .
                '-600 dark:text-' .
                $color .
                '-100',
            ])>
                <x-dynamic-component :component="$icon" class="w-{{ $sizeIcon }} h-{{ $sizeIcon }} text-blue-600 dark:text-gray-800" />
            </div>
        @endif

    </div>
</div>
