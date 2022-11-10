<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.login');
});

//Auth::routes();
Auth::routes(['verify' => true]);


Route::middleware(['auth', 'role:Admin'])->group(function () {
    // User is authentication and has admin role

});
Route::middleware(['auth', 'role:User'])->group(function () {
    // User is authentication and has User role

});

Route::group(['middleware' => ['auth','teamowner']], function () {
    Route::get('/', function () {return redirect('dashboard');});
    // User is authentication and has User role 
    //Route::get('/home', [App\Http\Controllers\backend\HomeController::class, 'index'])->name('admin');
    Route::get('/dashboard', [App\Http\Controllers\backend\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('patients', \App\Http\Controllers\backend\PatientController::class);
    Route::post ('patients/addnote',[\App\Http\Controllers\backend\PatientController::class,'addnote']) -> name ('patients.addnote');

    Route::get ('/geticds',[\App\Http\Controllers\backend\PatientController::class,'geticd10'])->name('geticd10');

    Route::resource('visits', \App\Http\Controllers\backend\VisitController::class);
    Route::put ('visits/updatedata/{id}',[\App\Http\Controllers\backend\VisitController::class,'updatedata']) -> name ('visits.updatedata');
    Route::post ('visits/storevitals',[\App\Http\Controllers\backend\VisitController::class,'storevitals']) -> name ('visits.storevitals');
    Route::get ('visits/{uuid}/prevew',[\App\Http\Controllers\backend\VisitController::class,'print'])->name('visits.prevew');

    Route::get ('covidscreen/{id}/create',[\App\Http\Controllers\backend\VisitController::class,'editcovid19']) -> name ('covidscreen.edit');
    Route::put ('covidscreen/updatedata/{id}',[\App\Http\Controllers\backend\VisitController::class,'updatecovid19']) -> name ('covidscreen.updatedata');
    Route::get ('covidscreen/storecovid19/{id}',[\App\Http\Controllers\backend\VisitController::class,'createcovid19']) -> name ('covidscreen.store');
    Route::get ('covidscreen/{id}/prevew',[\App\Http\Controllers\backend\VisitController::class,'covidprint'])->name('covidscreen.covidpreview');

    Route::resource('diagnosis', \App\Http\Controllers\backend\ptDiagnosisController::class);

    Route::get ('settings/company',[\App\Http\Controllers\backend\SettingsController::class,'showcompany']) -> name ('settings.company');
    Route::post ('settings/addcompany',[\App\Http\Controllers\backend\SettingsController::class,'addcompany']) -> name ('settings.addcompany');
    Route::get ('settings/company/{uuid}/prevew',[\App\Http\Controllers\backend\SettingsController::class,'companypreview'])->name('settings.companypreview');
    Route::put ('settings/updatecompany/{id}',[\App\Http\Controllers\backend\SettingsController::class,'updatecompany']) -> name ('settings.updatecompany');

    //Route::get('/patients', [\App\Http\Controllers\backend\PatientController::class, 'index'])->name('patients');
    //Route::get('/patients/{uuid}', [\App\Http\Controllers\backend\PatientController::class, 'show'])->name('profile');
    //Route::get('/patients/{uuid}', '\App\Http\Controllers\backend\PatientController@show')->name('profile');
});


/**
 * Teamwork routes
 */
Route::group(['prefix' => 'teams', 'namespace' => 'Teamwork'], function()
{
    Route::get('/', [App\Http\Controllers\Teamwork\TeamController::class, 'index'])->name('teams.index');
    Route::get('create', [App\Http\Controllers\Teamwork\TeamController::class, 'create'])->name('teams.create');
    Route::post('teams', [App\Http\Controllers\Teamwork\TeamController::class, 'store'])->name('teams.store');
    Route::get('edit/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'edit'])->name('teams.edit');
    Route::put('edit/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'update'])->name('teams.update');
    Route::delete('destroy/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'destroy'])->name('teams.destroy');
    Route::get('switch/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'switchTeam'])->name('teams.switch');

    Route::get('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'show'])->name('teams.members.show');
    Route::get('members/resend/{invite_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'resendInvite'])->name('teams.members.resend_invite');
    Route::post('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'invite'])->name('teams.members.invite');
    Route::delete('members/{id}/{user_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'destroy'])->name('teams.members.destroy');

    Route::get('accept/{token}', [App\Http\Controllers\Teamwork\AuthController::class, 'acceptInvite'])->name('teams.accept_invite');
});
