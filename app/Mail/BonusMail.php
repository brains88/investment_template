<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BonusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // User data to personalize the email

    /**
     * Create a new message instance.
     *
     * @param \App\Models\User $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your $200 Bonus is Waiting!') // Clear, enticing subject
                    ->view('emails.bonus') // Template: `resources/views/emails/bonus.blade.php`
                    ->with([
                        'name' => $this->user->name, // Personalize with user's name
                    ]);
    }
}