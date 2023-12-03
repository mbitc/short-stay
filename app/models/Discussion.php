<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Discussion extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'discussions';

	public function apartament(){

		return $this->belongsTo('Apartament');

		//return $this->hasOne('Apartament');
	}
	public function messages(){
		return $this->hasMany('Message');
	}
	public function lastMessage(){
		return $this->hasOne('Message')->latest();
	}
    
    public function discussionStatus(){
        return $this->belongsTo('DiscussionStatus');
    }
    public function scopeDone($query){
        return $query->where('discussion_status_id','<', 11);
   }
}