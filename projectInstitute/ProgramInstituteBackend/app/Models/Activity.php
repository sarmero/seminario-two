<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activity';
    public $timestamps = false;

    protected $fillable = [
		'description',
		'offer_subject_id',
		'deadline'
	];

    protected $casts = [
		'offer_subject_id' => 'int',
		'deadline' => 'datetime'
	];

    public function offerSubject():BelongsTo
    {
        return $this->belongsTo(OfferSubject::class);
    }


}
