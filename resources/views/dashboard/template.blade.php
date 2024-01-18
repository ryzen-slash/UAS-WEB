<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Leckerli+One&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('assets/css/dashboard-template.css')}}">
    @yield('css')

    <script src="https://kit.fontawesome.com/c5f9d8adf4.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="/">WARS-Bakery</a>
        </div>
    </header>
    <aside>
        <div class="menu-toggle">
            <div class="toggle-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <span>Sembunyikan Sidebar</span>
        </div>
        <menu>
            <li class="orders">
                <a href="/dashboard/orders#">
                    <div class="icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <span>Daftar Pesanan</span>
                </a>
            </li>
            <li class="products">
                <a href="/dashboard/foods#">
                    <div class="icon">
                        <i class="fa-solid fa-burger"></i>
                    </div>
                    <span>Menu Makanan</span>
                </a>
            </li>
        </menu>
        <nav class="logout">
            <a href="/admin/logout">
                <div class="icon">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </div>
                <span>Logout</span>
            </a>
        </nav>
    </aside>
    <main>
        @yield('main')
    </main>

<script>
    const sidebar    = document.querySelector("aside");
    const sidebarBtn = document.querySelector("aside .menu-toggle");

    sidebarBtn.onclick = (e) => {
        sidebar.classList.toggle('active');
    }
</script>

@yield('js')
</body>
</html>
