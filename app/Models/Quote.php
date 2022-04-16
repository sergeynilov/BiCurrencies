<?php

namespace App\Models;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Quote extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $table = 'quotes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function scopeGetByKey($query, $key = null)
    {
        if ( ! empty($key)) {
            if (is_array($key)) {
                $query->whereIn(with(new Quote)->getTable() . '.key', $key);
            } else {
                $query->where(with(new Quote)->getTable() . '.key', $key);
            }
        }
        return $query;
    }

    public function scopeGetById($query, $id)
    {
        if ( ! empty($id)) {
            if (is_array($id)) {
                $query->whereIn(with(new Quote)->getTable() . '.id', $id);
            } else {
                $query->where(with(new Quote)->getTable() . '.id', $id);
            }
        }

        return $query;
    }

    public function scopeGetByAuthorName($query, $author_name = null)
    {
        if (empty($author_name)) {
            return $query;
        }

        return $query->where(with(new Quote)->getTable() . '.author_name', $author_name );
    }

    public function scopeGetByPublished($query, $published = null)
    {
        if ( ! isset($published) or strlen($published) == 0) {
            return $query;
        }

        return $query->where(with(new Quote)->getTable() . '.published', $published);
    }


    public static function getQuoteValidationRulesArray($quote_id = null, array $skipFieldsArray = []): array
    {
        /*
        CREATE TABLE `quotes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
*/

        $validationRulesArray = [
            'author_name' => [
                'required',
                'string',
                'max:100',
            ],
            'key'         => [
                'required',
                'string',
                'max:255',
                Rule::unique(with(new Quote)->getTable())->ignore($quote_id),
            ],
            'text'        => 'required',
            'published'   => 'boolean',

        ];

        foreach ($skipFieldsArray as $next_field) {
            if ( ! empty($validationRulesArray[$next_field])) {
                unset($validationRulesArray[$next_field]);
            }
        }

        return $validationRulesArray;
    }

}
