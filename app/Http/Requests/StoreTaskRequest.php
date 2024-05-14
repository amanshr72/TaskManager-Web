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
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            // 'status' => 'required|in:Unassigned,Assigned,In Process,Pending',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than :max characters.',
            'description.string' => 'The description must be a string.',
            'assigned_by.exists' => 'The selected assigned by is invalid.',
            'assigned_to.exists' => 'The selected assigned to is invalid.',
            'start_date.date' => 'The start date must be a valid date.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid. It must be one of: Unassigned, Assigned, In Process.',
        ];
    }
}
