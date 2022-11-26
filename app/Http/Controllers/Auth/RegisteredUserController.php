<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
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
            'bookReg' => ['required', 'string', 'max:10', 'min:10'],
            'emailReg' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'passwordReg' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $name = null;
        if (Student::query()->where('passport', '=', $request->bookReg)->exists()) {
            $profile = Student::query()->where('passport', '=', $request->bookReg)->first();
            if ($profile->s_user) {
                throw ValidationException::withMessages([
                    'bookReg' => 'Данный пользователь уже зарегистрирован',
                ]);
            }
            $name = $profile->surname;
        } else if (Employee::query()->where('passport', '=', $request->bookReg)->exists()) {
            $profile = Employee::query()->where('passport', '=', $request->bookReg)->first();
            if ($profile->s_user) {
                throw ValidationException::withMessages([
                    'bookReg' => 'Данный пользователь уже зарегистрирован',
                ]);
            }
            $name = $profile->surname;
        } else {
            throw ValidationException::withMessages([
                'bookReg' => 'Пользователь с данными данными не найден',
            ]);
        }

        $user = User::create([
            'name' => $name,
            'email' => $request->emailReg,
            'password' => Hash::make($request->passwordReg),
        ]);

        $profile->s_user = $user->id;
        $profile->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('welcome'));
    }
}
