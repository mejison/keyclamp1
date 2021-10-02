<?php

namespace Tests\Feature\Central;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TenantAdminTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function updating_tenant_admins_email_changes_the_email_in_the_tenant_too()
    {
        $tenant = Tenant::create([
            'name' => 'Super Admin',
            'email' => 'foo@admin',
            'password' => 'password',
        ]);

        $tenant->run(function () {
            User::first()->update([
                'email' => 'bar@email',
            ]);
        });

        $this->assertSame('bar@email', Tenant::first()->email);
    }
}
