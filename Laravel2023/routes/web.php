<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Admin\Admin_UsersController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/homeuser', [UsersController::class, 'index'])->name('homeuser');

Route::get('/register', [UsersController::class, 'register'])->name('register');

Route::post('/register', [UsersController::class, 'postRegister'])->name('postRegister');

Route::get('/login', [UsersController::class, 'login'])->name('login');

Route::post('/login', [UsersController::class, 'postLogin'])->name('postLogin');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::prefix('categories')->name('categories.')->group(function () {

        Route::get('/', [CategoriesController::class, 'index'])->name('index');

        Route::get('/addCategory', [CategoriesController::class, 'addCategory'])->name('addCategory');

        Route::post('/addCategory', [CategoriesController::class, 'postaddCategory'])->name('postaddCategory');

        Route::get('/edit/{id}', [CategoriesController::class, 'getEdit'])->name('edit');

        Route::post('/update', [CategoriesController::class, 'postEdit'])->name('post-edit');

        Route::get('/delete/{id}', [CategoriesController::class, 'delete'])->name('delete');

        Route::prefix('products')->name('products.')->group(function () {

            Route::get('/', [ProductsController::class, 'index'])->name('index');
    
            // Route::get('/addCategory', [CategoriesController::class, 'addCategory'])->name('addCategory');
    
            // Route::post('/addCategory', [CategoriesController::class, 'postaddCategory'])->name('postaddCategory');
    
            // Route::get('/edit/{id}', [CategoriesController::class, 'getEdit'])->name('edit');
    
            // Route::post('/update', [CategoriesController::class, 'postEdit'])->name('post-edit');
    
            // Route::get('/delete/{id}', [CategoriesController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('users')->name('users.')->group(function () {

        Route::get('/', [Admin_UsersController::class, 'index'])->name('index');

        Route::get('/addUser', [Admin_UsersController::class, 'addUser'])->name('addUser');

        Route::post('/addUser', [Admin_UsersController::class, 'postaddUser'])->name('postaddUser');

        Route::get('/editUser/{id}', [Admin_UsersController::class, 'editUser'])->name('editUser');

        Route::post('/updateUser', [Admin_UsersController::class, 'updateUser'])->name('post-editUser');

        Route::get('/delete/{id}', [Admin_UsersController::class, 'deleteUser'])->name('deleteUser');
    });

    Route::prefix('news')->name('news.')->group(function () {

        Route::get('/', [NewsController::class, 'index'])->name('index');

        Route::get('/addNew', [NewsController::class, 'addNew'])->name('addNew');

        Route::post('/addNew', [NewsController::class, 'postaddNew'])->name('postaddNew');

        Route::get('/editNew/{id}', [NewsController::class, 'editNew'])->name('editNew');

        Route::post('/updateNew', [NewsController::class, 'updateNew'])->name('post-editNew');

        Route::get('/deleteNew/{id}', [NewsController::class, 'deleteNew'])->name('deleteNew');
    });
});
