<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\AgentChatEvaluationController;
use App\Http\Controllers\CenterVisitEvaluationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminAuthController::class, 'showLoginForm']);

Route::resource('agent-chat-evaluations', AgentChatEvaluationController::class);
Route::get('agent-chat-evaluations/{id}/pdf', [AgentChatEvaluationController::class, 'downloadPdf'])
    ->name('agent-chat-evaluations.pdf');
Route::get('agent-chat-evaluations/pdf/all', [AgentChatEvaluationController::class, 'downloadAllPdf'])
    ->name('agent-chat-evaluations.pdf.all');
Route::resource('center-visit-evaluations', CenterVisitEvaluationController::class);
Route::get('center-visit-evaluations/{id}/pdf', [CenterVisitEvaluationController::class, 'downloadPdf'])
    ->name('center-visit-evaluations.pdf');
Route::get('center-visit-evaluations/pdf/all', [CenterVisitEvaluationController::class, 'downloadAllPdf'])
    ->name('center-visit-evaluations.pdf.all');

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])
        ->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])
        ->name('admin.login.submit');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])
            ->name('admin.dashboard');
        Route::get('chart-view', [AdminAuthController::class, 'chartView'])
            ->name('admin.chart.view');
        Route::get('settings', [AdminAuthController::class, 'settings'])
            ->name('admin.settings');
        Route::post('settings', [AdminAuthController::class, 'updateSettings'])
            ->name('admin.settings.update');
        Route::post('logout', [AdminAuthController::class, 'logout'])
            ->name('admin.logout');
    });
});

Route::middleware(['auth:admin', 'superadmin'])->group(function () {
    Route::get('admin/manage-admins', [AdminManagementController::class, 'index'])
        ->name('admin.management.index');
    Route::get('admin/manage-admins/create', [AdminManagementController::class, 'create'])
        ->name('admin.management.create');
    Route::post('admin/manage-admins', [AdminManagementController::class, 'store'])
        ->name('admin.management.store');
    Route::get('admin/manage-admins/{id}/edit', [AdminManagementController::class, 'edit'])
        ->name('admin.management.edit');
    Route::put('admin/manage-admins/{id}', [AdminManagementController::class, 'update'])
        ->name('admin.management.update');
    Route::delete('admin/manage-admins/{id}', [AdminManagementController::class, 'destroy'])
        ->name('admin.management.destroy');
});
