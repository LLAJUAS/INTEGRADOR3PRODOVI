<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Brief;
use App\Policies\BriefPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Brief::class => BriefPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}