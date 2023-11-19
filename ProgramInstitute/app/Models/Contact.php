<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    public $timestamps = false;

    protected $fillable = ['email', 'phone'];

    public function person()
    {
        return $this->hasOne(Person::class);
    }
}
