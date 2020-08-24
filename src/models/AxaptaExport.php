<?php

namespace Abs\AxaptaExportPkg;

use Illuminate\Database\Eloquent\Model;

class AxaptaExport extends Model {
	protected $table = 'axapta_exports';
	protected $fillable = [
		'company_id',
		'entity_type_id',
		'entity_id',
		'CurrencyCode',
		'JournalName',
		'JournalNum',
		'LineNum',
		'Voucher',
		'ApproverPersonnelNumber',
		'Approved',
		'TransDate',
		'AccountType',
		'LedgerDimension',
		'DefaultDimension',
		'Txt',
		'AmountCurDebit',
		'AmountCurCredit',
		'OffsetAccountType',
		'OffsetLedgerDimension',
		'OffsetDefaultDimension',
		'PaymMode',
		'TaxGroup',
		'TaxItemGroup',
		'Invoice',
		'SalesTaxFormTypes_IN_FormType',
		'TDSGroup_IN',
		'DocumentNum',
		'DocumentDate',
		'LogisticsLocation_LocationId',
		'Due',
		'PaymReference',
	];

}
