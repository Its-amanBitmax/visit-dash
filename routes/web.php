<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AgentChatEvaluationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminAuthController::class, 'showLoginForm']);

Route::resource('agent-chat-evaluations', AgentChatEvaluationController::class);
Route::get('agent-chat-evaluations/{id}/pdf', [AgentChatEvaluationController::class, 'downloadPdf'])
    ->name('agent-chat-evaluations.pdf');

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])
        ->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])
        ->name('admin.login.submit');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])
            ->name('admin.dashboard');
        Route::get('settings', [AdminAuthController::class, 'settings'])
            ->name('admin.settings');
        Route::post('settings', [AdminAuthController::class, 'updateSettings'])
            ->name('admin.settings.update');
        Route::post('logout', [AdminAuthController::class, 'logout'])
            ->name('admin.logout');
    });
});
