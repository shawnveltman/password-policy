<?php

namespace Simplesales\PasswordPolicy;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Simplesales\PasswordPolicy\Skeleton\SkeletonClass
 */
class PasswordPolicyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'password-policy';
    }
}
