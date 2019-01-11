<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{

	use SoftDeletes;
	protected $dates=[
		'deleted_at',
		'tanggal'
	];
	 // protected $dateFormat = 'M d';
	 // ->format('d, M Y');

    protected $guarded=['created_at','updated_at','id'];//blacklist


    // Belongs to akun
    public function akun(){
    	return $this->belongsTo('App\Akun', 'no_ref');
    }
}
