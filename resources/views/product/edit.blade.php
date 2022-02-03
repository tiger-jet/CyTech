@extends('product.layout')
@section('title', '商品情報編集')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>商品情報編集フォーム</h2>
        <p><a href='/product/{{$product->id}}'>→商品詳細画面へ戻る</a></p>

        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$product->id}}">

            <div class="form-group">
               <p>商品名：<input type="text" name="product_name" value="{{$product->product_name}}"></p>

                @if ($errors->has('product_name'))
                    <div class="text-danger">
                        <p>商品名を入力してください</p>
                    </div>
                @endif
            </div>
            
            <div class="form-group">
                <p>メーカー名：
                    <select name="company_name">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">"{{ $company->company_name}}"</option>
                    @endforeach
                    </select></p>
            </div>
            

            <div class="form-group">
                <p>値段：<input type="number" name="price" value="{{$product->price}}"></p>
                @if ($errors->has('price'))
                    <div class="text-danger">
                    <p>値段を入力してください</p>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <p>在庫数：<input type="number" name="stock" value="{{$product->stock}}"></p>
                @if ($errors->has('stock'))
                    <div class="text-danger">
                    <p>在庫数を入力してください</p>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <p>商品画像：<input type="file" name="picture" value="{{$product->picture}}"></p>
                @if ($errors->has('picture'))
                    <div class="text-danger">
                    <p>画像を添付してください</p>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <p>コメント：
                    <textarea name="comment"
                    class="form-control"
                    rows="4" >{{$product->comment}}
                    </textarea>
                </p>
                @if ($errors->has('comment'))
                    <div class="text-danger">
                    <p>コメントを入力してください</p>
                    </div>
                @endif
            </div>
            
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('product') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection