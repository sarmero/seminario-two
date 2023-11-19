<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

    use HasFactory;
    protected $table = 'program';
    public $timestamps = false;

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
}
