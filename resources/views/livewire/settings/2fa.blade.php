<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Livewire\Volt\Component;
use PragmaRX\Google2FA\Google2FA;

new class extends Component
{
    public Authenticatable $user;
    public string $urlQRCode;
    public string $secret;
    public string $otp = '';

    public function mount(): void
    {
        $this->user = auth()->user();
        $google2fa = app('pragmarx.google2fa');

        if ($this->user->google2fa_secret) {
            $this->secret = $this->user->google2fa_secret;
        } else {
            $this->secret = $google2fa->generateSecretKey();
        }

        $this->urlQRCode = $google2fa->getQRCodeInline(
            config('app.name'),
            $this->user->email,
            $this->secret
        );
    }

    public function verifyOTP()
    {
        $this->validate([
            'otp' => 'required',
        ]);

        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($this->secret, $this->otp);

        if ($valid) {
            $this->user->google2fa_secret = $this->secret;
            $this->user->save();

            return redirect()->route('dashboard')->with('success', '2FA verified');
        }

        return redirect()->route('dashboard')->with('error', 'Invalid OTP');
    }
}; ?>

<div class="flex flex-col items-start">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Google 2FA')" :subheading=" __('Update the appearance settings for your account')">
        <p>Set up your to factor authentication by scanning the barcode below. Alternatively, you can use the code
            <strong>{{ $secret }}</strong></p>

        {!! $urlQRCode !!}
        <div class="pt-3">
            <form wire:submit="verifyOTP">
                <flux:input wire:model="otp" :label="__('Enter OTP for Google 2FA Enable')" type="text"/>
                <div class="pt-3">
                    <flux:button variant="primary" type="submit">{{ __('Verify') }}</flux:button>
                </div>
            </form>
        </div>
    </x-settings.layout>
</div>
