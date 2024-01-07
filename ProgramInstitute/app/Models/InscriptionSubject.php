<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InscriptionSubject extends Model
{
    use HasFactory;
    protected $table = 'inscription_subject';
    public $timestamps = false;

    protected $fillable = [
        'note',
        'offer_subject_id',
        'student_id'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function offerSubject(): BelongsTo
    {
        return $this->belongsTo(OfferSubject::class);
    }
}
