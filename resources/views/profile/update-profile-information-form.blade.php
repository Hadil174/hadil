<style>
    .profile-section {
        background-color: #f7f3ec;
        border: 1px solid #6e5d32;
        border-radius: 10px;
        padding: 30px;
        max-width: 800px;
        margin: 40px auto;
        box-shadow: 0px 4px 10px rgba(110, 93, 50, 0.3);
    }

    .profile-section h2 {
        color: #6e5d32;
        font-size: 28px;
        margin-bottom: 10px;
    }

    .profile-section p {
        color: #8b7a4f;
        margin-bottom: 20px;
    }

    .profile-section label {
        color: #6e5d32;
        font-weight: bold;
    }

    .profile-section input[type="text"],
    .profile-section input[type="email"] {
        border: 1px solid #6e5d32;
        border-radius: 5px;
        padding: 8px;
        width: 100%;
        background-color: #fdfcf8;
        color: #6e5d32;
    }

    .profile-section .rounded-full {
        border: 2px solid #6e5d32;
    }

    .profile-section .x-button,
    .profile-section .x-secondary-button {
        background-color: #6e5d32;
        color: white;
        border-radius: 5px;
        padding: 8px 20px;
        border: none;
        transition: background-color 0.3s ease;
    }

    .profile-section .x-button:hover,
    .profile-section .x-secondary-button:hover {
        background-color: #5a4a29;
    }

    .profile-section .x-input-error {
        color: #b45309;
    }

    .profile-section .text-green-600 {
        color: #5f7a3e;
    }
</style>

<div class="profile-section">
    <x-form-section submit="updateProfileInformation">
        <x-slot name="title">
            {{ __('Profile Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your account\'s profile information and email address.') }}
        </x-slot>

        <x-slot name="form">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <input type="file" id="photo" class="hidden"
                           wire:model.live="photo"
                           x-ref="photo"
                           x-on:change="
                               photoName = $refs.photo.files[0].name;
                               const reader = new FileReader();
                               reader.onload = (e) => {
                                   photoPreview = e.target.result;
                               };
                               reader.readAsDataURL($refs.photo.files[0]);
                           " />

                    <x-label for="photo" value="{{ __('Photo') }}" />

                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover">
                    </div>

                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-secondary-button>

                    @if ($this->user->profile_photo_path)
                        <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-secondary-button>
                    @endif

                    <x-input-error for="photo" class="mt-2" />
                </div>
            @endif

            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
                <x-input-error for="email" class="mt-2" />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2">
                        {{ __('Your email address is unverified.') }}
                        <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
