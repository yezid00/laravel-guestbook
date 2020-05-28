<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;

use App\Message;
use DB;
use Illuminate\Support\Facades\Mail;


class MessageController extends Controller
{
    // public function __construct(){
    //     $this->middleware('Auth',['except'=>['store','index']]);
    // }
   // public function __construct()
    //{
   // $this->middleware('auth');
    //}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();

        return view('messages.index')->with('messages',$messages);
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

        $this->validate($request, [
            'name'=>'required|max:255',
            'email'=>'required|',
            'subject'=>'required',
            'message'=>'required',
            'doc' => 'file|nullable|max:1999'
        ]);

        if ($request->hasFile('doc')) {
            $fileNameWithExt = $request->file('doc')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('doc')->extension(); 

            $upload = $fileName.'.'.$extension;
            $path =$request->file('doc')->storeAs('public/uploads',$upload);
        }else{
            $upload= 'nofile.txt';
        }

        $message = new Message;

        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->doc = $upload;
        $message->save();

        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'message'=> $request->message,
            'file' => $request->doc,
            // 'file' =>$path
        ];

        Mail::to('olanaseyezid@gmail.com')->send(new SendMail($data));

        return redirect('/')->with('success','Message sent,Will get back to you in a jiffy');
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
        // dd($request);
         //$message = Message::find($id);

         $update = DB::table('messages')
                    ->where('id',$id)
                    ->update(['status'=>1]);
         // Message::where('id', $message->id)->update(['status', 1]);;
        // $message->save();

        return redirect()->route('messages.index')->with('success','Message Status has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        return redirect()->route('messages.index')->with('success','Message deleted');
    }
}
