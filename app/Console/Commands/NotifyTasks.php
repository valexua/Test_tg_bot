<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendTasksNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\User;


class NotifyTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send tasks';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {   
        $text = "Task:\n";
        $users = User::where(['subscribed' => true ])->get();

        # get user <= 5 and complated = false
        for ($i = 1; $i <= 5; $text .= "\n", $i++) {
            $tasks_temp = http::get("https://jsonplaceholder.typicode.com/users/$i/todos?completed=false");
            $text .= "User $i:\n";

            # generate task text
            foreach( $tasks_temp->json() as $t ) {  
                $text .= "  - {$t['title']}\n"; 
            }
        }
        //Log::info('Tasks',[$tasks_temp]);
        # send post message4telegram with queue
        foreach($users as $u){ 
            SendTasksNotification::dispatch($u, $text);
        } 
        
        $this->info('job has been queued');
    }
} 