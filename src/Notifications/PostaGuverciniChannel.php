<?php

namespace SerefErcelik\PostaGuvercini\Notifications;

use SerefErcelik\PostaGuvercini\Notifications\PostaGuverciniMessage;
use Illuminate\Notifications\Notification;
use SerefErcelik\PostaGuvercini\PostaGuvercini;

class PostaGuverciniChannel
{
    protected PostaGuvercini $client;

    /**
     * @param PostaGuvercini $client
     */
    public function __construct(PostaGuvercini $client) {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $mobile = $notifiable->routeNotificationFor('postaguvercini')) {
            return;
        }

        $message = $notification->toSmsApi($notifiable);

        if (is_string($message)) {
            $message = new PostaGuverciniMessage($message);
        }

        $this->client->sendMessage($mobile,$message->content);
    }
}