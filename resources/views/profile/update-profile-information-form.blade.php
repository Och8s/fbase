<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        Informació del perfil
    </x-slot>

    <x-slot name="description">
        <div class="text-sm text-gray-600">
            Consulta la teva informació de perfil. <br><br><br><br><br><br><br><br><br>
            Les teves dades no es poden modificar online. <br>
            Per fer-ho cal anar presencialment a les oficines del club. <br>
            Gràcies!
        </div>
    </x-slot>

    <x-slot name="form">
        <!-- Foto de perfil -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <x-label for="photo" value="Foto" />
                <div class="mt-2">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover">
                </div>
            </div>
        @endif

        <!-- Nom (només lectura) -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="Nom" />
            <div class="mt-1 p-2 bg-gray-100 rounded text-gray-800 text-sm font-medium">
                {{ auth()->user()->name }}
            </div>
        </div>

        <!-- Correu electrònic (només lectura) -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="Correu electrònic" />
            <div class="mt-1 p-2 bg-gray-100 rounded text-gray-800 text-sm font-medium">
                {{ auth()->user()->email }}
            </div>
        </div>

        <!-- Grup Rol + DNI junts -->
        <div class="col-span-6 sm:col-span-4 flex gap-4 mt-4">
            <div class="flex-1">
                <x-label for="rol" value="Rol" />
                <div class="mt-1 p-2 bg-gray-100 rounded text-gray-800 text-sm font-medium">
                    {{ auth()->user()->rol }}
                </div>
            </div>

            <div class="flex-1">
                <x-label for="dni" value="DNI" />
                <div class="mt-1 p-2 bg-gray-100 rounded text-gray-800 text-sm font-medium">
                    {{ auth()->user()->dni }}
                </div>
            </div>
        </div>
    </x-slot>
</x-form-section>
