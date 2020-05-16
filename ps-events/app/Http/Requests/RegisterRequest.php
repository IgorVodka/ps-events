<?php

namespace App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $slot = $this->route('slot');
        return $slot->sparePlaces() > 0 && $slot->event->isRegistrationOpen();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $slot = $this->route('slot');
        return [
            'name' => 'required|max:255|min:5',
            'group' => 'required|max:16|min:5',
            'student_ticket' => 'required|max:32|min:5',
            'email' => [
                'required',
                'email',
                Rule::unique('participants')->where(function (Builder $query) use ($slot) {
                    // TODO: check for all event, not just slot (add join)
                    return $query->where('slot_id', $slot->id)->where('activated', true);
                })
            ],
            'phone' => 'required_without:vk_link',
            'agree' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Укажите свои фамилию и имя.',
            'name.max' => 'Имя слишком длинное.',
            'name.min' => 'Имя слишком короткое.',
            'group.required' => 'Укажите группу, в которой учитесь.',
            'group.max' => 'Группа слишком длинная.',
            'group.min' => 'Группа слишком короткая.',
            'student_ticket.required' => 'Укажите номер своего студенческого билета.',
            'student_ticket.max' => 'Номер студенческого билета слишком длинный.',
            'student_ticket.min' => 'Номер студенческого билета слишком короткий.',
            'email.required' => 'Укажите свою электронную почту.',
            'email.email' => 'Укажите корректный адрес электронной почты.',
            'email.unique' => 'Вы уже зарегистрированы.',
            'phone.required_without' => 'Укажите либо номер телефона, либо ссылку на VK.',
            'agree.required' => 'Вы должны согласиться с правилами проведения мероприятия.'
        ];
    }
}
