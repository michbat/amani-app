<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\CheckoutSuccessComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\MenuComponent;
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

// Home routes

Route::get('/', HomeComponent::class)->name('home');
Route::get('/menu', MenuComponent::class)->name('menu');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/menu/{slug}', DetailsComponent::class)->name('details');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/checkout-success', CheckoutSuccessComponent::class)->name('checkout.success');

// Paypal routes

Route::get('/paypal/success/{user}', [CheckoutComponent::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [CheckoutComponent::class, 'cancel'])->name('paypal.cancel');


// Login & logout routes

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login-submit', [LoginController::class, 'login_submit'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Registration routes

Route::get('/register', [RegistrationController::class, 'register'])->name('register');
Route::post('/register-submit', [RegistrationController::class, 'register_submit'])->name('register.submit');
Route::get('/register-verify/{token}/{email}', [RegistrationController::class, 'register_verify'])->name('register.verify');

// Password routes

Route::get('/forgot-password', [PasswordController::class, 'forgot_password'])->name('forgot.password');
Route::post('/forgot-password-submit', [PasswordController::class, 'forgot_password_submit'])->name('forgot.password.submit');
Route::get('/reset-password/{token}/{email}', [PasswordController::class, 'reset_password'])->name('reset.password');
Route::post('/reset-password-submit', [PasswordController::class, 'reset_password_submit'])->name('reset.password.submit');

Route::get('/resent-link', [PasswordController::class, 'resent_link'])->name('resent.link');
Route::post('/resent-link-submit', [PasswordController::class, 'resent_link_submit'])->name('resent.link.submit');

//  Admin routes

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/types', TypeController::class);
    Route::resource('/ingredients', IngredientController::class);
    Route::resource('/units', UnitController::class);
    Route::resource('/galleries', GalleryController::class);
    Route::resource('/sliders', SliderController::class);

    // Routes pour gérer les informations sur le restaurant

    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
    Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
    Route::put('/restaurants/{restaurant} ', [RestaurantController::class, 'update'])->name('restaurants.update');

    // Routes pour assigner des tags et enlèver un tag à un menu

    Route::post('/menus/{menu}/tags', [MenuController::class, 'assignTags'])->name('menus.tags');
    Route::delete('/menus/{menu}/tags/{tag}', [MenuController::class, 'removeTag'])->name('menus.tags.remove');
});

// Employee routes

Route::middleware(['auth', 'role:employee'])->name('employee.')->prefix('/employee')->group(function () {
    // Route::get('/', [BackEndController::class, 'index'])->name('index');

});

// Authenticated User routes

Route::middleware(['auth'])->name('user.')->prefix('/user')->group(function () {
    Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/edit-password', [UserAuthController::class, 'edit_password'])->name('edit.password');
    Route::post('/edit-password-submit', [UserAuthController::class, 'edit_password_submit'])->name('edit.password.submit');
    Route::get('/edit-profile', [UserAuthController::class, 'edit_profile'])->name('edit.profile');
    Route::post('/edit-profile-submit', [UserAuthController::class, 'edit_profile_submit'])->name('edit.profile.submit');
});