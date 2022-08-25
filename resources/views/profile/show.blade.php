<x-app-layout>
    <div class="container mt-3">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border></x-jet-section-border>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            @livewire('profile.update-password-form')
            <x-jet-section-border></x-jet-section-border>
        @endif
    </div>

</x-app-layout>

