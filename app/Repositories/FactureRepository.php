<?php

namespace App\Repositories;

use App\Models\Facture;
use App\Models\FactureEmailHistory;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class FactureRepository
{
    /**
     * Create email history record
     */
    public function createEmailHistory($factureId, $userId, $recipientEmail, $subject, $emailContent, $status = 'pending')
    {
        return FactureEmailHistory::create([
            'facture_id' => $factureId,
            'user_id' => $userId,
            'recipient_email' => $recipientEmail,
            'subject' => $subject,
            'email_content' => $emailContent,
            'status' => $status
        ]);
    }

    /**
     * Update email history status to sent
     */
    public function updateEmailHistoryToSent($emailHistoryId)
    {
        return FactureEmailHistory::where('id', $emailHistoryId)->update([
            'status' => 'sent',
            'sent_at' => now()
        ]);
    }

    /**
     * Update email history status to failed
     */
    public function updateEmailHistoryToFailed($emailHistoryId, $errorMessage = null)
    {
        return FactureEmailHistory::where('id', $emailHistoryId)->update([
            'status' => 'failed',
            'error_message' => $errorMessage,
            'failed_at' => now()
        ]);
    }

    /**
     * Get email history for a facture
     */
    public function getEmailHistoryByFactureId($factureId)
    {
        return FactureEmailHistory::where('facture_id', $factureId)
            ->with(['user', 'facture'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get email statistics for a facture
     */
    public function getEmailStatistics($factureId)
    {
        $totalEmails = FactureEmailHistory::where('facture_id', $factureId)->count();
        $successfulEmails = FactureEmailHistory::where('facture_id', $factureId)->where('status', 'sent')->count();
        $failedEmails = FactureEmailHistory::where('facture_id', $factureId)->where('status', 'failed')->count();
        $pendingEmails = FactureEmailHistory::where('facture_id', $factureId)->where('status', 'pending')->count();

        return [
            'total' => $totalEmails,
            'successful' => $successfulEmails,
            'failed' => $failedEmails,
            'pending' => $pendingEmails,
            'success_rate' => $totalEmails > 0 ? round(($successfulEmails / $totalEmails) * 100, 2) : 0
        ];
    }

    /**
     * Get global email statistics
     */
    public function getGlobalEmailStatistics()
    {
        $totalEmails = FactureEmailHistory::count();
        $successfulEmails = FactureEmailHistory::where('status', 'sent')->count();
        $failedEmails = FactureEmailHistory::where('status', 'failed')->count();
        $pendingEmails = FactureEmailHistory::where('status', 'pending')->count();

        return [
            'total' => $totalEmails,
            'successful' => $successfulEmails,
            'failed' => $failedEmails,
            'pending' => $pendingEmails,
            'success_rate' => $totalEmails > 0 ? round(($successfulEmails / $totalEmails) * 100, 2) : 0
        ];
    }

    /**
     * Get all email history with filters
     */
    public function getAllEmailHistory($filters = [])
    {
        $query = FactureEmailHistory::query();

        // Filter by facture ID if provided
        if (isset($filters['facture_id']) && $filters['facture_id']) {
            $query->where('facture_id', $filters['facture_id']);
        }

        // Filter by status if provided
        if (isset($filters['status']) && $filters['status']) {
            $query->where('status', $filters['status']);
        }

        // Filter by date range if provided
        if (isset($filters['start_date']) && $filters['start_date']) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        }

        if (isset($filters['end_date']) && $filters['end_date']) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        // Search functionality
        if (isset($filters['search']) && !empty($filters['search'])) {
            $searchValue = $filters['search'];
            $query->where(function($q) use ($searchValue) {
                $q->where('recipient_email', 'like', "%{$searchValue}%")
                  ->orWhere('subject', 'like', "%{$searchValue}%")
                  ->orWhereHas('facture', function($factureQuery) use ($searchValue) {
                      $factureQuery->where('name', 'like', "%{$searchValue}%");
                  })
                  ->orWhereHas('user', function($userQuery) use ($searchValue) {
                      $userQuery->where('name', 'like', "%{$searchValue}%")
                                ->orWhere('surname', 'like', "%{$searchValue}%");
                  });
            });
        }

        return $query;
    }
}

