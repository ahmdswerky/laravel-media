<?php

namespace AhmdSwerky\Media\Tests;

use AhmdSwerky\Media\Traits\Mediable;
use Illuminate\Database\Eloquent\Model;

class MockeryModel extends Model
{
    use Mediable;
    
    public function getIdAttribute()
    {
        return 0;
    }
}