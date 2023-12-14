<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\KategoriBisnisController;
use App\Http\Controllers\KomisiController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefKataPembukaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'verify' => true,
]);

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('biarpro/{referral}', [
    WelcomeController::class,
    'handleReferral',
])->name('affiliate.handle');
Route::post('getKabupaten', [ArtikelController::class, 'getKabupaten'])->name(
    'getKabupaten'
);
Route::post('getKatapembuka', [
    ArtikelController::class,
    'getKatapembuka',
])->name('getKatapembuka');


Route::group(
    [
        'middleware' => [
            'role:super-admin|admin|contributor|contributor-pro',
            'verified',
        ],
    ],
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/dashboard/artikel/create', [
            ArtikelController::class,
            'create',
        ])->name('artikel.create');
        Route::post('/dashboard/artikel/store', [
            ArtikelController::class,
            'store',
        ])->name('artikel.store');
        Route::get('/dashboard/artikel', [
            ArtikelController::class,
            'index',
        ])->name('artikel.index');
        Route::get('/dashboard/user-export/{history}', [
            ArtikelController::class,
            'export',
        ])->name('artikel.export');
        Route::get('/dashboard/clear/{history}', [
            ArtikelController::class,
            'clear',
        ])->name('artikel.clear');
        Route::get('/dashboard/profile/edit/{id}', [
            ProfileController::class,
            'edit',
        ])->name('profile.edit');
        Route::put('/dashboard/profile/update/{id}', [
            ProfileController::class,
            'update',
        ])->name('profile.update');
    }
);

Route::group(['middleware' => ['role:super-admin', 'verified']], function () {
    //paket
    Route::post('/dashboard/paket/store', [
        PaketController::class,
        'store',
    ])->name('paket.store');
    Route::get('/dashboard/paket/create', [
        PaketController::class,
        'create',
    ])->name('paket.create');
    Route::get('/dashboard/paket/edit/{id}', [
        PaketController::class,
        'edit',
    ])->name('paket.edit');
    Route::put('/dashboard/paket/update/{id}', [
        PaketController::class,
        'update',
    ])->name('paket.update');
    Route::get('/dashboard/paket', [PaketController::class, 'index'])->name(
        'paket.index'
    );
    Route::get('/dashboard/paket/{id}', [
        PaketController::class,
        'destroy',
    ])->name('paket.destroy');
    Route::get('/dashboard/updateStatus/{id}', [
        PaketController::class,
        'updateStatus',
    ])->name('paket.updateStatus');
    //role
    Route::post('/dashboard/role/store', [
        RoleController::class,
        'store',
    ])->name('role.store');
    Route::get('/dashboard/role/create', [
        RoleController::class,
        'create',
    ])->name('role.create');
    Route::get('/dashboard/role/edit/{id}', [
        RoleController::class,
        'edit',
    ])->name('role.edit');
    Route::put('/dashboard/role/update/{id}', [
        RoleController::class,
        'update',
    ])->name('role.update');
    Route::get('/dashboard/role', [RoleController::class, 'index'])->name(
        'role.index'
    );
    Route::get('/dashboard/role/{id}', [
        RoleController::class,
        'destroy',
    ])->name('role.destroy');
    //komisi
    Route::get('/dashboard/komisi/updateStatus/{id}', [
        KomisiController::class,
        'updateStatus',
    ])->name('komisi.updateStatus');

});
Route::group(
    ['middleware' => ['role:super-admin|contributor-pro', 'verified']],
    function () {
        //user
        Route::post('/dashboard/user/store', [
            UserController::class,
            'store',
        ])->name('user.store');
        Route::get('/dashboard/user/create', [
            UserController::class,
            'create',
        ])->name('user.create');
        Route::get('/dashboard/user/edit/{id}', [
            UserController::class,
            'edit',
        ])->name('user.edit');
        Route::put('/dashboard/user/update/{id}', [
            UserController::class,
            'update',
        ])->name('user.update');
        Route::get('/dashboard/user', [UserController::class, 'index'])->name(
            'user.index'
        );
    }
);
Route::get('/dashboard/user/{id}', [UserController::class, 'destroy'])->name(
    'user.destroy'
);

Route::group(
    ['middleware' => ['role:admin|super-admin', 'verified']],
    function () {
        //ref kata pembuka
        Route::post('/dashboard/ref_kata_pembuka/store', [
            RefKataPembukaController::class,
            'store',
        ])->name('ref_kata_pembuka.store');
        Route::get('/dashboard/ref_kata_pembuka/create', [
            RefKataPembukaController::class,
            'create',
        ])->name('ref_kata_pembuka.create');
        Route::get('/dashboard/ref_kata_pembuka/edit/{id}', [
            RefKataPembukaController::class,
            'edit',
        ])->name('ref_kata_pembuka.edit');
        Route::put('/dashboard/ref_kata_pembuka/update/{id}', [
            RefKataPembukaController::class,
            'update',
        ])->name('ref_kata_pembuka.update');
        Route::get('/dashboard/ref_kata_pembuka', [
            RefKataPembukaController::class,
            'index',
        ])->name('ref_kata_pembuka.index');
        Route::get('/dashboard/ref_kata_pembuka/{id}', [
            RefKataPembukaController::class,
            'destroy',
        ])->name('ref_kata_pembuka.destroy');

        //kategori bisnis
        Route::post('/dashboard/kategoribisnis/store', [
            KategoriBisnisController::class,
            'store',
        ])->name('kategoribisnis.store');
        Route::get('/dashboard/kategoribisnis/create', [
            KategoriBisnisController::class,
            'create',
        ])->name('kategoribisnis.create');
        Route::get('/dashboard/kategoribisnis/edit/{id}', [
            KategoriBisnisController::class,
            'edit',
        ])->name('kategoribisnis.edit');
        Route::put('/dashboard/kategoribisnis/update/{id}', [
            KategoriBisnisController::class,
            'update',
        ])->name('kategoribisnis.update');
        Route::get('/dashboard/kategoribisnis', [
            KategoriBisnisController::class,
            'index',
        ])->name('kategoribisnis.index');
        Route::get('/dashboard/kategoribisnis/{id}', [
            KategoriBisnisController::class,
            'destroy',
        ])->name('kategoribisnis.destroy');
    }
);

//login goole
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name(
    'auth.google'
);
Route::get('auth/google/callback', [
    GoogleController::class,
    'handleGoogleCallback',
]);

Route::get('/pro', [PembayaranController::class, 'store'])->name('pro.store');

//pembayaran
Route::group(
    ['middleware' => ['role:admin|super-admin', 'verified']],
    function () {
        Route::get('/dashboard/pembayaran', [
            PembayaranController::class,
            'index',
        ])->name('pembayaran.index');
    }
);
//komisi
Route::get('/dashboard/komisi', [KomisiController::class, 'index'])->name(
    'komisi.index'
);

// routes/web.php

Route::get('/checkout/{id}', [PembayaranController::class, 'checkout'])->name(
    'checkout'
);
Route::get('/delete_payment', [PembayaranController::class, 'destroy'])->name(
    'delete_payment'
);
Route::get('/notification/{id}/{idPaket}', [
    PembayaranController::class,
    'notification',
])->name('notification');
