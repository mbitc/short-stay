<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Apartament extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'apartaments';

	public function messages(){
		return $this->hasManyThrough('Message', 'Discussion' );
	}
	public function discussions(){
		return $this->hasMany('Discussion');
	}
	public function discussion(){
        return $this->belongsTo('Discussion');
    }

}
