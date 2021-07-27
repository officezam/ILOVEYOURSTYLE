<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\PictureModel;
use App\Models\Contacts;
use Faker\Core\File;
use Illuminate\Support\Facades\URL;

class PictureController extends Controller
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
        $AllList = PictureModel::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Picture"], ['name' => "All Picture"]];
        return view('/content/picture/all-List', ['breadcrumbs' => $breadcrumbs, 'AllList' => $AllList ]);
    }

    /*
        * NEw SMS blade
        *
        * */
    public function ShowPicture()
    {
        $AllContact = Contacts::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Picture"], ['name' => "New Picture"]];
        return view('/content/picture/new-picture', ['breadcrumbs' => $breadcrumbs, 'AllContact' => $AllContact  ]);
    }

    public function Delete($id)
    {
        $Contacts = PictureModel::findOrFail($id);
        $Contacts->delete();
        $AllList = PictureModel::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Picture"], ['name' => "New Picture"]];
        return view('/content/picture/all-List', ['breadcrumbs' => $breadcrumbs, 'AllList' => $AllList ]);
    }



    /*
     * Save and Send Picture
     *
     * */
    public function SaveAndSendPicture(Request $request)
    {

        if ( $request->hasFile('picture_link') )
        {
            $file = $request->file('picture_link');

            //Display File Name
            echo 'File Name: '.$file->getClientOriginalName();


            //Display File Extension
            echo 'File Extension: '.$file->getClientOriginalExtension();
            echo '<br>';

            //Display File Real Path
            echo 'File Real Path: '.$file->getRealPath();
            echo '<br>';

            //Display File Size
            echo 'File Size: '.$file->getSize();
            echo '<br>';

            //Display File Mime Type
            echo 'File Mime Type: '.$file->getMimeType();

            //Move Uploaded File
            $destinationPath = 'uploads/picture';
            $filename = time().'_'.$file->getClientOriginalName();


            $file->move($destinationPath,$filename);
        }
        $pathofpicture = URL::asset('uploads/picture/'.$filename);

        $ListData = [
            'picture_from' => $this->from,
            'picture_to' =>  (int)str_replace("-", "",$request->ToPhone),$request->ToPhone,
            'picture_link' => $pathofpicture,
            'picture_text' =>  $request->picture_text,
            'status' =>  'Initiated',
        ];
        $picturData = PictureModel::create($ListData);


        //$picture_id = $picturData->id;
        //$PictureXmlPath = url("/xml/picture-xml/{$picture_id}");

        $this->SendPicture($request->ToPhone,$picturData->picture_link,$picturData->picture_text);

        return redirect('picture/picture-list');

    }


    /*
       * All XML File
       *
       * */
    public function PictureXml($picture_id)
    {
        $PictureData = PictureModel::findOrFail($picture_id);
        return response()->view('content/xml/picture_xml', ['PictureData' => $PictureData])->header('Content-Type', 'text/xml');
    }




    public function SendPicture($ToPhone,$PicturePath, $pictureText)
    {
        // $phone_number = '+923007272332';
        //Lookup phone number to make sure it is valid before initiating call
        $phone_number = $this->client->lookups->v1->phoneNumbers($ToPhone)->fetch();
        try {
            // If phone number is valid and exists
            if($ToPhone) {



                $messageParams = array(
                    'from' => $this->from,
                    'body' => $pictureText
                );
                if ($PicturePath) {
                    $messageParams['mediaUrl'] = $PicturePath;
                }

                $PictureMessage =$this->client->messages->create(
                    '+'.$ToPhone,
                    $messageParams
                );




                if($PictureMessage) {
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
