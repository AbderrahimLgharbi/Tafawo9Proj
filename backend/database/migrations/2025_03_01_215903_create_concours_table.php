<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('concours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("administration_id");
            $table->unsignedBigInteger("domaine_id");
            $table->unsignedBigInteger("grade_id");

            $table->string("counc_name")->nullable();
            $table->string('conc_pdf')->nullable();
            $table->string('generated_name')->nullable();
            $table->string('concour_pdf_correction')->nullable();
            $table->string('generated_name_corr')->nullable();
            $table->boolean('is_corrected')->default(false);
            $table->timestamp('submitted_at')->nullable(); // When the contest was submitted
            $table->enum('status', ['pending', 'in_review', 'completed', 'archived'])->default('pending'); // Status of the contest
            $table->text('feedback')->nullable(); // Feedback field to store reviewer notes

            $table->foreign('administration_id')
            ->references('id')->on('administrations')->onDelete('cascade');
            $table->foreign('domaine_id')
            ->references('id')->on('domaines')->onDelete('cascade');
            $table->foreign('grade_id')
            ->references('id')->on('grades')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concours');
    }
};
