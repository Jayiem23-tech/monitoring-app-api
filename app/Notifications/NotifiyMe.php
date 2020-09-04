<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification; 

class NotifiyMe extends Notification  
{
    use Queueable;
    protected $datas;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($getDatas)
    {
        $this->datas = $getDatas; 
        // dd($this->datas);
         
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable use App\User; 
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
       
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $newArray = json_decode($this->datas, true) ;
        $count = sizeof($newArray);  
        foreach($newArray as $items){ 
            return[
                'data' => ' warning for expiration : '. $items["owner"]
                    .' date expired on : '.$items["asp_end_date"] .' Account Name : '.$items["acct_id"]
                    .' Contact Person :'.$items["contact_person"] . ' Phone :'.$items["phone"]
                    . ' email :'.$items["email"]
            ];
        }  
        
    }
}
