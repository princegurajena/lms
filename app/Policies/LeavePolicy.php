<?php

namespace App\Policies;

use App\Leave;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeavePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Leave $leave)
    {
        return $user->id == $leave->user_id
            || $leave->supervisor_email === $user->email
            || $leave->timeline->contains('email' , '=' , $user->email);
    }

    public function authorize(User $user, Leave $leave)
    {
        return $user->hasRole('authorize') && $leave->supervisor_email == $user->email && !$leave->completed;
    }

    public function recommend(User $user, Leave $leave)
    {
        if ($user->hasRole('authorize'))
        {
            return true && !$leave->completed;
        }

        return $user->hasRole('recommend') && $leave->supervisor_email == $user->email && !$leave->completed;
    }

    public function close(User $user, Leave $leave)
    {
        return !$leave->completed && $this->view($user , $leave);
    }

}


