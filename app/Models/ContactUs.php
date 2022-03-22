<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{

    protected $table = 'contact_us';
    protected $primaryKey = 'id';
    public $timestamps = false;

    use HasFactory;

    protected $fillable = ['author_id', 'title', 'content_message'];

    private static $contactUsAcceptedValueArray = array('1' => 'Accepted', '0' => 'New');

    protected $casts
        = [
        ];


    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function getContactUsAcceptedValueArray($key_return = true): array
    {
        $resArray = [];
        foreach (self::$contactUsAcceptedValueArray as $key => $value) {
            if ($key_return) {
                $resArray[] = ['key' => $key, 'label' => $value];
            } else {
                $resArray[$key] = $value;
            }
        }

        return $resArray;
    }


    public static function getContactUsAcceptedLabel(string $accepted): string
    {
        if ( ! empty(self::$contactUsAcceptedValueArray[$accepted])) {
            return self::$contactUsAcceptedValueArray[$accepted];
        }

        return self::$contactUsAcceptedValueArray[0];
    }


    public function scopeGetByAuthor($query, $author_id = null)
    {
        if (empty($author_id)) {
            return $query;
        }

        return $query->where(with(new ContactUs)->getTable() . '.author_id', $author_id);
    }


    public function scopeGetByAccepted($query, $accepted = null)
    {
        if ( ! isset($accepted) or strlen($accepted) == 0) {
            return $query;
        }

        return $query->where(with(new ContactUs)->getTable() . '.accepted', $accepted);
    }


    public function scopeGetByTitle($query, $title = null)
    {
        if (empty($title)) {
            return $query;
        }

        return $query->where(with(new ContactUs)->getTable() . '.title', 'like', '%' . $title . '%');
    }

    public static function getContactUsValidationRulesArray(array $skipFieldsArray= []): array
    {
        $validationRulesArray = [
            'title'           => 'required|min:5',
            'content_message' => 'required|min:20',
            'author_id'       => 'required|integer|exists:' . (with(new User)->getTable()) . ',id',
            'accepted'        => 'required|in:' . getValueLabelKeys(ContactUs::getContactUsAcceptedValueArray(false)),
        ];
        foreach( $skipFieldsArray as $next_field ) {
            if(!empty($validationRulesArray[$next_field])) {
                unset($validationRulesArray[$next_field]);
            }
        }

        return $validationRulesArray;
    }


}
