<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esqueceu sua senha? Sem problemas!') }}<br />
            {{ __('Informe abaixo o seu email e enviaremos o link para trocar a senha.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('E-mail') }}"/>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required autofocus/>
            </div>
            <div class="mb-4 text-sm text-gray-600">
            {{ __('Mandamos um email para resetar sua senha! Caso não o localize, lembre-se de olhar o SPAM.') }}
           
        </div>

            <div class="flex items-center justify-end mt-4">
          
                <x-jet-button>
                    {{ __('Reset de Senha por e-mail') }}
                </x-jet-button>
                
            </div>
           
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
