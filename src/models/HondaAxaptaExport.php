<?php

namespace Abs\AxaptaExportPkg;

use Illuminate\Database\Eloquent\Model;

class HondaAxaptaExport extends Model {
	protected $table = 'honda_axapta_exports'; 
	protected $fillable = [
		 
		'entity_type_id',
		'entity_id',
		'PlantCode',
		'CurrencyCode',
		'JournalName',
		'JournalNum',
		'LineNum',
		'Voucher',
		'ApproverPersonnelNumber',
		'Approved',
		'TransDate',
		'Account',
		'AccountType',
		'Department',
		'LedgerDimension',
		'DefaultDimension',
		'Txt',
		'AmountCurDebit',
		'AmountCurCredit',
		'Sub_GL',
		'OffsetAccountType',
		'OffsetLedgerDimension',
		'OffsetDefaultDimension',
		'PaymMode',
		'TaxGroup',
		'TaxItemGroup',
		'Invoice',
		'InvoiceDate',
		'SalesTaxFormTypes_IN_FormType',
		'TDSGroup_IN',
		'DocumentNum',
		'DocumentDate',
		'DocumentType',
		'LogisticsLocation_LocationId',
		'Due',
		'PaymReference', 
		'VatPercentage',
		'Qty',
	];

}
