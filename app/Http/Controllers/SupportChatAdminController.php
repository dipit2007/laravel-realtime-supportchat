<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;

use Validator;

use App\BroadcastMessage;

use App\Events\SupportChatMessageEvent;

class SupportChatAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supportchat.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $broadcastmessagedata = new BroadcastMessage;

        $broadcastmessagedata->message = $request->message;
        $broadcastmessagedata->user_id = $user->id;

        $broadcastmessagedata->save();

        event(new SupportChatMessageEvent($broadcastmessagedata));

        //$request->session()->flash('status', 'Task was successful!');

        if($request->ajax()){
            return ['status' => "success", "message" => "Message Saved OK","data" => $broadcastmessagedata ];
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
        //
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
