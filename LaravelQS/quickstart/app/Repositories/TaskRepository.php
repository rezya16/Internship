<?php


namespace App\Repositories;


use App\User;

class TaskRepository
{

    /**
     * Получить все задачи пользователя
     *
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function forUser(User $user) {
        return $user->tasks()
            ->orderBy('created_at')
            ->get();
    }

}
