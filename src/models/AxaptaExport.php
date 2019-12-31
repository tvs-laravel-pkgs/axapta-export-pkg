<?php

namespace Abs\AxaptaExportPkg;

use Illuminate\Database\Eloquent\Model;

class AxaptaExport extends Model {
	protected $table = 'axapta_exports';
	protected $fillable = [
		'company_id',
		'entity_type_id',
		'entity_id',
		'LedgerDimension',
	];

}
