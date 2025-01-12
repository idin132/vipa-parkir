<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="https://codepen.io/gymratpacks/pen/VKzBEp#0">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../assets/css/create.css">
</head>
@include('admin.layouts.sidebar')

<body>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('anggota.store')}}" method="post">
                @csrf
                <div>
                    <h4> Tambah Anggota </h4>
                </div>
                <hr>
                <fieldset>
                    <label for="id_card">ID Card</label>
                    <input type="text" id="id_card" name="id_card">

                    <label for="id_chat">ID Chat</label>
                    <input type="text" id="id_chat" name="id_chat">

                    <label for="nama_anggota">Nama Lengkap</label>
                    <input type="text" id="nama_anggota" name="nama_anggota">

                    <label>Jenis Kelamin</label><br>
                    <input type="radio" id="laki-laki" value="laki-laki" name="jenis_kelamin">
                    <label for="laki-laki" class="light">Laki-laki</label>
                    <input type="radio" id="wanita" value="wanita" name="jenis_kelamin">
                    <label for="wanita" class="light">Wanita</label><br><br>

                    <label for="saldo">Saldo</label>
                    <input type="text" id="saldo" name="saldo">
                </fieldset>
                <br>
                <button type="submit">OK</button>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk menangani pengisian ID Card dari alat IoT 
        function fillIdCard(idCard) {
            document.getElementById('id_card').value = idCard;
        }

        // Simulasi panggilan API alat IoT (gunakan AJAX untuk request nyata) 
        setTimeout(() => {
            fetch('/api/fill-id-card', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id_card: 'RFID1430' }) // Ganti dengan data dari alat IoT 
            })
                .then(response => response.json())
                .then(data => fillIdCard(data.id_card))
                .catch(error => console.error('Error:', error));
        }, 1000); // Simulasi delay untuk pengisian 
    </script>
</body>

</html>