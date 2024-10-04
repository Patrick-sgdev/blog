<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserToken;

class SettingsLivewire extends Component
{
    public $api_key;

    public function mount()
    {
        $this->api_key = auth()->user()->token->token;
    }
    public function newKey()
    {
        $this->api_key = UserToken::updateOrCreate(['user_id' => auth()->user()->id], ['token' => fake()->uuid()])->token;
    }

    public function render()
    {
        return view('livewire.settings-livewire');
    }
}
