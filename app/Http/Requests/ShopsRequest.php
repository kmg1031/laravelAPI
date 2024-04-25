<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class ShopsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $routeName = $this->route()->getName();

        switch ($routeName) {
            case 'shops.store':
                return [
                    'name' => 'required|unique:shops,name,NULL,id,deleted_at,NULL|max:255',
                    'address' => 'required|string|max:255',
                    'is_all_day' => 'boolean',
                    'opened_at' => 'required_if:is_all_day,false|date_format:H:i',
                    'closed_at' => 'required_if:is_all_day,false|date_format:H:i',
                ];
            case 'shops.update':
                return [
                    'name' => 'required|unique:shops,name,' . $this->shops->idx .',idx,deleted_at,NULL|max:255',
                    'address' => 'required|string|max:255',
                    'is_all_day' => 'boolean',
                    'opened_at' => 'required_if:is_all_day,false|date_format:H:i',
                    'closed_at' => 'required_if:is_all_day,false|date_format:H:i',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'name.required' => '상점 이름은 필수 입력 항목입니다.',
            'name.unique' => '이미 존재하는 상점 이름입니다.',
            'name.max' => '상점 이름은 최대 255자까지 입력 가능합니다.',
            'address.required' => '상점 위치는 필수 입력 항목입니다.',
            'address.max' => '상점 위치는 최대 255자까지 입력 가능합니다.',
            // 'is_all_day.required' => '상점 영업 시간은 필수 입력 항목입니다.',
            'is_all_day.boolean' => '상점 영업 시간은 true 또는 false로 입력해야 합니다.',
            'opened_at.required' => '상점 오픈 시간은 필수 입력 항목입니다.',
            'opened_at.date_format' => '상점 오픈 시간은 H:i 형식으로 입력해야 합니다.',
            'closed_at.required' => '상점 마감 시간은 필수 입력 항목입니다.',
            'closed_at.date_format' => '상점 마감 시간은 H:i 형식으로 입력해야 합니다.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        \Log::error('Validation failed:', $errors->toArray());

        throw new HttpResponseException(response()->json($errors, 422));
    }

}
