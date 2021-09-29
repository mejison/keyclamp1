<?php

namespace Tests\Feature\Central;

use App\Actions\CreateTenantAction;
use App\Domain;
use App\Exceptions\DomainCannotBeChangedException;
use App\Tenant;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DomainsCannotBeUpdatedTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function domain_attributes_can_be_changed()
    {
        $tenant = $this->createTenant();

        $domain = $tenant->createDomain('foo.localhost');

        /** @var Domain $domain */
        $domain->update([
            'is_primary' => true,
        ]);

        $this->assertSame(true, $domain->is_primary);
    }

    /** @test */
    public function domain_columns_cannot_be_changed()
    {
        $tenant = $this->createTenant();

        $this->expectException(DomainCannotBeChangedException::class);

        /** @var Domain $domain */
        $domain = $tenant->createDomain('foo.localhost');
        $domain->update([
            'domain' => 'bar.localhost',
        ]);
    }
}
