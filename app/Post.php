<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jahondust\ModelLog\Traits\ModelLogging; 
use App\User;
use App\PostUser;

use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    //
    use ModelLogging;
    public function autor(){
        return $this->belongsTo('App\User', 'author_id','id');
    }

    public function favoritosPost()
    {
        return $this->belongsToMany('App\User', 'post_users')->withTimeStamps();
    }

    public function favoritado()
{
    return (bool) PostUser::where('user_id', Auth::id())
                        ->where('post_id', $this->id)
                        ->first();
}
}
