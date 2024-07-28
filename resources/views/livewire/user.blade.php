<div>
    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-success' : 'btn-outline-success' }}">
                    Semua Pengguna
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-success' : 'btn-outline-success' }}">
                    Tambah Pengguna
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
                            Semua Pengguna
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Data</th>
                                </thead>
                                <tbody>
                                    @foreach ($semuaPengguna as $pengguna)
                                        <tr>
                                            <td>{{ $pengguna['id'] }}</td>
                                            <td>{{ $pengguna['name'] }}</td>
                                            <td>{{ $pengguna['email'] }}</td>
                                            <td>{{ $pengguna['peran'] }}</td>
                                            <td>
                                                <button wire:click="pilihMenu('edit')" class="btn btn-sm btn-warning">
                                                    Edit
                                                </button>
                                                <button wire:click="pilihMenu('hapus')"
                                                    class="btn btn-sm btn-danger">
                                                    Hapus
                                                </button>
                                                {{-- <button wire:click="pilihMenu('edit')"
                                                    class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                    Edit Pengguna
                                                </button> --}}
                                                {{-- <button wire:click="pilihMenu('hapus')"
                                                    class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                    Edit Pengguna
                                                </button> --}}
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
                            Tambah Pengguna
                        </div>
                        <div class="card-body">
                            tes
                        </div>
                    </div>
                @elseif($pilihanMenu == 'edit')
                    <div class="card border-primary">
                        <div class="card-header">
                            Edit Pengguna
                        </div>
                        <div class="card-body">
                            tes
                        </div>
                    </div>
                @elseif($pilihanMenu == 'hapus')
                    <div class="card border-primary">
                        <div class="card-header">
                            Hapus Pengguna
                        </div>
                        <div class="card-body">
                            tes
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
