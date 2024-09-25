<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string',  'max:20', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
           
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);
        // return redirect(RouteServiceProvider::HOME);
// hello this for create condition aboute role admin and customer and employer 
//  login condition aboute admin
            // if(Auth::check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }

            if (Auth::user()->role === 'admin') {
                return redirect(RouteServiceProvider::HOME);
            }
            elseif (Auth::user()->role === 'customer') {
                return redirect(RouteServiceProvider::CUSTOMER);
            }
            elseif(Auth::user()->role === 'employee'){
                return redirect(RouteServiceProvider::EMPLOYER);
            }
            
            
           
    }
}
