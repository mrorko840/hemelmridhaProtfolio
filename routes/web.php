<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\HomeSectionController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SocialDetailsController;
use App\Http\Controllers\SupportController;
use App\Models\About;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'HomePage'])->name('home');
Route::post('/send-message', [SupportController::class, 'send'])->name('send.message');

Route::group(['prefix'=>'admin', 'middleware' => 'auth','verified'], function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    //HomeSection
    Route::get('/home', [HomeSectionController::class, 'index'])->name('admin.home');
    Route::post('/home', [HomeSectionController::class, 'update'])->name('admin.home.update');

    //about
    Route::get('/about', [AboutController::class, 'index'])->name('admin.about');
    Route::post('/about', [AboutController::class, 'update'])->name('admin.about.update');
    
    //setting
    Route::get('/setting', [GeneralSettingController::class, 'index'])->name('admin.setting');
    Route::post('/setting', [GeneralSettingController::class, 'update'])->name('admin.setting.update');

    //portfolio
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('admin.portfolio');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('admin.portfolio.store');
    Route::post('/portfolio/delete', [PortfolioController::class, 'destroy'])->name('admin.portfolio.delete');

    //skills
    Route::get('/skills', [SkillController::class, 'index'])->name('admin.skills');
    Route::post('/skills', [SkillController::class, 'store'])->name('admin.skills.store');
    Route::post('/skills/delete', [SkillController::class, 'destroy'])->name('admin.skills.delete');

    //social-details
    Route::get('/social', [SocialDetailsController::class, 'index'])->name('admin.social');
    Route::post('/social', [SocialDetailsController::class, 'store'])->name('admin.social.store');
    Route::post('/social/delete', [SocialDetailsController::class, 'destroy'])->name('admin.social.delete');

    //contact
    Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact');
    Route::post('/contact', [ContactController::class, 'update'])->name('admin.contact.update');

    //support
    Route::get('/support/all', [SupportController::class, 'allMessage'])->name('admin.support.all');
    Route::get('/support/pending', [SupportController::class, 'pendingMessage'])->name('admin.support.pending');
    Route::post('/support/isRead', [SupportController::class, 'isReadMessage'])->name('admin.support.isRead');
    Route::post('/support/delete', [SupportController::class, 'deleteMessage'])->name('admin.support.delete');
    Route::get('/support/all/ajax', [SupportController::class, 'allMessageAjax'])->name('admin.support.all.ajax');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
