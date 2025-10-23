<x-layout>
    <x-card :model="$model">
        <x-form :model="$model">

            <x-input name="username" :model="$model" col="6" hint="Username cannot be changed" />
            <x-input name="name" :model="$model"/>
            <x-input type="email" name="email" :model="$model" col="12" />
            <x-input type="password" name="password" col="6" />
            <x-input type="password" name="password_confirmation" col="6" />
            <x-select name="role" :model="$model" :options="$role" />

            <x-footer :model="$model" />

        </x-form>
    </x-card>
</x-layout>