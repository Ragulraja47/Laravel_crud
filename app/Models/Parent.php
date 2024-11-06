<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Parent
 * 
 * @property int $id
 * @property string $date
 * @property string $purpose
 * @property string $points
 *
 * @package App\Models
 */
class Parent extends Model
{
	protected $table = 'parent';
	public $timestamps = false;

	protected $fillable = [
		'date',
		'purpose',
		'points'
	];
}
