<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   
	protected $table = 'posts';

	protected $fillable = [ 
		'id',
		'text',
		'title',
		'image', 
		'longtext',
		'user_id',
		'category_id',
	];

	public function category()
	{
		return $this->belongsTo('App\Category');
	}
}
