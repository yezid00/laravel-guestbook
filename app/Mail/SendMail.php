<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    // public $file;
    // public $storagePath;
    // /**
     // * Create a new message instance.
     // *
     // * @return void
     // */
    public function __construct($data)
    {
        $this->data = $data;
        // $this->file =  $file;
        // $this->attachment_file= public_path() . '/' . $storagePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from($this->data['email'])->subject($this->data['subject'])->view('emails.index')->attach($this->data['file']->getRealPath(),[
        //     'as'=>$this->data['file']->getClientOriginalName(),
        //     'mime'=>$this->data['file']->getClientMimeType()

        // ])->with('data',$this->data);
       
         $mail = $this->from($this->data['email'])->subject($this->data['subject'])->view('emails.index')->with('data',$this->data);

        if(!is_null($this->data['file'])){
            $mail->attach($this->data['file']->getRealPath(), ['as' => $this->data['file']->getClientOriginalName(), 'mime' => $this->data['file']->getClientMimeType()]);
        }

        return $mail;
    }
}
