<?php

namespace App\Actions;

use App\Tenant;

/**
 * Create a tenant with the necessary information for the application.
 * 
 * We don't use a listener here, because we want to be able to create "simplified" tenants in tests.
 * This action is only used when we need to create the tenant properly (with billing logic etc).
 */
class CreateTenantAction
{
    public function __invoke(array $data, string $domain, bool $createStripeCustomer = true): Tenant
    {
        $tenant = Tenant::create($data + [
            'ready' => false,
            'trial_ends_at' => now()->addDays(config('saas.trial_days')),
        ]);

        $tenant->createDomain([
            'domain' => $domain,
        ])->makePrimary()->makeFallback();

        if ($createStripeCustomer) {
            $tenant->createAsStripeCustomer();
        }

        return $tenant;
    }
}