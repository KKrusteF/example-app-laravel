<?php

namespace App\Providers;

use App\Http\Controllers\AdminPostController;
use App\Http\Middleware\EnsureUserHasRole;
use App\Models\User;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function () {
            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us14'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();

        Blade::if('admin', function () {
            return auth()->user()->role == 'admin';
        });

//        Gate::define('admin', function (User $user) {
//            return $user->username === 'KrusteF';
//        });
    }
}
