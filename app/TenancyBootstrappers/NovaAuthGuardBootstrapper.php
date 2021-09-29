<?php

namespace App\TenancyBootstrappers;

use Stancl\Tenancy\Contracts\TenancyBootstrapper;
use Stancl\Tenancy\Contracts\Tenant;

class NovaAuthGuardBootstrapper implements TenancyBootstrapper
{
    public function bootstrap(Tenant $tenant)
    {
        config(['nova.guard' => 'web']);
    }

    public function revert()
    {
        config(['nova.guard' => 'admin']);
    }
}
