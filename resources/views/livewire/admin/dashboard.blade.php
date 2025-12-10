<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-4">
        <x-widgets.stat-card label="Total Pemilik Kolam" value="{{ $this->getUserProperty() }}" icon="heroicon-o-users"
            color="indigo-800" color="indigo" sizeIcon="8" />
        <x-widgets.stat-card label="Total Kolam Di Peta" value="{{ $this->getKolamInMapProperty() }}"
            icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
        <x-widgets.stat-card label="Total Kolam Di Peta Belum Terdata"
            value="{{ $this->getKolamInMapNotTerdaftarProperty() }}" icon="heroicon-o-cube" color="indigo-800"
            color="indigo" sizeIcon="8" />
        <x-widgets.stat-card label="Total Kolam Di Peta Terdata" value="{{ $this->getKolamInMapTerdaftarProperty() }}"
            icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
        <x-widgets.stat-card label="Total Kolam Aktif" value="{{ $this->getKolamAktifProperty() }}"
            icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
        <x-widgets.stat-card label="Total Kolam Rusak" value="{{ $this->getKolamRusakProperty() }}"
            icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
        <x-widgets.stat-card label="Total Penebaran Benih" value="{{ $this->getSeedingProperty() }}"
            icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
        <x-widgets.stat-card label="Total Estimasi Panen" value="{{ $this->getPanenProperty() }}" icon="heroicon-o-cube"
            color="indigo-800" color="indigo" sizeIcon="8" />
    </div>
    <div class="relative h-full flex-1 overflow-hidden">

        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            <div class="flex-col space-y-4">
                <x-widgets.table title="Kolam Baru Ditambahkan" :headers="['Nama Kolam', 'Pemilik', 'Status', 'Dibuat Pada']" :data="$this->getKolamActivityProperty()" :fields="['nama_kolam', 'user.name', 'status', 'created_at']" />
                <x-widgets.table title="Pengguna Activity Login" :headers="['Nama Pengguna', 'Email', 'Role', 'Login Terakhir']" :data="$this->getUserActivityProperty()" :fields="['name', 'email', 'role', 'last_login']" />
            </div>

        </div>
    </div>
</div>
