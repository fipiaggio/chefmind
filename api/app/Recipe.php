<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
	protected $table = 'recipes';
	protected $fillable = [
		'name',
		'description',
		'img',
		'dificulty',
		'cost',
		'people',
		'time',
		'people',
		'user_id',
		'category_id'
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function ingredients()
	{
		return $this->belongsToMany('App\Ingredient');
	}

    public function steps()
    {
        return $this->hasMany('App\Step');
    }
}
