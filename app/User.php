<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Post;

use Illuminate\Database\Eloquent\SoftDeletes;


class User extends \TCG\Voyager\Models\User 
{
    use Notifiable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favoritos()
{
    return $this->belongsToMany('App\Post', 'post_users')->withTimeStamps();
}

   /*  public function roles() {
        return $this->belongsToMany(\App\Role::class, 'user_roles');
    } 
    public function isAdmin() 
{
   return $this->roles()->where('role_id', 1)->first();
} */

public static function boot() {
    parent::boot();

    static::created(function($user) {
        //Send your mail
        $user9 = \App\User::find($user->id);

$textoMg = 'Olá '.$user->name.' estamos muito felizes por você registrar em nosso site';
$details = [
        'subject' =>'Miniblog - Mensagem de Boas Vindas!',
        'greeting' => 'Bem Vindo',
        'body' => $textoMg,
        'thanks' => ':)',
];

$user9->notify(new \App\Notifications\TarefaCompleta($details));

    });
}


}




