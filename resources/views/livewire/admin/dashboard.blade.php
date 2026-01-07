<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="w-full">
        <!-- Welcome Card -->
        <div
            class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg p-6 flex flex-col md:flex-row items-center justify-between gap-6 animate-fadeIn">

            <!-- Kiri: Icon + Greeting -->
            <div class="flex items-center gap-4">
                <!-- Icon / Illustration -->
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-20 w-20">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12.75 19.5v-.75a7.5 7.5 0 0 0-7.5-7.5H4.5m0-6.75h.75c7.87 0 14.25 6.38 14.25 14.25v.75M6 18.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </div>
                <!-- Greeting Text -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold">Selamat Datang, <span
                            class="underline decoration-white/50">{{ auth()->user()->name }}</span>!</h2>
                    <p class="mt-2 text-white/80">Semoga hari ini produktif! Lihat ringkasan aktivitasmu di dashboard.
                    </p>
                    <!-- Quick Actions -->
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="{{ route('kolam.index') }}" wire:navigate
                            class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded-lg shadow hover:bg-indigo-50 transition">Mulai
                            Aktivitas</a>
                    </div>
                </div>
            </div>

            <!-- Kanan: Hari, Tanggal, Jam -->
            <div x-data="clock()" class="text-right flex flex-col items-end space-y-1">
                <div class="text-lg font-semibold" x-text="day"></div>
                <div class="text-sm" x-text="date"></div>
                <div class="text-2xl font-mono" x-text="time"></div>
            </div>
        </div>
    </div>
    <div class="grid auto-rows-min gap-6 md:grid-cols-3">
        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            @if (auth()->user()->role === 'Administrator')
                <x-widgets.stat-card label="Total Pemilik Kolam" value="{{ $this->getUserProperty() }}"
                    icon="heroicon-o-users" color="indigo-800" color="indigo" sizeIcon="8" />
                <x-widgets.stat-card label="Total Kolam Di Peta" value="{{ $this->getKolamInMapProperty() }}"
                    icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
                <x-widgets.stat-card label="Total Kolam Di Peta Belum Terdata"
                    value="{{ $this->getKolamInMapNotTerdaftarProperty() }}" icon="heroicon-o-cube" color="indigo-800"
                    color="indigo" sizeIcon="8" />
                <x-widgets.stat-card label="Total Kolam Di Peta Terdata"
                    value="{{ $this->getKolamInMapTerdaftarProperty() }}" icon="heroicon-o-cube" color="indigo-800"
                    color="indigo" sizeIcon="8" />
            @endif
            @if (auth()->user()->role === 'Pemilik Kolam')
                <x-widgets.stat-card label="Total Kolam Saya" value="{{ $this->getMyKolamProperty() }}"
                    icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
            @endif
            <x-widgets.stat-card label="Total Kolam Aktif" value="{{ $this->getKolamAktifProperty() }}"
                icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
            <x-widgets.stat-card label="Total Kolam Rusak" value="{{ $this->getKolamRusakProperty() }}"
                icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
            <x-widgets.stat-card label="Total Penebaran Benih" value="{{ $this->getSeedingProperty() }}"
                icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
            <x-widgets.stat-card label="Total Estimasi Panen" value="{{ $this->getPanenProperty() }}"
                icon="heroicon-o-cube" color="indigo-800" color="indigo" sizeIcon="8" />
        </div>
        <div class="col-span-2 relative h-full flex-1 overflow-hidden">

            <div class="grid auto-rows-min gap-4 md:grid-cols-1">

                @if (auth()->user()->role === 'Administrator')
                    <x-widgets.table title="Kolam Baru Ditambahkan" :headers="['Nama Kolam', 'Pemilik', 'Status', 'Dibuat Pada']" :data="$this->getKolamActivityProperty()"
                        :fields="['nama_kolam', 'user.name', 'status', 'created_at']" />
                    <x-widgets.table title="Pengguna Activity Login" :headers="['Nama Pengguna', 'Email', 'Role', 'Login Terakhir']" :data="$this->getUserActivityProperty()"
                        :fields="['name', 'email', 'role', 'last_login']" />
                @endif
                <x-widgets.higligth-list :estimasi="$this->getEstimateHighlightProperty()" />
            </div>
        </div>
    </div>

</div>
<script>
    function clock() {
        return {
            day: '',
            date: '',
            time: '',
            init() {
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const updateClock = () => {
                    const now = new Date();
                    this.day = days[now.getDay()];
                    this.date = now.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                    this.time = now.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    });
                }
                updateClock();
                setInterval(updateClock, 1000);
            }
        }
    }
</script>
