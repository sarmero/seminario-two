<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    // use HasFactory;
    protected $table = 'offer';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'quotas',
        'calendar_id',
        'program_id',
        'modality_id',
        'state_offer_id'
    ];


    public function admission(): HasMany
    {
        return $this->hasMany(Admission::class);
    }

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function stateOffer(): BelongsTo
    {
        return $this->belongsTo(StateOffer::class);
    }

    public function modality(): BelongsTo
    {
        return $this->belongsTo(Modality::class);
    }

    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($offer) {
            if ($offer->state_offer_id == 2) {
                $admi = Admission::with('person')
                    ->where('state_id', '1')->where('offer_id', $offer->id)
                    ->get(['id', 'person_id','offer_id']);


                foreach ($admi as $i => $adm) {
                    $code = static::uniqueCode();
                    Student::create(
                        [
                            'code' => $code,
                            'admission_id' => $adm->id,
                            'semester_id' => 1,
                            'person_id' => $adm->person_id,
                            'offer_id' => $adm->offer_id,
                        ]
                    );

                    User::create(
                        [
                            'username' =>  $code,
                            'person_id' => $adm->person_id,
                            'password' => bcrypt(substr($adm->person->document, -4)),
                        ]
                    );

                    $person = $adm->person;

                    $person->update([
                        'role_id' => 1,
                    ]);
                }
            }
        });
    }

    protected static function uniqueCode()
    {
        $code = date('Y') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        while (Student::where('code', $code)->exists()) {
            $code = date('Y') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        }

        return $code;
    }
}
