<?php

use Illuminate\Support\Facades\Route;

Route::get('/api/transactions/latest', [App\Http\Controllers\frontend\HomeController::class, 'getLatestTransactions']);

Route::get('/api/verify', [App\Http\Controllers\auth\authCheckController::class, 'verify']);
Route::get('/api/checkUser', [App\Http\Controllers\auth\authCheckController::class, 'checkUser']);
Route::get('/api/checkAdmin', [App\Http\Controllers\auth\authCheckController::class, 'checkAdmin']);
Route::post('/api/register', [App\Http\Controllers\auth\registerController::class, 'register']);
Route::get('api/register/{username}', [App\Http\Controllers\auth\registerController::class, 'handleReferral'])->name('referral');
Route::post('/api/login', [App\Http\Controllers\auth\loginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\auth\loginController::class, 'logout'])->name('logout');
Route::post('/api/user-verification', [App\Http\Controllers\auth\loginController::class, 'activateAccount']);
Route::get('/api/plans', [App\Http\Controllers\user\investmentController::class, 'index']);
Route::post('/api/password/email', [App\Http\Controllers\auth\PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('/api/password/reset', [App\Http\Controllers\auth\PasswordResetController::class, 'resetPassword'])->name('password.reset');
Route::post('api/contact', [App\Http\Controllers\frontend\ContactController::class, 'store']);

//Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
 Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'index'])->name('admin.profile');
 Route::get('/dashboard', [App\Http\Controllers\admin\DashboardController::class, 'index'])->name('admin.dashboard');
 Route::get('/users', [App\Http\Controllers\admin\UsersController::class, 'index'])->name('admin.users');
 Route::get('users/{user}/view', [App\Http\Controllers\admin\UsersController::class, 'viewUser'])->name('user.view');
 Route::post('users/{user}/ban', [App\Http\Controllers\admin\UsersController::class, 'banUser'])->name('user.ban');
 Route::post('users/{user}/unban', [App\Http\Controllers\admin\UsersController::class, 'unbanUser'])->name('user.unban');
 Route::delete('users/{user}', [App\Http\Controllers\admin\UsersController::class, 'deleteUser'])->name('user.delete');
 Route::post('/user/email/{id}', [App\Http\Controllers\admin\UsersController::class, 'sendEmail'])->name('user.email');
 Route::post('/transactions/{id}/approve', [App\Http\Controllers\admin\UsersDatialsController::class, 'approveDeposit'])->name('transactions.approve');
 Route::delete('/transactions/{id}', [App\Http\Controllers\admin\UsersDatialsController::class, 'deleteDeposit'])->name('transactions.delete');
 Route::post('/withdrawals/{id}/approve', [App\Http\Controllers\admin\UsersDatialsController::class, 'approveWithdrawal'])->name('withdrawals.approve');
 Route::post('/withdrawals/feedback', [App\Http\Controllers\admin\UsersDatialsController::class, 'addFeedback'])->name('withdrawals.feedback');
 Route::delete('/withdrawals/{id}', [App\Http\Controllers\admin\UsersDatialsController::class, 'deleteWithdrawal'])->name('withdrawals.delete');
 Route::resource('wallets', App\Http\Controllers\admin\WalletController::class)->names([
  'index'   => 'wallets.index',
  'create'  => 'wallets.create',
  'store'   => 'wallets.store',
  'show'    => 'wallets.show',
  'edit'    => 'wallets.edit',
  'update'  => 'wallets.update',
  'destroy' => 'wallets.destroy',
 ]);

 // Display all plans
 Route::get('plans', [App\Http\Controllers\admin\PlanController::class, 'index'])->name('admin.plans');

 // Show form to create a new plan
 Route::get('plans/create', [App\Http\Controllers\admin\PlanController::class, 'create'])->name('plans.create');

 // Store a new plan
 Route::post('plans', [App\Http\Controllers\admin\PlanController::class, 'store'])->name('plans.store');

 // Show form to edit an existing plan
 Route::get('plans/{id}/edit', [App\Http\Controllers\admin\PlanController::class, 'edit'])->name('plans.edit');

 // Update an existing plan
 Route::put('plans/{id}', [App\Http\Controllers\admin\PlanController::class, 'update'])->name('plans.update');

 // Delete a plan
 Route::delete('plans/{id}', [App\Http\Controllers\admin\PlanController::class, 'destroy'])->name('plans.destroy');

 Route::post('/logout', [App\Http\Controllers\auth\loginController::class, 'logout'])->name('admin.logout');
 Route::get('/deposits', [App\Http\Controllers\admin\DepositController::class, 'GetUserdeposits'])->name('admin.fund-history');
 Route::get('/invest-history', [App\Http\Controllers\admin\investmentController::class, 'allInvestments'])->name('admin.invest-history');
 Route::get('/transfer-history', [App\Http\Controllers\admin\TransferController::class, 'GetUsertransfers'])->name('admin.transfer-history');
 Route::delete('/transfers/{id}', [App\Http\Controllers\admin\TransferController::class, 'destroy'])->name('transfers.delete');
 Route::get('/referrals', [App\Http\Controllers\admin\ReferralController::class, 'GetAllReferrals'])->name('admin.referrals');
 Route::get('/payout-history', [App\Http\Controllers\admin\WithdrawalController::class, 'getWithdrawals'])->name('admin.payout-history');
 Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'index'])->name('admin.profile');
 Route::post('/admin/profile/update-password', [App\Http\Controllers\admin\ProfileController::class, 'updatePassword'])->name('admin.profile.update-password');
 Route::post('/admin/send-activation-email/{id}', [App\Http\Controllers\admin\UsersDatialsController::class, 'sendActivationEmail'])->name('admin.activation-email');
 Route::post('/adjust-balance', [App\Http\Controllers\admin\UsersDatialsController::class, 'adjustBalance'])->name('admin.adjust-balance');
});

