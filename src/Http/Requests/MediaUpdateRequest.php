<?php

namespace AhmdSwerky\Media\Http\Requests;

use AhmdSwerky\Media\Media;
use AhmdSwerky\Media\Rules\RequiredAlone;
use Illuminate\Foundation\Http\FormRequest;

class MediaUpdateRequest extends FormRequest
{
    protected $class;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|min:2|max:255',
            'title' => 'sometimes|min:2|max:255',
            'description' => 'sometimes|min:2|max:1000',
            'notes' => 'sometimes|min:2|max:1000',

            'photo' => [
                new RequiredAlone('file,video,video_url'),
                'mimes:' . implode(',', config('media.photos.allowed_extensions')),
                'max:' . config('media.photos.max'),
            ],
            'file' => [
                new RequiredAlone('photo,video,video_url'),
                'mimes:' . implode(',', config('media.files.allowed_extensions')),
                'max:' . config('media.files.max'),
            ],
            'video' => [
                new RequiredAlone('photo,file,video_url'),
                'mimes:' . implode(',', config('media.videos.allowed_extensions')),
                'max:' . config('media.videos.max'),
            ],
            'video_url' => [
                new RequiredAlone('photo,file,video'),
                'active_url',
            ],
        ];
    }

    protected function getValidatorInstance()
    {
        $medium = Media::findOrFail($this->medium);
        $this->class = $medium->mediable;

        $this->merge([
            'additional' => [
                'name' => $this->name,
                'title' => $this->title,
                'description' => $this->description,
                'notes' => $this->notes,
            ]
        ]);

        return parent::getValidatorInstance();
    }

    public function updateMedia()
    {
        $medium = Media::findOrFail($this->medium);

        if ( $this->exists('video_url') ) {
            return $this->class->updateMedia($medium, $this->video_url, $this->additional);
        }

        foreach (['photo', 'video', 'file', 'video_url'] as $type) {
            if ( $this->exists($type) ) {
                return $this->class->updateMedia($medium, $this->file($type), $this->additional);
            }
        }
    }
}
