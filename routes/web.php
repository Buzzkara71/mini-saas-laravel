<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Billing\PlanController;
use App\Http\Controllers\Billing\SubscriptionController;
use App\Http\Controllers\Billing\PaymentController;
use App\Http\Controllers\Billing\BillingDashboardController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('app.dashboard');
    }

    return redirect()->route('login');
});

// Alias /dashboard → /app 
Route::get('/dashboard', function () {
    return redirect()->route('app.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->prefix('app')->group(function () {

    // App Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('app.dashboard');

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('app.projects.index');

    Route::get('/projects/create', [ProjectController::class, 'create'])
        ->middleware('plan.limit:projects,max_projects')
        ->name('app.projects.create');

    Route::post('/projects', [ProjectController::class, 'store'])
        ->middleware('plan.limit:projects,max_projects')
        ->name('app.projects.store');

    // Billing dashboard
    Route::get('/billing', [BillingDashboardController::class, 'index'])->name('app.billing.index');

    // Plans
    Route::get('/billing/plans', [PlanController::class, 'index'])->name('app.billing.plans.index');
    Route::get('/billing/plans/{plan:slug}', [PlanController::class, 'show'])->name('app.billing.plans.show');

    Route::post('/billing/subscribe', [SubscriptionController::class, 'store'])
        ->name('app.billing.subscribe');

    // Manage/change plan
    Route::post('/billing/change-plan', [SubscriptionController::class, 'change'])
        ->name('app.billing.change');    

    // Export billing data to PDF
    Route::get('/billing/export/pdf', [BillingDashboardController::class, 'exportPdf'])
    ->name('app.billing.export.pdf');    

    // Payment History
    Route::get('/billing/payments', [PaymentController::class, 'index'])->name('app.billing.payments.index');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
