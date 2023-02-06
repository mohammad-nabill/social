<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['pic' , 'subject', 'author_id' ];

    function author(){
        return $this->hasOne('App\Models\User', 'id', 'author_id' );
          
    }

    function comments(){
       
        return $this->hasMany(comments::class,'post_id','id');
           
    }
}
