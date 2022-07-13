<?php

use App\Models\Account;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Type;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('recipient');
            $table->string('message');
            $table->dateTime('date');
            $table->foreignIdFor(Type::class)->constrained();
            $table->foreignIdFor(Tag::class)->nullable()->constrained();
            $table->foreignIdFor(Category::class)->nullable()->constrained();
            $table->foreignIdFor(Account::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
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
