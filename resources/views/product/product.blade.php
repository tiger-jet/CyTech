@extends('product/layout')
@section('title','商品一覧')
@section('content')
         
 <div class="row">
  <div class="col-md-10 col-md-offset-2">
      <h2>商品一覧</h2>
      @if (session('err_msg'))
            <p class="text-danger">
                {{ session('err_msg') }}
            </p>
        @endif
        <div class="search">
            <form class="form-inline my-2 my-lg-0 ml-2 search" acition="{{route('search')}}" method="post">
                @csrf
                <div class="form-group">
                <input type="search" class="form-control mr-sm-2" name="search_product_name"  value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">
                <select class="form-control maker_search" name="search_company_name">
                    @foreach ($products as $product)
                        <option value="{{ $product->company_id }}">"{{ $product->company_name}}"</option>
                    @endforeach
                </select>
                <input type="submit" value="検索" class="btn btn-info">
                </div>
            </form>
        </div>
      <table class="table table-striped">
          <tr>
              <th>商品番号</th>
              <th>商品画像</th>
              <th>商品名</th>
              <th>価格</th>
              <th>在庫</th>
              <th>メーカー名</th>
              <th></th>
              <th></th>
              
          </tr>
          @foreach($products as $product)
          <tr>
              <td>{{$product->id}} </td>
              <td><img src="{{asset('storage/'.$product->picture)}}"></td>
              <td>{{$product->product_name}} </td>
              <td>{{$product->price}}</td>
              <td>{{$product->stock}}</td>
              <td>{{$product->company_name}}</td>
              <td><a href="/product/{{$product->id}}">詳細へ</a></td>
              <form method="POST" action="{{ route('delete' ,$product->id) }}" onSubmit="return checkSubmit('削除してよろしいですか？')">
             @csrf
              <td><button type="submit" onclick="">削除する</button></td>
              </form>
              
          </tr>
          @endforeach
      </table>
  </div>
</div>
@endsection
    