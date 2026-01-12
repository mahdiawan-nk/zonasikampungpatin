<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\DataKolam;
use App\Models\DataSeeding;
use App\Models\DataEstimasiPanen as DataPanen;
use App\Models\MapFeature;
use Carbon\Carbon;

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
        return DataSeeding::query()
            ->when(!$this->isAdminData(), function ($query) {
                $query->whereHas('kolam', function ($q) {
                    $q->where('user_id', auth()->id());
                });
            })
            ->whereNotNull('estimated_days')
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

        $getEstimasi = function (int $hari) use ($today) {
            $targetDate = $today->copy()->addDays($hari)->format('Y-m-d');
            return DataSeeding::query()
                ->with('kolam')
                ->when(!$this->isAdminData(), function ($query) {
                    $query->whereHas('kolam', function ($q) {
                        $q->where('user_id', auth()->id());
                    });
                })
                ->whereRaw(
                    "DATE_ADD(tanggal_penebaran, INTERVAL estimated_days DAY) = ?",
                    [$targetDate]
                )
                ->orderBy('tanggal_penebaran')
                ->limit(5)
                ->get();
        };
        $data = [
            'H-14' => $getEstimasi(14),
            'H-7' => $getEstimasi(7),
            'H-3' => $getEstimasi(3),
        ];

        return $data;
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
