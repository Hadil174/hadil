
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentColumnsToBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Add payment columns
            $table->decimal('amount', 10, 2)->nullable()->after('end_date');
            $table->string('currency', 3)->default('USD')->after('amount');
            $table->string('payment_status')->default('pending')->after('currency');
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('transaction_id')->nullable()->after('payment_method');
            $table->text('payment_details')->nullable()->after('transaction_id');
            $table->integer('nights')->default(1)->after('end_date');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'amount',
                'currency',
                'payment_status',
                'payment_method',
                'transaction_id',
                'payment_details',
                'nights'
            ]);
        });
    }
}