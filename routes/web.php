<?php

use App\Livewire\Admin\Configs\AmbienceCategories;
use App\Livewire\Admin\Configs\AmbienceTenants;
use App\Livewire\Admin\Configs\CostCenters;
use App\Livewire\Admin\Configuration;
use App\Livewire\Admin\ListUser;
use App\Livewire\Admin\Panel;
use App\Livewire\Admin\Homepage;
use App\Livewire\Admin\Configs\PartnerCategories;
use App\Livewire\Admin\Configs\ReasonEvents;
use App\Livewire\Admin\Ambiences\AmbienceContracts;
use App\Livewire\Admin\Ambiences\AmbienceEdit;
use App\Livewire\Admin\Ambiences\AmbienceNew;
use App\Livewire\Admin\Ambiences\Ambiences;
use App\Livewire\Admin\Ambiences\AmbienceValues;
use App\Livewire\Admin\UserAccesses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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


Route::get('/', Homepage::class)->name('homepage');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'registerLogging'
])->group(function () {
    Route::get('/dashboard', Panel::class)->name('dashboard');
    Route::post('/upload-editor',function(Request $request){
        $file = $request->file('file');
        $url = $file->store('public/uploads');
        return Storage::url($url);
    })->name('upload-editor');
});
// Configurations pageAccess 1
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'registerLogging',
    'pagesAccess:1'
])->group(function () {
    Route::get('/configurações-da-página', Configuration::class)
        ->name('configuration')
        ->middleware('admin.access');
    Route::get('/configurações-categorias-de-socio', PartnerCategories::class)
        ->name('partner-categories');
    Route::get('/configurações-categorias-de-ambiente', AmbienceCategories::class)
        ->name('ambience-categories');
    Route::get('/configurações-tipos-de-locatário', AmbienceTenants::class)
        ->name('ambience-tenats');
    Route::get('/configurações-tipos-de-evento', ReasonEvents::class)
        ->name('event-types');
    Route::get('/configurações-centro-de-custo', CostCenters::class)
        ->name('cost-center');
});
// Usuários pageAccess 2
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'registerLogging',
    'pagesAccess:2'
])->group(function () {
    Route::get('/usuários', ListUser::class)
        ->name('list-users');
        Route::get('/acessos-do-usuários/{user}', UserAccesses::class)
        ->name('user.access');
});

// Cadastros pageAccess 3
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'registerLogging',
    'pagesAccess:3'
])->group(function () {
    Route::get('/sócios', ListUser::class)
        ->name('partners');
    Route::get('/não-sócios', ListUser::class)
        ->name('others');
});
// Ambientes pageAccess 4
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'registerLogging',
    'pagesAccess:4'
])->group(function () {
    Route::get('/ambientes', Ambiences::class)
        ->name('ambiences');
    Route::get('/ambientes/novo', AmbienceNew::class)
        ->name('new-ambience');
    Route::get('/ambientes/{ambience}/editar', AmbienceEdit::class)
        ->name('edit-ambience');
    Route::get('/ambientes/{ambience}/valores', AmbienceValues::class)
        ->name('ambience-values');
    Route::get('/ambientes/{ambience}/termo-contrato', AmbienceContracts::class)
        ->name('ambience-contracts');
});


