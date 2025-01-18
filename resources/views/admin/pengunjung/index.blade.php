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

        <title>Data Pengunjung Parkir</title>
    </head>

    <body>
        @extends('admin.layouts.sidebar')
        <div class="main-content">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header mb-2">
                            <center>
                                <h5 class="card-title">Data Pengunjung Parkir</h5>
                            </center>
                        </div>
                        <form class="d-flex align-items-center">
                            <!-- <a class="btn btn-success mx-2" href="#"><i class="bi bi-file-excel mr-2"></i> Export Excel</a> -->
                        </form>

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        <div class="card-body">
                            <table id="Pengunjung" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Card</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Durasi</th>
                                        <th>Jam Keluar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengunjung as $var)
                                        <tr>
                                            <td>{{ $var->id }}</td>
                                            <td>{{ $var->id_card }}</td>
                                            <td>{{ $var->nama }}</td>
                                            <td>{{ $var->tanggal }}</td>
                                            <td>{{ $var->jam_masuk }}</td>
                                            <td>{{ $var->durasi }}</td>
                                            <td>{{ $var->jam_keluar }}</td>
                                            <td>{{ $var->status }}</td>
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
            let table = new DataTable('#Pengunjung');
        </script>
    </body>

    </html>