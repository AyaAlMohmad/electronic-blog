<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SubsectionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WriterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('sections', SectionController::class);
    Route::resource('subsections', SubsectionController::class);
    Route::resource('contact_us', ContactUsController::class);
    Route::resource('about_us', AboutUsController::class);
    Route::resource('users', UserController::class);
    Route::get('/writers/pending', [WriterController::class, 'pendingRequests'])->name('writers.pending');
    Route::get('/writers/approved', [WriterController::class, 'approvedWriters'])->name('writers.approved');
    Route::get('/writers/{id}', [WriterController::class, 'show'])->name('writers.show');

    // Approve writers
    Route::get('/writers/approve/{user}', [WriterController::class, 'approveForm'])->name('writers.approve-form');
    Route::post('/writers/approve/{user}', [WriterController::class, 'approve'])->name('writers.approve');

    // Reject request
    Route::delete('/writers/reject/{user}', [WriterController::class, 'reject'])->name('writers.reject');

    // Revoke privileges
    Route::delete('/writers/revoke/{user}', [WriterController::class, 'revoke'])->name('writers.revoke');


    Route::get('/posts/pending', [PostController::class, 'pending'])->name('posts.pending');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/post/approved', [PostController::class, 'approved'])->name('posts.approved');
    Route::post('/posts/{post}/approve', [PostController::class, 'approve'])->name('posts.approve');
    Route::post('/posts/{post}/reject', [PostController::class, 'reject'])->name('posts.reject');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});
