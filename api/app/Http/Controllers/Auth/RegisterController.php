<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		
        return Validator::make($data, [
            'fullName' => ['required', 'string', 'max:150'],
            'phoneNumber' => ['required', 'string', 'max:20', 'unique:users'],
			'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:50','confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
		$data=array_merge($data,['password' => Hash::make($data['password'])]);
		$user=User::create($data);
		json_encode('registrationFormFields');
		dd('ok');
		return 'success';
    }
    public function store(Request $request){
        dd($request->all());
    }
}
