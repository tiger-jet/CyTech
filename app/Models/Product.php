<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;

    //テーブル名
    protected $table = 'products';

    //可変項目
    protected $fillable=
    [
        'id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'picture',
        'created_at',
        'updated_at'
    ];

     //CompaniesとProductsの結合処理
     Public function join(){
        $join = DB::table('products')
                ->join('companies', 'products.company_id', '=', 'companies.id');
        return $join;
    }

    // public function company(){
    //     return $this->belongsTo(Company::class);
    // }
    // public function sale(){
    //     return $this->hasMany(Sale::class);
    // }
}
