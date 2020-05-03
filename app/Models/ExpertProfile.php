<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertProfile extends Model
{

    protected $guard = 'expert_services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'experience', 'expert_id', 'departure'
    ];

    public function expert()
    {
        return $this->belongsTo('App\Models\Expert', 'expert_id', 'id');
    }
}
