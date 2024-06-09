<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => 'string',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|unique:tags,title',
            'group_id' => 'required|exists:groups,id',
            'image' => 'nullable|file',
            'delete' => 'nullable|string'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge( [
            'title' => $this->title,
            'tags' => explode(', ', $this->tags),
            'group_id' => $this->group_id,
            'image' => $this->image,
            'delete' => $this->delete
        ]);
    }

}
