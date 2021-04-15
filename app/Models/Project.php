<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'about',
        'architect_id'
    ];

    public function architect()
    {
        return $this->belongsTo(Architect::class, 'architect_id', 'id');
    }
}
