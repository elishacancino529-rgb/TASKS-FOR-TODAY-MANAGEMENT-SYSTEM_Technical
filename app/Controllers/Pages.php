<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class Pages extends BaseController
{
    public function profile()
    {
        $user = (new UserModel())->first();
        $taskCount = (new TaskModel())->active()->countAllResults();

        return view('profile', ['pageTitle' => 'Profile', 'profile' => $user, 'taskCount' => $taskCount]);
    }

    public function about()
    {
        return view('about', ['pageTitle' => 'About Todayline']);
    }
}
