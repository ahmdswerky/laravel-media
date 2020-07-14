<?php

namespace AhmdSwerky\Media\Rules;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class RequiredAlone implements Rule
{
    protected $forbidden = [ ];
    
    protected $field = null;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($forbidden)
    {
        $this->forbidden = explode(',', $forbidden);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->forbidden as $key) {
            if ( request()->exists($key) ) {
                $this->field = $key;
                return false;
            }
        }
        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('media::validation.required_alone', [
            'field' => __("media::validation.fields.{$this->field}"),
        ]);
    }
}
