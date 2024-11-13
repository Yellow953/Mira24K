<?php

use App\Jobs\UpdateGoldPriceJob;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('gold:update', function () {
    UpdateGoldPriceJob::dispatch();
})->describe('Fetch and update the gold price in the Global table');

Schedule::command('gold:update')->weekdays()->at('9:00');
Schedule::command('gold:update')->weekdays()->at('11:00');
Schedule::command('gold:update')->weekdays()->at('13:00');
Schedule::command('gold:update')->weekdays()->at('15:00');

Schedule::command('gold:update')->saturdays()->at('9:00');
Schedule::command('gold:update')->saturdays()->at('11:00');
Schedule::command('gold:update')->saturdays()->at('13:00');
Schedule::command('gold:update')->saturdays()->at('15:00');
