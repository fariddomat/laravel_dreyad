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
            $table->string('service'); // نوع الخدمة (مثل تقويم الأسنان، زراعة الأسنان)
            $table->string('teeth_no'); // أرقام الأسنان المعالجة
            $table->integer('visits_no'); // عدد الزيارات
            $table->date('date_start'); // تاريخ بدء العلاج
            $table->date('date_end'); // تاريخ انتهاء العلاج
            $table->text('treatment_plan'); // خطة العلاج
            $table->enum('status', ['attended', 'booked_but_not_attended', 'not_booked'])->default('not_booked'); // الحالة (حضر، مجدول ولم يحضر)
            $table->decimal('pricing', 10, 2); // التسعير
            $table->decimal('discount', 5, 2)->default(0); // الخصم
            $table->decimal('total_cost', 10, 2); // التكلفة الإجمالية
            $table->string('follow_up')->nullable(); // المتابعة
            $table->text('outcome')->nullable(); // النتيجة
            $table->enum('financial_status', ['fully_paid', 'partially_paid', 'overdue'])->default('overdue'); // الحالة المالية
            $table->decimal('amount_paid', 10, 2)->default(0); // المبلغ المدفوع
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
