<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Produk;
use App\Livewire\Laporan;
use App\Livewire\Transaksi;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// middleware jika sudah login boleh mengakses
Route::get("/home", Beranda::class)->middleware(["auth"])->name('home'); // route home
Route::get("/user", User::class)->middleware(["auth"])->name('user'); // route user
Route::get("/produk", Produk::class)->middleware(["auth"])->name('produk'); // route produk
Route::get("/laporan", Laporan::class)->middleware(["auth"])->name('laporan'); // route laporan
Route::get("/transaksi", Transaksi::class)->middleware(["auth"])->name('transaksi'); // route transaksi

