<x-filament-panels::page>
    <form wire:submit.prevent="submit" class="space-y-6">
        {{-- Start Time --}}
        <div>
            <label for="start" class="block text-sm font-medium text-gray-700">
                Start Time
            </label>
            <input 
                type="datetime-local" 
                id="start" 
                wire:model="start" 
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
            />
            @error('start')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- End Time --}}
        <div>
            <label for="end" class="block text-sm font-medium text-gray-700">
                End Time
            </label>
            <input 
                type="datetime-local" 
                id="end" 
                wire:model="end" 
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
            />
            @error('end')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <x-filament::button type="submit">
            Check Availability
        </x-filament::button>
    </form>

    {{-- Results --}}
    @if($drivers && $vehicles)
        <div class="mt-8 space-y-6">
            <div>
                <h3 class="font-bold text-lg">Available Drivers</h3>
                <ul class="list-disc list-inside mt-2">
                    @forelse($drivers as $driver)
                        <li>{{ $driver->name }}</li>
                    @empty
                        <li class="text-gray-500">No drivers available</li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-lg">Available Vehicles</h3>
                <ul class="list-disc list-inside mt-2">
                    @forelse($vehicles as $vehicle)
                        <li>{{ $vehicle->name }}</li>
                    @empty
                        <li class="text-gray-500">No vehicles available</li>
                    @endforelse
                </ul>
            </div>
        </div>
    @endif
</x-filament-panels::page>
