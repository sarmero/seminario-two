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

    public function inscription(): HasMany
    {
        return $this->hasMany(Inscription::class);
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

        // Evento se dispara al actualizar una oferta de programas
        static::updated(function ($oferta) {
            if ($oferta->state_offer_id == 2) {
                $person = Admission::select('admission.id', 'admission.person_id', 'person.number_document as idp')
                    ->join('person', 'admission.person_id', '=', 'person.id')
                    ->where('admission.state_id', '1')
                    ->get();


                foreach ($person as $i => $adm) {
                    $code = static::uniqueCode();
                    Student::create(
                        [
                            'code' => $code,
                            'admission_id' => $adm->id,
                            'semester_id' => 1,
                        ]
                    );

                    User::create(
                        [
                            'username' =>  $code,
                            'person_id' => $adm->person_id,
                            'password' => bcrypt(substr($adm->idp, -4)),
                        ]
                    );
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
