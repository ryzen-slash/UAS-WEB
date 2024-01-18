@extends('dashboard.template')

@section('title', 'Edit Menu Makanan | WARS-Bakery')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/dashboard-edit-food.css')}}">
@endsection

@section('main')

<div class="container">
    <h1>Edit Menu Makanan</h1>

    <form action="/dashboard/foods/edit/{{$food->id}}" method="post" enctype="multipart/form-data">
    @csrf @method("PUT")
        <ul class="form-group">
            <li class="input">
                <label for="name">Nama Menu</label>
                <input value="{{$food->name}}" type="text" name="name" id="name" placeholder="Masukkan Nama Menu">
            </li>
            <li class="input">
                <label for="price">Harga Menu (Rp)</label>
                <input value="{{$food->price}}" type="number" name="price" id="price" pattern="[0-9]*" inputmode="numeric" min="1000" step="1000" placeholder="10000">
            </li>
            <li class="image-preview">
                <img src="{{asset('storage/'.$food->img.'')}}" alt="Image of {{$food->name}}">
            </li>
            <li class="input upload">
                <label for="thumbnail">Gambar Menu</label>
                <input type="file" name="img" id="thumbnail">
                <input type="hidden" name="old_thumbnail" value="{{$food->img}}">
            </li>
            <li class="submit">
                <button type="submit">Simpan</button>
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
