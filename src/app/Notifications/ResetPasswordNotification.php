<?php

namespace Cesi\Core\app\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(trans('cesi::core.password_reset.subject'))
            ->greeting(trans('cesi::core.password_reset.greeting'))
            ->line([
                trans('cesi::core.password_reset.line_1'),
                trans('cesi::core.password_reset.line_2'),
            ])
            ->action(trans('cesi::core.password_reset.button'), route('cesi.auth.password.reset.token', $this->token).'?email='.urlencode($notifiable->getEmailForPasswordReset()))
            ->line(trans('cesi::core.password_reset.notice'));
    }
}
