<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat_m extends Model
{
    use HasFactory;
    protected $table = "chat";

    protected $fillable=['from','to','text','pic'];

    function user_info(){
        return $this->hasone(User::class , 'id' , 'from' );
    }
}
