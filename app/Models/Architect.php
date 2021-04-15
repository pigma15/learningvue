<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Architect extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'about'
    ];

    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'architect_id', 'id');
    }
}
