<form wire:submit.prevent="store" class="space-y-6">
    <div>
        <flux:heading size="lg">Tambahkan Calculation Panen</flux:heading>
    </div>
    <flux:field>
        <flux:label>Seeding Data</flux:label>
        <flux:select wire:model="data_seeding_id" placeholder="Choose a seeding data">
            @foreach ($this->getSeedingsProperty() as $seeding)
                <flux:select.option value="{{ $seeding->id }}">{{ $seeding->jenis_benis }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:error name="data_seeding_id" />
    </flux:field>
    <flux:field>
        <flux:label>Tanggal Tebar Benih</flux:label>
        <flux:input wire:model="tanggal_penebaran" type="date" />
        <flux:error name="tanggal_penebaran" />
    </flux:field>
    <flux:field>
        <flux:label>Jenis Benih</flux:label>
        <flux:input wire:model="jenis_benih" placeholder="Masukkan jenis benih" />
        <flux:error name="jenis_benih" />
    </flux:field>
    <flux:field>
        <flux:label>Jumlah Ikan</flux:label>
        <flux:input wire:model="jumlah_ikan" type="number" placeholder="Masukkan jumlah ikan" />
        <flux:error name="jumlah_ikan" />
    </flux:field>
    <flux:field>
        <flux:label>Berat Rata Rata (gram)</flux:label>
        <flux:input wire:model="berat_rata_rata" type="number" placeholder="Masukkan berat rata rata ikan" />
        <flux:error name="berat_rata_rata" />
    </flux:field>
    <flux:field>
        <flux:label>SGR Value</flux:label>
        <flux:input wire:model="sgr" type="number" placeholder="Masukkan sgr ikan" />
        <flux:error name="sgr" />
    </flux:field>
    <flux:field>
        <flux:label>Target Weight</flux:label>
        <flux:input wire:model="target_weight" type="number" placeholder="Masukkan target weight ikan" />
        <flux:error name="target_weight" />
    </flux:field>

    <flux:field>
        <flux:label>Estimated Day</flux:label>
        <flux:input wire:model="estimated_days" type="text" />
        <flux:error name="estimated_days" />
    </flux:field>

    <flux:field>
        <flux:label>Estimated Date</flux:label>
        <flux:input wire:model="estimated_harvest_date" type="date" />
        <flux:error name="target_weight" />
    </flux:field>

    <div class="flex gap-2">
        <flux:spacer />
        <flux:button type="button" variant="filled">Batal</flux:button>
        <flux:button type="submit" variant="primary">Simpan</flux:button>
    </div>
</form>
