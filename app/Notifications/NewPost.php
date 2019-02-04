<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;


class NewPost extends Notification
{

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return   $this->post;

    }
}
