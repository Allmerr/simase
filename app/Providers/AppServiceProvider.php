<?php

namespace App\Providers;

use App\Models\User;
use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

use Config;

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
        if (\Schema::hasTable('email_configuration')) {
            $mailsetting = EmailConfiguration::first();
            if($mailsetting){

                config(['mail.default' => $mailsetting->protocol]);
                config(['mail.mailers.smtp.host' => $mailsetting->host]);
                config(['mail.mailers.smtp.port' => $mailsetting->port]);
                config(['mail.mailers.smtp.encryption' => $mailsetting->tls]);
                config(['mail.mailers.smtp.username' => $mailsetting->username]);
                config(['mail.mailers.smtp.password' => $mailsetting->password]);
                config(['mail.mailers.form.address' => $mailsetting->email]);
                config(['mail.mailers.form.name' => 'simase']);

            }
        }

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