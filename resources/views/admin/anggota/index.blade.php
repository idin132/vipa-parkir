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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

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
                        <!-- <a class="btn btn-success mx-2" href="#"><i class="bi bi-file-excel mr-2"></i> Export Excel</a> -->
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
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Saldo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $var)
                                    <tr>
                                        <td>{{ $var->id }}</td>
                                        <td>{{ $var->id_card }}</td>
                                        <td>{{ $var->nama_anggota }}</td>
                                        <td>{{ $var->jenis_kelamin }}</td>
                                        <td>{{ $var->saldo }}</td>
                                        <td>
                                            @if($var->status == 'aktif')
                                                <button class="btn btn-success">Aktif</button>
                                            @elseif($var->status == "diblokir")
                                                <button class="btn btn-danger">Diblokir</button>
                                            @else
                                                <button class="btn btn-secondary">Inactive</button>
                                            @endif
                                        </td>

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
                                                    <a class="dropdown-item"
                                                        href="{{ route('FormTopUp', ['id_card' => $var->id_card]) }}"><i
                                                            class="bi bi-cart"></i>
                                                        TopUp</a>
                                                    <a class="dropdown-item"
                                                        href="{{route('anggota.edit', $var->id_card)}}"><i
                                                            class="bi bi-arrow-repeat"></i>
                                                        Ubah</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('transaction-history', $var->id_card) }}">
                                                        <i class="bi bi-clipboard-data"></i> Riwayat
                                                    </a>
                                                    @if ($var->status == 'aktif')
                                                        <a class="dropdown-item" href="#"
                                                            onclick="confirmBlock('{{ $var->id_card }}')">
                                                            <i class="bi bi-exclamation-triangle"></i> Blokir
                                                        </a>
                                                    @else
                                                        <a class="dropdown-item" href="#"
                                                            onclick="confirmAktif('{{ $var->id_card }}')">
                                                            <i class="bi bi-exclamation-triangle"></i> Buka Blokir
                                                        </a>
                                                    @endif


                                                </div>
                                            </div>
                                            <form id="delete-form-{{ $var->id_card }}"
                                                action="{{route('anggota.destroy', $var->id_card)}}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button style="font-size: 12px" type="button" class="btn btn-danger"
                                                    onclick="confirmHapus('{{ $var->id_card }}')">
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
    <script>
        function confirmBlock(id_card) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Yakin diblokir?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, block it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to block the user
                    fetch(`{{ route('block-user', '') }}/${id_card}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id_card: id_card
                        })
                    }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Blocked!',
                                    'Status has been updated to diblokir.',
                                    'success'
                                );
                                // Optionally reload the page or update the status on the page
                                location.reload(); // Reload page to see the status updated
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong, try again.',
                                    'error'
                                );
                            }
                        });
                }
            });
        }

    </script>
    <script>
        function confirmAktif(id_card) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Aktifkan Kembali?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Ya, Aktifkan Kembali',
                cancelButtonText: 'Tidak, Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to block the user
                    fetch(`{{ route('aktif-user', '') }}/${id_card}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id_card: id_card
                        })
                    }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Aktif!',
                                    'Status has been updated to aktif.',
                                    'success'
                                );
                                // Optionally reload the page or update the status on the page
                                location.reload(); // Reload page to see the status updated
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong, try again.',
                                    'error'
                                );
                            }
                        });
                }
            });
        }

    </script>
    <script>
        function confirmHapus(id_card) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirmed, submit the form
                    // Find the form containing the delete button and submit it
                    document.getElementById('delete-form-' + id_card).submit();
                }
            });
        }

    </script>
</body>

</html>