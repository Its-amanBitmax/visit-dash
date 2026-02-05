<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\AgentChatEvaluationController;
use App\Http\Controllers\CenterVisitEvaluationController;
use App\Http\Controllers\QaEvaluationReportController;
use App\Http\Controllers\TlEvaluationReportController;
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
Route::get('center-visit-evaluations/{id}/proof', [CenterVisitEvaluationController::class, 'proof'])
    ->name('center-visit-evaluations.proof');
Route::post('center-visit-evaluations/{id}/proof', [CenterVisitEvaluationController::class, 'storeProof'])
    ->name('center-visit-evaluations.proof.store');

Route::resource('qa-evaluation-reports', QaEvaluationReportController::class);
Route::get('qa-evaluation-reports/{id}/pdf', [QaEvaluationReportController::class, 'downloadPdf'])
    ->name('qa-evaluation-reports.pdf');
Route::get('qa-evaluation-reports/pdf/all', [QaEvaluationReportController::class, 'downloadAllPdf'])
    ->name('qa-evaluation-reports.pdf.all');

Route::resource('tl-evaluation-reports', TlEvaluationReportController::class);
Route::get('tl-evaluation-reports/{id}/pdf', [TlEvaluationReportController::class, 'downloadPdf'])
    ->name('tl-evaluation-reports.pdf');
Route::get('tl-evaluation-reports/pdf/all', [TlEvaluationReportController::class, 'downloadAllPdf'])
    ->name('tl-evaluation-reports.pdf.all');

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
