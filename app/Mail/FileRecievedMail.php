<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileRecievedMail extends Mailable
{
    use Queueable, SerializesModels;

    //the list of the name of the files sent to the user
    public $file_name_list;

    //the name of the user who sent the files
    public $username;

    public function __construct($file_name_list, $username)
    {
        $this->file_name_list = $file_name_list;
        $this->username = $username;
    }

    //build the email from the file_recived blade and the given data
    public function build()
    {
        return $this->markdown('emails.file_recieved')
            ->with('username', $this->username)
            ->with('file_name_list', $this->file_name_list);
    }
}
