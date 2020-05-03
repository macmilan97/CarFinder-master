<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model {

    public function expert()
    {
        return $this->belongsToMany('App\Models\Expert', 'expert_skill');
    }

}
