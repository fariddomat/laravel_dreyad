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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // الربط مع جدول المرضى
            $table->string('service')->nullable(); // نوع الخدمة (مثل تقويم الأسنان، زراعة الأسنان)
            $table->string('teeth_no')->nullable(); // أرقام الأسنان المعالجة
            $table->string('visits_no')->nullable(); // عدد الزيارات
            $table->date('date_start')->nullable(); // تاريخ بدء العلاج
            $table->date('date_end')->nullable(); // تاريخ انتهاء العلاج
            $table->text('treatment_plan')->nullable(); // خطة العلاج
            $table->string('status')->nullable()->default('not_booked'); // الحالة (حضر، مجدول ولم يحضر)
            $table->integer('pricing')->default(0); // التسعير
            $table->string('discount')->nullable()->default(0); // الخصم
            $table->decimal('total_cost', 20, 2)->nullable(); // التكلفة الإجمالية
            $table->string('follow_up')->nullable(); // المتابعة
            $table->text('outcome')->nullable(); // النتيجة
            $table->string('financial_status')->nullable()->default('overdue'); // الحالة المالية
            $table->string('amount_paid', 10, 2)->nullable()->default(0); // المبلغ المدفوع
            $table->text('notes')->nullable(); // الملاحظات
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
