<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'image',
        'bio',
        'private_account',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function likes(){
        return $this->belongsToMany(Post::class,'likes');
    }
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function SuggestedUsers(){
        return User::whereNot('id',auth()->id())->get()->shuffle()->take(5);
    }

    public function following(){
        return $this->belongsToMany(User::class,'follows','user_id','following_user_id')
        ->withTimestamps()
        ->withPivot('confirm');
    }
    public function followers(){
        return $this->belongsToMany(User::class,'follows','following_user_id','user_id')
        ->withTimestamps()
        ->withPivot('confirm');
    }

    public function follow(User $user){
        if($user->private_account){
            return $this->following()->syncWithoutDetaching([$user->id => ['confirm' => false]]);
        }
        return $this->following()->syncWithoutDetaching([$user->id => ['confirm' => true]]);
    }
    public function unfollow(User $user){
        return $this->following()->detach($user);
    }

    public function is_pending(User $user){
        return $this->following()->where('following_user_id',$user->id)->where('confirm',false)->exists();
    }
    public function is_following(User $user){
        return $this->following()->where('following_user_id',$user->id)->where('confirm',true)->exists();
    }

    public function is_follower(User $user){
        return $this->followers()->where('user_id',$user->id)->where('confirm',true)->exists();
    }





}
