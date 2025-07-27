<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/example', function () {
    return view('example');
});

Route::get('/form', function () {
    return view('test-form');
});

Route::get('/create-vehicle', function () {
    return view('create-vehicle');
});

Route::get('/create-invoice', function () {
    return view('invoice-form');
});


// Route::resource('vehicles', VehicleController::class);
// Route::get('/vehicle', function () {
//     $vehicles = [
//         [
//             'vehicle_number' => 'ABC-1234',
//             'brand' => 'Toyota',
//             'model' => 'Corolla',
//             'year' => '2018',
//         ],
//         [
//             'vehicle_number' => 'XYZ-5678',
//             'brand' => 'Honda',
//             'model' => 'Civic',
//             'year' => '2020',
//         ],
//     ];

//     return view('vehicle', compact('vehicles'));
// });



require __DIR__ . '/auth.php';
