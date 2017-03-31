<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportChatMessage extends Model
{
    protected $fillable = ['message','to_user_id','from_user_id','channel'];

  	
  	public function touser()
    {
        return $this->belongsTo('App\User', 'to_user_id', 'id');
    }
    public function fromuser()
    {
        return $this->belongsTo('App\User', 'from_user_id', 'id');
    }
}
