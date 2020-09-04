<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setnotification;
use App\User;
use Illuminate\Support\Facades\DB;



class NotificationOptionController extends Controller 
{
    function setMonth(Request $req){  
        $notif = Setnotification::find(1);
        if (!$notif) {
            $notif = new Setnotification; 
        }  
        $notif->setMonth = 2;
        $notif->save();
        return Setnotification::all(); 
    }
    function setMarkAsRead(){
        $user = App\User::find(1); 
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
    }
    function getNotification(){
        
        $user = User::find(1);
        $arrayOfdatas = [];
        // $getDatas = DB::table("notifications")
        //     ->select("notifications.data")
        //     ->groupBy("notifications.data")  
        //     ->get();
        
        foreach ($user->unreadNotifications as $notification) {
            array_push($arrayOfdatas, $notification->data);
        }
        return response()->json(["count" => $user->unreadNotifications->count(),"data" => $arrayOfdatas]);
    }
}
