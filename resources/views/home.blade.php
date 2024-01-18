<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Leckerli+One&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <title>Rasa yang Menggoda, Kebahagiaan dalam Setiap Gigitan | Selamat Datang di WARS-Bakery!</title>

    <link rel="stylesheet" href="{{asset('assets/css/home.css')}}">
    <script src="https://kit.fontawesome.com/c5f9d8adf4.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <span class="logo">
            <a href="#">WARS-Bakery</a>
        </span>
        <menu>
            <li class="home">
                <a href="#">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="home">
                <a href="#menu">
                    <i class="fa-solid fa-bell-concierge"></i>
                    <span>Menu</span>
                </a>
            </li>
            <li class="cart">
                <a href="#cart" onclick="cartToggle()">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </li>
            @guest('customers')
            <li class="login">
                <a href="/login">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    <span>Login</span>
                </a>
            </li>
            @endguest
            @auth('customers')
            <li class="login">
                <a href="/logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>
            @endauth
        </menu>
    </header>
    <aside id="cart">
        <h1 class="cart-title">Your Cart <i style="color: white;" class="fa-brands fa-opencart"></i></h1>
        <menu>
            @foreach ($carts_item as $cart)
            <li>
                <div class="menu-item">
                    <div class="menu-thumbnail">
                        <img src="{{asset('storage/' . $cart->img)}}" alt="Menu Thumbnail">
                    </div>
                    <div class="menu-description">
                        <h2 class="menu-title">{{$cart->name}}</h2>
                        <p class="menu-price">Rp{{number_format($cart->price, 2, ',', '.')}}</p>
                        <div class="cta-btn">
                            <form action="/order" method="POST"> @csrf @method("POST")
                                <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                <input type="hidden" name="product_id" value="{{$cart->product_id}}">
                                <div class="counter-btn">
                                    <span class="number">
                                        <input type="number" name="qty" id="qty" value="{{$cart->qty}}" min="1">
                                    </span>
                                </div>
                                <div class="shop-btn">
                                    <button type="submit">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                        <span>Beli Sekarang</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </menu>
    </aside>
    <main>
        <section class="hero">
            <div class="hero-text">
                <h1 class="hero-title">Rasa yang Menggoda, Kebahagiaan dalam Setiap Gigitan. <strong>Selamat Datang di WARS-Bakery!</strong></h1>
                <div class="cta-btn">
                    <a href="#menu">
                        Nikmati Sekarang &downarrow;
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{asset('assets/img/hero-image.jpg')}}" alt="hero-image" loading="lazy">
            </div>
        </section>
        <section class="menu" id="menu">
            <h2 class="menu-title">Enjoy Our Masterpieces!</h2>
            <div class="cards">
                @foreach($foods as $food)
                <div class="card">
                    <div class="card-body">
                        <div class="card-img">
                            <img src="{{asset('storage/'.$food->img.'')}}" alt="Image of {{$food->name}}" loading="lazy">
                        </div>
                        <div class="card-info">
                            <h3 class="menu-title">{{$food->name}}</h3>
                            <p class="menu-price">Rp{{number_format($food->price, 2, ',', '.')}}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="/cart/new/{{$food->id}}" method="POST"> @csrf @method('POST')
                            @php
                                $disabled = false;
                                foreach($carts_item as $cart) {
                                    if($cart->product_id == $food->id) {
                                        $disabled = true;
                                    }
                                }
                            @endphp
                            <button type="submit" class={{$disabled ? "disabled" : ""}}>
                                <div class="add-to-cart">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>Add To Cart</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </main>


    <script>
        const cartBtn  = document.querySelector("header menu li.cart a");
        const cartMenu = document.getElementById("cart");

        function cartToggle() {
            cartMenu.classList.toggle('active');
        }
    </script>
</body>
</html>
