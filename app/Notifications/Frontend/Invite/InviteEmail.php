<?php

namespace App\Notifications\Frontend\Invite;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InviteEmail extends Notification
{
    use Queueable;

    /**
     * @var Invite $invite
     */
    protected $invite;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invite)
    {
        $this->invite = $invite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->greeting('Hello! ' . strtoupper($notifiable->profile->last_name))
                ->line('You have been invited as one of our user at ' . app_name() . '.')
                ->line('You can now use your account with the following credentials.')
                ->line('Email: ' . $notifiable->email)
                ->line('Username: ' . $notifiable->username)
                ->line('Password: ' . $this->invite->password)
                ->action('Confirm Account', route('frontend.auth.account.confirm', $notifiable->confirmation_code))
                ->line('By using this account you will have a 30-day trial. Please do note after the trial you will be asked to subscribe inorder to use this account.')
                ->line('We would like to welcome you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
