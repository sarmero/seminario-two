<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teacher';
    public $timestamps = false;

    protected $fillable = [
		'program_id',
		'person_id'
	];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function programming(): HasMany
    {
        return $this->hasMany(Programming::class);
    }

}
