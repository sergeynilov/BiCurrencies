<?php

namespace App\Models;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CMSItem extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $table = 'cms_item';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function scopeGetByKey($query, $key= null)
    {
        if (!empty($key)) {
            $query->where(with(new CMSItem)->getTable().'.key', $key);
        }
        return $query;
    }

    public function scopeGetByName($query, $name = null)
    {
        if (empty($name)) {
            return $query;
        }
        return $query->where( with(new CMSItem)->getTable() . '.name', 'like', '%'.$name.'%');
    }




    public static function getCMSItemValidationRulesArray($cms_item_id= null, array $skipFieldsArray= []) : array
    {
        $validationRulesArray = [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'key' => [
                'required',
                'string',
                'max:255',
                Rule::unique(with(new CMSItem)->getTable())->ignore($cms_item_id),
            ],
            'text'                 => 'required',
        ];

        foreach( $skipFieldsArray as $next_field ) {
            if(!empty($validationRulesArray[$next_field])) {
                unset($validationRulesArray[$next_field]);
            }
        }

        return $validationRulesArray;
    }

}
