<?php

namespace Partymeister\Core\Forms\Component;

use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Form;

class VisitorRegistrationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => trans('partymeister-core::backend/visitors.name'), 'rules' => ['required','max:255', Rule::unique('visitors', 'name')]])
            ->add('group', 'text', ['label' => trans('partymeister-core::backend/visitors.group')])
            ->add('access_key', 'text', ['label' => trans('partymeister-competitions::backend/access_keys.access_key'), 'rules' =>
                [
                    'required',
                    'min:8',
                    Rule::exists('access_keys', 'access_key')->where(function ($query) {
                        $query->where('visitor_id', null);
                        })
                ]])
            ->add('country_iso_3166_1', 'select', ['label' => trans('motor-backend::backend/global.address.country'), 'choices' => \Symfony\Component\Intl\Intl::getRegionBundle()->getCountryNames()])
            ->add('password', 'password', ['value' => '', 'label' => trans('motor-backend::backend/users.password'), 'rules' => 'required|min:6|confirmed'])
            ->add('password_confirmation', 'password', ['value' => '', 'label' => trans('motor-backend::backend/users.password_confirm'), 'rules' => 'required|min:6'])
            ->add('submit', 'submit', ['attr' => ['class' => 'success button expanded'], 'label' => 'Register']);
    }
}