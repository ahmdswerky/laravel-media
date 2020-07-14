<?php

namespace AhmdSwerky\Media;

use ReflectionClass;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'mediable_type',
        'mediable_id',
        'type',
        'path',
        'name',
        'title',
        'description',
        'notes',
    ];

    // protected $table = config('media.table');

    public function __construct()
    {
        parent::__construct();

        $table = config('media.table');
        if ( $table ) {
            $this->setTable( $table );
        }
    }

    public static function createFor(array $attributes = [ ], Model $morph)
    {
        $media = new Media;

        $media->mediable_type = (new ReflectionClass($morph))->getName();
        $media->mediable_id = $morph->id;

        foreach ($attributes as $key => $value) {
            $media->$key = $value;
        }

        return tap($media, function ($media) {
            $media->save();
        });
    }

    //? ==== Relations ==== //
    public function mediable()
    {
        return $this->morphTo();
    }

    public function test()
    {
        return __('media::validation.accepted');
    }

    public function scopeByModel($query, $model, $id)
    {
        return $query->when($model, function ($query) use ($model) {
            $query->where('mediable_type', am_class_name($model));
        })->when($id, function ($query) use ($id) {
            $query->where('mediable_id', $id);
        });
    }

    //? ==== Accessors & Mutators ==== //
    public function getDisplayedPathAttribute() : ?string
    {
        if ( is_null($this->path) ) {
            return $this->path;
        }

        if ( Str::startsWith($this->path, 'http') ) {
            return $this->path;
        }

        return url( str_replace('public', 'storage', $this->path), [ ], !app()->isLocal() );
    }
}
