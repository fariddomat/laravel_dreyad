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

            $table->id(); // رقم معرف فريد لكل مريض
            $table->string('file_number')->unique(); // رقم الملف
            $table->string('name'); // اسم المريض
            $table->string('phone')->nullable(); // رقم الجوال
            $table->date('birth_date')->nullable(); // تاريخ الميلاد
            $table->string('source')->nullable(); // المصدر (مثال: محول، صلاح، إلخ)
            $table->string('status')->default('مجدول مسبقاً'); // حالة الحضور (حضر، لم يحضر، إلخ)
            $table->string('clinic')->nullable(); // العيادة التي حضرها
            $table->text('notes')->nullable(); // ملاحظات
            $table->timestamps(); // تاريخ الإنشاء والتحديث
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
