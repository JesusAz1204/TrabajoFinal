<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes - Chaymba
|--------------------------------------------------------------------------
*/

// Home público (tu diseño "Oportunidades Flexibles")
Route::view('/', 'welcome')->name('home');

// Rutas protegidas (requiere login)
Route::middleware('auth')->group(function () {

    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::post('/contacts/{user}', [ContactController::class, 'store'])->name('contacts.store');
    Route::delete('/contacts/{user}', [ContactController::class, 'destroy'])->name('contacts.destroy');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Dashboard (pantalla principal ya logueado)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Contactos
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

    // Mensajes (chat)
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');

    // Informes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Cursos (CRUD Completo)
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/crear', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy'); // ⭐ NUEVA RUTA DELETE ⭐

    // Mi Perfil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Publicar Oportunidad
    Route::get('/opportunities/create', [OpportunityController::class, 'create'])->name('opportunities.create');
    Route::post('/opportunities', [OpportunityController::class, 'store'])->name('opportunities.store');
});

// Rutas de autenticación Breeze (login/register/logout)
require __DIR__ . '/auth.php';