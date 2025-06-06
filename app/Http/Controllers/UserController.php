<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Http;



class UserController extends Controller
{
    //protected string $token2;


    public function __construct() {
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Отримати список користувачів",
     *     description="Повертає масив користувачів з їхніми ID, іменами та датами оновлення",
     *     @OA\Response(
     *         response=200,
     *         description="Успішний запит",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Іван"),
     *                 @OA\Property(property="subscribed", type="boolean", example=true)
     *             )
     *         )
     *     )
     * )
     */

    public function getUser()
    {
        $users = User::ALL()->map(fn($u) => [
            'id' => $u->id,
            'Name' => $u->name,
            'Subscribed' => $u->subscribed
        ]);

        return response()->json($users);

    }


    /**
     * @OA\get(
     *     path="/api/get/task/service/{userID}",
     *     summary="Перевірка завдань на сервісі",
     *     @OA\Parameter(
     *         name="userID",
     *         in="path",
     *         required=true,
     *         description="ID користувача",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Успішно")
     * )
     */
    public function chekTask(int $userID)
    {
        $task = http::get("https://jsonplaceholder.typicode.com/users/$userID/todos?completed=false");
        return response( $task->body(), $task->status(), $task->headers() );

    }
    
}