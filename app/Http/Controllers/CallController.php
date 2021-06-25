<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallModel;
use App\Models\Contacts;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;
use Twilio\TwiML\VoiceResponse;
use Twilio;




class CallController extends Controller
{



    public function __construct()
    {
        //getenv("TWILIO_SID"), getenv("TWILIO_AUTH_TOKEN")

        $this->clientToken= new ClientToken(getenv("TWILIO_SID"), getenv("TWILIO_AUTH_TOKEN"));
    }


    /*
    * All Call list Fetch
    *
    * */
    public function FetchAll()
    {
        //$this->CreateJsonFile();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Call"], ['name' => "All Calls"]];
        return view('/content/call/call-List', ['breadcrumbs' => $breadcrumbs ]);
    }


    /*
     * Make Call
     *
     * */
    public function makeCall()
    {

         $ClientToken = $this->newToken();
        //dd($ClientToken);
        $AllContact = Contacts::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Call"], ['name' => "Mak a Call"]];
        return view('/content/call/new-call', ['breadcrumbs' => $breadcrumbs , 'AllContact' => $AllContact  ]);
    }


    /**
     * Create a new capability token
     *
     * @return \Illuminate\Http\Response
     */
    public function newToken()
    {

        $forPage = 'make-call';//$request->input('forPage');
        //$applicationSid = config('services.twilio')['applicationSid'];

        $this->clientToken->allowClientOutgoing(getenv("API_SID"));

//        if ($forPage === route('dashboard', [], false)) {
//            $this->clientToken->allowClientIncoming('support_agent');
//        } else {
//            $this->clientToken->allowClientIncoming('customer');
//        }

        $token = $this->clientToken->generateToken();
        return response()->json(['token' => $token]);
    }



    public function newCall(Request $request)
    {
        $response = new VoiceResponse();
        $callerIdNumber = config('services.twilio')['number'];

        $dial = $response->dial(null, ['callerId'=>$callerIdNumber]);
        $phoneNumberToDial = $request->input('phoneNumber');

        if (isset($phoneNumberToDial)) {
            $dial->number($phoneNumberToDial);
        } else {
            $dial->client('support_agent');
        }

        return $response;
    }

























}
