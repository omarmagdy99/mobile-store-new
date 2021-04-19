<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function index()
    {
        $user_data = User::all();
        return view('pages.users.usersList', compact('user_data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'f_name' => ['string', 'required'],
            'l_name' => ['string', 'required'],
            'email' => ['required', 'unique:users', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'confirmed'],
            'phone' => ['required'],
            'address' => ['required'],
            'national_id' => ['required'],
            'pic' => ['required'],
            'gender' => ['required'],
            'permission' => ['required'],

        ]);
        User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            's_phone' => $request->s_phone,
            'address' => $request->address,
            'national_id' => $request->national_id,
            'image' => $request->file('pic')->store('userImage', 'public'),
            'gender' => $request->gender,
            'permission' => $request->permission,
        ]);
        session()->flash('add', 'user added successfully');
        return redirect('/usersList');
    }
    public function destroy(Request $request)
    {
        User::find($request->user_id)->delete();
        Storage::delete(['public', $request->pic]);
        session()->flash('delete', 'user deleted successfully');
        return redirect('usersList');
    }
}
