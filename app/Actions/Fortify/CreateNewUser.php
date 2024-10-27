<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'register_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'digits:10'],
            'register_password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],[
            'register_email.required' => 'The email field is required.',
            'register_email.email' => 'The email must be a valid email address.',
            'register_email.unique' => 'The email has already been taken.',
            'register_password.required' => 'The password field is required.',
            'register_password.min' => 'The password must be at least 8 characters.',
            'register_password.confirmed' => 'The password confirmation does not match.',
        ])->validate();
        

        /* generate refer code for user */
        $randomDigits = '';
        for ($i = 0; $i < 5; $i++) {
            $randomDigits .= random_int(0, 9);
        }
        $referCode = substr($input['name'], 0, 1).substr($input['register_email'], 0, 1).substr($input['phone'], 0, 1).substr($input['register_password'], 0, 1).$randomDigits;
        //dd($referCode);
        return User::create([
            'name' => $input['name'],
            'email' => $input['register_email'],
            'phone' => $input['phone'],
            'refer_code' => $referCode,
            'password' => Hash::make($input['register_password']),
        ]);

        /* $notification = array(
            'message' => 'You Registered Sucessfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification); */
    }
}
