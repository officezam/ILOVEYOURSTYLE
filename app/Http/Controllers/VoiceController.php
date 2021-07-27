<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Voice;
use App\Models\Contacts;
use Faker\Core\File;
use Illuminate\Support\Facades\URL;
use Mtownsend\ResponseXml\Providers\ResponseXmlServiceProvider;

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


    /*
        * All Call list Fetch
        *
        * */
    public function FetchAll()
    {
        $AllList = Voice::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Voice"], ['name' => "All Voice"]];
        return view('/content/voice/all-List', ['breadcrumbs' => $breadcrumbs, 'AllList' => $AllList ]);
    }

    /*
        * NEw SMS blade
        *
        * */
    public function ShowVoice()
    {
        $AllContact = Contacts::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Voice"], ['name' => "New Voice"]];
        return view('/content/voice/new-voice', ['breadcrumbs' => $breadcrumbs, 'AllContact' => $AllContact  ]);
    }

    public function Delete($id)
    {
        $Contacts = Voice::findOrFail($id);
        $Contacts->delete();
        $AllContact = Contacts::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Voice"], ['name' => "New Voice"]];
        return view('/content/voice/new-voice', ['breadcrumbs' => $breadcrumbs, 'AllContact' => $AllContact  ]);
    }



    /*
     * Save and Send Voice
     *
     * */
    public function SaveAndSendVoice(Request $request)
    {

        if ( $request->hasFile('voiceAudio') )
        {
            $file = $request->file('voiceAudio');

            //Display File Name
          //  echo 'File Name: '.$file->getClientOriginalName();


            //Display File Extension
           // echo 'File Extension: '.$file->getClientOriginalExtension();
          //  echo '<br>';

            //Display File Real Path
          //  echo 'File Real Path: '.$file->getRealPath();
          //  echo '<br>';

            //Display File Size
         //   echo 'File Size: '.$file->getSize();
         //   echo '<br>';

            //Display File Mime Type
         //   echo 'File Mime Type: '.$file->getMimeType();

            //Move Uploaded File
            $destinationPath = 'uploads';
            $filename = time().'_'.$file->getClientOriginalName();


            $file->move($destinationPath,$filename);
        }
        $pathofAudio = URL::asset('uploads/'.$filename);

        $ListData = [
            'voice_from' => $this->from,
            'voice_to' =>  $request->ToPhone,
            'voiceAudio' => $pathofAudio,
            'voice_text' =>  $request->voice_text,
            'status' =>  'Initiated',
        ];
        $ListId = Voice::create($ListData);
        $voice_id = $ListId->id;
        $VoiceXmlPath = url("/voice/voice-xml/{$voice_id}");

        $this->initiateCall($request->ToPhone,$VoiceXmlPath);

        return redirect('voice/voice-list');

    }


    /*
       * All XML File
       *
       * */
    public function VoiceXml($voice_id)
    {
        $VoiceData = Voice::findOrFail($voice_id);

//        $data = [
//            'Say' => $VoiceData->voice_text,
//
//        ];
//        return response()->xml($data);

        return response()->view('content/xml/voice_xml', ['VoiceData' => $VoiceData])->header('Content-Type', 'text/xml');
    }




    public function initiateCall($ToPhone,$VoiceXmlPath)
    {

        try {
            // If phone number is valid and exists
            if($ToPhone) {

                /*$call =$this->client->account->calls->create(
                    '+'.$ToPhone,
                    $this->from,
                    array(
                        //"url" => $VoiceXmlPath
                         "url" => "https://demo.twilio.com/docs/voice.xml"
                    )
                );*/


                $call = $this->client->calls
                    ->create( '+'.$ToPhone, // to
                        $this->from, // from
                        [
                            "method" => "GET",
                            "statusCallback" => "http://amir.memarketingmanagement.com/voice/voice-xml-response",
                            "statusCallbackMethod" => "GET",
                            "statusCallbackEvent" => ["initiated","answered"],
                            "url" => $VoiceXmlPath
                            //"url" => "http://demo.twilio.com/docs/voice.xml"
                        ]
                    );





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


    public  function Response(Request $request)
    {
        return true;
        //dd( $request);
    }






























}
