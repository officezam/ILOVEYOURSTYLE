<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
use App\Models\SMSModel;
use Twilio\Rest\Client;
use Illuminate\Session;
use App\Models\ListModel;
use Propaganistas\LaravelPhone\PhoneNumber;

class SMSController extends Controller
{

    /*
    * All SMS list Fetch
    *
    * */
    public function FetchAll()
    {
        $this->CreateJsonFile();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "SMS"], ['name' => "All SMS"]];
        return view('/content/sms/sms-list', ['breadcrumbs' => $breadcrumbs ]);
    }


    /*
    * NEw SMS blade
    *
    * */
    public function ShowNewSMS()
    {
        $AllContact = Contacts::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "SMS"], ['name' => "New SMS"]];
        return view('/content/sms/new-sms', ['breadcrumbs' => $breadcrumbs , 'AllContact' => $AllContact  ]);
    }

    /*
    * Send and store Sms
    *
    * */
    public function StoreSMS(Request $request)
    {
        $message    = $request->sms_text;
        $ToPhone    = '+'.$request->ToPhone;
       // $ToPhone = PhoneNumber::make($ToPhone, 'BE')->getCountry();
        //PhoneNumber::make('012/34.56.78', 'BE')->formatNational();
        //$ToPhone = (string) PhoneNumber::make($ToPhone, 'BE');
        //$ToPhone = (string) PhoneNumber::make($ToPhone);              // +3212345678
        //$ToPhone = (string) PhoneNumber::make($ToPhone, 'BE');          // +3212345678
        //$ToPhone = (string) PhoneNumber::make($ToPhone)->ofCountry('BE');  // +3212345678
       // dd($ToPhone);
        $response =  $this->sendMessage($message, $ToPhone);

        $SMS = new SMSModel;
        $SMS->from       = getenv("TWILIO_NUMBER");
        $SMS->to         = $ToPhone;
        $SMS->Message    = $message;
        $SMS->MessageSid = $response->sid;
        $SMS->status     = 'Sent';//$response->status;
        $SMS->save();

        $this->CreateJsonFile();

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "SMS"], ['name' => "New SMS"]];
        return view('/content/sms/sms-List', ['breadcrumbs' => $breadcrumbs  ]);
    }


    /*
     * Send Message by Twilio
     * Pass Message and toNumber/recipients
     *
     */
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_ACCOUNT_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        //$TWILIO_NOTIFY_SID = getenv("TWILIO_NOTIFY_SID");

        $twilio = new Client( $account_sid, $auth_token);

        return $twilio->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message] );
    }


    public function Delete($id)
    {
        $Contacts = SMSModel::findOrFail($id);
        $Contacts->delete();

        //Call Json file Function
        $this->CreateJsonFile();

        //Session::flash('flash_message', 'Contact successfully deleted!');

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "Contact List"]
        ];
        return view('/content/sms/sms-List', ['breadcrumbs' => $breadcrumbs ]);
    }


    /*
    * Show Page of Bulk SMS
    * */
    public function ShowBulkSms()
    {
        $AllList = ListModel::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "SMS"], ['name' => "Bulk SMS"]];
        return view('/content/sms/bulk-sms', ['breadcrumbs' => $breadcrumbs , 'AllList' => $AllList  ]);
    }

    /*
        * Send and store Bulk Sms
        *
        * */
    public function StorebulkSMS(Request $request)
    {
        $ListContacts = Contacts::where('list_id', '=' , $request->list_id)->get('mobile_phone')->toArray();

        //dd($ListContacts);

        $message    = $request->sms_text;
        //$ToPhone = '+923007272332';//$request->ToPhone;
        $response =  $this->SendBulkMessage($message, $ListContacts);

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "SMS"], ['name' => "ALL SMS"]];
        return view('/content/sms/sms-List', ['breadcrumbs' => $breadcrumbs  ]);



        $SMS = new SMSModel;
        $SMS->from       = getenv("TWILIO_NUMBER");
        $SMS->to         = $ToPhone;
        $SMS->Message    = $message;
        $SMS->MessageSid = $response->sid;
        $SMS->status     = $response->status;
        $SMS->save();

        $this->CreateJsonFile();

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "SMS"], ['name' => "New SMS"]];
        return view('/content/sms/sms-List', ['breadcrumbs' => $breadcrumbs  ]);
    }


    /*
     * Send Bulk Message by Twilio
     * Pass Message and toNumber/recipients
     *
     */
    private function SendBulkMessage($message, $ListContacts)
    {
        //Make subscriber List for twilio array
        $subscribers = $this->MakeSubscriberArray($ListContacts);

        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        //$twilio_number = getenv("TWILIO_NUMBER");
        $notify_sid = getenv('TWILIO_NOTIFY_SID');
        $client = new Client($account_sid, $auth_token);
        $start_time = microtime(true);

        //+14844458575
        //+13695147426

        $request_data = [
            "toBinding" => $subscribers,
            'body' => $message
        ];

        // Bulk send the SMS
        $notification = $client->notify->v1->services($notify_sid)
            ->notifications->create($request_data);

        return $notification;




        echo $notification->body; // => Knok-Knok! This is your first Notify SMS
        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time);

        echo " Execution time: " . $execution_time . " seconds";
        dd($notification);
    }


    /*
     * Make Subscriber LISt For Twillio
     * */
    Public function MakeSubscriberArray($ListContacts)
    {
        $search  = 'mobile_phone';
        $replace = 'address';

        foreach ($ListContacts as $key => $value)
        {
            $ToPhone = $this->change_key( $ListContacts[$key], $old_key = 'mobile_phone', $new_key= 'address' );
             //$ListContacts = array_push($ListContacts[$key], 'binding_type', 'sms');
            $updatedArray[] = json_encode(array_merge($ToPhone, ['binding_type' => "sms"]));
            //$subscribers = json_encode($updatedArray);
                continue;
        }
        //$subscribers = json_encode($updatedArray);
        return $updatedArray;

    }

    public function change_key( $array, $old_key, $new_key ) {

        if( ! array_key_exists( $old_key, $array ) )
            return $array;

        $keys = array_keys( $array );
        $keys[ array_search( $old_key, $keys ) ] = $new_key;

        return array_combine( $keys, $array );
    }


    /*
    * Json File Creation
    * SMS Record
    */
    public function CreateJsonFile()
    {
        /*
        * All Contact table json formate file save
        */
        $ContactsList = '{ "data":'.json_encode(SMSModel::all()).'}';
        //$newJsonString = json_encode(Contacts::all(), JSON_PRETTY_PRINT);
        $respose =  file_put_contents(base_path('public/data/all-sms-list.json'), stripslashes($ContactsList));

    }



















































}
