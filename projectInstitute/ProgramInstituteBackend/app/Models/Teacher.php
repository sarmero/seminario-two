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
        'code',
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

    public function offerSubject(): HasMany
    {
        return $this->hasMany(OfferSubject::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($teacher) {
            $teacher->code = static::uniqueCode();
            $person = Person::find($teacher->person_id);

            User::create(
                [
                    'username' =>  $teacher->code,
                    'person_id' => $teacher->person_id,
                    'password' => bcrypt(substr($person->document, -4)),
                ]
            );
        });

        static::deleting(function ($teacher) {
            $teacher->person()->delete();
        });
    }

    protected static function uniqueCode()
    {
        $code = '345' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        while (Teacher::where('code', $code)->exists()) {
            $code = '345' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        }

        return $code;
    }
}
