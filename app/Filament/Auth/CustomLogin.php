<?php

namespace App\Filament\Auth;

use Filament\Schemas\Schema;
use Filament\Auth\Pages\Login;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;

class CustomLogin extends Login
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ]);
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label('Username / Alamat email')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(#[SensitiveParameter] array $data): array
    {
        $login_field = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return [
            $login_field => $data['login'],
            'password' => $data['password'],
        ];
    }
}
