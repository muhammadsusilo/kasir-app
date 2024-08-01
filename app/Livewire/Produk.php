<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;
class Produk extends Component
{

	public $pilihanMenu = "lihat";
	public $kode;
	public $nama;
	public $harga;
	public $stock;
	public $productSelected;

	public function pilihMenu($menu)
	{
		$this->pilihanMenu = $menu;
	}

	// fungsi untuk simpan
	public function simpan()
	{
		// untuk memvalidasi form tambah
		$this->validate([
			'kode' => 'required',
			'nama' => 'required',
			'harga' => 'required',
			'stock' => "required"
		], [
			"kode.required" => "Kode unik produk harus diisi",
			"nama.required" => "Nama harus diisi",
			"harga.required" => "Harga harus diisi",
			"stock.required" => "Stock harus dipilih"
		]);

		// fungsi simpan / tambah
		$simpan = new ModelProduk();
		$simpan->kode = $this->kode;
		$simpan->name = $this->nama; // name untuk di user dan nama untuk di blade
		$simpan->price = $this->harga;
		$simpan->stock = $this->stock;
		$simpan->save(); // save

		$this->reset("kode", "nama", "harga", "stock"); // setelah melakukan pengisian form maka reset form
		$this->pilihanMenu = "lihat"; // kembali ke lihat / semua pengguna
	}

	// fungsi untuk mengambil id hapus
	public function removeSelected($id)
	{
		$this->productSelected = ModelProduk::findOrFail($id); // setelah memilih, dan jika tidak ada $id 404 {kurang lebih seperti itu}
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
		$this->productSelected->delete(); // untuk menghapus
		// $this->reset();
		$this->pilihanMenu = "lihat"; // untuk kembali ke lihat / semua pengguna
	}

	// fungsi untuk mengedit
	public function editSelected($id)
	{
		$this->productSelected = ModelProduk::findOrFail($id); // setelah memilih, dan jika tidak ada $id 404 {kurang lebih seperti itu}
		$this->kode = $this->productSelected->kode;
		$this->nama = $this->productSelected->name;
		$this->harga = $this->productSelected->price;
		$this->stock = $this->productSelected->stock;

		$this->pilihanMenu = "edit";
	}

	// fungsi untuk menyimpan edit
	public function saveEdit()
	{
		// untuk memvalidasi form tambah
		$this->validate([
			'kode' => 'required',
			'nama' => 'required',
			'harga' => 'required',
			'stock' => "required"
		], [
			"kode.required" => "Kode unik produk harus diisi",
			"nama.required" => "Nama produk harus diisi",
			"harga.required" => "Harga harus diisi",
			"stock.required" => "Stock harus dipilih"
		]);

		// fungsi edit
		$simpan = $this->productSelected;
		$simpan->kode = $this->kode;
		$simpan->name = $this->nama; // name untuk di user dan nama untuk di blade
		$simpan->price = $this->harga;
		$simpan->stock = $this->stock;
		$simpan->save(); // save

		$this->reset("kode", "nama", "harga", "stock", "productSelected"); // setelah melakukan pengisian form maka reset form
		$this->pilihanMenu = "lihat"; // kembali ke lihat / semua produk
	}

	public function render()
	{
		return view('livewire.produk')->with([
			"semuaProduk" => ModelProduk::all()
		]);
	}
	
}
