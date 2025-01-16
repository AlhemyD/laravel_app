<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('publish-posts', function () {
	$this->call('posts:publish-auto');
})->purpose('Автоматически публиковать посты, которые назначены на публикацию')->everyMinute();