<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required|max:200',
            'tags' => 'required|array',
            'group_id' => 'required|exists:groups,id',
            'image' => 'nullable|file'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'tags' => explode(', ', $this->tags),
            'title' => $this->title,
            'group_id' => $this->group_id,
            'image' => $this->image
        ]);
    }
}
