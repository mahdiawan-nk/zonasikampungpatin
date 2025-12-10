<form wire:submit.prevent="store" class="space-y-6">
    <div>
        <flux:heading size="lg">Tambahkan Pengguna Baru</flux:heading>
    </div>
    <flux:field>
        <flux:label>Nama Pengguna</flux:label>
        <flux:input wire:model="name" placeholder="example.com" />
        <flux:error name="name" />
    </flux:field>

    <flux:field>
        <flux:label>Email Pengguna</flux:label>
        <flux:input wire:model="email" placeholder="example.com" />
        <flux:error name="email" />
    </flux:field>

    <flux:field>
        <flux:label>Role</flux:label>
        <flux:radio.group wire:model="role" variant="segmented">
            <flux:radio value="Administrator" label="Administrator" />
            <flux:radio value="Pemilik Kolam" label="Pemilik Kolam" />
        </flux:radio.group>
        <flux:error name="role" />
    </flux:field>

    <flux:field>
        <flux:label>Password</flux:label>
        <flux:input wire:model="password" placeholder="1234576" type="password" />
        <flux:error name="password" />
    </flux:field>

    <div class="flex gap-2">
        <flux:spacer />
        <flux:button type="button" variant="filled">Batal</flux:button>
        <flux:button type="submit" variant="primary">Simpan</flux:button>
    </div>
</form>
