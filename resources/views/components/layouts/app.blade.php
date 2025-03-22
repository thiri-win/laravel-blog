<x-layouts.app.header :title="$title ?? null">
    <x-notification></x-notification>
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.header>
