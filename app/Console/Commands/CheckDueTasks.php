<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckDueTasks extends Command
{
    protected $signature = 'tasks:check-due-tasks';
    protected $description = 'Check and remind about due tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDateTime = Carbon::now();
        $dueTasks = Task::where('due_date', '<=', $currentDateTime->addMinute(5))->get();
        
        foreach($dueTasks as $task){
            Notification::create([
                'user_id' => $task->assigned_to,
                'from_user_id' => $task->assigned_by,
                'message' =>  $task->title,
                'due' => (isset($task->due_date) ? true : null ),
            ]);
        }

        Log::info('Due Reminder created successfully.');
    }
}
