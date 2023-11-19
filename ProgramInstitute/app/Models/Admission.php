<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;
    protected $table = 'admission';
    public $timestamps = false;

    protected $fillable = ['state_id', 'person_id','offer_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
