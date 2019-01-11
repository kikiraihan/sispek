<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates=['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'nip', 'email','username', 'password','kategori',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    // public function getPasswordAttribute($password)
    // {
    //     return Crypt::decryptString($password);
    // }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] =  bcrypt($password);

        // $decrypted = Crypt::decryptString($encrypted);

        // $this->attributes['password'] = Hash::make($password);
        // kalau hash, tidak bisa di unhasing..
    }
}
