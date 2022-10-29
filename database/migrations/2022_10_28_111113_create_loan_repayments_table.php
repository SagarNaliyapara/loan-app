<?php

use App\Models\Enums\LoanRepaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained();
            $table->string('status')->default(LoanRepaymentStatus::PENDING);
            $table->timestamps();
        });
    }
};
