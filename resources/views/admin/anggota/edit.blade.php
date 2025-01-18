<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota Update</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form action="{{ route('anggota.update', $anggota->id_card)}}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="id_card">ID Card</label>
                                        <input type="text" name="id_card" class="form-control"
                                            value="{{($anggota->id_card)}}" id="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="id_chat">ID Chat</label>
                                        <input type="text" name="id_chat" class="form-control"
                                            value="{{($anggota->id_chat)}}" id="">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="nama_anggota">Nama</label>
                                        <input type="text" name="nama_anggota" class="form-control"
                                            value="{{($anggota->nama_anggota)}}" id="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                            <option value="wanita" {{ $anggota->jenis_kelamin == 'wanita' ? 'selected' : '' }}>Wanita</option>
                                            <option value="laki-laki" {{ $anggota->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>laki-laki</option>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="font-weight-bold" for="saldo">Saldo</label>
                                        <input type="text" name="saldo" class="form-control"
                                            value="{{($anggota->saldo)}}" id="">
                                    </div> -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    <button type="reset" class="btn btn-warning">RESET</button>
                                    <a type="button" class="btn btn-info" href="{{ route('anggota.index')}}">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>