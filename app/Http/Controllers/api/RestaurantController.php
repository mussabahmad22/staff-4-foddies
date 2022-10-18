<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DateTime;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class RestaurantController extends Controller
{
    public function index(){
        $resturent= Restaurant::all();
        $x = 0;
        foreach ($resturent as $rest){
            // $now = Carbon::now();
            // $start = Carbon::parse($rest->from_tile);
            // $end = Carbon::parse($rest->to_time);
            // // print_r($start);
            // if ($now->between($start,$end)) {
            //     $resturent[$x]['open_status'] = '1';
            // }
            
            $now = new DateTime();
            $begin = new DateTime($rest->from_time);
            $end = new DateTime($rest->to_time);
            
            if ($this->isBetween($rest->from_time,$rest->to_time,date('H:i'))){
                $resturent[$x]['open_status'] = '1';
            }
            
            $resturent[$x]['cuisines']  = explode(',',$rest->cuisines);
            $x++;
        }
        return $resturent;
    }
    
    function isBetween($from, $till, $input) {
        $f = DateTime::createFromFormat('!H:i', $from);
        $t = DateTime::createFromFormat('!H:i', $till);
        $i = DateTime::createFromFormat('!H:i', $input);
        if ($f > $t) $t->modify('+1 day');
        return ($f <= $i && $i <= $t) || ($f <= $i->modify('+1 day') && $i <= $t);
    }
    
    public function contactus(Request $request){
        $data = "Hi ".$request->name.", <br> Thank You for reaching out to us. We have received your query, we will go through it and get back to you as soon as possible. <br> Best Regards! <br> Team Stafford Foodies";
        $dataadmin = "Hi Admin, <br/> You Just Received a Contact Email from ".$request->email." <br>
        <span><b>Name</b></span>&nbsp;&nbsp;&nbsp;<span>".$request->name."</span><br/>
        <span><b>Email</b></span>&nbsp;&nbsp;&nbsp;<span>".$request->email."</span><br/>
        <span><b>Phone</b></span>&nbsp;&nbsp;&nbsp;<span>".$request->phone."</span><br/>
        <span><b>Message</b></span>&nbsp;&nbsp;&nbsp;<span>".$request->message."</span><br/>";
        
        Mail::to($request->email)->send(new ContactMail($data,'Thank You For Contacting Stafford Foodies'));
        Mail::to('staffordfoodies@gmail.com')->send(new ContactMail($dataadmin,'Email From Stafford Foodies Contact Form'));
        
        return response()->json(['message'=>'Message sent'],200);
    }
}
