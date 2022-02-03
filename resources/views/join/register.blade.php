<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会員登録</title>
    <link rel="stylesheet" href="/css/register.css">
    <script src="/js/product.js" defer></script>
</head>

<body>

<div id="wrap">
    <div id="head">
        <h1>会員登録</h1>
    </div>

    <div id="content">
        <p>次のフォームに必要事項をご記入ください。</p>
        <a class = backToLogin href="{{route('home')}}">→ログイン画面へ戻る</a>
        <form action="{{ route('exeRegister') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            <dl>
                <dt>お名前<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="user_name" size="35">
                </dd>
                <dt>メールアドレス<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="email" size="35" maxlength="255" >
                <dt>パスワード<span class="required">必須</span></dt>
                <dd>
                    <input type="password" name="password" size="10" maxlength="20">
                </dd>
                <dt>パスワード確認用<span class="required">必須</span></dt>
                <dd>
                    <input type="password" name="password_confirmation" size="10" maxlength="20" value="">
                </dd>
            </dl>
            <div><input type="submit" value="登録する"/></div>
        </form>
    </div>
</body>

</html>