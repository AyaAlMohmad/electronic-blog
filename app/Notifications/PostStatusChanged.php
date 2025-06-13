<?php
namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostStatusChanged extends Notification
{
    use Queueable;

    public $post;
    public $status;
    public $reason; // NEW

    public function __construct(Post $post, string $status, string $reason = null)
    {
        $this->post = $post;
        $this->status = $status;
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your post has been ' . ($this->status === 'approved' ? 'approved' : 'rejected') . '.')
            ->line('Post title: ' . $this->post->title);

        if ($this->status === 'rejected' && $this->reason) {
            $message->line('Reason for rejection: ' . $this->reason);
        }

        $message->action('View Post', url('/posts/' . $this->post->id))
                ->line('Thank you for using our platform!');

        return $message;
    }

    public function toArray($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'title' => $this->post->title,
            'status' => $this->status,
            'reason' => $this->reason,
        ];
    }
}
