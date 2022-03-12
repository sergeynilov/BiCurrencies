<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use DB;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $table      = 'users';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    private static $userStatusLabelValueArray = Array('A' => 'Active', 'I' => 'Inactive', 'N' => 'New');
    public static function getUserStatusValueArray($key_return= true) : array
    {
        $resArray = [];
        foreach (self::$userStatusLabelValueArray as $key => $value) {
            if ($key_return) {
                $resArray[] = [ 'key' => $key, 'label' => $value ];
            } else {
                $resArray[$key] = $value;
            }
        }
        return $resArray;
    }
    public static function getUserStatusLabel(string $status):string
    {
        if (!empty(self::$userStatusLabelValueArray[$status])) {
            return self::$userStatusLabelValueArray[$status];
        }
        return '';
    }


    public function scopeGetById($query, int $id)
    {
        return $query->where(with(new User)->getTable() . '.id', $id);
    }

    public function scopeGetByEmail($query, $email)
    {
        if (empty($email)) {
            return $query;
        }
        return $query->whereRaw(with(new User)->getTable() . ".email like '%" . $email . "%' " );
    }

    public function scopeExcludeId($query, $id)
    {
        return $query->where(with(new User)->getTable() . '.id', '!=' , $id);
    }

    public function scopeGetByName($query, $name = null, $extended_search = false)
    {
        if (empty($name)) {
            return $query;
        }

        $prefix= DB::getTablePrefix();
        $tb= with(new User)->getTable() . ($prefix ?? $prefix ). '.';

        if(!$extended_search) {
            return $query->whereRaw(with(new User)->getTable() . ".name like '%" . $name . "%' " );
        }

        // email, phone, website, notes, first_name, last_name
        return $query->whereRaw( " ( "   . $tb . "name like '%" . $name . "%' " . ' OR ' .
                                 $tb . "email like '%" . $name . "%' "  . ' OR ' // .
//                                 $tb . "phone like '%" . $name . "%' " . ' OR '  .
//                                 $tb . "website like '%" . $name . "%' " . ' OR '  .
//                                 $tb . "first_name like '%" . $name . "%' " . ' OR '  .
//                                 $tb . "last_name like '%" . $name . "%' " . ' OR '  .
//                                 $tb . "notes like '%" . $name . "%' "
         . " ) ");
    }

    public function scopeGetByStatus($query, $status= null)
    {
        if (!empty($status)) {
            if ( is_array($status) ) {
                $query->whereIn(with(new User)->getTable().'.status', $status);
            } else {
                $query->where(with(new User)->getTable().'.status', $status);
            }
        }
        return $query;
    }

    public function scopeGetByAccountType($query, $account_type= null)
    {
        if (!empty($account_type)) {
            $query->where(with(new User)->getTable().'.account_type', $account_type);
        }
        return $query;
    }

    public function scopeGetByUserPermission($query, $permission_id=null)
    {

        if (empty($permission_id)) {
            return $query;
        }

//        if (!empty($permission_id)) {
        $query->whereHas('permissions', function ($query) use ($permission_id): void {
            $query->whereIn('permission_id', (array)$permission_id);
        });
//        } else {zz
//            $query->Has('permissions');
//        }
        return $query;
    }

    public function scopeGetByUserPermissionModelType($query, $table_name)
    {
        $query->where($table_name.'.model_type', 'App\Models\User');
        return $query;
    }

    public function scopeGetByEmailVerifiedAt($query, $filter_email_verified_at= null, string $sign= null)
    {
        if (!empty($filter_email_verified_at)) {
            if (!empty($sign)) {
                $query->whereRaw( DB::getTablePrefix().with(new User)->getTable().'.email_verified_at ' . $sign . "'".$filter_email_verified_at."' " );
            } else {
                $query->where(with(new User)->getTable().'.email_verified_at', $filter_email_verified_at);
            }
        }
        return $query;
    }


    public static function getValidationRulesArray($user_id, array $skipFieldsArray= []) : array
    {

        \Log::info(  varDump(with(new User)->getTable(), ' -1 with(new User)->getTable()::') );
        $validationRulesArray = [
            'name'            => 'required|max:100|unique:' . with(new User)->getTable(),
            'email'           => 'required|email|max:100|unique:' . with(new User)->getTable(),
            'status'           => 'required|in:' . getValueLabelKeys(User::getUserStatusValueArray(false)),
            'password'        => 'required|min:6|max:15', // required|min:6|max:15|confirmed:register_password
            'password_2'      => 'required|min:6|max:15|same:password' // required|min:6|max:15|confirmed:register_password
        ];

        foreach( $skipFieldsArray as $next_field ) {
            if(!empty($validationRulesArray[$next_field])) {
                unset($validationRulesArray[$next_field]);
            }
        }
        return $validationRulesArray;
    } // public static function getUserValidationRulesArray($user_id) : array

}
