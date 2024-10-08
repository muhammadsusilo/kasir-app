<?php

namespace App\Livewire;

use App\Models\Produk as ModelProduk;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Produk as imporProduk;

class Produk extends Component
{

	use WithFileUploads;

	public $pilihanMenu = "lihat";
	public $kode;
	public $nama;
	public $harga;
	public $stock;
	public $productSelected;
	public $fileExcel;


	public function pilihMenu($menu)
	{
		$this->pilihanMenu = $menu;
	}

	// fungsi untuk simpan
	public function simpan()
	{
		// untuk memvalidasi form tambah
		$this->validate([
			'kode' => ["required", "unique:produks,kode"],
			'nama' => 'required',
			'harga' => 'required',
			'stock' => "required"
		], [
			"kode.required" => "Kode produk harus diisi",
			"kode.unique" => "Kode sesuai format",
			"kode.kode" => "Kode telah digunakan",
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
			'kode' => ["required", "unique:produks,kode"],
			'nama' => 'required',
			'harga' => 'required',
			'stock' => "required"
		], [
			"kode.required" => "Kode produk harus diisi",
			"kode.unique" => "Kode sesuai format",
			"kode.kode" => "Kode Telah digunakan",
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

	public function importExcel() // nama di ambil dari wire model submit import excel
	{

		Excel::import(new imporProduk, $this->fileExcel);  // file excel name di input
		$this->reset();

	}

}
