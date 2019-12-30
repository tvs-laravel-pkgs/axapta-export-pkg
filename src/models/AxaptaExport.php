<?php

namespace Abs\AxaptaExportPkg;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AxaptaExport extends Model {
	use SoftDeletes;
	protected $table = 'axapta_exports';
	protected $fillable = [
		'code',
		'name',
		'cust_group',
		'dimension',
		'mobile_no',
		'email',
		'company_id',
	];

}
