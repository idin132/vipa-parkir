@extends('admin.layouts.sidebar')

@section('title', 'Dashboard')

@section('content')

<!-- CSS -->
<style>
    /* Card Styles */
.card1 {
    margin-top: 20px;
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background: linear-gradient(90deg, rgba(41,38,210,1) 35%, rgba(67,113,160,1) 100%);
    color: white;
    text-align: center;
    padding: 2rem; /* Added padding from .card.p-4 */
}
.card2 {
    margin-top: 20px;
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background: linear-gradient(90deg, rgba(0,72,255,1) 35%, rgba(165,131,233,1) 100%);
    color: white;
    text-align: center;
    padding: 2rem; /* Added padding from .card.p-4 */
}
.card3 {
    margin-top: 20px;
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background: linear-gradient(90deg, rgba(21,0,255,1) 35%, rgba(72,159,200,1) 100%);
    color: white;
    text-align: center;
    padding: 2rem; /* Added padding from .card.p-4 */
}

.card h3 {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.card h5 {
    font-size: 1.5rem;
    font-weight: 600;
}

/* Container Spacing */
.container {
    margin-top: 2rem;
}

/* Adjust Cards in Grid */
.row {
    gap: 1rem;
}

/* Adjust Cards for Smaller Screens */
@media (max-width: 768px) {
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .col-md-4 {
        flex: 1 1 calc(100% - 1rem);
        margin-bottom: 1rem;
    }
}
</style>

<!-- Content -->
<div class="row">
    <div class="col-md-4">
        <div class="card1 p-4 text-black">
            <h3>Total Anggota</h3>
            <h5>
                <i class="bi bi-person-fill"></i> 10
            </h5>
            <hr>
            <br> <!--untuk diisi-->
        </div>
    </div>
    <div class="col-md-4">
        <div class="card2 p-4 text-black">
            <h3>Top Up Hari Ini</h3>
            <h5>
                <i class="bi bi-cart"></i> 10
            </h5>
            <hr>
            <h5>
                <i class="bi bi-wallet2"></i></i> Rp100.000
            </h5>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card3 p-4 text-black">
            <h3>Pengunjung</h3>
            <h5>
                <i class="bi bi-people-fill"></i> 10
            </h5>
            <hr>
            <br> <!--untuk diisi-->
        </div>
    </div>
</div>

@endsection