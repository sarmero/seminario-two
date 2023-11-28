<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function contatac(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function admission(): HasOne
    {
        return $this->hasOne(Admission::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($person) {
            if ($person->role_id == 3) {
                User::create(
                    [
                        'username' =>  static::uniqueCode(),
                        'person_id' => $person->id,
                        'password' => bcrypt(substr($person->number_document, -4)),
                    ]
                );
            }
        });
    }

    protected static function uniqueCode()
    {
        $code = '345' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        while (User::where('username', $code)->exists()) {
            $code = '345' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        }

        return $code;
    }
}
