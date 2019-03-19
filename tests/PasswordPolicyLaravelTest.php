<?php

namespace Simplesales\PasswordPolicy\Tests;

use Orchestra\Testbench\TestCase;
use Simplesales\PasswordPolicy\PasswordPolicy;
use Simplesales\PasswordPolicy\PasswordPolicyServiceProvider;

class PasswordPolicyLaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PasswordPolicyServiceProvider::class,
        ];
    }
    protected function getPackageAliases($app)
    {
        return [
            'PasswordPolicy' => PasswordPolicy::class,
        ];
    }

    /** @test */
    public function route_works()
    {
        $this->get('/password_policy_reset')->assertStatus(200);
    }

    /** @test */
    public function config_can_be_accessed()
    {
        $config_default_route = config('password-policy.successful_redirect_route');
        $this->assertEquals('home',$config_default_route);
    }


}
