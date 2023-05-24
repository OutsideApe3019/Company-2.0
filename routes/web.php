<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PanelPagesController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\NewsController;

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

Route::middleware('forbid-banned-user')->group(function () {
    Route::get('/', [PagesController::class, 'home'])->name('home');

    Route::middleware('auth')->group(function () {
        Route::name('user.settings.')->prefix('/settings')->group(function() {
            Route::get('/', [PagesController::class, 'settings'])->name('index');

            Route::prefix('/edit')->name('edit.')->group(function() {
                Route::post('/', [UserSettingsController::class, 'edit'])->name('index');
                Route::post('/password', [UserSettingsController::class, 'password'])->name('password');
            });
        });

        Route::name('panel.')->prefix('/panel')->middleware('can:panel.see')->group(function() {
            Route::get('/', [PanelPagesController::class, 'index'])->name('index');

            Route::name('users.')->prefix('/users')->group(function() {
                Route::get('/', [PanelPagesController::class, 'users'])->name('index');

                Route::get('/{user}/edit', [PanelPagesController::class, 'editUser'])->name('edit')->middleware('can:panel.user.edit');
                Route::post('/{user}/edit', [PanelController::class, 'editUser'])->name('edit')->middleware('can:panel.user.edit');
            });

            Route::name('roles.')->prefix('/roles')->group(function() {
                Route::get('/', [PanelPagesController::class, 'roles'])->name('index');

                Route::get('/create', [PanelPagesController::class, 'createRole'])->name('create')->middleware('can:panel.role.create');
                Route::post('/create', [PanelController::class, 'createRole'])->name('create')->middleware('can:panel.role.create');

                Route::get('/{role}/edit', [PanelPagesController::class, 'editRole'])->name('edit')->middleware('can:panel.role.edit');
                Route::post('/{role}/edit', [PanelController::class, 'editRole'])->name('edit')->middleware('can:panel.role.edit');

                Route::post('/{role}/delete', [PanelController::class, 'deleteRole'])->name('delete')->middleware('can:panel.role.delete');
            });

            Route::name('perms.')->prefix('/permissions')->group(function() {
                Route::get('/', [PanelPagesController::class, 'perms'])->name('index');

                Route::get('/create', [PanelPagesController::class, 'createPerm'])->name('create')->middleware('can:panel.perm.create');
                Route::post('/create', [PanelController::class, 'createPerm'])->name('create')->middleware('can:panel.perm.create');

                Route::post('/{perm}/delete', [PanelController::class, 'deletePerm'])->name('delete')->middleware('can:panel.perm.delete');
            });

            Route::name('news.')->prefix('/news')->group(function() {
                Route::get('/', [PanelPagesController::class, 'news'])->name('index');

                Route::get('/create', [PanelPagesController::class, 'createNew'])->name('create')->middleware('can:panel.new.create');
                Route::post('/create', [PanelController::class, 'createNew'])->name('create')->middleware('can:panel.new.create');

                Route::post('/{new}/delete', [PanelController::class, 'deleteNew'])->name('delete')->middleware('can:panel.new.delete');
            });
        });
    });

    Route::name('news.')->prefix('/news')->group(function() {
        Route::get('/', [PagesController::class, 'news'])->name('index');

        Route::get('/{new}', [PagesController::class, 'newsView'])->name('view');
        Route::post('/{new}/comment/create', [NewsController::class, 'newComment'])->name('comments.create')->middleware(['auth', 'forbid-banned-user']);
    });
});

Auth::routes();

Route::get('/banned', [PagesController::class, 'banned'])->name('user.banned');

Route::view('/test', 'test');