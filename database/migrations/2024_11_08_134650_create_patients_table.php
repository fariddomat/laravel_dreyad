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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('file_number')->unique(); // رقم الملف
            $table->string('name'); // اسم المريض
            $table->string('gender')->nullable(); // الجنس
            $table->string('mob1')->nullable(); // رقم الجوال الأول
            $table->string('mob2')->nullable(); // رقم الجوال الثاني
            $table->date('date_contacted')->nullable(); // تاريخ التواصل
            $table->string('source')->nullable(); // المصدر
            $table->string('level')->default('normal'); // مستوى المريض
            $table->text('notes')->nullable(); // ملاحظات
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
