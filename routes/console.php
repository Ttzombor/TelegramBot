<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('init-telegram-menu', function () {
    /** @var \DefStudio\Telegraph\Models\TelegraphBot $telegramBot */
    $telegramBot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);
    dd($telegramBot->registerCommands([
        'actions' => 'Choose action',
    ])->send());

})->purpose('Initialize telegram menu');
