<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

    <title>Data Anggota</title>
</head>

<body>
    @extends('admin.layouts.sidebar')
    <div class="main-content">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <center>
                            <h5 class="card-title">Data Anggota</h5>
                        </center>
                    </div>
                    <form class="d-flex align-items-center">
                        <a class="btn btn-info mr-2 ml-2" href="{{ route('anggota.create')}}"><i class="bi bi-plus mr-2"></i>Tambah Anggota</a>
                        <a class="btn btn-success" href="#"><i class="bi bi-file-excel mr-2"></i> Export Excel</a>
                    </form>

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <table id="Anggota" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Card</th>
                                    <th>ID Chat</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Saldo</th>
                                    <th>Telegram</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $var)
                                    <tr>
                                        <td>{{ $var->id }}</td>
                                        <td>{{ $var->id_card }}</td>
                                        <td>{{ $var->id_chat }}</td>
                                        <td>{{ $var->nama_anggota }}</td>
                                        <td>{{ $var->jenis_kelamin }}</td>
                                        <td>{{ $var->saldo }}</td>
                                        <td>{{ $var->telegram }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a style="font-size: 14.5px" href="#"
                                                    class="btn btn-sm btn-primary dropdown-toggle"
                                                    id="dropdownMenuButton{{ $var->id }}" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <div class="dropdown-menu"
                                                    aria-labelledby="dropdownMenuButton{{ $var->id }}">
                                                    <a class="dropdown-item" href="#"><i class="bi bi-cart"></i>
                                                        TopUp</a>
                                                    <!-- <a class="dropdown-item" href="#"><i class="bi bi-trash"></i>
                                                        Hapus</a> -->
                                                    <a class="dropdown-item" href="#"><i class="bi bi-arrow-repeat"></i>
                                                        Ubah</a>
                                                    <a class="dropdown-item" href="#"><i class="bi bi-clipboard-data"></i>
                                                        Riwayat</a>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="bi bi-exclamation-triangle"></i> Blokir</a>
                                                    <a class="dropdown-item" href="#"><i class="bi bi-person"></i> Reset
                                                        ID</a>
                                                </div>
                                            </div>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button style="font-size: 12px" type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#Anggota');
    </script>
</body>

</html>