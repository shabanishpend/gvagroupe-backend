<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\FactureEmailHistory;
use App\Repositories\FactureRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FactureEmailHistoryController extends Controller
{
    protected $factureRepository;
    protected $userService;

    public function __construct(FactureRepository $factureRepository, UserService $userService)
    {
        $this->factureRepository = $factureRepository;
        $this->userService = $userService;
    }

    /**
     * Display email history for a specific facture
     */
    public function show($factureId, $website)
    {
        // Check if user is admin
        if (!$this->userService->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $facture = Facture::with(['client', 'emailHistory.user'])->findOrFail($factureId);
        $emailStatistics = $this->factureRepository->getEmailStatistics($factureId);
        $emailHistory = $this->factureRepository->getEmailHistoryByFactureId($factureId);
        
        return view('factures.email-history.show', compact('facture', 'emailStatistics', 'emailHistory', 'website'));
    }

    /**
     * Get email history via API for DataTables
     */
    public function api(Request $request)
    {
        try {
            // Check if user is admin
            if (!$this->userService->isAdmin()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            // Get search value - handle both DataTables format and direct input
            $searchValue = null;
            if ($request->has('search')) {
                $search = $request->input('search');
                if (is_array($search) && isset($search['value'])) {
                    $searchValue = is_string($search['value']) ? $search['value'] : null;
                } elseif (is_string($search)) {
                    $searchValue = $search;
                }
            }

            // Build base query
            $query = FactureEmailHistory::query();

            // Apply facture_id filter
            $factureId = $request->input('facture_id');
            if (!empty($factureId)) {
                $query->where('facture_id', $factureId);
            }

            // Apply status filter
            $status = $request->input('status');
            if (!empty($status)) {
                $query->where('status', $status);
            }

            // Apply date filters
            $startDate = $request->input('start_date');
            if (!empty($startDate)) {
                $query->whereDate('created_at', '>=', $startDate);
            }

            $endDate = $request->input('end_date');
            if (!empty($endDate)) {
                $query->whereDate('created_at', '<=', $endDate);
            }

            // Apply search filter
            if (!empty($searchValue)) {
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

            // Get total count before any filtering
            $totalRecords = FactureEmailHistory::count();
            
            // Get filtered count
            $filteredRecords = $query->count();

            // Handle ordering
            $hasJoin = false;
            if ($request->has('order') && is_array($request->order) && count($request->order) > 0) {
                $columns = [
                    'created_at', 'recipient_email', 'subject', 'status', 'user', 'facture', 'actions'
                ];
                
                foreach ($request->order as $order) {
                    if (!isset($order['column']) || !isset($order['dir'])) {
                        continue;
                    }
                    
                    $columnIndex = (int)$order['column'];
                    $columnName = isset($columns[$columnIndex]) ? $columns[$columnIndex] : 'created_at';
                    $direction = in_array(strtolower($order['dir']), ['asc', 'desc']) ? strtolower($order['dir']) : 'desc';
                    
                    if ($columnName === 'user') {
                        if (!$hasJoin) {
                            $query->leftJoin('users', 'facture_email_history.user_id', '=', 'users.id')
                                  ->select('facture_email_history.*');
                            $hasJoin = true;
                        }
                        $query->orderBy(DB::raw("COALESCE(CONCAT(users.name, ' ', users.surname), '')"), $direction);
                    } elseif ($columnName === 'facture') {
                        if (!$hasJoin) {
                            $query->leftJoin('factures', 'facture_email_history.facture_id', '=', 'factures.id')
                                  ->select('facture_email_history.*');
                            $hasJoin = true;
                        }
                        $query->orderBy(DB::raw("COALESCE(factures.name, '')"), $direction);
                    } else {
                        $tablePrefix = $hasJoin ? 'facture_email_history.' : '';
                        $query->orderBy($tablePrefix . $columnName, $direction);
                    }
                }
            } else {
                $query->orderBy('created_at', 'desc');
            }

            // Pagination
            $start = (int)$request->input('start', 0);
            $length = (int)$request->input('length', 10);
            
            $emails = $query->skip($start)->take($length)->get();
            
            // Load relationships
            if ($emails->count() > 0) {
                $emails->load(['facture', 'user']);
            }

            // Format data for DataTables
            $data = [];
            
            foreach ($emails as $email) {
                try {
                    // Get sender name safely
                    $senderName = '-';
                    if ($email->user) {
                        $name = $email->user->name ?? '';
                        $surname = $email->user->surname ?? '';
                        $senderName = trim($name . ' ' . $surname);
                        if (empty($senderName)) {
                            $senderName = '-';
                        }
                    }
                    
                    // Get facture name safely
                    $factureName = '-';
                    $website = 'gvacars';
                    if ($email->facture) {
                        $factureName = $email->facture->name ?? '-';
                        $website = $email->facture->website ?? 'gvacars';
                    }
                    
                    // Get status badge safely
                    $status = is_string($email->status) ? $email->status : 'pending';
                    $statusBadge = '<span class="badge ';
                    switch($status) {
                        case 'sent':
                            $statusBadge .= 'bg-success-subtle text-success';
                            break;
                        case 'failed':
                            $statusBadge .= 'bg-danger-subtle text-danger';
                            break;
                        case 'pending':
                        default:
                            $statusBadge .= 'bg-warning-subtle text-warning';
                            break;
                    }
                    $statusBadge .= '">' . htmlspecialchars($status) . '</span>';
                    
                    $data[] = [
                        $email->created_at ? $email->created_at->format('d/m/Y H:i') : '-',
                        htmlspecialchars($email->recipient_email ?? '-'),
                        htmlspecialchars($email->subject ?? '-'),
                        $statusBadge,
                        htmlspecialchars($senderName),
                        htmlspecialchars($factureName),
                        $this->getActionButtons($email->id, $email->facture_id, $website)
                    ];
                } catch (\Exception $e) {
                    Log::error('Error processing email ID ' . ($email->id ?? 'unknown') . ': ' . $e->getMessage(), [
                        'trace' => $e->getTraceAsString(),
                        'email_data' => $email->toArray()
                    ]);
                    // Add a fallback row
                    $data[] = [
                        '-',
                        'Error',
                        'Error processing',
                        '<span class="badge bg-danger">Error</span>',
                        'Error',
                        'Error',
                        '<span class="text-danger">Error</span>'
                    ];
                }
            }

            return response()->json([
                'draw' => (int)$request->input('draw', 1),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data
            ]);
            
        } catch (\Exception $e) {
            Log::error('FactureEmailHistory API Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'error' => 'Internal server error: ' . $e->getMessage(),
                'draw' => (int)$request->input('draw', 1),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ], 500);
        }
    }

    /**
     * Get action buttons for DataTables
     */
    private function getActionButtons($emailId, $factureId, $website)
    {
        $buttons = '<div class="btn-group" role="group">';
        $buttons .= '<a href="' . route('factures.email-history.show', [$factureId, $website]) . '" class="btn btn-sm btn-info" title="View Facture Email History"><i class="mdi mdi-eye"></i></a>';
        $buttons .= '<a href="' . route('factures.edit', [$factureId, $website]) . '" class="btn btn-sm btn-secondary" title="Edit Facture"><i class="mdi mdi-pencil"></i></a>';
        $buttons .= '</div>';
        
        return $buttons;
    }
}
