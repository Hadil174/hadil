<style>
    .update-password-section {
        background-color: #f7f3ec;
        border: 1px solid #6e5d32;
        border-radius: 10px;
        padding: 30px;
        max-width: 800px;
        margin: 40px auto;
        box-shadow: 0px 4px 10px rgba(110, 93, 50, 0.3);
    }

    .update-password-section h2 {
        color: #6e5d32;
        font-size: 28px;
        margin-bottom: 10px;
    }

    .update-password-section p {
        color: #8b7a4f;
        margin-bottom: 20px;
    }

    .update-password-section label {
        color: #6e5d32;
        font-weight: bold;
    }

    .update-password-section input[type="password"] {
        border: 1px solid #6e5d32;
        border-radius: 5px;
        padding: 8px;
        width: 100%;
        background-color: #fdfcf8;
        color: #6e5d32;
    }

    .update-password-section .x-button,
    .update-password-section .x-secondary-button {
        background-color: #6e5d32;
        color: white;
        border-radius: 5px;
        padding: 8px 20px;
        border: none;
        transition: background-color 0.3s ease;
    }

    .update-password-section .x-button:hover,
    .update-password-section .x-secondary-button:hover {
        background-color: #5a4a29;
    }

    .update-password-section .x-input-error {
        color: #b45309;
    }

    .update-password-section .text-green-600 {
        color: #5f7a3e;
    }
</style>

<div class="update-password-section">
    <x-form-section submit="updatePassword">
        <x-slot name="title">
            {{ __('Update Password') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="current_password" value="{{ __('Current Password') }}" />
                <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="password" value="{{ __('New Password') }}" />
                <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
                <x-input-error for="password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
