<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Models\Facture;
class FactureSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facture-subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Facture Subscription';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $factures = Facture::all();
        foreach ($factures as $facture) {
            $subscription_type = $facture->subscription_type;
            $payable_end_time = $facture->subscription_start_date;
            if(isset($subscription_type) && $subscription_type != '' && $payable_end_time != null){
                $todayDate = \Carbon\Carbon::now()->format('Y-m-d');
                $options = ["monthly", "3_months", "6_months", "yearly"];
                $is_expired = false;
    
                if(in_array($subscription_type, $options)){
                    $end_date = strtotime($payable_end_time);
                    
                    switch($subscription_type) {
                        case 'monthly':
                            $end_date = strtotime("+1 month", $end_date);
                            break;
                        case '3_months':
                            $end_date = strtotime("+3 months", $end_date);
                            break;
                        case '6_months':
                            $end_date = strtotime("+6 months", $end_date);
                            break;
                        case 'yearly':
                            $end_date = strtotime("+1 year", $end_date);
                            break;
                    }
    
                    if(\Carbon\Carbon::parse($todayDate)->greaterThan(\Carbon\Carbon::createFromTimestamp($end_date))){
                        $is_expired = true;
                    }
    
                    if($is_expired){
                        // $facture->status = 0;
                        // $facture->payable_date = null;
                        // $facture->email_sended = null;
                        // $facture->save();
                    }
                }
            }
        }
    }
}
