<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $loginLink = route('auth.magic.login', ['user' => $this->user->id, 'signature' => sha1($this->user->email . config('app.key'))]);

        return $this->view('emails.reg_confirmation')
                    ->with([
                        'user' => $this->user,
                        'loginLink' => $loginLink
                    ]);
    }

}
