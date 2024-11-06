<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Acadamicdetail
 * 
 * @property int $id
 * @property string $sname
 * @property string $graduation
 * @property string $year
 * @property int $grade
 *
 * @package App\Models
 */
class Acadamicdetail extends Model
{
	protected $table = 'acadamicdetail';
	public $timestamps = false;

	protected $casts = [
		'grade' => 'int'
	];

	protected $fillable = [
		'sname',
		'graduation',
		'year',
		'grade'
	];
}
