<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Family
 * 
 * @property int $id
 * @property string $fname
 * @property string $frelation
 * @property string $foccupation
 *
 * @package App\Models
 */
class Family extends Model
{
	protected $table = 'family';
	public $timestamps = false;

	protected $fillable = [
		'fname',
		'frelation',
		'foccupation'
	];
}
