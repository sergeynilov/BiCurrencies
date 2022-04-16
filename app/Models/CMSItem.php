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

    protected $table = 'cms_items';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable
        = [
            'title',
            'key',
            'text',
            'author_id',
            'published',
        ];

    public function scopeGetByKey($query, $key = null)
    {
        if ( ! empty($key)) {
            $query->where(with(new CMSItem)->getTable() . '.key', $key);
        }

        return $query;
    }

    public function scopeGetByAuthorId($query, $author_id = null)
    {
        if (empty($author_id)) {
            return $query;
        }

        return $query->where(with(new CMSItem)->getTable() . '.author_id', $author_id);
    }

    public function scopeGetById($query, $id)
    {
        if ( ! empty($id)) {
            if (is_array($id)) {
                $query->whereIn(with(new CMSItem)->getTable() . '.id', $id);
            } else {
                $query->where(with(new CMSItem)->getTable() . '.id', $id);
            }
        }

        return $query;
    }

    public function scopeGetByTitle($query, $title = null)
    {
        if (empty($title)) {
            return $query;
        }

        return $query->where(with(new CMSItem)->getTable() . '.title', 'like', '%' . $title . '%');
    }

    public function scopeGetByPublished($query, $published = null)
    {
        if ( ! isset($published) or strlen($published) == 0) {
            return $query;
        }

        return $query->where(with(new CMSItem)->getTable() . '.published', $published);
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }


    public static function getCMSItemValidationRulesArray($cms_item_id = null, array $skipFieldsArray = []): array
    {
        /*         Schema::create('cms_item', function (Blueprint $table) {
    $table->id();
        $table->string('title', 255);
        $table->string('key', 255)->unique();
    $table->mediumText('text');
    $table->foreignId('author_id')->references('id')->on('users')->onDelete('CASCADE');
    $table->boolean('published')->default(false);

        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->nullable();
*/

        $validationRulesArray = [
            'title'     => [
                'required',
                'string',
                'max:255',
            ],
            'key'       => [
                'required',
                'string',
                'max:255',
                Rule::unique(with(new CMSItem)->getTable())->ignore($cms_item_id),
            ],
            'text'      => 'required',
            'published' => 'boolean',
        ];

        foreach ($skipFieldsArray as $next_field) {
            if ( ! empty($validationRulesArray[$next_field])) {
                unset($validationRulesArray[$next_field]);
            }
        }

        return $validationRulesArray;
    }

}