//User Routes
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
 Route::get('/dashboard', [App\Http\Controllers\user\DashboardController::class, 'index'])->name('user.dashboard');
 Route::get('/add-fund', [App\Http\Controllers\user\DepositController::class, 'index'])->name('user.add-fund');
 Route::get('/fund-history', [App\Http\Controllers\user\DepositController::class, 'GetUserdeposits'])->name('user.fund-history');
 Route::post('/deposit/store', [App\Http\Controllers\user\DepositController::class, 'Makedeposit'])->name('deposit.store');
 Route::get('/invest-history', [App\Http\Controllers\user\investmentController::class, 'userInvestments'])->name('user.invest-history');
 Route::get('/user-plans', [App\Http\Controllers\user\investmentController::class, 'bladePlans'])->name('user.plans');;
 Route::get('/money-transfer', [App\Http\Controllers\user\TransferController::class, 'index'])->name('user.money-transfer');
 Route::post('/money-transfer/submit', [App\Http\Controllers\user\TransferController::class, 'store'])->name('money-transfer.submit');
 Route::get('/transactions', [App\Http\Controllers\user\TransferController::class, 'getUserTransactions'])->name('user.transactions');
 Route::get('/payout', [App\Http\Controllers\user\WithdrawalController::class, 'index'])->name('user.payout');
 Route::post('/payout/submit', [App\Http\Controllers\user\WithdrawalController::class, 'submitWithdrawal'])->name('payout.submit');
 Route::get('/payout-history', [App\Http\Controllers\user\WithdrawalController::class, 'getWithdrawals'])->name('user.payout-history');
 Route::get('/referral', [App\Http\Controllers\user\ReferralController::class, 'index'])->name('user.referral');
 Route::get('/referral-bonus', [App\Http\Controllers\user\ReferralController::class, 'ShowReferrals'])->name('user.referral-bonus');
 Route::get('/profile', [App\Http\Controllers\user\ProfileController::class, 'index'])->name('user.profile');
 Route::post('/profile/update-image', [App\Http\Controllers\user\ProfileController::class, 'updateImage'])->name('profile.update-image');
 Route::put('/profile/update-info', [App\Http\Controllers\user\ProfileController::class, 'updateInfo'])->name('profile.update-info');
 Route::post('/profile/update-password', [App\Http\Controllers\user\ProfileController::class, 'updatePassword'])->name('user.profile.update-password');
 Route::post('/profile/submit-identity', [App\Http\Controllers\user\ProfileController::class, 'submitIdentity'])->name('profile.submit-identity');
 Route::post('/profile/submit-address', [App\Http\Controllers\user\ProfileController::class, 'submitAddress'])->name('profile.submit-address');
 Route::post('/investment/submit/{plan}', [App\Http\Controllers\user\investmentController::class, 'makeInvestment'])->name('investment.submit');
 Route::post('/transfer-interest', [App\Http\Controllers\user\DashboardController::class, 'transferInterest'])->name('user.transfer.interest');
 Route::post('/profile/update-image', [App\Http\Controllers\user\ProfileController::class, 'updateImage'])->name('profile.update-image');
 Route::put('/profile/update-info', [App\Http\Controllers\user\ProfileController::class, 'updateInfo'])->name('profile.update-info');
 Route::post('/profile/update-password', [App\Http\Controllers\user\ProfileController::class, 'updatePassword'])->name('profile.update-password');
 Route::post('/profile/submit-identity', [App\Http\Controllers\user\ProfileController::class, 'submitIdentity'])->name('profile.submit-identity');
 Route::post('/profile/submit-address', [App\Http\Controllers\user\ProfileController::class, 'submitAddress'])->name('profile.submit-address');


});

Route::get('/{pathMatch}', function () {
 return view('welcome');
})->where('pathMatch', ".*");