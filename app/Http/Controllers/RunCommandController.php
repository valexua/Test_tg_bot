<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;

class RunCommandController extends Controller
{
    /**
     * @OA\post(
     *     path="/api/run/search/task",
     *     summary="Запуск завдання",
     *     @OA\Response(response=200, description="Успішно",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Task run successfully")
     *         )
     *     ),
     *     @OA\Response(response=500, description="Помилка",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Task run failed")
     *         )
     *     )
     * )
     */
    public function run_task_command(){
        
        try{
            Artisan::call('tasks:notify');
        }catch(\Exception $e){
            $err = $e->getMessage();
        }

        $ok = ($err ?? null == null) ? true : false;
        $data = [
            'message' => $ok ? 'Task run successfully' : "Task run failed $err",
        ];

        return response()->json($data, $ok ? 200 : 500);
    }
}
