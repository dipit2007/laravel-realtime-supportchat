<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;

use Validator;

use App\BroadcastMessage;
use App\SupportChatMessage;

use App\Events\SupportChatMessageEvent;

use GuzzleHttp\Client;

use App\User;

class SupportChatAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->id === 1){
            return view('supportchat.adminhome');
        } else {
            return view('supportchat.home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $http = new Client;

        $response = $http->get('http://127.0.0.1:6001/apps/2c37972fa6db434a/channels?auth_key=8dd18f96e2dc6f6805e2068160fc16ec');

        return response($response->getBody(),200)->header('Content-Type', 'application/json; charset=utf-8');
        //json_decode((string) $response->getBody(), true);
        //return response('Hello World', 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'message' => 'required|max:255',
            'foruser' => 'required',
        ]);

        if ($validator->fails()) {
            if($request->ajax()){
                return ['status' => 'validatorfails' , 'message' => $validator->errors()];
            } else {
                return redirect(route('supportchat.create'))
                ->withInput()
                ->withErrors($validator);   
            }
        }

        // Store the new message
        $user = Auth::user();

        $supportchatmessage = new SupportChatMessage;

        $supportchatmessage->message = $request->message;
        $supportchatmessage->from_user_id = $user->id;
        $supportchatmessage->to_user_id = $request->foruser['id'];
        $supportchatmessage->channel = 'support.' . $request->foruser['id'];

        $supportchatmessage->save();

        event(new SupportChatMessageEvent($supportchatmessage));

        //$request->session()->flash('status', 'Task was successful!');

        if($request->ajax()){
            return ['status' => "success", "message" => "Message Saved OK","data" => $supportchatmessage ];
        } else {
            return redirect(route('supportchat.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->id !== 1){
            return "NOT ALLOWED";
        }
        $foruser = User::find($id);

        if($foruser){
            return view('supportchat.supportuserchat',[
                'foruser' => $foruser,
            ]);
        } else {
            return "User NOT Found";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
