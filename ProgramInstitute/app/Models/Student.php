<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';
    public $timestamps = false;

    protected $fillable = [
		'code',
		'admission_id',
		'semester_id',
        'offer_id',
        'person_id'
	];

    public function admission(): BelongsTo
    {
        return $this->belongsTo(Admission::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function inscriptionSubject(): HasMany
    {
        return $this->hasMany(InscriptionSubject::class);
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
