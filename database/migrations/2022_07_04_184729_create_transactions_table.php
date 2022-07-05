<?php

use App\Models\Account;
use App\Models\TransactionCategory;
use App\Models\TransactionTag;
use App\Models\TransactionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('recipient');
            $table->string('message');
            $table->dateTime('date');
            $table->foreignIdFor(TransactionType::class)->constrained();
            $table->foreignIdFor(TransactionTag::class)->nullable()->constrained();
            $table->foreignIdFor(TransactionCategory::class)->nullable()->constrained();
            $table->foreignIdFor(Account::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
