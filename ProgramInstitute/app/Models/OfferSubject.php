<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferSubject extends Model
{
    use HasFactory;
    protected $table = 'offer_subject';
    public $timestamps = false;
}
