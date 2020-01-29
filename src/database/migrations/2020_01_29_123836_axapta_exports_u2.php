<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AxaptaExportsU2 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('axapta_exports', function (Blueprint $table) {
			$table->string('LineNum', 20)->default(0)->after('JournalNum');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('axapta_exports', function (Blueprint $table) {
			$table->dropColumn('LineNum');
		});
	}
}
