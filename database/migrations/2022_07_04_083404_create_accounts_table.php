<?php

use App\Models\AccountType;
use App\Models\Family;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(AccountType::class)->constrained();
            $table->foreignIdFor(Family::class)->nullable()->constrained();
            $table->integer('start_balance');
            $table->integer('alert');
            $table->unsignedInteger('user_position');
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
        Schema::dropIfExists('accounts');
    }
};
