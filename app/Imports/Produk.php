<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use app\Models\Produk as ModelProduk;

class Produk implements ToCollection, WithStartRow
{

	public function startRow(): int
	{

		return 1;
	}


	/**
	 * @param Collection $collection
	 */
	public function collection(Collection $collection)
	{
		dd($collection);
		
	}

}
