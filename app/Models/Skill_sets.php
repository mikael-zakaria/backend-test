<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill_sets extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'candidate_id',
        'skill_id'
    ];
}
