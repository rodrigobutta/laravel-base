<?php
namespace App\Modules\Form;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $form;
    protected $lead;


    public function __construct($form,$lead)
    {
        $this->form = $form;
        $this->lead = $lead;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Nueva entrada para el formulario ' . $this->form->name)
            ->view('form::emails.notification')->with([
                    'lead' => $this->lead,
                    'form' => $this->form
                  ]);

        return $this;
    }
}