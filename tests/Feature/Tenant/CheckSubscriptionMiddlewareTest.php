<?php

namespace Tests\Feature\Tenant;

use App\Actions\CreateTenantAction;
use App\Tenant;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TenantTestCase;
use Tests\TestCase;

class CheckSubscriptionMiddlewareTest extends TenantTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function the_tenant_is_taken_to_the_billing_screen_if_he_doesnt_have_a_subscription_or_trial()
    {
        $this->get('posts')
            ->assertStatus(200);

        tenant()->update([
            'trial_ends_at' => Carbon::now()->subtract('30d'),
        ]);

        tenant()->refresh(); // Update model persisted on Tenancy singleton

        $this->get('posts')
            ->assertRedirect('/settings/application');

        $this->get('settings/application')
            ->assertSee('not subscribed');
    }
}
