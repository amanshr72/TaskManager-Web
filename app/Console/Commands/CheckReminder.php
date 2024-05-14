<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckReminder extends Command
{
    protected $signature = 'tasks:check-reminder';
    protected $description = 'To check task reminder on daily basis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDateTime = Carbon::now();
        $reminders = Task::where('due_date', '<=', $currentDateTime->addMinute(5))->get();
        
        foreach($reminders as $reminder){
            Notification::create([
                'user_id' => $reminder->assigned_to,
                'from_user_id' => $reminder->assigned_by,
                'message' =>  $reminder->title,
                'reminder' => (isset($reminder->due_date) ? true : null ),
            ]);
        }

        Log::info('Reminder created successfully.');
    }
}
