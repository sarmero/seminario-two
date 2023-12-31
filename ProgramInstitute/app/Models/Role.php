<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;
    protected $table = 'role';
    public $timestamps = false;

    protected $fillable = [
		'description'
	];

    public function person():HasMany
	{
		return $this->hasMany(Person::class);
	}
}
