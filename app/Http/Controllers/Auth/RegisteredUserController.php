<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Addresses;
use App\Models\Communities;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Avatar;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $addresses = Addresses::all(['id','name']);
        $communities = Communities::all();
        
        
        return view('auth.register',[ 'addresses' => $addresses, 'communities' => $communities]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_address' => $request->address,
            'lot' => $request->lot,
            'password' => Hash::make($request->password),
        ]));
        
        $user->attachRole($request->role_id);
        event(new Registered($user));

       /* $defaultAvatar =  Avatar::create([
            'user_id' = Auth::user()->id,
            'avatar' = file_get_contents()
        ])*/

        if(Auth::user()->hasRole('RESIDENT')){
            $id = Auth::user()->id;
            $user = DB::table('users')
            ->where('users.id','=',"$id")
            ->select(['users.id','users.email','users.name','users.lot as lot','users.id_address'])
            ->get();
            return view('residentDetails.create',['user' => $user]);
        }else{
            return redirect(RouteServiceProvider::HOME);
        }
        
    }
}
