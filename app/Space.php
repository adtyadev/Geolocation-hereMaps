<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use app\User;
use app\SpacePhoto;

class Space extends Model
{
    protected $guarded = [];

    public function photos(){
        return $this->hasMany(SpacePhoto::class, 'space_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getSpaces($latitude, $longitude,$radius){
        return $this->select('*')
        ->selectRaw(
            '(6371 *
                acos( cos( radians(?) ) *
                    cos( radians( latitude ) ) *
                    cos( radians( longitude ) - radians(?)) +
                    sin( radians(?) ) *
                    sin( radians( latitude ) )
                )
            ) AS distance',[$latitude,$longitude,$latitude]
        )
        ->havingRaw("distance < ?", [$radius])
        ->orderBy('distance', 'asc');
    }
}
// SELECT id, 
// ( 3959 * acos( cos( radians(37) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(-122) ) + sin( radians(37) ) * sin( radians( lat ) ) ) ) 
// AS distance FROM markers HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;
