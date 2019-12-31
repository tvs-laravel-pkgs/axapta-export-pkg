<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AxaptaExportsU1 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('axapta_exports', function (Blueprint $table) {
			$table->string('OffsetAccountType', 255)->nullable()->after('AmountCurCredit');
			$table->string('OffsetLedgerDimension', 255)->nullable()->after('OffsetAccountType');
			$table->string('OffsetDefaultDimension', 255)->nullable()->after('OffsetLedgerDimension');
			$table->string('TaxGroup', 255)->nullable()->after('PaymMode');
			$table->string('TaxItemGroup', 255)->nullable()->after('TaxGroup');
			$table->string('SalesTaxFormTypes_IN_FormType', 255)->nullable()->after('Invoice');
			$table->string('Due', 255)->nullable()->after('LogisticsLocation_LocationId');
			$table->string('PaymReference', 255)->nullable()->after('Due');
			$table->string('TVSVendorLocationID', 255)->nullable()->after('TVSSACCode');
			$table->string('TVSCustomerLocationID', 255)->nullable()->after('TVSVendorLocationID');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('axapta_exports', function (Blueprint $table) {
			$table->dropColumn('OffsetAccountType');
			$table->dropColumn('OffsetLedgerDimension');
			$table->dropColumn('OffsetDefaultDimension');
			$table->dropColumn('TaxGroup');
			$table->dropColumn('TaxItemGroup');
			$table->dropColumn('SalesTaxFormTypes_IN_FormType');
			$table->dropColumn('Due');
			$table->dropColumn('PaymReference');
			$table->dropColumn('TVSVendorLocationID');
			$table->dropColumn('TVSCustomerLocationID');
		});
	}
}
