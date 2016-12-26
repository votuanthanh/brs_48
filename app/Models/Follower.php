<?php

namespace App\Models;

class Follower extends BaseModel
{
    protected $fillable = ['following_id', 'follower_id'];
}
