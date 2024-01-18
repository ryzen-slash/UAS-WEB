@extends('dashboard.template')

@section('title', 'Tambah Menu Makanan | WARS-Bakery')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/dashboard-new-food.css')}}">
@endsection

@section('main')

<div class="container">
    <h1>Tambah Menu Makanan</h1>

    <form action="/dashboard/foods/new" method="post" enctype="multipart/form-data">
    @csrf @method("POST")
        <ul class="form-group">
            <li class="input">
                <label for="name">Nama Menu</label>
                <input required type="text" name="name" id="name" placeholder="Masukkan Nama Menu">
            </li>
            <li class="input">
                <label for="price">Harga Menu (Rp)</label>
                <input required type="number" name="price" id="price" pattern="[0-9]*" inputmode="numeric" min="1000" step="1000" placeholder="10000">
            </li>
            <li class="input upload">
                <label for="thumbnail">Gambar Menu</label>
                <input required type="file" name="img" id="thumbnail">
            </li>
            <li class="submit">
                <button type="submit">Buat Menu</button>
            </li>
        </ul>
    </form>

</div>

@endsection
@section('js')
<script>
    document.addEventListener("input", function (event) {
        if (event.target.type === "number") {
            event.target.setCustomValidity("");
            if (!/^[0-9]*$/.test(event.target.value)) {
                event.target.setCustomValidity("Masukkan hanya angka");
            }
        }
    });
</script>
@endsection
