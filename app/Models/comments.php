<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class comments extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillable = ['comment','post_id','author_id','pic'];

    function author_name(){
        return $this->hasone(User::class,'id','author_id');
    }

    
}
