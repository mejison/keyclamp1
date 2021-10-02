<?php

namespace Tests\Feature\Tenant;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Tests\TenantTestCase;

class UserSettingsTest extends TenantTestCase
{
    /** @test */
    public function owner_cannot_use_a_different_tenants_email()
    {
        $tenant2 = $this->createTenant([
            'email' => 'second@tenant',
        ]);

        $this->expectException(ValidationException::class);
        $this->withoutExceptionHandling()->post(route('tenant.settings.user.personal'), [
            'name' => 'John Foo',
            'email' => 'second@tenant',
        ]);
    }

    /** @test */
    public function normal_user_can_use_a_different_tenants_email()
    {
        $tenant2 = $this->createTenant([
            'email' => 'second@tenant',
        ]);

        $user2 = User::factory()->create();
        $this->actingAs($user2);

        $this->withoutExceptionHandling()->post(route('tenant.settings.user.personal'), [
            'name' => 'John Foo',
            'email' => 'second@tenant',
        ])->assertRedirect();
    }
}
