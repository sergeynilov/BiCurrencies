<?php
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class UserCurrencySubscription extends Model
{
    protected $table = 'user_currency_subscriptions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['currency_id', 'user_id' ];

    public function scopeGetById($query, $id)
    {
        if (empty($id)) {
            return $query;
        }
        return $query->where(with(new UserCurrencySubscription)->getTable() . '.id', $id);
    }


    public function scopeGetByCurrencyId($query, int $currency_id= null)
    {
        if (!empty($currency_id)) {
            $query->where(with(new UserCurrencySubscription)->getTable().'.currency_id', $currency_id);
        }
        return $query;
    }

    public function currency(){
        return $this->belongsTo('App\Models\Currency', 'currency_id','id');
    }


    public function scopeGetByUserId($query, int $user_id= null)
    {
        if (!empty($user_id)) {
            $query->where(with(new UserCurrencySubscription)->getTable().'.user_id', $user_id);
        }
        return $query;
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id','id');
    }


    public static function getValidationRulesArray() : array
    {
        $validationRulesArray = [
            'currency_id'     => 'required|exists:'.( with(new Currency)->getTable() ).',id',
            'user_id'     => 'required|exists:'.( with(new User)->getTable() ).',id',
        ];
        return $validationRulesArray;
    }

}
