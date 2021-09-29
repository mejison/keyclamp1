<?php

namespace Tests\Feature\Central;

use App\Exceptions\NoPrimaryDomainException;
use App\Tenant;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Events\TenantCreated;
use Tests\TestCase;

class PrimaryDomainTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        // Prevent tenant databases from being created
        Event::fake([TenantCreated::class]);

        Route::get('/foo/{bar}', [
            'as' => 'foo',
            'action' => function ($bar) {
                return $bar;
            }
        ]);
    }

    /** @test */
    public function tenant_has_one_primary_domain()
    {
        $tenant = factory(Tenant::class)->create();
        $domain = $tenant->createDomain([
            'domain' => 'acme',
        ]);

        $this->assertNull($tenant->primary_domain);

        $domain->makePrimary();

        $this->assertTrue($domain->is($tenant->primary_domain));
    }

    /** @test */
    public function making_a_domain_primary_will_make_previous_primary_domains_secondary()
    {
        $tenant = factory(Tenant::class)->create();
        $foo = $tenant->createDomain([
            'domain' => 'foo',
            'is_primary' => true,
        ]);

        $bar = $tenant->createDomain([
            'domain' => 'bar',
        ]);

        $this->assertSame('foo', $tenant->primary_domain->domain);

        $bar->makePrimary();

        $this->assertSame('bar', $tenant->primary_domain->domain);
        $this->assertSame(false, $foo->refresh()->is_primary);
        $this->assertSame(true, $bar->refresh()->is_primary);
    }

    /** @test */
    public function tenant_routes_are_generated_using_the_primary_domain()
    {
        $tenant = factory(Tenant::class)->create();
        $domain = $tenant->createDomain([
            'domain' => 'acme.localhost',
        ]);

        $domain->makePrimary();

        $this->assertSame(
            'http://acme.localhost/foo/xyz',
            $tenant->route('foo', ['bar' => 'xyz'])
        );
    }

    /** @test */
    public function a_primary_domain_is_needed_to_generate_a_tenant_route()
    {
        $tenant = factory(Tenant::class)->create();
        $domain = $tenant->createDomain([
            'domain' => 'acme.localhost',
        ]);

        // Not called: $domain->makePrimary();
        $this->expectException(NoPrimaryDomainException::class);
        $tenant->route('foo', ['bar' => 'xyz']);
    }

    /** @test */
    public function subdomains_are_converted_to_domains_when_generating_a_tenant_route()
    {
        config(['tenancy.central_domains' => [
            'localhost',
        ]]);

        $tenant = factory(Tenant::class)->create();
        $domain = $tenant->createDomain([
            'domain' => 'acme',
        ]);

        $domain->makePrimary();

        $this->assertSame(
            'http://acme.localhost/foo/xyz',
            $tenant->route('foo', ['bar' => 'xyz'])
        );
    }
}
