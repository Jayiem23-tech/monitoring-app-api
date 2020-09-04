<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Coverage; 
use App\User; 
use App\Notifications\NotifiyMe;
use App\Setnotification;

class ShowDataController extends Controller
{
    
    function ShowAll(){
        $this->NotifyUserWhileLoading();
        $getDatas = DB::table("owners as a")  
        ->leftJoin("accounts as b",'a.id','=','b.owner_id')
        ->leftJoin("coverages as c",'b.id','=','c.acct_id') 
        ->get();
        
        return $collection = collect($getDatas); 
    }
    protected function NotifyUserWhileLoading(){
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
