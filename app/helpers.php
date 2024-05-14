<?php

use App\Models\TaskCategory;
use App\Models\User;
use Carbon\Carbon;

if (!function_exists('getUserNameById')) {
    function getUserNameById($userId)
    {
        $user = User::find($userId);

        return $user ? $user->name : null;
    }
}

if (!function_exists('getCategoryNameByTaskId')) {
    function getCategoryNameByTaskId($categoryId)
    {
        $category = TaskCategory::find($categoryId);

        return $category ? $category->name : null;
    }
}

