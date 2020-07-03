<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UbahPembimbing extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $nim;
    public $key;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama, $nim, $key)
    {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->key = $key;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('psts.unsyiah@gmail.com')
                   ->subject('Pengusulan Pengubahan Pembimbing')
                   ->view('email.ubah-pembimbing')
                   ->with(
                    [
                        'nama' => $this->nama,
                        'nim' => $this->nim,
                        'key' => $this->key
                    ]);
    }
}
