<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\MenuComponent;
use App\Http\Livewire\PlatComponent;
use App\Http\Livewire\DrinkComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ReviewComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\ReglementComponent;
use App\Http\Livewire\DetailsDrinkComponent;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PlatController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DrinkController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Livewire\CheckoutSuccessComponent;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Auth\RegistrationController;

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

// Frontend routes

Route::get('/', HomeComponent::class)->name('home');
Route::get('/plat', PlatComponent::class)->name('plat');


/**
 * On affecte le middleware 'check.added.menu' qui vérifie si un visiteur ou un utilisateur qui n'est pas "generic user" tenter d'ajouter
 * une boisson dans le panier sans avoir au préalable ajouté un menu (voir nos règles de gestion!)
 */
Route::get('/drink', DrinkComponent::class)->name('drink')->middleware('check.added.plat');

Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/plat/{slug}', DetailsComponent::class)->name('details');
Route::get('/drink/{slug}', DetailsDrinkComponent::class)->name('details.drink');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/checkout-success', CheckoutSuccessComponent::class)->name('checkout.success');
Route::get('/wishlist', WishlistComponent::class)->name('wishlist');
Route::get('/review/{slug}/{user}', ReviewComponent::class)->name('review');
Route::get('/reglement', ReglementComponent::class)->name('reglement');

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


//  Admin routes

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/plats', PlatController::class);
    Route::resource('/drinks', DrinkController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/types', TypeController::class);
    Route::resource('/ingredients', IngredientController::class);
    Route::resource('/units', UnitController::class);
    Route::resource('/galleries', GalleryController::class);
    Route::resource('/sliders', SliderController::class);
    Route::resource('/staffs', StaffController::class);



    // Ouvrir ou fermer le restaurant

    Route::get('/open-close', [AdminController::class, 'openCloseRestaurant'])->name('openClose');

    // Routes pour gérer les commandes

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}/update', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}/destroy', [OrderController::class, 'destroy'])->name('orders.destroy');

    // Routes pour gérer les informations sur le restaurant

    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
    Route::put('/restaurants/{restaurant}/update', [RestaurantController::class, 'update'])->name('restaurants.update');

    // Routes pour gérer les commentaires sur nos plats

    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}/show', [ReviewController::class, 'show'])->name('reviews.show');
    Route::delete('/reviews/{review}/destroy', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews/{review}/publish', [ReviewController::class, 'publish'])->name('reviews.publish');
    Route::get('/reviews/{review}/censor', [ReviewController::class, 'censor'])->name('reviews.censor');

    // Routes pour assigner des tags et enlèver un tag à un plat

    Route::post('/plats/{plat}/tags', [PlatController::class, 'assignTags'])->name('plats.tags');
    Route::delete('/plats/{plat}/tags/{tag}', [PlatController::class, 'removeTag'])->name('plats.tags.remove');

    // Routes pour gérer des tables et leur occupation dans la salle

    Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
    Route::get('/tables/create', [TableController::class, 'create'])->name('tables.create');
    Route::post('/tables/store', [TableController::class, 'store'])->name('tables.store');
    Route::get('/tables/{table}/edit', [TableController::class, 'edit'])->name('tables.edit');
    Route::put('/tables/{table}/update', [TableController::class, 'update'])->name('tables.update');
    Route::delete('/tables/{table}/destroy', [TableController::class, 'destroy'])->name('tables.destroy');
    Route::get('/tables/{table}/setisfree', [TableController::class, 'setIsFree'])->name('tables.setisfree');
});

// Employee routes

Route::middleware(['auth', 'role:personnel'])->name('personnel.')->prefix('/personnel')->group(function () {
    // Route::get('/', [BackEndController::class, 'index'])->name('index');
});

// Authenticated User routes

Route::middleware(['auth'])->name('user.')->prefix('/user')->group(function () {
    Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/edit-password', [UserAuthController::class, 'editPassword'])->name('edit.password');
    Route::post('/edit-password-submit', [UserAuthController::class, 'editPasswordSubmit'])->name('edit.password.submit');
    Route::get('/edit-profile', [UserAuthController::class, 'editProfile'])->name('edit.profile');
    Route::post('/edit-profile-submit', [UserAuthController::class, 'editProfileSubmit'])->name('edit.profile.submit');

    // Commandes de l'utilisateur

    Route::get('/orders', [UserAuthController::class, 'userOrdersIndex'])->name('index.orders');
    Route::get('/orders/{order}/cancel', [UserAuthController::class, 'userOrderCancel'])->name('cancel.order');

    // La facture de la commande

    Route::get('/invoice/{order}/generate', [UserAuthController::class, 'getOrderInvoice'])->name('invoice.generate');
    Route::get('/invoice/{order}/download', [UserAuthController::class, 'downloadPDFInvoice'])->name('invoice.download');
});
