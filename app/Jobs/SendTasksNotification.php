<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendTasksNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected array $tgData;
    protected string $url;
    
    public function __construct($user, $text)
    {
        $this->tgData = [
            'chat_id' => $user->telegram_id,
            'text'    => $text
        ];
        $this->url = "https://api.telegram.org/bot". env('TELEGRAM_BOT_TOKEN') ."/sendMessage";

    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {        
        Http::post( $this->url, $this->tgData );
    }
} 