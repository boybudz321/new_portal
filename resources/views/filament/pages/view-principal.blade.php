<x-filament-panels::page>
    <div class="w-full mx-auto rounded-lg">
        <div class="">
            <div class="w-full">
                <div class="w-full h-48 overflow-hidden rounded-t-lg">
                    <img src="{{ asset('img/ship_background.jpg') }}" class="object-cover w-full h-full rounded-lg"
                        style="height: 150px;" alt="Ship Banner" />
                </div>
            </div>
            <div class="flex flex-col gap-8 mt-6 sm:flex-row">
                <!-- Profile Details and Contacts -->
                <div class="w-full min-w-0 space-y-6">
                    <div
                        class="flex flex-col w-full gap-6 p-6 bg-white shadow-sm md:flex-row rounded-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                        <div class="flex flex-col items-center justify-center overflow-hidden rounded-lg aspect-square">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                alt="Profile picture" class="object-cover w-full max-w-xs"
                                style="border-radius: 10px; border-width: 3px; border-color: white; @media (prefers-color-scheme: dark) { border-color: white; }" />
                        </div>
                        <div class="w-full">
                            <!-- Header Section -->
                            <div style="margin-bottom: 1.5rem;">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-3xl font-bold">
                                        {{ $record->Name ? Str::title(Str::lower($record->Name)) : 'N/A' }}
                                    </h1>
                                    <span
                                        style="--c-50:var(--success-50);--c-400:var(--success-400);--c-600:var(--success-600);"
                                        class="fi-badge flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2 min-w-[theme(spacing.6)] py-1 fi-color-custom bg-custom-50 text-custom-600 ring-custom-600/10 dark:bg-custom-400/10 dark:text-custom-400 dark:ring-custom-400/30 fi-color-success">
                                        Code {{ $record->PrinCode ? Str::title(Str::lower($record->PrinCode)) : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <!-- Info Grid -->
                            <div class="grid grid-cols-1 gap-6 p-2 overflow-x-auto md:grid-cols-2 lg:grid-cols-4">
                                <!-- Abbreviation -->
                                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                                    <label
                                        class="text-sm font-medium text-gray-500 dark:text-gray-400">Abbreviation</label>
                                    <div class="block mt-1">
                                        <h2 style="--c-50:var(--primary-50);--c-400:var(--primary-400);--c-600:var(--primary-600);"
                                            class="fi-badge inline-block font-semibold gap-x-1 rounded-md ring-1 ring-inset px-2 min-w-[theme(spacing.6)] fi-color-custom bg-custom-50 text-custom-600 ring-custom-600/10 dark:bg-custom-400/10 dark:text-custom-400 dark:ring-custom-400/30 fi-color-primary">
                                            {{ $record->Abbrv ? Str::title(Str::lower($record->Abbrv)) : 'N/A' }}

                                        </h2>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</label>
                                    <div class="mt-1 overflow-x-auto font-semibold truncate">
                                        {{ $record->Addr ? Str::title(Str::lower($record->Addr)) : 'N/A' }}
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                                    <div class="mt-1 font-semibold">
                                        {{ $record->Email ? $record->Email : 'N/A' }}
                                    </div>
                                </div>

                                <!-- Mobile -->
                                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Mobile</label>
                                    <div class="mt-1 font-semibold">
                                        {{ $record->Phone ? $record->Phone : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-filament::tabs>
                        <!-- Profile Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'profile'" wire:click="$set('activeTab', 'profile')">
                            <x-slot name="icon">
                                <x-heroicon-o-user class="w-4 h-4" />
                            </x-slot>
                            Profile
                        </x-filament::tabs.item>

                        <!-- Addresses Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'vessels'" wire:click="$set('activeTab', 'vessels')">
                            <x-slot name="icon">
                                <x-heroicon-o-map-pin class="w-4 h-4" />
                            </x-slot>
                            Vessels
                        </x-filament::tabs.item>

                        <!-- Relatives Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'personnels'" wire:click="$set('activeTab', 'personnels')">
                            <x-slot name="icon">
                                <x-heroicon-o-user-group class="w-4 h-4" />
                            </x-slot>
                            Office Personnels
                        </x-filament::tabs.item>
                    </x-filament::tabs>

                    <!-- Tab Content -->
                    <div>
                        @if ($activeTab === 'profile')
                            {{ $this->infoList }}
                        @elseif ($activeTab === 'vessels')
                            @livewire(\App\Filament\Resources\PrincipalResource\RelationManagers\VesselsRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ])
                        @elseif ($activeTab === 'personnels')
                            @livewire(\App\Filament\Resources\PrincipalResource\RelationManagers\OfficePersonnelRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
