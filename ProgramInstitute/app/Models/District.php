<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class district extends Model
{
    use HasFactory;
    protected $table = 'district';
    public $timestamps = false;

	protected $fillable = [
		'description'
	];

    public function person():HasOne
    {
        return $this->hasOne(Person::class);
    }
}
