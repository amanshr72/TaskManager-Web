<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateRecurringTasks extends Command
{
    protected $signature = 'tasks:create-recurring-tasks';
    protected $description = 'Create recurring tasks based on the selected recurrence';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::whereNotNull('recurrence')->where('is_processed', 0)->get();

        foreach ($tasks as $task) {
            $this->createRecurringTask($task);
        }

        Log::info('Recurring tasks created successfully.');
    }

    private function createRecurringTask($task)
    {
        switch ($task->recurrence) {
            case 'daily':
                $this->createDailyRecurringTasks($task);
                break;
            case 'weekdays':
                $this->createWeekdayRecurringTasks($task);
                break;
            case 'weekly':
                $this->createWeeklyRecurringTasks($task);
                break;
            case 'monthly':
                $this->createMonthlyRecurringTasks($task);
                break;
            default:
                break;
        }
    }

    private function createDailyRecurringTasks($task){
        $newTask = $task->replicate();
        $newTask->start_date = Carbon::parse($newTask->start_date)->addDay();
        $newTask->end_date = Carbon::parse($newTask->end_date)->addDay();
        $newTask->is_processed = true;
        $newTask->save();
    }
    private function createWeekdayRecurringTasks($task){
        $startDate = Carbon::parse($task->start_date);

        for ($i = 0; $i < 5; $i++) {
            $currentDate = $startDate->copy()->addWeekdays($i);    
            while ($currentDate->isWeekend()) {
                $currentDate->addDay();
            }
            
            $newTask = $task->replicate();
            $newTask->start_date = $currentDate->setHour(9)->setMinute(0)->setSecond(0);

            if ($i === 4) {
                $newTask->end_date = Carbon::parse($newTask->end_date)->setHour(19)->setMinute(0)->setSecond(0);
            } else {
                $newTask->end_date = Carbon::parse($newTask->end_date)->setHour(19)->setMinute(0)->setSecond(0)
                ->addDays($currentDate->diffInDays(Carbon::parse($task->start_date)));
            }

            $newTask->is_processed = true;
            $newTask->save();
        }
    }
    private function createWeeklyRecurringTasks($task){
        $newTask = $task->replicate();
        $newTask->start_date = Carbon::parse($newTask->start_date)->addWeek();
        $newTask->end_date = Carbon::parse($newTask->end_date)->addWeek();
        $newTask->is_processed = true;
        $newTask->save();
    }
    private function createMonthlyRecurringTasks($task){
        $newTask = $task->replicate();
        $newTask->start_date = Carbon::parse($newTask->start_date)->addMonth();
        $newTask->end_date = Carbon::parse($newTask->end_date)->addMonth();
        $newTask->is_processed = true;
        $newTask->save();
    }
}
