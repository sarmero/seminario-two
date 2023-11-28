<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subject';
    public $timestamps = false;

    protected $fillable = [
		'description',
		'program_id',
		'semester_id'
	];

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function offerSubject(): HasMany
    {
        return $this->hasMany(OfferSubject::class);
    }


}
