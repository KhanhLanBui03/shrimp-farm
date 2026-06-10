<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('[AquaControl] Yêu cầu khôi phục mật khẩu')
            ->greeting('Xin chào ' . $notifiable->name . '!')
            ->line('Bạn nhận được email này vì chúng tôi nhận được yêu cầu khôi phục mật khẩu cho tài khoản của bạn trên hệ thống AquaControl.')
            ->action('Đặt lại mật khẩu', $url)
            ->line('Liên kết khôi phục mật khẩu này sẽ hết hạn trong vòng 60 phút.')
            ->line('Nếu bạn không yêu cầu đặt lại mật khẩu, bạn không cần thực hiện thêm hành động nào.')
            ->salutation('Trân trọng, Đội ngũ AquaControl');
    }
}
