<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table='siswa';
    protected $fillable=[
        'id','siswa_id'
    ];
    public function user(){
        return $this->hasOne(User::class);
    }
}
