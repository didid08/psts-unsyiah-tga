<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class UsulKomisiPenguji2 extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $nim;
    public $hariSidang;
    public $jamSidang;
    public $tglSidang;
    public $tempatSidang;
    public $key;
    public $target;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama, $nim, $jamSidang, $tglSidang, $tempatSidang, $key, $target)
    {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->hariSidang = Carbon::parse($tglSidang)->translatedFormat('l');
        $this->jamSidang = Carbon::parse($jamSidang)->translatedFormat('H:i').' WIB';
        $this->tglSidang = Carbon::parse($tglSidang)->translatedFormat('d F Y');
        $this->tempatSidang = $tempatSidang;
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
                   ->subject('Pengusulan Komisi Penguji untuk Sidang Buku TGA')
                   ->view('email.usul-komisi-penguji-2')
                   ->with(
                    [
                        'nama' => $this->nama,
                        'nim' => $this->nim,
                        'hari_sidang' => $this->hariSidang,
                        'jam_sidang' => $this->jamSidang,
                        'tgl_sidang' => $this->tglSidang,
                        'tempat_sidang' => $this->tempatSidang,
                        'key' => $this->key,
                        'target' => $this->target
                    ]);
    }
}
