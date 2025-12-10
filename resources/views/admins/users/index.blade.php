<x-layouts.app :title="__('User')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="w-full bg-white shadow-sm rounded-xl p-4 border border-gray-200 dark:border-gray-700 dark:bg-gray-800">

            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="#"><span class="dark:text-withe">Home</span></flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Data Pengguna</flux:breadcrumbs.item>
            </flux:breadcrumbs>

        </div>
        <livewire:admin.user.index />
    </div>
</x-layouts.app>
