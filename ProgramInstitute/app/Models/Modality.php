<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    use HasFactory;
    protected $table = 'modality';
    public $timestamps = false;

    protected $fillable = [
		'description'
	];

    public function offers()
	{
		return $this->hasMany(Offer::class);
	}

}
