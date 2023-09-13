<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\LocalStudents;
use App\ForeignStudents;

class StoreValidationRequest extends FormRequest
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
        $name = $this->name;
        $mobile_number = $this->mobile_number;
        
        return [
            'student_type'  => 'bail|required',
            'id_number'     => ['bail', 'required', 'numeric', 'digits:5',
                                function ($attribute, $value, $fail) {
                                if (LocalStudents::where([[$attribute, '=', $value], ['id', '<>', request()->id]])->count()) $fail($value.' is already taken');
                                if (ForeignStudents::where([[$attribute, '=', $value], ['id', '<>', request()->id]])->count()) $fail($value.' is already taken');
                                },
            ],
            'name'          => ['bail','required',
                                Rule::unique('local_students')->where(function ($query) use($name, $mobile_number) {
                                return $query->where('name', $name)
                                ->where('mobile_number', $mobile_number);
                                   })->ignore($this->id),

                                Rule::unique('foreign_students')->where(function ($query) use($name, $mobile_number) {
                                    return $query->where('name', $name)
                                    ->where('mobile_number', $mobile_number);
                                  })->ignore($this->id)],


            'age'           => 'bail|required|numeric|integer|digits_between:2,2|min:10|max:80',
            'gender'        => 'bail|nullable',
            'city'          => 'bail|required|max:20',
            'mobile_number' => ['bail','required','numeric', 'digits:11', 'regex:/^(09)\\d{9}$/',

                                Rule::unique('local_students')->where(function ($query) use($name, $mobile_number) {
                                    return $query->where('name', $name)
                                    ->where('mobile_number', $mobile_number);
                                  })->ignore($this->id),

                                Rule::unique('foreign_students')->where(function ($query) use($name, $mobile_number) {
                                    return $query->where('name', $name)
                                    ->where('mobile_number', $mobile_number);
                                  })->ignore($this->id)],

            'grades'        => 'bail|nullable',
            'email'         => 'bail|required|email|ends_with:@gmail.com'
        ];
    }

    public function messages()
    {
    return [
        'age.integer'            => 'Age should not contain decimal numbers.',
        'age.digits_between'     => 'The minimum allowed age is 10 years old.',
        'age.min'                => 'The minimum allowed age is 10 years old.',
        'age.max'                => 'The maximum allowed age is 80 years old.',
        'mobile_number.regex'    => 'The mobile number must starts from 09',
        'email.ends_with'        => 'The email must end with: @gmail.com',
    ];
  }
}


