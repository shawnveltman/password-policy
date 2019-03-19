<?php

namespace Simplesales\PasswordPolicy;

class PasswordPolicy
{
    /**
     * @var string
     */
    private $password;

    /**
     * PasswordPolicy constructor.
     * @param string $password
     */
    public function __construct(string $password = null)
    {
        $this->password = $password;
    }

    public function password_matches_length_policy()
    {
        return strlen($this->password) >= 8;
    }

    public function password_matches_uppercase_policy()
    {
        return preg_match('/[A-Z]/', $this->password);
    }

    public function password_matches_lowercase_policy()
    {
        return preg_match('/[a-z]/', $this->password);
    }

    public function password_matches_number_policy()
    {
        return preg_match('/[0-9]/', $this->password);
    }

    public function password_matches_special_character_policy()
    {
        return preg_match('/[\W]+/', $this->password);
    }

    public function satisfies_password_policy()
    {
        $length  = $this->password_matches_length_policy();
        $upper   = $this->password_matches_uppercase_policy();
        $lower   = $this->password_matches_lowercase_policy();
        $number  = $this->password_matches_number_policy();
        $special = $this->password_matches_special_character_policy();

        return $length && $upper && $lower && $number && $special;
    }

    public function activate_password_middleware()
    {
        $user = auth()->user() ?? null;
        if (!$user)
        {
            return redirect()->to('/login');
        }

        $prod         = config('app.env') === 'production';
        $testing_user = $user->email === 'testing_email@test.com';

        if ($prod || $testing_user)
        {
            if ($this->satisfies_password_policy())
            {
                return false;
            }

            return true;
        }

        return false;
    }

    public function handle()
    {
        if(! $this->satisfies_password_policy())
        {
            return redirect()->route('reset-password');
        }

        return redirect()->route(config('password-policy.successful_redirect_route'));
    }
}
