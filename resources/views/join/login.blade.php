<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインフォーム</title>
    <script src="{{asset('js/app.js')}}" defer ></script>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/join.css')}}" rel="stylesheet">
</head>
<body>

<form class="form-signin" method="POST" action="{{route('login')}}">
@csrf
  <h1 class="h3 mb-3 font-weight-normal">ログインフォーム</h1>
 
  @if (session('err_msg'))
    <p class="alert alert-success">
        {{ session('err_msg') }}
    </p>
  @endif

  <label for="inputEmail" class="sr-only">メールアドレス</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" autofocus>
  <label for="inputPassword"  class="sr-only">パスワード</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <p><a href="{{route('register')}}">→新規会員登録はこちら</a></p>
  <button class="btn btn-lg btn-primary btn-block btn-size form-control" type="submit">ログイン</button>
</form>

</body>
</html>