<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Coverage;
use Illuminate\Support\Facades\DB;
use App\User; 
use App\Notifications\NotifiyMe;
use App\Setnotification;



class checkEveryDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Check:EveryDay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To check the notification for Expiration of asp';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getMonth = Setnotification::find(1)->setMonth;
        $today = Carbon::today();
        $get = $today->addMonths($getMonth)->format('Y-m-d');
        $getDatas = DB::table("owners as a")  
            ->join("accounts as b",'a.id','=','b.owner_id')
            ->join("coverages as c",'b.id','=','c.acct_id')  
            ->whereDate("asp_end_date" ,'=',$get)
            ->get();  
        $collection = collect($getDatas); 
        User::find(1)->notify(new NotifiyMe($collection));
    }
}
