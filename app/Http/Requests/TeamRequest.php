<?php

namespace App\Http\Requests;

use App\Team;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd(auth()->check());
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => [
            //     'required', 'min:3'
            // ],
            // 'admin_id' => [
            //     'required', 'email', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)
            // ],
            // 'password' => [
            //     $this->route()->user ? 'nullable' : 'required', 'confirmed', 'min:6'
            // ]
        ];
    }
}
