<?php

namespace Modules\OrdemServico\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\OrdemServico\Entities\{
    OrdemServico
};

class EnviarProtocoloMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $os;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($os)
    {
        $this->os = $os;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

    return $this->from('freeerp@mail.com')->view('ordemservico::emails.protocolo')->with(['protocolo'=> $this->os->protocolo]);
    }
}
