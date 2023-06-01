<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function state()
    {
        return $this->morphedByMany(State::class, 'localables');
    }
}
