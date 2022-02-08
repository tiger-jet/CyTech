<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginFormRequest;
use InterventionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cytechController extends Controller
{   
//ログイン画面表示
public function showLogin () {
    return view ('join.login');
}

//ログイン処理　成功→商品詳細へ　失敗→戻る
public function login(LoginFormRequest $request) {
    $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
        $request ->session()->regenerate();
        return redirect (route('product'));
        }else{
        return redirect (route('home'))->with('err_msg', 'メールアドレス又はパスワードが間違っています');}
    }

//ログアウト
public function logout(Request $request) {
    Auth::logout();
    $request ->session()->invalidate();
    $request ->session()->regenerateToken();
    return redirect(route('home'));
}

//新規登録画面表示
public function showRegister() {
    return view ('join.register');
}

//登録処理
public function exeRegister(RegisterRequest $request) {
    \DB::beginTransaction();

    try{
            // 商品をデータベースに登録
            User::create ([
                'user_name' => $request ->user_name,
                'email' => $request ->email,
                'password' => Hash::make ( $request ->password)
            ]);

        \DB::commit();
    }catch (\Throwable $e) {
        \DB::rollback();
        abort(500);
    }

    return redirect(route('home'));
    }



// 商品一覧を表示
public function showProduct(Request $request) {
            $Company = new Company;
            $products = $Company->join()
            ->select('companies.*', 'products.*')
            ->get();
    return view ('product.product', ['products' => $products ]);
    }

//商品名検索機能
 public function search(Request $request) {
    $request ->all();
    $Company = new Company;
    $products = $Company->join()
                ->Where('products.product_name','like',"%$request->search_product_name%")
                ->Where('companies.id',"$request->search_company_name")
                ->get();

   return view ('product.product', ['products' => $products ]);
    }

// 商品詳細画面を表示
public function showDetail($id) {

            $Company = new Company;
            $products = $Company->join()
            ->select('*')
            ->where('products.id', '=', $id )
            ->get();


    if (is_null($products)) {
        \Session::flash('err_msg', 'データがありません');
        return redirect(route('product'));
    }
    return view('product.detail', ['products' => $products ]);
    }

// 商品登録画面を表示
public function showCreate() {
    $companies = Company::all();
    return view ('product.form', compact('companies'));
    }


// 商品情報を登録
public function exeStore (ProductRequest $request) {

    \DB::beginTransaction();

    try{
            // アップロードされたファイルの取得
            $path = $request ->file('picture');
            //リサイズ
            InterventionImage::make($path)->resize(100, 100)->save($path);
            // ファイルの保存とパスの取得
            $path = isset($path) ? $path -> store('items', 'public') : '';
            // 商品をデータベースに登録
            Product::create([
                'product_name' => $request ->product_name,
                'company_id' => $request ->company_name,
                'price' => $request ->price,
                'stock' => $request ->stock,
                'comment' => $request ->comment,
                'picture' => $path
            ]);

        \DB::commit();
    }catch(\Throwable $e){
        \DB::rollback();
        abort(500);
    }

    \Session::flash('err_msg', '登録しました');
    return redirect(route('product'));
}

//編集フォーム
public function showEdit($id) {
    $product = Product::find ($id);
    $companies = Company::all();

    if(is_null($product)){
        \Session::flash('err_msg', 'データがありません');
        return redirect(route('product'));
    }
    return view('product.edit', ['product' => $product ], ['companies' => $companies ]);
    }

//更新処理
public function exeUpdate(ProductRequest $request) {
    \DB::beginTransaction();

    try{

        //アップロードされたファイルの取得
        $path = $request ->file('picture');
        //リサイズ
        InterventionImage::make($path) ->resize(100, 100)->save($path);
        //ファイルの保存とパスの取得
        $path = isset($path) ? $path ->store('items', 'public') : '';
        //クリックされたid
        $id = $request ->id;

        $product=Product::find($id);

        $product->fill([
            'product_name' => $request ->product_name,
            'company_id' => $request ->company_name,
            'price' => $request ->price,
            'stock'=> $request ->stock,
            'picture' => $path,
            'comment' => $request ->comment
        ]);
      
        $product ->save();
        \DB::commit();
        
    }catch(\Throwable $e){
        \DB::rollback();
        abort(500);
    }

    \Session::flash('err_msg', '更新しました');
    return redirect(route('product'));
    }

//削除
public function exeDelete($id) {
    
    if (empty($id)) {
        \Session::flash('err_msg', 'データがありません');
        return redirect(route('product'));
    }
   
    try{
        Product::destroy($id);
    }catch(\Throwable $e){
        \DB::rollback();
        abort(500);
    }

    \Session::flash('err_msg', '削除しました');
    return redirect(route('product'));
    }
}
