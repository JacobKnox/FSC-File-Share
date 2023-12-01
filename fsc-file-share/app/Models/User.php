<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable # implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'name',
        'sid',
        'username',
        'email',
        'pemail',
        'password',
        'roles',
        'visible',
        'verified',
    ];

    /**
     * The valid options for status
     * 
     * @var array<string>
     */
    public static $valid_statuses = [
        'student',
        'faculty',
        'alumni',
    ];

    /**
     * The valid options for roles
     * 
     * @var array<string>
     */
    public static $valid_roles = [
        'user',
        'mod',
        'admin',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'pemail_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'password' => 'hashed',
        'roles' => 'array',
        'visible' => 'boolean',
        'verified' => 'boolean',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function checkLike(string $file_id)
    {
        return $this->likes->where('file_id', $file_id)->isNotEmpty();
    }

    public static function createFromInput($input)
    {
        User::create($input);
        
        $credentials = [
            'username' => $input['username'],
            'password' => $input['password'],
        ];

        return Auth::attempt($credentials);
    }

    public function checkStatus(string $check_status){
        return $this->status == $check_status;
    }

    public static function updateStatus(string $request_id, string $target_id, string $new_status){
        if(!User::find($request_id)?->checkRoles(['mod'])){
            return False;
        }
        if(!in_array($new_status, User::$valid_statuses, True)){
            return False;
        }
        return User::find($target_id)->changeStatus($new_status);
    }

    private function changeStatus(string $new_status){
        if(!in_array($new_status, User::$valid_statuses, True)){
            return False;
        }
        $this->status = $new_status;
        $this->save();
        return True;
    }

    public function checkRoles(array $roles, bool $all = True){
        $user_roles = $this->roles;
        foreach($roles as $role){
            if(in_array($role, $user_roles, True) && !$all){
                return True;
            }
            if(!in_array($role, $user_roles, True) && $all){
                return False;
            }
        }
        return (True && $all);
    }

    public static function changeRoles(string $request_id, string $target_id, array $roles, string $action){
        if(!User::find($request_id)?->checkRoles(["admin"])){
            return False;
        }
        $target = User::find($target_id);
        return ($action == "give") ? $target?->giveRoles($roles) : $target?->removeRoles($roles);
    }

    private function giveRoles(array $roles){
        foreach($roles as $role){
            if(!in_array($role, User::$valid_roles, True)){
                return False;
            }
        }
        $current_roles = $this->roles;
        array_push($current_roles, $roles);
        $this->update(['roles' => $current_roles]);
        return True;
    }

    private function removeRoles(array $roles){
        if(in_array('user', $roles, True)){
            return False;
        }
        $current_roles = $this->roles;
        foreach($roles as $role){
            if(in_array($role, $current_roles, True)){
                unset($current_roles[$role]);
            }
        }
        $this->update(['roles' => $current_roles]);
        return True;
    }

    /**
     * Interact with the users's roles.
     */
    protected function roles(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value),
            set: fn (array $value) => json_encode($value)
        );
    }

    /**
     * Interact with the users's password.
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value)
        );
    }
}
