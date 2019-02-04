<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use social\album\app\Models\Image;
use social\company\app\Models\Company;
use social\core\app\Models\Setting;
use social\datas\app\Models\Project;
use social\datas\app\Models\Skill;
use social\profile\app\Models\Connection;
use social\profile\app\Models\Education;
use social\profile\app\Models\Job;
use social\profile\app\Models\Message;
use social\profile\app\Models\messenger;
use social\profile\app\Models\Notification;
use social\profile\app\Models\Post;
use social\profile\app\Models\Profile;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name', 'email', 'password','mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function posts()
    {
        return $this->hasmany( Post::class,'user_id','id');
    }


    public function messengers()
    {
        return $this->hasmany( messenger::class,'messenger_id','id');
    }


    public function profile()
    {
        return $this->belongsTo(Profile::class,'id',"user_id");
    }

    public function image()
    {
        return $this->belongsTo(Image::class,'image_id',"image_id");
    }

    public function userType()
    {
        return $this->belongsTo(Setting::class,'user_type','setting_id');
    }


    public function jobs()
    {
        return $this->hasMany(Job::class,'user_id','id');
    }

    public function current_jobs()
    {
        return $this->hasMany(Job::class,'user_id','id')->where('currently',1);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Get Educations
     */
    public function educations()
    {
        return $this->hasmany(Education::class,'user_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Get Skills
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class,'profiles_skills','user_id','skill_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Get Projects
     */
    public function projects()
    {
        return $this->belongsToMany(project::class,'profiles_projects','user_id','project_id');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Get connections
     */
    public function connections()
    {
        return $this->belongsToMany(User::class,'connections','user_from_id','user_to_id')->with('image');
    }


    public function follows()
    {
        return $this->belongsToMany(Company::class,'follows','user_id','company_id');
    }



    public function sendBox()
    {
        return $this->hasMany(Message::class,'user_from_id','id');
    }

    public function inBox()
    {
        return $this->hasMany(Message::class,'user_to_id','id');
    }

    public function messages()
    {
        return $this->belongsToMany(User::class,'messages','user_from_id','user_to_id')->withTimestamps();
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Get Notifications
     */
    public function notifications()
    {
        return $this->hasmany(Notification::class,'notifiable_id','id');
    }

    public function CompanyAdmin()
    {
        return $this->belongsToMany(Company::class , 'companies_admins','user_id','company_id');
    }



}
