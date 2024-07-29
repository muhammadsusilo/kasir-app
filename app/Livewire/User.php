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
  public $userSelected;

  public function pilihMenu($menu)
  {
    $this->pilihanMenu = $menu;
  }
  // fungsi untuk simpan
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

  // fungsi untuk mengambil id hapus
  public function removeSelected($id)
  {
    $this->userSelected = ModelUser::findOrFail($id); // setelah memilih, dan jika tidak ada $id 404 {kurang lebih seperti itu}
    $this->pilihanMenu = "hapus";
  }

  // fungsi untuk batal ketika mau hapus
  public function batal()
  {
    // $this->reset();
    $this->pilihanMenu = "lihat"; // untuk kembali ke lihat / semua pengguna
  }

  // fungsi untuk hapus ketika mau hapus
  public function hapus()
  {
    $this->userSelected->delete(); // untuk menghapus
    // $this->reset();
    $this->pilihanMenu = "lihat"; // untuk kembali ke lihat / semua pengguna
  }

  // fungsi untuk mengedit
  public function editSelected($id)
  {
    $this->userSelected = ModelUser::findOrFail($id); // setelah memilih, dan jika tidak ada $id 404 {kurang lebih seperti itu}
    $this->nama = $this->userSelected->name;
    $this->email = $this->userSelected->email;
    $this->peran = $this->userSelected->peran;

    $this->pilihanMenu = "edit";
  }

  // fungsi untuk menyimpan edit
  public function saveEdit()
  {
    // untuk memvalidasi form edit
    $this->validate([
      'nama' => 'required',
      'email' => ["required", "email", "unique:users," . $this->userSelected->id],
      "peran" => "required"
    ], [
      "nama.required" => "Nama harus diisi",
      "email.required" => "Email harus diisi",
      "email.email" => "Format harus email",
      "email.unique" => "Email telah digunakan",
      "peran.required" => "Peran harus dipilih"
    ]);

    // fungsi simpan / tambah
    $simpan = new ModelUser();
    $simpan->name = $this->nama; // name untuk di user dan nama untuk di blade
    $simpan->email = $this->email;
    $simpan->peran = $this->peran;
    $simpan->save(); // save

    $this->reset("nama", "email", "email"); // setelah melakukan pengisian form maka reset form
    $this->pilihanMenu = "lihat"; // kembali ke lihat / semua pengguna

  }


  public function render()
  {
    return view('livewire.user')->with([
      "semuaPengguna" => ModelUser::all()
    ]);
  }
}
