<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEventNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = \App\Models\Event::whereDate('event_start', '=', now()->addDay()->toDateString())
                    ->orWhereDate('event_start', '=', now()->toDateString())
                    ->get();

        if ($events->isEmpty()) {
            $this->info('No events starting soon.');
            return;
        }

        $users = \App\Models\User::all();

        foreach ($events as $event) {
            foreach ($users as $user) {
                // Create notification
                // Assuming Notification model has 'user_id', 'title', 'message', 'type'
                \App\Models\Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Event Segera Dimulai!',
                    'message' => "Event '{$event->name}' akan dimulai pada " . $event->event_start->format('d M Y H:i') . ". Jangan lewatkan!",
                    'type' => 'info' // or 'event'
                ]);
            }
            $this->info("Notified users about event: {$event->name}");
        }
    }
}
