<?php

namespace App\Mail\UsulKomisiPenguji;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Penguji2 extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $nim;
    public $jamSeminar;
    public $tglSeminar;
    public $tempatSeminar;
    public $key;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama, $nim, $jamSeminar, $tglSeminar, $tempatSeminar, $key)
    {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->jamSeminar = $jamSeminar;
        $this->tglSeminar = $tglSeminar;
        $this->tempatSeminar = $tempatSeminar;
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
                   ->view('email.usul-komisi-penguji.penguji-2')
                   ->with(
                    [
                        'nama' => $this->nama,
                        'nim' => $this->nim,
                        'jam_seminar' => $this->jamSeminar,
                        'tgl_seminar' => $this->tglSeminar,
                        'tempat_seminar' => $this->tempatSeminar,
                        'key' => $this->key
                    ]);
    }
}
