<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('submissions', function (Blueprint $table) {
        $table->id();
        $table->string('q1_domain');
        $table->string('q2_industry');
        $table->string('q3_contact_email');
        $table->integer('q4_number_of_employees');
        $table->text('q5_description');
        $table->string('q6_launch_date');
        $table->string('q7_primary_goal');
        $table->string('q8_company_name');
        $table->string('q9_industry_category');
        $table->longText('llm_response')->nullable();
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
