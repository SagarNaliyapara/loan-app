<?php

use App\Models\Enums\LoanStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('amount');
            $table->integer('term')->comment('stored and calculated based on weekly term');
            $table->string('status')->default(LoanStatus::PENDING);
            $table->timestamps();
        });
    }
};
