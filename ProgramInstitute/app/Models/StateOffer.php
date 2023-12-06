<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StateOffer extends Model
{
    use HasFactory;
    protected $table = 'state_offer';
    public $timestamps = false;

    protected $fillable = [
		'description'
	];

	public function offers():HasMany
	{
		return $this->hasMany(Offer::class);
	}
}
