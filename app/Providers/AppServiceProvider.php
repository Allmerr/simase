<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('isPeserta', function (User $user) {
            return $user->role === 'peserta';
        });


        Gate::define('isHasSurvey', function (User $user) {

            if($user->role !== 'peserta'){
                return false;
            }

            if(auth()->user()->status_peserta()->where('tanggal_surveilan', '!=', null)->where('sudah_servey', 'belum')->get()->count() > 0){

                $berapaJumlahSurveyYangBelumDiIsi = 0;
                $belumSurvey = auth()->user()->status_peserta()->where('tanggal_surveilan', '!=', null)->where('sudah_servey', 'belum')->get();

                foreach ($belumSurvey as $key => $value) {
                    if($value->hasSurveyPassed()){
                        $berapaJumlahSurveyYangBelumDiIsi += 1;
                    }
                }

                if($berapaJumlahSurveyYangBelumDiIsi > 0){
                    return true;
                }

                return false;

            }else{

                return false;
                
            }

        });

    }
}