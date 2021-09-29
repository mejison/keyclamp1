<?php

namespace Tests;

use App\Actions\CreateTenantAction;
use App\Tenant;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Most tests don't need this. Unless they test the billing page.
     *
     * @var boolean
     */
    protected $createStripeCustomer = false;

    public function setUp(): void
    {
        parent::setUp();

        config(['tenancy.database.prefix' => 'test_tenant']);
    }

    protected function createTenant(array $data = [], string $domain = null, bool $createStriperCustomer = null): Tenant
    {
        $domain = $domain ?? Str::random('10');
        return (new CreateTenantAction)(array_merge([
            'company' => 'Foo company',
            'name' => 'John Doe',
            'email' => 'foo@tenant.localhost',
            'password' => bcrypt('password'),
        ], $data), $domain, $createStriperCustomer ?? $this->createStripeCustomer);
    }
}
