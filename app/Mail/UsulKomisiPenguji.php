<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class UsulKomisiPenguji extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $nim;
    public $hariSeminar;
    public $jamSeminar;
    public $tglSeminar;
    public $tempatSeminar;
    public $key;
    public $target;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama, $nim, $jamSeminar, $tglSeminar, $tempatSeminar, $key, $target)
    {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->hariSeminar = Carbon::parse($tglSeminar)->translatedFormat('l');
        $this->jamSeminar = Carbon::parse($jamSeminar)->translatedFormat('H:i').' WIB';
        $this->tglSeminar = Carbon::parse($tglSeminar)->translatedFormat('d F Y');
        $this->tempatSeminar = $tempatSeminar;
        $this->key = $key;
        $this->target = $target;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('psts.unsyiah@gmail.com')
                   ->view('email.usul-komisi-penguji')
                   ->with(
                    [
                        'nama' => $this->nama,
                        'nim' => $this->nim,
                        'hari_seminar' => $this->hariSeminar,
                        'jam_seminar' => $this->jamSeminar,
                        'tgl_seminar' => $this->tglSeminar,
                        'tempat_seminar' => $this->tempatSeminar,
                        'key' => $this->key,
                        'target' => $this->target
                    ]);
    }
}
