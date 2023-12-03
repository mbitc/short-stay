<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Message extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';
	
	

	public function apartament(){

		return $this->belongsTo('Apartament');

		//return $this->hasOne('Apartament');
	}

	
	public function discussion(){

		//return $this->hasManyThrough('Discussion', 'Apartament');
		return $this->belongsTo('Discussion');
	}

	public function messageType(){
		return $this->belongsTo('MessageType');
	}

}
