<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Akun extends Model
{
    // custom primary key
    protected $primaryKey="no_ref";

    use SoftDeletes;
	protected $fillable=[
		'no_ref',
		'gol',
		'nama',
	];

    // hasmany transaski
    public function transaksi()
    {
        return $this->hasMany('App\Transaksi', 'no_ref');
    }
}
