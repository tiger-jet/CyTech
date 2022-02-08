<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class Company extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'id',
        'company_name',
        'street_address',
        'created_at',
        'updated_at'
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }

    //CompaniesとProductsの結合処理
    Public function join() {
        $join = DB::table('companies')
            ->join('products', 'companies.id', '=', 'products.company_id');
        return $join;
    }

}
