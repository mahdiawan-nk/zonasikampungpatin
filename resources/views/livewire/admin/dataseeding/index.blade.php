<div class="space-y-6 mt-10">

    {{-- Top Toolbar --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 items-center">

        {{-- Add Button --}}
        <div>
            <button wire:click="openCreate()"
                class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition w-full md:w-auto">
                + Tambah
            </button>
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
                    <th class="px-4 py-3 font-medium text-gray-700">Tanggal Tebar</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Kolam</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Jenis Benih</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Jumlah</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Berat Rata Rata</th>
                    <th class="px-4 py-3 font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($data as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-3">
                            {{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}
                        </td>
                        <td class="px-4 py-3">{{ $item->tanggal_penebaran }}</td>
                        <td class="px-4 py-3">{{ $item->kolam->nama_kolam }}</td>
                        <td class="px-4 py-3">{{ $item->jenis_benih }}</td>
                        <td class="px-4 py-3">{{ $item->jumlah_ikan }}</td> 
                        <td class="px-4 py-3">{{ $item->berat_rata_rata }}</td>

                        <td class="px-4 py-3">
                            <flux:button variant="ghost" square wire:click="openUpdate({{ $item->id }})">
                                <flux:icon.pencil-square class="text-blue-500 w-5 h-5" />
                            </flux:button>
                            <flux:button variant="ghost" square wire:click="openDelete({{ $item->id }})">
                                <flux:icon.trash class="text-red-500 w-5 h-5" />
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">
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


    <flux:modal name="create-seeding" class="md:w-1/2">
        <livewire:admin.dataseeding.create wire:key="create-form" />
    </flux:modal>
    {{-- @if ($showUpdate) --}}
    <flux:modal wire:show="showUpdate" name="update-seeding" class="md:w-1/2">
        <livewire:admin.dataseeding.update wire:key="update-form-{{ $selectedId }}" :seedingId="$selectedId" />
    </flux:modal>
    <flux:modal name="delete-seeding" class="min-w-[22rem]">
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
