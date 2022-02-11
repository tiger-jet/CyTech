<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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
    // public function products(){
    //     return $this->hasMany(Product::class);
    // }

   

}
