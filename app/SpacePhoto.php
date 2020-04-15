<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Space;
class SpacePhoto extends Model
{
    protected $guarded =  [];
    protected $table = "space_photos";
    public function space(){
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }
}
