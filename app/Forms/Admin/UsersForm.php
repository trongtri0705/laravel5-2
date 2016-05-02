<?php

namespace App\Forms\Admin;

use Kris\LaravelFormBuilder\Form;

class UsersForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Name *',
                'rules' => 'required|max:255',
                'attr' => array(
                    'autofocus' => 'autofocus',
                    'class' => 'first-input form-control',
                ),
            ])            
            ->add('email', 'text', [
                'label' => 'Email *',
                'rules' => 'required|email|max:100|unique:users',
            ])
            ->add('role_id', 'select', [
                'choices' => array(1 => 'Admin', 2 => 'User'),
                'selected' => !empty($this->model->id) ? $this->model->role_id : '',
                'label' => 'Role *',
            ])
            ->add('password', 'password', [
                'label' => 'Password',
                'rules' => 'confirmed|min:4'.isset($this->model->id) ? '' : '!required',
                'value' => '',
                'attr' => array(
                    'required' => null,
                ),
            ])
            ->add('password_confirmation', 'password')            
            ->add('save', 'submit', [
                'label' => 'Save',
                'wrapper' => array('box-footer'),
                'attr' => array(
                    'class' => 'btn btn-primary',
                ),
            ]);
    }
}
