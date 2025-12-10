<div class="space-y-6 mt-10">

    {{-- Top Toolbar --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 items-center">

        {{-- Add Button --}}
        <div>
            <a href="{{ route('kolam.create') }}" wire:navigate
                class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition w-full md:w-auto">
                + Tambah
            </a>
        </div>

        {{-- Search --}}
        <div>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari data kolam..."
                class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600">
        </div>

        {{-- Per Page --}}
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 dark:bg-gray-800">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-700">No</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Nama Kolam</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Detail Kolam</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Status Kolam</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Pemilik</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($data as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-3">
                            {{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}
                        </td>
                        <td class="px-4 py-3">{{ $item->nama_kolam }}</td>
                        <td class="px-4 py-3 w-55">
                            <div class="space-y-2 w-50">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-white">Panjang</span>
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ $item->panjang }} m
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-white">Lebar</span>
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ $item->lebar }} m
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-white">Kedalaman</span>
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ $item->kedalaman }} m
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-white">Kapasitas</span>
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ $item->kapasitas }} ekor
                                    </span>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-3">{{ $item->status }}</td>
                        <td class="px-4 py-3">{{ $item->user->name }}</td>

                        <td class="px-4 py-3">
                            <flux:button variant="ghost" square href="{{ route('kolam.update',['id'=>$item->id]) }}" wire:navigate>
                                <flux:icon.pencil-square class="text-blue-500 w-5 h-5" />
                            </flux:button>
                            <flux:button variant="ghost" square wire:click="openDelete({{ $item->id }})">
                                <flux:icon.trash class="text-red-500 w-5 h-5" />
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            Tidak ada data ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pt-3">
        {{ $data->onEachSide(0)->links(data: ['scrollTo' => false]) }}
    </div>
    
  
    <flux:modal name="delete-kolam" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete data?</flux:heading>
                <flux:text class="mt-2">
                    You're about to delete this data.<br>
                    This action cannot be reversed.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="deleteData">Delete data</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
