<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class person extends Model
{
    use HasFactory;
    protected $table = 'person';
    public $timestamps = false;

    protected $fillable = [
        'number_document',
        'first_name',
        'last_name',
        'gender',
        'contact_id',
        'district_id',
        'role_id',
        'photo',
    ];

    public function contatac()
    {
        return $this->hasOne(Contact::class);
    }

    public function admission()
    {
        return $this->hasOne(Admission::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}


