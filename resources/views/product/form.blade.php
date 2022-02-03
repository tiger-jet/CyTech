@extends('product.layout')
@section('title', '新規商品登録')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>新規商品登録</h2>
        <p class = backToProduct><a href="{{route('product')}}">→商品一覧画面へ戻る</a></p>
        <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
               <p>商品名：<input type="text" name="product_name"></p>

                @if ($errors->has('product_name'))
                    <div class="text-danger">
                        <p>商品名を入力してください</p>
                    </div>
                @endif
            </div>

            <div class="form-group">
                メーカー名：
                    <select class="form-control" name="company_name">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">"{{ $company->company_name}}"</option>
                        @endforeach
                    </select>
                    
            </div>

            <div class="form-group">
                <p>値段：<input type="number" name="price"></p>
                @if ($errors->has('price'))
                    <div class="text-danger">
                    <p>値段を入力してください</p>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <p>在庫数：<input type="number" name="stock"></p>
                @if ($errors->has('stock'))
                    <div class="text-danger">
                    <p>在庫数を入力してください</p>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <p>コメント：
                    <textarea name="comment"
                    class="form-control"
                    rows="4" >
                    </textarea>
                </p>
                @if ($errors->has('comment'))
                    <div class="text-danger">
                    <p>コメントを入力してください</p>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <p>商品画像：<input type="file" name="picture" accept="image/png, image/jpeg"></p>
                @if ($errors->has('picture'))
                    <div class="text-danger">
                    <p>画像をjpeg又はpng形式で添付してください</p>
                    </div>
                @endif
            </div>

            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('product') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    登録する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection