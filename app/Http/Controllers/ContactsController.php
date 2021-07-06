<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Contacts;
use Illuminate\Validation;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use App\Imports\CsvImport;
use Maatwebsite\Excel\Reader;
use Illuminate\Support\Facades\Validator;
use App\Models\ListModel;
use Auth;
use Illuminate\Support\Facades\DB;


class ContactsController extends Controller
{


    /*
     * All contact list Fetch
     *
     * */
    public function FetchAll()
    {
        //Call Json file Function
        $this->CreateJsonFile();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "All Contact List"]];
        return view('/content/contacts/contacts-List', ['breadcrumbs' => $breadcrumbs ]);
    }


    /*
     * Add New Record Blade show
     * */
    public function ShowAddContact()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "Add Contact"]
        ];
        return view('/content/contacts/add-contact', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }


    /*
     * Add New Record
     * */
    public function Store(Request $request)
    {
        $validData =  \Validator::make($request->all(),[
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'home_phone' => 'required|unique:Contacts|max:255',
            'mobile_phone' => 'required|unique:Contacts|max:255',
            'work_phone' => 'required|unique:Contacts|max:255',
            'company_name' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        if ($validData->fails())
        {
            return redirect()->back()->withErrors($validData->errors())->withInput();
        }else{
            Contacts::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'home_phone' => (int)str_replace("-", "",$request->home_phone),
                'mobile_phone' => (int)str_replace("-", "",$request->mobile_phone),
                'work_phone' => (int)str_replace("-", "",$request->work_phone),
                'company_name' => $request->company_name,
                'email' => $request->email,
                'created_by_id' => 1,
            ]);
        }

        //Call Json file Function
        $this->CreateJsonFile();

        $AllList = ListModel::all();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "Add Contact"]
        ];
        return view('/content/contacts/contacts-List', [
            'breadcrumbs' => $breadcrumbs, 'AllList' => $AllList
        ])->withSuccess('Data successfully store into Contact List');
    }


    /*
     * Update Contact
    */
    public function Edit($id)
    {
        $ContactData = Contacts::find($id);

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "Update Contact"]
        ];
        return view('/content/contacts/update-contact', [
            'breadcrumbs' => $breadcrumbs, 'ContactData' => $ContactData
        ]);

    }

    /*
       * Update Record
       * */
    public function Update(Request $request)
    {

        $validData =  \Validator::make($request->all(),[
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            ///'home_phone' => 'required|max:255|unique:Contacts,id,'. $request->id,
            //'mobile_phone' => 'required|max:255|unique:Contacts,id,'. $request->id,
            //'work_phone' => 'required|max:255|unique:Contacts,id,'. $request->id,
            'home_phone' => 'required|max:255',
            'mobile_phone' => 'required|max:255',
            'work_phone' => 'required|max:255',
            'company_name' => 'required|max:255',
            //'email' => 'required|email|unique:Contacts,id,' . $request->id,
            'email' => 'required|email',
        ]);

        if ($validData->fails())
        {
            return redirect()->back()->withErrors($validData->errors())->withInput();

        }else{

            $input = $request->all();
            $Contacts = Contacts::findOrFail($request->id);
            $Contacts->fill(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'home_phone' => (int)str_replace("-", "",$request->home_phone),
                    'mobile_phone' => (int)str_replace("-", "",$request->mobile_phone),
                    'work_phone' => (int)str_replace("-", "",$request->work_phone),
                    'company_name' => $request->company_name,
                    'email' => $request->email,
                    'created_by_id' => Auth::id(),
                ]
            )->save();

            //Session::flash('flash_message', 'Contact successfully updated!');
        }

        //Call Json file Function
        $this->CreateJsonFile();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "Add Contact"]
        ];
        return view('/content/contacts/contacts-List', [
            'breadcrumbs' => $breadcrumbs
        ])->withSuccess('Data successfully updated into Contact List');
    }


    public function Delete($id)
    {
        $Contacts = Contacts::findOrFail($id);
        $Contacts->delete();

        //Call Json file Function
        $this->CreateJsonFile();

        Session::flash('flash_message', 'Contact successfully deleted!');

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "Contact List"]
        ];
        return view('/content/contacts/contacts-List', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function Detail($id)
    {
        $Contacts = Contacts::findOrFail($id);

        Session::flash('flash_message', 'Contact successfully deleted!');

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "Contact List"]
        ];
        return view('/content/contacts/contact-detail', [
            'breadcrumbs' => $breadcrumbs , 'Contacts' => $Contacts
        ]);
    }


    /*
     * Json File Creation
     * Contact Record
    */
    public function CreateJsonFile()
    {
        /*
        * All Contact table json formate file save
        */
        $ContactsList = '{ "data":'.json_encode(Contacts::all()).'}';
        //$newJsonString = json_encode(Contacts::all(), JSON_PRETTY_PRINT);
        $respose =  file_put_contents(base_path('public/data/contact-list.json'), stripslashes($ContactsList));

    }


    /*
     * All contact list Fetch
     *
     * */
    public function FetchAllList()
    {
        $AllList = ListModel::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "List"], ['name' => "All Contact List"]];
        return view('/content/contacts/all-List', ['breadcrumbs' => $breadcrumbs, 'AllList' => $AllList ]);
}


    // Add New List Form
    public function Addlist()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "List"], ['name' => "Add List"]
        ];
        return view('/content/contacts/add-list', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /*
         * Add Excel sheet contact
         * */
    public function StoreList(Request $request)
    {

        $validData =  Validator::make($request->all(),[
            'listtype' => 'required',
            'listname' => 'required|file|mimes:xls,xlsx',
        ]);

        if ($validData->fails()){
            return redirect()->back()->withErrors($validData->errors())->withInput();
        }else{
            $fileName = $request->file('listname')->getClientOriginalName();
            $ListData = [
                'list_name' => $fileName,
                'compaign_id' =>  $request->compaign_id,
                'created_by_id' => $request->created_by_id,
                'remember_token' =>  $request->_token,
            ];
            $ListId = ListModel::create($ListData);

           // $path = $request->file('listname')->getRealPath();
            $theCollection = Excel::import(new CsvImport(), $request->file('listname'));
            //Call Json file Function
            $this->CreateJsonFileofcontact();
        }
        $AllList = ListModel::all();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "ALL List"], ['name' => "All Contact List"]];
        return view('/content/contacts/all-List', ['breadcrumbs' => $breadcrumbs, 'AllList' => $AllList  ]);
    }


    public function CreateJsonFileofcontact()
    {
        /*
        * All Contact table json formate file save
        */
        $ContactsList = '{ "data":'.json_encode(Contacts::where('list_id', '>' ,0)->get()).'}';
        //dd(Contacts::where('list_id', '>', 0)->get());
        //$newJsonString = json_encode(Contacts::all(), JSON_PRETTY_PRINT);
        $respose =  file_put_contents(base_path('public/data/All-list.json'), stripslashes($ContactsList));

    }


    public function ContactListDetail($id)
    {
        $Contacts = Contacts::findOrFail($id);

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "ALL List"], ['name' => "All Contact List"]];
        return view('/content/contacts/contact-list-detail', [
            'breadcrumbs' => $breadcrumbs , 'Contacts' => $Contacts
        ]);
    }
























}
