<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Produk as ModelProduk;

class Produk implements ToCollection, WithStartRow
{

	public function startRow(): int
	{
		return 3;
	}


	/**
	 * @param Collection $collection
	 */
	public function collection(Collection $collection)
	{
		// dd($collection);
		
		foreach($collection as $col)
		{
			// mengambil kode untuk di database
			$databaseToCode = ModelProduk::where('kode', $col[1])->first();
			
			// jika tidak ada di dalam database maka simpan data
			if(!$databaseToCode){
				$simpan = new ModelProduk();
				$simpan->kode = $col[1];
				$simpan->name = $col[2];
				$simpan->price = $col[3];
				$simpan->stock = 10 ; // default stock
				$simpan->save();


			}
			
		}



	}

}
