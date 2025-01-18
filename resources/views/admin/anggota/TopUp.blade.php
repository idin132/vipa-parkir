<style>
    .topup-form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 15rem;
    }
    
    .topup-form .form-group {
        margin-bottom: 15px;
    }

    .topup-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .topup-form input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }
    
    .topup-form input[type="number"]:focus {
        border-color: #80bdff;
        outline: none;
        box-shadow: 0 0 5px rgba(128, 189, 255, 0.3);
    }
    
    .btn-submit {
        display: inline-block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .btn-submit:hover {
        background-color: #0056b3;
    }
</style>


<form action="{{ route('TopUp', ['id_card' => $anggota->id_card]) }}" method="POST" class="topup-form">
    @csrf
    <div class="form-group">
        <label for="amount">Jumlah Top-Up:</label>
        <input type="number" id="amount" name="amount" placeholder="Masukkan jumlah" required>
    </div>
    <button type="submit" class="btn-submit">Top Up</button>
</form>
