<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrator Login | WARS-Bakery</title>
    <link rel="stylesheet" href="{{asset('assets/css/dashboard-login.css')}}">
</head>
<body>
  <div class="container">
    <div class="top"></div>
    <div class="bottom"></div>
    <div class="center">
      <h2>Please Sign In</h2>
      <form action="/admin/login" method="post">
        @csrf @method("POST")
        <input required name="email" type="email" placeholder="email"/>
        <input required name="password" type="password" placeholder="password"/>
        <input type="submit" value="Login">
      </form>
      <h2>&nbsp;</h2>
    </div>
  </div>
</body>
</html>
