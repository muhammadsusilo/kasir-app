<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class Dataawal extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data untuk user
        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@gmail.com";
        $user->password = bcrypt("12345678");
        $user->peran = "admin";
        $user->save();

        // data untuk produk
        $produk = new Produk();
        $produk->kode= "HB9898";
        $produk->name = "Nabati";
        $produk->price = 5000;
        $produk->stock = 15;
        $produk->save();
    }
}
