<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Flyer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AddPhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (App::environment('demo')) {
            return true;
        }

        return Flyer::where([
            'zip' => $this->zip,
            'street' => $this->street,
            'user_id' => $this->user()->id
        ])->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ];
    }
}
