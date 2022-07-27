<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true ,'register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/me', [App\Http\Controllers\UserController::class, 'me'])->name('me');



//  AUTENTICACIONES INICIO
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


// =================================== WEB APLICATION ===============================

Route::prefix('api')->group(function(){

    // CONTABILIDAD

    Route::group(['prefix' => 'egreso'], function ($router) {
        Route::get('/', [App\Http\Controllers\EgresoController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\EgresoController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\EgresoController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_egreso}', [App\Http\Controllers\EgresoController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\EgresoController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\EgresoController::class, 'restoreLogic'])->name('/restorelogic');
    });

    Route::group(['prefix' => 'ingreso'], function ($router) {
        Route::get('/', [App\Http\Controllers\IngresoController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\IngresoController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\IngresoController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_ingreso}', [App\Http\Controllers\IngresoController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\IngresoController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\IngresoController::class, 'restoreLogic'])->name('/restorelogic');
    });

    Route::group(['prefix' => 'emisionderecibo'], function ($router) {
        Route::get('/', [App\Http\Controllers\EmisiondereciboController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\EmisiondereciboController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\EmisiondereciboController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_emisionderecibo}', [App\Http\Controllers\EmisiondereciboController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\EmisiondereciboController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\EmisiondereciboController::class, 'restoreLogic'])->name('/restorelogic');
    });

    Route::group(['prefix' => 'tipocliente'], function ($router) {
        Route::get('/', [App\Http\Controllers\TipoclienteController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\TipoclienteController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\TipoclienteController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_tipocliente}', [App\Http\Controllers\TipoclienteController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\TipoclienteController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\TipoclienteController::class, 'restoreLogic'])->name('/restorelogic');
    });

    Route::group(['prefix' => 'formapago'], function ($router) {
        Route::get('/', [App\Http\Controllers\FormapagoController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\FormapagoController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\FormapagoController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_formapago}', [App\Http\Controllers\FormapagoController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\FormapagoController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\FormapagoController::class, 'restoreLogic'])->name('/restorelogic');
    });

    // ALMACEN
    Route::group(['prefix' => 'tipoutensilio'], function ($router) {
        Route::get('/', [App\Http\Controllers\TipoutensilioController::class, 'index'])->name('/');
        Route::get('/selectall', [App\Http\Controllers\TipoutensilioController::class, 'selectAll'])->name('/selectall');
        Route::post('/insert', [App\Http\Controllers\TipoutensilioController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\TipoutensilioController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_tipoutensilio}', [App\Http\Controllers\TipoutensilioController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\TipoutensilioController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\TipoutensilioController::class, 'restoreLogic'])->name('/restorelogic');
    });
    Route::group(['prefix' => 'utensilio'], function ($router) {
        Route::get('/', [App\Http\Controllers\UtensilioController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\UtensilioController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\UtensilioController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_utensilio}', [App\Http\Controllers\UtensilioController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\UtensilioController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\UtensilioController::class, 'restoreLogic'])->name('/restorelogic');
    });

    // TOURS
    Route::group(['prefix' => 'empresa'], function ($router) {
        Route::get('/', [App\Http\Controllers\EmpresaController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\EmpresaController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\EmpresaController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_empresa}', [App\Http\Controllers\EmpresaController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\EmpresaController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\EmpresaController::class, 'restoreLogic'])->name('/restorelogic');
    });
    Route::group(['prefix' => 'tour'], function ($router) {
        Route::get('/', [App\Http\Controllers\TourController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\TourController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\TourController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_tour}', [App\Http\Controllers\TourController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\TourController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\TourController::class, 'restoreLogic'])->name('/restorelogic');
    });

    // HABITACIONES
    Route::group(['prefix' => 'tipohabitacion'], function ($router) {
        Route::get('/', [App\Http\Controllers\TipohabitacionController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\TipohabitacionController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\TipohabitacionController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_tipohabitacion}', [App\Http\Controllers\TipohabitacionController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\TipohabitacionController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\TipohabitacionController::class, 'restoreLogic'])->name('/restorelogic');
    });
    Route::group(['prefix' => 'piso'], function ($router) {
        Route::get('/', [App\Http\Controllers\PisoController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\PisoController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\PisoController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_piso}', [App\Http\Controllers\PisoController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\PisoController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\PisoController::class, 'restoreLogic'])->name('/restorelogic');
    });
    Route::group(['prefix' => 'habitacion'], function ($router) {
        Route::get('/', [App\Http\Controllers\HabitacionController::class, 'index'])->name('/');
        Route::get('/all', [App\Http\Controllers\HabitacionController::class, 'allHabitacion'])->name('/all');
        Route::post('/insert', [App\Http\Controllers\HabitacionController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\HabitacionController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_habitacion}', [App\Http\Controllers\HabitacionController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\HabitacionController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\HabitacionController::class, 'restoreLogic'])->name('/restorelogic');
    });

    // DISPENSA
    Route::group(['prefix' => 'categoriadispensa'], function ($router) {
        Route::get('/', [App\Http\Controllers\CategoriadispensaController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\CategoriadispensaController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\CategoriadispensaController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_categoriadispensa}', [App\Http\Controllers\CategoriadispensaController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\CategoriadispensaController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\CategoriadispensaController::class, 'restoreLogic'])->name('/restorelogic');
    });
    Route::group(['prefix' => 'dispensa'], function ($router) {
        Route::get('/', [App\Http\Controllers\DispensaController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\DispensaController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\DispensaController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_dispensa}', [App\Http\Controllers\DispensaController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\DispensaController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\DispensaController::class, 'restoreLogic'])->name('/restorelogic');
    });

    // CLIENTE
    Route::group(['prefix' => 'cliente'], function ($router) {
        Route::get('/', [App\Http\Controllers\ClienteController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\ClienteController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\ClienteController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_cliente}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\ClienteController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\ClienteController::class, 'restoreLogic'])->name('/restorelogic');
    });

    // RESERVACION
    Route::group(['prefix' => 'reservacion'], function ($router) {
        Route::get('/', [App\Http\Controllers\ReservacionController::class, 'index'])->name('/');
        Route::post('/insert', [App\Http\Controllers\ReservacionController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\ReservacionController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_reservacion}', [App\Http\Controllers\ReservacionController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\ReservacionController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\ReservacionController::class, 'restoreLogic'])->name('/restorelogic');
    });
    Route::group(['prefix' => 'reservacionhabitacion'], function ($router) {
        Route::get('/', [App\Http\Controllers\ReservacionhabitacionController::class, 'index'])->name('/');
        Route::get('/consulta', [App\Http\Controllers\ReservacionhabitacionController::class, 'findHabitacionReserva'])->name('/consulta');
        Route::post('/insert', [App\Http\Controllers\ReservacionhabitacionController::class, 'store'])->name('/insert');
        Route::put('/update', [App\Http\Controllers\ReservacionhabitacionController::class, 'update'])->name('/update');
        Route::delete('/delete/{id_reservacionhabitacion}', [App\Http\Controllers\ReservacionhabitacionController::class, 'destroy'])->name('/delete');
        Route::put('/destroylogic', [App\Http\Controllers\ReservacionhabitacionController::class, 'destroyLogic'])->name('/destroylogic');
        Route::put('/restorelogic', [App\Http\Controllers\ReservacionhabitacionController::class, 'restoreLogic'])->name('/restorelogic');
    });

});
