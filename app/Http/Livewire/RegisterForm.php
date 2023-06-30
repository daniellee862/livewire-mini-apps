<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RegisterForm extends Component
{
    public $email = '';
    public $password = '';
    public $first_name = '';
    public $last_name = '';
    public $role = 'customer';
    public $company_name = '';
    public $vat_number = '';

    protected $rules = [
        'first_name' => ['required', 'min:2'],
        'last_name' => ['required', 'min:2'],
        'email' => ['required', 'email'],
        'password' => ['required', 'min:8'],
        'company_name' => ['required_if:role,vendor'],
        'vat_number' => ['required_if:role,vendor'],
    ];

    public function render()
    {
        return view('livewire.register-form');
    }

    public function submit()
    {
        $this->validate();

        // Register customer
        session()->flash('message', 'Customer was created.');

        $this->email = '';
        $this->password = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->role = 'customer';
        $this->company_name = '';
        $this->vat_number = '';
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }
}
