<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class VoiceController extends Controller
{


    public function __construct()
    {
        // Twilio credentials
        $this->account_sid = env('TWILIO_SID');
        $this->auth_token = env('TWILIO_AUTH_TOKEN');

        //The twilio number you purchased
        $this->from = env('TWILIO_NUMBER');

        // Initialize the Programmable Voice API
        $this->client = new Client($this->account_sid, $this->auth_token);
    }


    public function initiateCall()
    {
        $phone_number = '+923007272332';
        //Lookup phone number to make sure it is valid before initiating call
        //$phone_number = $this->client->lookups->v1->phoneNumbers($phone_number)->fetch();
        try {
            // If phone number is valid and exists
            if($phone_number) {
                // Initiate call and record call
                $call = $this->client->account->calls->create(
                    $phone_number, // Destination phone number
                    $this->from, // Valid Twilio phone number
                    array(
                        "record" => True,
                        "url" => "http://demo.twilio.com/docs/voice.xml"));

                if($call) {
                    echo 'Call initiated successfully';
                } else {
                    echo 'Call failed!';
                }
            }
        }
        catch (Exception $e)
        {
            echo 'Error: ' . $e->getMessage();
        } catch (RestException $rest) {
            echo 'Error: ' . $rest->getMessage();
        }



    }

































}
