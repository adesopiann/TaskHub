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
            'title' => 'required|string|max:250',
            'description' => 'string|nullable',
            'status' => 'required|in:Open,In Progress,Done',
            'due_date' => 'date|nullable',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,csv,sql|max:2048',
        ];
    }

     /**
     * Mendapatkan pesan error yang disesuaikan untuk validasi.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Judul tugas wajib diisi.',
            'status.required' => 'Status tugas wajib diisi.',
            'due_date.date' => 'Tanggal due date harus valid.',
        ];
    }
}
