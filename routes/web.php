<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\VolunteerController as AdminVolunteerController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\LogViewerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Programs
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program:slug}', [ProgramController::class, 'show'])->name('programs.show');

// Donations
Route::get('/donate', [DonationController::class, 'index'])->name('donate');
Route::post('/donate/initiate', [DonationController::class, 'initiate'])->name('donation.initiate');
Route::get('/donation/callback', [DonationController::class, 'callback'])->name('donation.callback');
Route::get('/donation/status/{token}', [DonationController::class, 'success'])->name('donation.success');

// Get Involved / Volunteers
Route::get('/get-involved', [VolunteerController::class, 'index'])->name('get-involved');
Route::post('/volunteer/apply', [VolunteerController::class, 'store'])->name('volunteer.store');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/verify/{token}', [NewsletterController::class, 'verify'])->name('newsletter.verify');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Authentication
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Programs
    Route::resource('programs', AdminProgramController::class);
    
    // Donations
    Route::get('donations', [AdminDonationController::class, 'index'])->name('donations.index');
    Route::get('donations/{donation}', [AdminDonationController::class, 'show'])->name('donations.show');
    
    // Volunteers
    Route::get('volunteers', [AdminVolunteerController::class, 'index'])->name('volunteers.index');
    Route::get('volunteers/{volunteer}', [AdminVolunteerController::class, 'show'])->name('volunteers.show');
    Route::put('volunteers/{volunteer}/status', [AdminVolunteerController::class, 'updateStatus'])->name('volunteers.updateStatus');
    
    // Blog Posts
    Route::resource('posts', AdminPostController::class);
    
    // Contacts
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::post('contacts/{contact}/reply', [AdminContactController::class, 'reply'])->name('contacts.reply');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    
    // Gallery
    Route::get('gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::post('gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::put('gallery/{gallery}', [AdminGalleryController::class, 'update'])->name('gallery.update');
    Route::delete('gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');
    
    // Users (Super Admin Only)
    Route::middleware(['super_admin'])->group(function () {
        Route::resource('users', AdminUserController::class);
        
        // System Logs
        Route::get('logs', [LogViewerController::class, 'index'])->name('logs.index');
        Route::get('logs/download/{file}', [LogViewerController::class, 'download'])->name('logs.download');
        Route::post('logs/clear/{file}', [LogViewerController::class, 'clear'])->name('logs.clear');
        Route::delete('logs/delete/{file}', [LogViewerController::class, 'delete'])->name('logs.delete');
    });
});
