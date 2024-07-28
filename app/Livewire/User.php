<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as ModelUser;

class User extends Component
{
  public $pilihanMenu = "lihat";
  public $nama;
  public $email;
  public $password;
  public $peran;

  public function simpan()
  {
    // untuk memvalidasi form tambah
    $this->validate([
      'nama' => 'required',
      'email' => ["required", "email", "unique:users,email"],
      'password' => "required",
      "peran" => "required"
    ], [
      "nama.required" => "Nama harus diisi",
      "email.required" => "Email harus diisi",
      "email.email" => "Format harus email",
      "email.unique" => "Email telah digunakan",
      "password.required" => "Password harus diisi",
      "peran.required" => "Peran harus dipilih"
    ]);

    // fungsi simpan / tambah
    $simpan = new ModelUser();
    $simpan->name = $this->nama; // name untuk di user dan nama untuk di blade
    $simpan->password = bcrypt($this->password);
    $simpan->email = $this->email;
    $simpan->peran = $this->peran;
    $simpan->save(); // save

    $this->reset("nama", "email", "password", "email"); // setelah melakukan pengisian form maka reset form
    $this->pilihanMenu = "lihat"; // kembali ke lihat / semua pengguna
  }

  public function pilihMenu($menu)
  {
    $this->pilihanMenu = $menu;
  }

  public function render()
  {
    return view('livewire.user')->with([
      "semuaPengguna" => ModelUser::all()
    ]);
  }
}
