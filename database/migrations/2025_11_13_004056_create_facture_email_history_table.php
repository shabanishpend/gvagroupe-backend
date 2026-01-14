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
        Schema::create('facture_email_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facture_id');
            $table->unsignedBigInteger('user_id'); // Who sent the email
            $table->string('recipient_email');
            $table->string('subject');
            $table->longText('email_content'); // Store the actual email content
            $table->enum('status', ['pending', 'sent', 'failed']);
            $table->text('error_message')->nullable(); // If email failed
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('facture_id')
                  ->references('id')
                  ->on('factures')
                  ->onDelete('cascade');
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // Indexes for better performance
            $table->index(['facture_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facture_email_history');
    }
};
