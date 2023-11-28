<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;
    protected $table = 'state';
    public $timestamps = false;

    protected $fillable = [
		'description'
	];

	public function admissions():HasMany
	{
		return $this->hasMany(Admission::class);
	}
}
