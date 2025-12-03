protected function schedule(Schedule $schedule): void
{
    $schedule->command('cart:send-email')->everyfiveMinute();
}
