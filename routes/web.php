<?php


use App\Livewire\Hello;
use App\Livewire\Prods;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/list/{category}', [HomeController::class, 'list'])->name('list');
Route::post('/list', [HomeController::class, 'search'])->name('search');

Route::get('/livewire', Prods::class)->name('livewire');
Route::get('/f5', Hello::class)->name('f5');



Route::group(['as'=>'cart.','prefix'=>'cart'],function(){



    Route::get('/{prod}/add',[CartController::class,'add'])->name('add');
    Route::get('/{prod}/incr',[CartController::class,'incr'])->name('incr');
    Route::get('/',[CartController::class,'index'])->name('index');
    Route::get('/{prod}/del',[CartController::class,'del'])->name('del');
    Route::get('/clear',[CartController::class,'clear'])->name('clear');

});

Route::get('/checkout',[CartController::class,'checkout'])->name('checkout');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
