<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class DiscussionStatus extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'discussion_status';    
    
    public $timestamps = false;
    public function find_by_level($level){
        return DiscussionStatus::where('level', '=', $level);
    }
    public function scopeDone($query){
        return $query->where('level','<', 10);
   }
}