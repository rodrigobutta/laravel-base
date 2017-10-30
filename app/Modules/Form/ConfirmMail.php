<?php
namespace App\Modules\Form;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $form;
    protected $name;
    protected $email;

    public function __construct($form,$name,$email)
    {
        $this->form = $form;
        $this->name = $name;
        $this->email = $email;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Confirmación del formulario ' . $this->form->name)
            ->view('form::emails.confirm')->with([
                    'name' => $this->name,
                    'email' => $this->email,
                    'form' => $this->form
                  ]);

        return $this;
    }
}