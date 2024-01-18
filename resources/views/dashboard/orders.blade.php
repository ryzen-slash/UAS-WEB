@extends('dashboard.template')

@section('title', 'Daftar Pesanan | WARS-Bakery')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/dashboard-orders.css')}}">
@endsection


@section('main')

<div class="container">
    <h1>Daftar Pesanan</h1>

    <table cellspacing=0>
        <thead>
            <tr>
                <th>No.</th>
                <th>Alamat</th>
                <th>Nama Pemesan</th>
                <th>Thumbnail</th>
                <th>Nama Menu</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="center">{{$loop->iteration}}</td>
                <td class="left address">{{$order->address}}</td>
                <td class="left">{{$order->name}}</td>
                <td class="center">
                    <div class="thumbnail">
                        <img src="{{asset('storage/' . $order->img)}}" alt="Image of {{$order->product_name}}">
                    </div>
                </td>
                <td class="left">{{$order->product_name}}</td>
                <td class="center">Rp{{number_format($order->price, 2, ',', '.')}}</td>
                <td class="center">{{$order->qty}}</td>
                <td class="center">Rp{{number_format($order->total_price, 2, ',', '.')}}</td>
                <td class="center">
                    <div class="action">
                        <div class="accept">
                            <form action="/orders/accept/{{$order->id}}" method="POST">
                                @csrf @method("PUT")
                                <button type="submit">
                                    <i class="fa-solid fa-check-double"></i>
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
