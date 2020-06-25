<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsulPembimbing extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $nim;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama, $nim)
    {
        $this->nama = $nama;
        $this->nim = $nim;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('psts.unsyiah@gmail.com')
                   ->view('email.usul-pembimbing')
                   ->with(
                    [
                        'nama' => $this->nama,
                        'nim' => $this->nim,
                    ]);
    }
}
