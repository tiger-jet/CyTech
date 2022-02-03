<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function sale(){
        return $this->hasMany(Sale::class);
    }
}
