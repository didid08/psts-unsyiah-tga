<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class BeritahuKomisiPenguji extends Mailable
{
    use Queueable, SerializesModels;

    public $info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($role, $nama, $nim, $tgl, $pukul, $tempat)
    {
        $this->info['role'] = $role;
        $this->info['nama'] = $nama;
        $this->info['nim'] = $nim;
        $this->info['hari'] = Carbon::parse($tgl)->translatedFormat('l');
        $this->info['tgl'] = Carbon::parse($tgl)->translatedFormat('d F Y');
        $this->info['pukul'] = Carbon::parse($pukul)->translatedFormat('H:i').' WIB';
        $this->info['tempat'] = $tempat;

        $this->info = json_decode(json_encode($this->info));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('psts.unsyiah@gmail.com')
                   ->subject('Informasi Seminar Proposal')
                   ->view('email.beritahu-komisi-penguji')
                   ->with(
                    [
                        'info' => $this->info
                    ]);
    }
}
