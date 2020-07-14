<?php

namespace AhmdSwerky\Media\Http\Requests;

use Illuminate\Validation\Rule;
use AhmdSwerky\Media\Rules\RequiredAlone;
use Illuminate\Foundation\Http\FormRequest;

class MediaStoreRequest extends FormRequest
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
        $this->class = am_class_name($this->model)::findOrFail($this->id);
        
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
    
    public function storeMedia()
    {
        if ( $this->exists('video_url') ) {
            return $this->class->addMediaUrl($this->video_url, 'video', $this->additional);
        }
        
        foreach (['photo', 'video', 'file'] as $type) {
            if ( $this->exists($type) ) {
                return $this->class->addMedia($this->file($type), $type, $this->additional);
            }
        }
    }
}