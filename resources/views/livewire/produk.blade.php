<div class="container">
    <div class="row my-2">
        <div class="col-12">
            <button wire:click="pilihMenu('lihat')"
                class="btn {{ $pilihanMenu == 'lihat' ? 'btn-success' : 'btn-outline-success' }}">
                Semua Produk
            </button>
            <button wire:click="pilihMenu('tambah')"
                class="btn {{ $pilihanMenu == 'tambah' ? 'btn-success' : 'btn-outline-success' }}">
                Tambah Produk
            </button>
            <button wire:click="pilihMenu('excel')"
                class="btn {{ $pilihanMenu == 'excel' ? 'btn-success' : 'btn-outline-success' }}">
                import Produk
            </button>
            <button wire:loading class="btn btn-info">
                Loading ...
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if ($pilihanMenu == 'lihat')
                <div class="card border-primary">
                    <div class="card-header">
                        Semua Produk
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>stok</th>
                                <th>Data</th>
                            </thead>
                            <tbody>
                                @foreach ($semuaProduk as $produk)
                                    <tr>
                                        <td>{{ $produk['id'] }}</td>
                                        <td>{{ $produk['kode'] }}</td>
                                        <td>{{ $produk['name'] }}</td>
                                        <td>{{ $produk['price'] }}</td>
                                        <td>{{ $produk['stock'] }}</td>
                                        <td>{{ $produk['data'] }}</td>
                                        <td>
                                            <button wire:click="editSelected({{ $produk->id }})"
                                                class="btn btn-sm btn-warning">
                                                Edit
                                            </button>
                                            <button wire:click="removeSelected({{ $produk->id }})"
                                                class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif($pilihanMenu == 'tambah')
                <div class="card border-primary">
                    <div class="card-header">
                        Tambah Produk
                    </div>
                    <div class="card-body">
                        <form wire:submit="simpan" method="post">

                            <label for="kode">Kode</label>
                            <input type="string" class="form-control" wire:model="kode">
                            @error('kode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" wire:model="harga">
                            @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" wire:model="stock">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <button type="button" class="btn btn-warning mt-3" wire:click="batal">Cancel</button>
                            <button type="submit" class="btn btn-success mt-3">Simpan</button>

                        </form>
                    </div>
                </div>
            @elseif($pilihanMenu == 'edit')
                <div class="card border-primary">
                    <div class="card-header">
                        Edit Produk
                    </div>
                    <div class="card-body">
                        <form wire:submit="saveEdit" method="post">
                            <label for="kode">Kode</label>
                            <input type="string" class="form-control" wire:model="kode">
                            @error('kode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" wire:model="harga">
                            @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" wire:model="stock">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <button type="submit" class="btn btn-success mt-3">Simpan</button>
                            <button type="button" wire:click="batal" class="btn btn-success mt-3">Batal</button>
                        </form>
                    </div>
                </div>
            @elseif($pilihanMenu == 'hapus')
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">
                        Hapus Pengguna
                    </div>
                    <div class="card-body">
                        Anda Yakin menghapus Pengguna ini ? <br>
                        <span>Kode : {{ $productSelected->kode }}</span> dan
                        <span>Nama : {{ $productSelected->name }}</span> <br>
                        <button class="btn btn-danger mt-2" wire:click="hapus">Hapus</button>
                        <button class="btn btn-success mt-2" wire:click="batal">Batal</button>
                    </div>
                </div>
            @elseif($pilihanMenu == 'excel')
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        import Produk
                    </div>
                    <div class="card-body">
                        <form wire:submit='importExcel'>
                            <input type="file" id="file" class="form-control" wire:model="fileExcel">

                            <button class="btn btn-primary mt-2" type="submit">Kirim</button>
                            <button class="btn btn-danger mt-2" wire:click="batal">Batal</button>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
