<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web'; // or whatever guard you want to use
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $roleOuputPairs = [
        'admin' => 'Adminisztrátor',
        'editor' => 'Tartalomszerkesztő',
        'user' => 'Bejelentkezett felhasználó'
    ];

    protected function getCorrespondOutputRole($role_name)
    {
        return array_key_exists($role_name, $this->roleOuputPairs) ? $this->roleOuputPairs[$role_name] : '';
    }

    
    public function getOutputRoleNames()
    {
        $roleNames = $this->getRoleNames();
        $outputRoleNames = [];
        foreach ($roleNames as $role) {
            $output = $this->getCorrespondOutputRole($role);
            if(!empty($output))
            {
                $outputRoleNames[] = $output;
            }
        }
        return $outputRoleNames;
    }

    public static function getByUserName($username)
    {
        return self::where('username', $username)->first();
    }
}
