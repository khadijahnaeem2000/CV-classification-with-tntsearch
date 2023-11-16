<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_phone',
        'office_phone',
        'password',
        'role',
        'imap_password',
        'last_login_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function manager()
    {
        return $this->hasOne(Manager::class, 'id_user','id');
    }

    public function commercial()
    {
        return $this->hasOne(Commercial::class, 'id_user','id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_user','id');
    }

    public function informant()
    {
        return $this->hasOne(Informant::class,'id_user');
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function contractor()
    {
        return $this->hasOne(Contractor::class,'id_user','id');
    }

    public function sourceCommunications()
    {
        return $this->hasMany(Communication::class,'source','id');
    }

    public function destinationCommunications()
    {
        return $this->hasMany(Communication::class,'destination','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'commentator', 'id');
    }

    public function commentTarget()
    {
        return $this->hasMany(Comment::class, 'concerned', 'id');
    }

    /**
     * Send a password reset email to the user
     * @param $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function generateToken(){
        $this->api_token = str_random(60);
        $this->save();
        return $this->api_token;
    }

    public function managers()
    {
        return $this->hasMany(Manager::class, "id_user_creator", 'id');
    }

}
