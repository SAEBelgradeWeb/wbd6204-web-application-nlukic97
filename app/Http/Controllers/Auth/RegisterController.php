<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers; //***overridden function
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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age' => ['required','integer'],
            'sex' => ['required', 'string','in:male,female'],
            'location_id' => ['required', 'integer','exists:locations,id'], //checks if this location_id is present in the id field of locations table
            'username' => ['required', 'string', 'min:4', 'unique:users'],
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
        return User::create([
            'name' => $data['name'],
            'age' => $data['age'],
            'sex' => $data['sex'],
            'location_id'=>$data['location_id'],
            'email' => $data['email'],
            'image_url'=>'',
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }


    /** overriding the function in: Illuminate\Foundation\Auth\RegistersUsers   */
    public function showRegistrationForm()
    {
        $locations = \App\Models\Location::orderBy('city','asc')->get();
        return view('auth.register',compact('locations'));
    }
}
