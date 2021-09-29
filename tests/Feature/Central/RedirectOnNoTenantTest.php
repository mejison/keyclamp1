<?php

namespace Tests\Feature\Central;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Stancl\Tenancy\Contracts\TenantCouldNotBeIdentifiedException;
use Tests\TestCase;

class RedirectOnNoTenantTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function exception_is_thrown()
    {
        $this->expectException(TenantCouldNotBeIdentifiedException::class);

        $this->withoutExceptionHandling()
            ->get('http://foo.localhost');
    }

    /** @test */
    public function exception_is_handled()
    {
        $this->get('http://foo.localhost')
            ->assertRedirect('http://' . config('tenancy.central_domains')[0]);
    }
}
