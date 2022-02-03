@extends('product/layout')
@section('title','商品詳細')
@section('content')

 <div class="row">
  <div class="col-md-20 col-md-offset-2">
      <h2>商品一覧</h2>
    
      <table class="table table-striped">
          <tr>
              <th>商品番号</th>
              <th>商品画像</th>
              <th>商品名</th>
              <th>メーカー</th>
              <th>価格</th>
              <th>在庫数</th>
              <th>コメント</th>
              <th></th> 
          </tr>
          @foreach($products as $product)
          <tr>
              <td>{{$product->id}}</td>
              <td><img src="{{asset('storage/'.$product->picture)}}"></td>
              <td>{{$product->product_name}}</td>
              <td>{{$product->company_name}}</td>
              <td>{{$product->price}}</td>
              <td>{{$product->stock}}</td>
              <td>{{$product->comment}}</td>
              <td><button type="button" onclick="location.href='/product/edit/{{$product->id}}'">編集する</button></td>
          </tr>
          @endforeach
      </table>
  
  </div>
</div>
@endsection
    