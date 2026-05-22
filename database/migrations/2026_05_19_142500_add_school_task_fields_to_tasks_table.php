<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table): void {
            if (! Schema::hasColumn('tasks', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            }

            if (! Schema::hasColumn('tasks', 'title')) {
                $table->string('title')->after('user_id');
            }

            if (! Schema::hasColumn('tasks', 'description')) {
                $table->text('description')->nullable()->after('title');
            }

            if (! Schema::hasColumn('tasks', 'status')) {
                $table->string('status')->default('belum')->after('description');
            }

            if (! Schema::hasColumn('tasks', 'deadline')) {
                $table->date('deadline')->nullable()->after('status');
            }

            if (! Schema::hasColumn('tasks', 'reminder_sent_at')) {
                $table->timestamp('reminder_sent_at')->nullable()->after('deadline');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table): void {
            foreach (['reminder_sent_at', 'deadline', 'status', 'description', 'title'] as $column) {
                if (Schema::hasColumn('tasks', $column)) {
                    $table->dropColumn($column);
                }
            }

            if (Schema::hasColumn('tasks', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
