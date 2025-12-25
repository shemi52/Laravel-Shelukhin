<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    // Проверка на обновление комментария
    public function update(User $user, Comment $comment)
    {
        // Только автор комментария может его редактировать
        return $user->id === $comment->user_id;
    }

    // Проверка на удаление комментария
    public function delete(User $user, Comment $comment)
    {
        // Автор комментария или администратор могут удалять
        return $user->id === $comment->user_id || $user->is_admin;
    }
}