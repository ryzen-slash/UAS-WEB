<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
</head>
<body>
    <div class="form-structor">
        <div class="signup">
            <h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
            <form action="/register" method="post"> @csrf @method('POST')
                <div class="form-holder">
                    <input name="name" type="text" class="input" placeholder="Nama" />
                    <input name="email" type="email" class="input" placeholder="Email" />
                    <textarea name="address" cols="30" rows="10" placeholder="Alamat"></textarea>
                    <input name="password" type="password" class="input" placeholder="Password" />
                </div>
                <button type="submit" class="submit-btn">Sign up</button>
            </form>
        </div>
        <div class="login slide-up">
            <div class="center">
                <h2 class="form-title" id="login"><span>or</span>Log in</h2>
                <form action="/login" method="post"> @csrf @method('POST')
                    <div class="form-holder">
                        <input name="email" type="email" class="input" placeholder="Email" />
                        <input name="password" type="password" class="input" placeholder="Password" />
                    </div>
                    <button type="submit" class="submit-btn">Log in</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        console.clear();

        const loginBtn = document.getElementById('login');
        const signupBtn = document.getElementById('signup');

        loginBtn.addEventListener('click', (e) => {
            let parent = e.target.parentNode.parentNode;
            Array.from(e.target.parentNode.parentNode.classList).find((element) => {
                if(element !== "slide-up") {
                    parent.classList.add('slide-up')
                }else{
                    signupBtn.parentNode.classList.add('slide-up')
                    parent.classList.remove('slide-up')
                }
            });
        });

        signupBtn.addEventListener('click', (e) => {
            let parent = e.target.parentNode;
            Array.from(e.target.parentNode.classList).find((element) => {
                if(element !== "slide-up") {
                    parent.classList.add('slide-up')
                }else{
                    loginBtn.parentNode.parentNode.classList.add('slide-up')
                    parent.classList.remove('slide-up')
                }
            });
        });
    </script>
</body>
</html>
