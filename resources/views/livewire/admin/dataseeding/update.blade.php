<form wire:submit.prevent="update" class="space-y-6">
    <div>
        <flux:heading size="lg">Tambahkan Penebaran Benih</flux:heading>
    </div>
    <flux:field>
        <flux:label>Kolam</flux:label>
        <flux:select wire:model="data_kolam_id" placeholder="Choose a kolam" disabled>
            @foreach ($this->getKolamsProperty() as $kolam)
                <flux:select.option value="{{ $kolam->id }}">{{ $kolam->nama_kolam }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:error name="data_kolam_id" />
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
        <flux:input wire:model="berat_rata_rata" type="text" placeholder="Masukkan berat rata rata ikan" />
        <flux:error name="berat_rata_rata" />
    </flux:field>
    <flux:field>
        <flux:label>Estimasi Hari</flux:label>
        <flux:input wire:model.live.debounce.350ms="estimated_days" type="number" placeholder="Masukkan estimasi hari" />
        <flux:error name="estimated_days" />
    </flux:field>
    <flux:field>
        <flux:label>Estimasi Tanggal Panen</flux:label>
        <flux:input wire:model="estimated_harvest_date" type="date" readonly/>
        <flux:error name="estimated_harvest_date" />
    </flux:field>

    <flux:field>
        <flux:label>Keterangan</flux:label>
        <flux:textarea wire:model="keterangan" placeholder="Masukkan keterangan" />
        <flux:error name="keterangan" />
    </flux:field>

    <div class="flex gap-2">
        <flux:spacer />
        <flux:button type="button" variant="filled">Batal</flux:button>
        <flux:button type="submit" variant="primary">Simpan</flux:button>
    </div>
</form>
