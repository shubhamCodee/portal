<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {

            // Basic business info
            $table->string('company_name')->nullable()->after('id');
            $table->string('first_name')->nullable()->after('company_name');
            $table->string('last_name')->nullable()->after('first_name');

            // Organization details
            $table->string('department')->nullable()->after('phone');
            $table->string('designation')->nullable()->after('department');

            // Financial fields
            $table->decimal('lead_cost', 10, 2)->nullable()->after('designation');
            $table->decimal('total_lead_cost', 10, 2)->nullable()->after('lead_cost');
            $table->string('currency', 3)->nullable()->after('total_lead_cost');
            $table->decimal('percentage', 5, 2)->nullable()->after('currency');

            // Dates & follow-ups
            $table->dateTime('follow_up_at')->nullable()->after('meeting_at');
            $table->date('closed_date')->nullable()->after('follow_up_at');

            // Location & web
            $table->string('website')->nullable()->after('closed_date');
            $table->string('city')->nullable()->after('website');
            $table->text('address')->nullable()->after('city');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'first_name',
                'last_name',
                'department',
                'designation',
                'lead_cost',
                'total_lead_cost',
                'currency',
                'percentage',
                'follow_up_at',
                'closed_date',
                'website',
                'city',
                'address',
            ]);
        });
    }
};
