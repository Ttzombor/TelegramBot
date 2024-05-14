<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    protected function handleChatMessage(Stringable $text): void
    {
        Log::channel('telegram')->info(json_encode($this->message->toArray()));
        if ($this->message->photos()->last()) {
            $this->reply("Photo received.");
            $chat =   \DefStudio\Telegraph\Models\TelegraphChat::find($this->message->chat()->id());
            $chat->store($this->message->photos()->last(), 'images');

            return;
        }
        parent::handleChatMessage($text);
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->reply("Please enter new command.");
    }

    public function start()
    {
        $this->reply("Hello! I am a bot. How can I help you?");
    }

    public function actions()
    {
        Telegraph::message('Please choose photo')
            ->keyboard(Keyboard::make()->buttons([
                Button::make('Upload')->action('uploadPhoto')
            ]))
            ->send();
    }

    public function uploadPhoto()
    {
        $this->reply("Please upload photo.");
    }
}
