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

    <title>Riwayat Transaksi</title>
</head>
<body>
    <div class="main-content">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <center>
                            <h5 class="card-title">Riwayat Transaksi - ID Card: {{ $id_card }}</h5>
                        </center>
                    </div>
                    <div class="card-body">
                        <table id="TransactionHistory" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Card</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Durasi</th>
                                    <th>Jam Keluar</th>
                                    <th>Tarif</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->id_card }}</td>
                                        <td>{{ $transaction->tanggal }}</td>
                                        <td>{{ $transaction->jam_masuk }}</td>
                                        <td>{{ $transaction->durasi }}</td>
                                        <td>{{ $transaction->jam_keluar }}</td>
                                        <td>{{ $transaction->tarif }}</td>
                                        <td>
                                            @if($transaction->status == 'selesai')
                                                <button class="btn btn-success">Selesai</button>
                                            @elseif($transaction->status == "aktif")
                                                <button class="btn btn-warning">Aktif</button>
                                            @else
                                                -
                                            @endif
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
    <br>
    <br>
    <center><h3><a href="{{route('anggota.index')}}">Kembali</a></h3></center>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#TransactionHistory');
    </script>
</body>
</html>
