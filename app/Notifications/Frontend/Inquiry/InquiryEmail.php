<?php

namespace App\Notifications\Frontend\Inquiry;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use URL;
use App\Models\Setting;
use Mail;

class InquiryEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  
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

        $email = setting()->key('email');

        $message = new MailMessage();
        // dd($message);


        // $firstName = $setting->value;
        // dd($email);
        // dd($notifiable);

        return (new MailMessage)
                ->from($notifiable->email)
                // ->to($email)
                ->greeting('From: ' . $notifiable->name )
                ->line($message)
                // ->line('Thank you for reaching out to '. app_name() .'. We have received your email, and our support team will be in touch with you soon.')
                // ->line('You may refer to our FAQs for more information.')
                // ->action('View FAQs', URL::to('faq'))
                // ->line('Please note that our working hours is 0730 to 1900 (GMT +100) from Monday to Saturday. We regret the delay in reply over the non-working hours.')
                // ->line('Thank you for your understanding.')
                ;
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
