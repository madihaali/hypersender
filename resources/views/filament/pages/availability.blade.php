<x-filament::page>
    <form wire:submit.prevent="submit" class="space-y-4">
        <x-filament::input.wrapper>
            <x-filament::input.label for="start">Start Time</x-filament::input.label>
            <x-filament::input type="datetime-local" wire:model="start" id="start" required />
        </x-filament::input.wrapper>

        <x-filament::input.wrapper>
            <x-filament::input.label for="end">End Time</x-filament::input.label>
            <x-filament::input type="datetime-local" wire:model="end" id="end" required />
        </x-filament::input.wrapper>

        <x-filament::button type="submit">Check Availability</x-filament::button>
    </form>

    @if($drivers && $vehicles)
        <div class="mt-6">
            <h3 class="font-bold">Available Drivers</h3>
            <ul>
                @forelse($drivers as $driver)
                    <li>{{ $driver->name }}</li>
                @empty
                    <li>No drivers available</li>
                @endforelse
            </ul>

            <h3 class="font-bold mt-4">Available Vehicles</h3>
            <ul>
                @forelse($vehicles as $vehicle)
                    <li>{{ $vehicle->name }}</li>
                @empty
                    <li>No vehicles available</li>
                @endforelse
            </ul>
        </div>
    @endif
</x-filament::page>
