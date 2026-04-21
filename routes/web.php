<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\PresenceController;


/*
|--------------------------------------------------------------------------
| Page d'accueil
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| Routes accessibles à TOUS les utilisateurs connectés
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/agent/calendrier', [PlanningController::class, 'index2'])
     ->name('agent.calendrier');

    Route::get('/agent/calendrier/events', [PlanningController::class, 'events'])
     ->name('agent.calendrier.events');
    
    Route::get('/agent/pointage', [PresenceController::class, 'indexAgent'])
        ->name('agent.pointage');

    Route::post('/agent/pointage', [PresenceController::class, 'store'])
        ->name('agent.pointage.store');
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Routes ADMIN UNIQUEMENT
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // Gestion des agents
    Route::resource('agents', AgentController::class);

    // Gestion des sites
    Route::resource('sites', SiteController::class);

    //gestion de planning
    Route::resource('plannings',PlanningController::class);
    
    Route::get('/admin/presence', [PresenceController::class, 'adminIndex'])
        ->name('admin.presence');
});

Route::middleware('auth')->group(function () {
    Route::get('/historique', [DashboardController::class, 'historiqueAgent'])
        ->name('agent.historique');
});

require __DIR__.'/auth.php';