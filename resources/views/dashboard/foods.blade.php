@extends('dashboard.template')

@section('title', 'Daftar Menu Makanan | WARS-Bakery')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/dashboard-foods.css')}}">
@endsection

@section('main')

<div class="container">
    <h1>Daftar Menu Makanan</h1>

    <div class="new-btn">
        <a href="/dashboard/foods/new">
            <i class="fa-solid fa-plus"></i>
            <span>Menu Baru</span>
        </a>
    </div>

    <table cellspacing=0>
        <thead>
            <tr>
                <th>No.</th>
                <th>Thumbnail</th>
                <th>Nama</th>
                <th>Harga</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
            <tr>
                <td class="center">{{$loop->iteration}}</td>
                <td class="center">
                    <div class="thumbnail">
                        <img src="{{asset('storage/'.$food->img.'')}}" alt="Image of {{$food->name}}">
                    </div>
                </td>
                <td class="left">{{$food->name}}</td>
                <td class="center">Rp{{ number_format($food->price, 2, ',', '.') }}</td>
                <td class="center">
                    <div class="action">
                        <div class="edit">
                            <a href="/dashboard/foods/edit/{{$food->id}}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                        <div class="delete">
                            <form action="/dashboard/foods/{{$food->id}}" method="POST">
                                @csrf @method("DELETE")
                                <button type="submit" onclick="return confirm('Anda Yakin Ingin Menghapus Item {{$food->name}} ?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
