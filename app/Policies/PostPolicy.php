<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use social\company\app\Models\Company;
use social\profile\app\Models\Post;

class PostPolicy
{
    use HandlesAuthorization;


    public function update(User $user, $Model)
    {

        return $user->id === $Model->user_id;
        
    }

    public function update_user(User $user, $Model)
    {

        return $user->id === $Model->id;

    }

    public function update_notification(User $user, $Model)
    {

        return $user->id == $Model->notifiable_id;

    }

    public function update_from(User $user, $Model)
    {

        return $user->id === $Model->user_from_id;

    }

    public function update_company(Company $company, $Model)
    {

        return $company->company_id === $Model->company_id;

    }


}
