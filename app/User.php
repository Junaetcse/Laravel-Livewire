<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $validationRules = [
        'name'  => 'required',
        'email'  => 'required|email|unique:users,email',
    ];
    public $validationMessages = [
        'required' => ':attribute is required',
        'unique' => ':attribute already exists',
    ];

    public function getValidationRules()
    {
        $rules = $this->validationRules;

        if ($this->id) { //for update ignore own email for unique
            $rules['email'] = $rules['email'] . ',' . $this->id;
        }

        return $rules;
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->api_token =Str::random(60);
            $user->setAttribute('password', Hash::make(\Request::get('password', $user->getAttribute('password'))));
        });
    }

}
