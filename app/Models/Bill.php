<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table ='bill';
    protected $fillable=[
        'idUser',
        'idCart',
        'name',
        'email',
        'numberPhone',
        'address',
        'price',
        'genaral',
        'created_at',
        'updated_at'
    ];

    public function users()
    {
        return $this->hasOne(Users::class);
    }
    public function scopeSearch($queryData)
    {
        if($searchData = request()->search){
            $queryData = $queryData->where('name','like','%'.$searchData.'%');
        }
        return $queryData;
    }
}
