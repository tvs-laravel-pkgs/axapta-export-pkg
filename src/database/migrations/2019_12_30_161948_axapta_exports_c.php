<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AxaptaExportsC extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if (!Schema::hasTable('axapta_exports')) {
			Schema::create('axapta_exports', function (Blueprint $table) {
				$table->increments('id');
				$table->unsignedInteger('company_id');
				$table->unsignedInteger('entity_type_id');
				$table->unsignedInteger('entity_id');
				$table->string('CurrencyCode', 5);
				$table->string('JournalName', 20);
				$table->string('JournalNum', 20)->nullable();
				$table->string('Voucher', 1);
				$table->string('ApproverPersonnelNumber', 30);
				$table->boolean('Approved');
				$table->date('TransDate');
				$table->string('AccountType', 20);
				$table->string('LedgerDimension', 255);
				$table->string('DefaultDimension', 50);
				$table->string('Txt', 255);
				$table->decimal('AmountCurDebit', 12, 2)->nullable();
				$table->decimal('AmountCurCredit', 12, 2)->nullable();
				$table->string('PaymMode', 30);
				$table->string('Invoice', 50);
				$table->string('TDSGroup_IN', 50)->nullable();
				$table->string('DocumentNum', 50);
				$table->date('DocumentDate');
				$table->string('LogisticsLocation_LocationId', 50);
				$table->string('TVSHSNCode', 50)->nullable();
				$table->string('TVSSACCode', 50)->nullable();
				$table->string('TVSCompanyLocationId', 50);
				$table->timestamps();

				$table->foreign('company_id')->references('id')->on('companies')->onDelete('CASCADE')->onUpdate('cascade');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('axapta_exports');
	}
}
