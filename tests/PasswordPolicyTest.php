<?php

namespace Simplesales\PasswordPolicy\Tests;

use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase;
use Simplesales\PasswordPolicy\PasswordPolicy;

class PasswordPolicyTest extends TestCase
{
    /** @test */
    public function passwords_less_than_8_characters_return_false()
    {
        $password       = Str::random(7);
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_length_policy();

        $this->assertFalse($matches_policy);
    }

    /** @test */
    public function passwords_greater_than_8_characters_returns_true()
    {
        $password       = Str::random(9);
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_length_policy();

        $this->assertTrue($matches_policy);
    }

    /** @test */
    public function password_8_characters_long_returns_true()
    {
        $password       = Str::random(8);
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_length_policy();

        $this->assertTrue($matches_policy);
    }

    /** @test */
    public function password_without_upper_case_letter_fails_uppercase_check()
    {
        $password       = 'abcdefg';
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_uppercase_policy();

        $this->assertEquals(0, $matches_policy);
    }

    /** @test */
    public function password_with_uppercase_passes_uppercase_check()
    {
        $password       = 'ABCDE';
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_uppercase_policy();

        $this->assertEquals(1, $matches_policy);
    }

    /** @test */
    public function password_without_lower_case_letter_fails_lowercase_check()
    {
        $password       = 'ABCDE';
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_lowercase_policy();

        $this->assertEquals(0, $matches_policy);
    }

    /** @test */
    public function password_with_lower_case_letter_passes_lowercase_check()
    {
        $password       = 'ABCDe';
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_lowercase_policy();

        $this->assertEquals(1, $matches_policy);
    }

    /** @test */
    public function password_without_number_fails_lowercase_check()
    {
        $password       = 'ABCDE';
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_number_policy();

        $this->assertEquals(0, $matches_policy);
    }

    /** @test */
    public function password_with_number_passes_lowercase_check()
    {
        $password       = 'ABCDe1';
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_number_policy();

        $this->assertEquals(1, $matches_policy);
    }

    /** @test */
    public function password_without_special_character_fails_lowercase_check()
    {
        $password       = 'ABCDE';
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_special_character_policy();

        $this->assertEquals(0, $matches_policy);
    }

    /** @test */
    public function password_with_special_character_passes_lowercase_check()
    {
        $password       = 'ABCDe1$';
        $policy         = new PasswordPolicy($password);
        $matches_policy = $policy->password_matches_special_character_policy();

        $this->assertEquals(1, $matches_policy);
    }

    /** @test */
    public function all_elements_required_for_password_to_pass()
    {
        $too_short    = 'Ab$1';
        $no_lowercase = 'A1$AHEIELE';
        $no_uppercase = 'a1$amesilaseil';
        $no_special   = 'A1b238asemiase';
        $no_number    = 'B@D@sssMMee';
        $passes       = '@BcD3fGhiJklM';

        $failures = [
            $too_short,
            $no_lowercase,
            $no_uppercase,
            $no_special,
            $no_number
        ];

        foreach($failures as $failure)
        {
            $policy = new PasswordPolicy($failure);
            $this->assertFalse($policy->satisfies_password_policy());
        }

        $policy = new PasswordPolicy($passes);
        $this->assertTrue($policy->satisfies_password_policy());
    }


}
