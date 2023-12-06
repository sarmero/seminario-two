<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'phone'
    ];

    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}
