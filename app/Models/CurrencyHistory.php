<?php
namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class CurrencyHistory extends Model
{
    protected $table = 'currency_history';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['currency_id', 'event_id' ];

    public function scopeGetByCurrencyId($query, int $currencyId= null)
    {
        if (!empty($currencyId)) {
            $query->where(with(new CurrencyHistory)->getTable().'.currency_id', $currencyId);
        }
        return $query;
    }

    public function scopeGetByDay($query, $filter_day= null, string $sign= null)
    {
        if (!empty($filter_day)) {
            if (!empty($sign)) {
                $query->whereRaw( DB::getTablePrefix().with(new CurrencyHistory)->getTable().'.day ' . $sign . "'".$filter_day."' " );
            } else {
                $query->where(with(new CurrencyHistory)->getTable().'.day', $filter_day);
            }
        }
        return $query;
    }


    public function currency(){
        return $this->belongsTo('App\Currency', 'currency_id','id');
    }

    public static function getValidationRulesArray() : array
    {
        $validationRulesArray = [
            'currency_id'     => 'required|exists:'.( with(new Currency)->getTable() ).',id',
            'day'             => 'required|date',
            'nominal'         => 'required|integer',
            'value'           => 'required||numeric|min:0'
        ];
        return $validationRulesArray;
    }

}
