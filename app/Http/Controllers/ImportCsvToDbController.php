<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Account;
use App\Owner;
use App\Coverage;
use App\User; 
    

class ImportCsvToDbController extends Controller 
{  
    function imports(Request $req){ 
        $datas = array($req->array); 
        $owner_id = 0;
        $count = sizeof($req->array);
         
        for ($i=0; $i < $count -1; $i++) { 
            foreach($datas as $index  => $key){
                
                $owner = $key[$i]["Account Owner "];
                $findOwner = DB::table("owners")
                    ->select("owners.id")
                    ->where("owner","=",$owner)
                    ->first() ; 
    
                // to get existing owner id
                $get_id = collect($findOwner)->first(); 
                
                if ($get_id >= 1) { 
                    
                }else{
                    
                    $newOwner = new Owner;
                    $owner = $key[$i]["Account Owner "];
                    $newOwner->owner = $owner;
                    $newOwner->save(); 
                    $get_id = $newOwner->id;
                    
                    
                }  
                    // ACCOUNT TABLE SAVING 
                    $accounts = new Account;
                    $accounts->owner_id = $get_id;
                    $accounts->acct_creation_date = $key[$i]["Account Creation Date"];
                    $accounts->acct_creation_time = $key[$i]["Account Creation Time"];
                    $accounts->acct_name = $key[$i]["Account Name"];
                    $accounts->acct_type = $key[$i]["Account Type"];
                    $accounts->acct_updated_date = $key[$i]["Account Updated Date"];
                    $accounts->branch = $key[$i]["Batch"];
                    $accounts->reseller = $key[$i]["Reseller"];
                    $accounts->industry = $key[$i]["Industry"];
                    $accounts->size = $key[$i]["Size"];
                    $accounts->address = $key[$i]["Address"]; 
                    $accounts->contact_person = $key[$i]["Contact Person "];
                    $accounts->phone = $key[$i]["Phone "];
                    $accounts->email = $key[$i]["Email "];
                    
                    $accounts->save(); 
                    $accounts->id;

                    // ASP TABLE SAVING
                    if ($key[$i]["ASP Coverage Start Date"]) {
                        $asp = new Coverage; 
                        $asp->bp_number = $key[$i]["BP Number"];
                        $asp->batch = $key[$i]["Batch"];
                        $asp->licience = $key[$i]["License"];
                        $asp->acct_id = $accounts->id;
                        $asp->asp_start_date = $key[$i]["ASP Coverage Start Date"];
                        $asp->asp_end_date = $key[$i]["ASP Coverage End Date"];
                        $asp->asp_price = $key[$i]["ASP Price"];
                        $asp->status = $key[$i]["ASP Status"];
                        $asp->type_of_support = $key[$i]["Type of Support"];
                        $asp->sap_system_audit = $key[$i]["SAP System Audit"]; 
                        $asp->software_audit = $key[$i]["Software Audit"];
                        $asp->type_of_server = $key[$i]["Type of Server"];
                        $asp->server_av = $key[$i]["Server AV"];
                        $asp->client_av = $key[$i]["Client Type"];
                        $asp->office_365 = $key[$i]["Office 365"];
                        $asp->firewall = $key[$i]["Firewall"];
                        $asp->backup_storage = $key[$i]["Backup Storage"];
                        $asp->ups = $key[$i]["UPS"];
                        $asp->veritas = $key[$i]["Veritas"]; 
                        $asp->infra_recommendations = $key[$i]["Infra Recommendations"];
                        $asp->product_inquiry = $key[$i]["Product Inquiry "];
                        $asp->client_type = $key[$i]["Client Type"]; 
                        $asp->remarks = $key[$i]["Remarks"];
                        $asp->software_version = $key[$i]["Software Version"];
                        $asp->save();  
                    }  
            } 
        } 
        return "Imported Done!!" ;
        
    }  
    function show(){ 
        return Coverage::all();
    }
}
