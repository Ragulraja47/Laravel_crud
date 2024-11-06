<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Demo
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $dept
 *
 * @package App\Models
 */
class Demo extends Model
{
	protected $table = 'demo';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'dept'
	];
}
