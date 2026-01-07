<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\DataKolam;
use App\Models\DataSeeding;
use App\Models\DataEstimasiPanen as DataPanen;
use App\Models\MapFeature;
use Illuminate\Support\Carbon;
class Dashboard extends Component
{
    protected function isAdminData()
    {
        return auth()->user()->role == 'Administrator';
    }
    public function getUserProperty()
    {
        return User::where('role', 'Pemilik Kolam')->count();
    }

    public function getKolamInMapProperty()
    {
        return MapFeature::where('geometry_type', 'Polygon')->count();
    }

    public function getKolamInMapNotTerdaftarProperty()
    {
        $dataKolam = DataKolam::get()->pluck('feature_id')->toArray();
        return MapFeature::where('geometry_type', 'Polygon')->whereNotIn('feature_id', $dataKolam)->count();
    }

    public function getKolamInMapTerdaftarProperty()
    {
        $dataKolam = DataKolam::get()->pluck('feature_id')->toArray();
        return MapFeature::where('geometry_type', 'Polygon')->whereIn('feature_id', $dataKolam)->count();
    }

    public function getKolamAktifProperty()
    {

        return DataKolam::query()
            ->when(!$this->isAdminData(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->where('status', 'Aktif')
            ->count();
    }

    public function getKolamRusakProperty()
    {
        return DataKolam::query()
            ->when(!$this->isAdminData(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->where('status', 'Rusak')
            ->count();

    }

    public function getSeedingProperty()
    {
        return DataSeeding::query()
            ->with('kolam')
            ->when(!$this->isAdminData(), function ($query) {
                return $query->whereHas('kolam', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            })
            ->count();
    }

    public function getPanenProperty()
    {
        return DataPanen::query()
            ->with('dataSeeding.kolam')
            ->when(!$this->isAdminData(), function ($query) {
                return $query->whereHas('dataSeeding', function ($query) {
                    $query->whereHas('kolam', function ($query) {
                        $query->where('user_id', auth()->id());
                    });
                });
            })
            ->count();
    }

    public function getKolamActivityProperty()
    {
        return DataKolam::with('user')->latest()->take(5)->get();
    }

    public function getUserActivityProperty()
    {
        return User::where('last_login', '!=', null)->take(5)->get();
    }

    public function getMyKolamProperty()
    {
        return DataKolam::where('user_id', auth()->id())->count();
    }

    public function getEstimateHighlightProperty()
    {
        $today = Carbon::today();

        // H-14
        $h14 = $today->copy()->addDays(14)->format('Y-m-d');
        $estimasiH14 = DataPanen::with('dataSeeding')
            ->when(!$this->isAdminData(), function ($query) {
                return $query->whereHas('dataSeeding', function ($query) {
                    $query->whereHas('kolam', function ($query) {
                        $query->where('user_id', auth()->id());
                    });
                });
            })
            ->whereDate('estimated_harvest_date', $h14)
            ->orderBy('estimated_harvest_date', 'asc')
            ->limit(5)
            ->get();

        // H-7
        $h7 = $today->copy()->addDays(7)->format('Y-m-d');
        $estimasiH7 = DataPanen::with('dataSeeding')
            ->when(!$this->isAdminData(), function ($query) {
                return $query->whereHas('dataSeeding', function ($query) {
                    $query->whereHas('kolam', function ($query) {
                        $query->where('user_id', auth()->id());
                    });
                });
            })
            ->whereDate('estimated_harvest_date', $h7)
            ->orderBy('estimated_harvest_date', 'asc')
            ->limit(5)
            ->get();

        // H-3
        $h3 = $today->copy()->addDays(3)->format('Y-m-d');
        $estimasiH3 = DataPanen::with('dataSeeding')
            ->when(!$this->isAdminData(), function ($query) {
                return $query->whereHas('dataSeeding', function ($query) {
                    $query->whereHas('kolam', function ($query) {
                        $query->where('user_id', auth()->id());
                    });
                });
            })
            ->whereDate('estimated_harvest_date', $h3)
            ->orderBy('estimated_harvest_date', 'asc')
            ->limit(5)
            ->get();
        return [
            'H-14' => $estimasiH14,
            'H-7' => $estimasiH7,
            'H-3' => $estimasiH3,
        ];
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
