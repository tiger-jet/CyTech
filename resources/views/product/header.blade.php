<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">自販機売上管理システム</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-item nav-link active" href="{{route('product')}}">商品一覧 <span class="sr-only"></span></a></li>
      <li class="nav-item"><a class="nav-item nav-link active" href="{{route('create')}}">新規商品登録</a></li>
     </div>
     <ul class="navbar-nav">
      <form class="nav-item nav-link active" action="{{route('logout')}}" method="post">
      @csrf  
      <button type="submit">ログアウト</button>
      </form>
    </div>
  </div>
</nav>