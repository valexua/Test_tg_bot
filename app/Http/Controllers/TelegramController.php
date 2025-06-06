<?php

namespace App\Http\Controllers;

use Log;
use Http;
#use Illuminate\Support\Facades\Artisan;
use Artisan;
use App\Models\User;



class TelegramController extends Controller
{
    //protected string $token2;
    protected string $apiUrl;

    public function __construct() {
        $token = env('TELEGRAM_BOT_TOKEN');
        $this->apiUrl = "https://api.telegram.org/bot$token/sendMessage";
    }

    public function index()
    {
        $updates = request()->all();
        Log::info('Telegram webhook received',[$updates]);

        # chek /get_task
        if ($updates['message']['text'] == '/get_task') {
            Artisan::call('tasks:notify');
            return response(null, 200);
        }


        $iStart = $updates['message']['text'] == '/start';
        $iStop  = $updates['message']['text'] == '/stop';

        $user = User::where(['telegram_id' => $updates['message']['chat']['id']])->first();

        $chekSubscribed = $iStart && ($user->subscribed ?? false);

        if ($iStart) {
            if (is_null($user)) {
                
                $name = ($updates['message']['chat']['first_name']  ?? 'Unknown').' '.($updates['message']['chat']['last_name'] ?? 'Unknown');
                
                User::create([
                    'telegram_id' => $updates['message']['chat']['id'],
                    'name'        => $name,
                ]);
            } else {
                $user->update(['subscribed' => true]); 
            }
        
            $tgData = [
                'chat_id' => $updates['message']['chat']['id'],
                'text'    => $chekSubscribed ? 'Ви вже підписані, дякую !'
                                             : 'Вітаємо! Ви успішно зареєстровані в системі.',
            ];
            
            Http::post( $this->apiUrl, $tgData );  
        
        } elseif ($iStop) {
            $user->update(['subscribed' => false, 'updated_at' => now()]);
        }

        return response(null, 200);
    }

}