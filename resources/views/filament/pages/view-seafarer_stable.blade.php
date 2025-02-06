<x-filament-panels::page>
    <div class="w-full mx-auto rounded-lg">
        <div class="space-y-0 sm:space-y-6">
            <div class="flex flex-col items-center justify-center gap-6 sm:items-start sm:flex-row">
                <!-- Profile Image and Info -->
                <div
                    class="w-full p-6 space-y-4 border shadow-sm sm:max-w-xs bg-gradient-to-b from-cyan-500 to-blue-500 border-cyan-500 profile-banner rounded-xl ring-1 ring-cyan-300 dark:bg-gray-900 dark:ring-white/10">
                    <div
                        class="flex flex-col items-center justify-center w-full overflow-hidden bg-white border border-white rounded-full aspect-square">
                        <img src="
                            @if ($record->avatar == null) {{ __('https://picsum.photos/200') }}
                            @else
                                {{ config('app.url') . '/storage/' . $record->avatar }} @endif
                                "
                            alt="Profile picture" class="object-cover max-w-xs scale-90" />
                    </div>
                    <div class="space-y-4" style="margin-top: 20px;">
                        <div class="flex flex-col items-center justify-center gap-6 sm:flex-row">
                            <h1 class="text-2xl font-bold tracking-tight text-center text-white">
                                {{ Str::title(Str::lower($record->surname)) }},
                                {{ Str::title(Str::lower($record->name)) }}
                                {{ Str::title(Str::lower($record->middle_name)) }}
                            </h1>
                        </div>

                        <hr class="w-full my-4 border-t border-white opacity-50">

                        <div class="flex flex-col items-center justify-center w-full gap-1">
                            <div class="flex flex-row items-center justify-center w-full gap-1">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Rank:</h3>
                                </div>
                                <div class="w-full">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{ Str::title(Str::lower($record->rank_long_name)) }}
                                    </h3>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full gap-1 truncate">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Status:</h3>
                                </div>
                                <div class="w-full truncate">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{ Str::title(Str::lower($record->available)) }}
                                    </h3>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full gap-1 truncate">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Vessel:</h3>
                                </div>
                                <div class="w-full truncate">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{ Str::title(Str::lower($record->last_vessel_name)) }}
                                    </h3>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full gap-1 truncate">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Principal:</h3>
                                </div>
                                <div class="w-full truncate">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{ Str::title(Str::lower($record->last_client_name)) }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <hr class="w-full my-4 border-t border-white opacity-50">

                        <div class="flex flex-col items-center justify-center w-full gap-1">
                            <div class="flex flex-row items-center justify-start w-full gap-1">
                                <h3 class="font-semibold text-white truncate text-start">Company Programs</h3>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full gap-1">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Roster Program:</h3>
                                </div>
                                <div class="w-full">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{-- {{ Str::title(Str::lower($record->rank_long_name)) }} --}}
                                    </h3>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full gap-1 truncate">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Cadetship Training Program:</h3>
                                </div>
                                <div class="w-full truncate">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{-- {{ Str::title(Str::lower($record->available)) }} --}}
                                    </h3>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full gap-1 truncate">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Career Development Program:</h3>
                                </div>
                                <div class="w-full truncate">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{-- {{ Str::title(Str::lower($record->last_vessel_name)) }} --}}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <hr class="w-full my-4 border-t border-white opacity-50">

                        <div class="flex flex-col items-center justify-center w-full gap-1">
                            <div class="flex flex-row items-center justify-center w-full gap-1 truncate">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Gender:</h3>
                                </div>
                                <div class="w-full truncate">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{ Str::title(Str::lower($record->sex == 'M' ? 'Male' : 'Female')) }}
                                    </h3>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full gap-1">
                                <div class="flex flex-wrap w-full word-wrap">
                                    <h3 class="font-medium text-gray-200 truncate">Address:
                                        <h3 class="font-semibold text-white truncate text-wrap text-start">
                                            {{ Str::title(Str::lower($record->addresses->first()?->name)) }}
                                            {{ Str::title(Str::lower($record->addresses->first()?->postal_index)) }}
                                            {{ Str::title(Str::lower($record->addresses->first()?->city)) }}
                                        </h3>
                                    </h3>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full gap-1 truncate">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Email:</h3>
                                </div>
                                <div class="w-full truncate">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{ Str::lower($record->primary_email) }}
                                    </h3>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full gap-1 truncate">
                                <div>
                                    <h3 class="font-medium text-gray-200 truncate">Mobile:</h3>
                                </div>
                                <div class="w-full truncate">
                                    <h3 class="font-semibold text-white truncate text-start">
                                        {{ Str::title(Str::lower($record->primary_mobile)) }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <hr class="w-full my-4 border-t border-white opacity-50">
                        <div
                            class="flex flex-col items-center justify-center w-full overflow-hidden bg-white border border-white aspect-square">
                            <img src="
                            @if ($record->esignature == null) {{ __('https://picsum.photos/200') }}
                            @else
                                {{ config('app.url') . '/storage/' . $record->esignature }} @endif
                                "
                                alt="E-Signature" class="object-cover w-full max-w-xs scale-105" />
                        </div>
                    </div>
                </div>
                <div class="w-full min-w-0 space-y-6">
                    <!-- Skill Details -->
                    <div class="flex flex-col items-center justify-between w-full gap-4 xl:flex-row">
                        <!-- Overall Rating -->
                        <div
                            class="w-full p-6 bg-white shadow-sm rounded-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 min-h-[298px]">
                            <!-- Header Section -->
                            <div style="margin-bottom: 1.5rem;">
                                <div class="flex flex-col items-start justify-start gap-6">
                                    <h1 class="text-xl font-bold tracking-tight text-gray-700 dark:text-gray-100">
                                        Overall Rating:
                                    </h1>
                                    <!-- Rating Stars -->
                                    <div class="flex items-center gap-1 mt-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div class="relative">
                                                @if ($i <= floor(4.5))
                                                    <!-- Full star -->
                                                    <svg class="w-10 h-10 text-yellow-400 sm:w-12 sm:h-12 md:w-14 md:h-14 lg:w-20 lg:h-20"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @elseif ($i <= 4.5)
                                                    <!-- Half star -->
                                                    <div class="relative">
                                                        <svg class="w-10 h-10 text-gray-300 sm:w-12 sm:h-12 md:w-14 md:h-14 lg:w-20 lg:h-20"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        <div class="absolute top-0 left-0 w-1/2 h-full overflow-hidden">
                                                            <svg class="w-10 h-10 text-yellow-400 sm:w-12 sm:h-12 md:w-14 md:h-14 lg:w-20 lg:h-20"
                                                                fill="currentColor" viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- Empty star -->
                                                    <svg class="w-10 h-10 text-gray-300 sm:w-12 sm:h-12 md:w-14 md:h-14 lg:w-20 lg:h-20"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endif
                                            </div>
                                        @endfor
                                        <div class="flex flex-col">
                                            <span
                                                class="ml-2 text-2xl font-bold text-green-300 dark:text-gray-100">4.0</span>
                                            <span class="ml-2 text-sm font-bold text-green-500 dark:text-gray-100">
                                                (Above Average)
                                            </span>

                                        </div>


                                    </div>
                                    <div>
                                        <span class="ml-2 text-xs font-bold dark:text-gray-100 text-stone-700">
                                            The seafarer fulfills training requirements and performs well in onboard
                                            appraisals, showcasing strong competence and a proactive approach to
                                            applying their training. While their performance is commendable, minor
                                            areas for development remain to achieve excellence.
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Traning KPI Details -->
                        <div
                            class="w-full p-6 bg-white shadow-sm rounded-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 min-h-[298px]">
                            <!-- Header Section -->
                            <div style="margin-bottom: 1.5rem;">
                                <div
                                    class="flex flex-col items-start justify-start gap-6 sm:items-center sm:justify-between sm:flex-row">
                                    <h1 class="text-xl font-bold tracking-tight text-gray-700 dark:text-gray-100">
                                        Traning KPI:
                                    </h1>
                                </div>
                            </div>
                            <!-- Info Grid -->
                            <div class="flex flex-col items-start justify-start w-full gap-2">
                                <div class="flex flex-row items-start justify-start w-full gap-2">
                                    <div class="flex flex-row items-center justify-start w-full gap-4">
                                        <h3 class="w-full font-medium text-black dark:text-white text-start">IMA
                                            Company
                                            Req:
                                        </h3>
                                        <h3 class="font-semibold text-black dark:text-white text-start">83%</h3>
                                        <div class="w-full h-2 bg-gray-200 rounded-full">
                                            <div class="h-full transition-all duration-300 rounded-full {{ 83 >= 50 ? 'bg-green-500' : 'bg-red-500' }}"
                                                style="width: 83%">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <div class="flex flex-row items-start justify-start w-full gap-2">
                                    <div class="flex flex-row items-center justify-start w-full gap-4">
                                        <h3 class="w-full font-medium text-black dark:text-white text-start">
                                            Ship/Class, Flag
                                            Req:
                                        </h3>
                                        <h3 class="font-semibold text-black dark:text-white text-start">21%</h3>
                                        <div class="w-full h-2 bg-gray-200 rounded-full">
                                            <div class="h-full transition-all duration-300 rounded-full {{ 21 >= 50 ? 'bg-green-500' : 'bg-red-500' }}"
                                                style="width: 21%">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <div class="flex flex-row items-start justify-start w-full gap-2">
                                    <div class="flex flex-row items-center justify-start w-full gap-4">
                                        <h3 class="w-full font-medium text-black dark:text-white text-start">Owner
                                            Recommended:
                                        </h3>
                                        <h3 class="font-semibold text-black dark:text-white text-start">90%</h3>
                                        <div class="w-full h-2 bg-gray-200 rounded-full">
                                            <div class="h-full transition-all duration-300 rounded-full {{ 90 >= 50 ? 'bg-green-500' : 'bg-red-500' }}"
                                                style="width: 90%">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <div class="flex flex-row items-start justify-start w-full gap-2 mt-6">
                                    <div class="flex flex-row items-center justify-start w-full gap-4">
                                        <h3 class="w-full font-medium text-black dark:text-white text-start">Appraisal
                                            Performance:
                                        </h3>
                                        <h3 class="font-semibold text-black dark:text-white text-start">100%</h3>
                                        <div class="w-full h-2 bg-gray-200 rounded-full">
                                            <div class="h-full transition-all duration-300 rounded-full {{ 100 >= 50 ? 'bg-green-500' : 'bg-red-500' }}"
                                                style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Tabs -->
                    <x-filament::tabs>
                        <!-- Sea Service Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'sea-service'" wire:click="$set('activeTab', 'sea-service')">
                            <x-slot name="icon">
                                <x-heroicon-o-briefcase class="w-4 h-4" />
                            </x-slot>
                            Sea Service
                        </x-filament::tabs.item>

                        <!-- Appraisal Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'appraisal'" wire:click="$set('activeTab', 'appraisal')">
                            <x-slot name="icon">
                                <x-heroicon-o-clipboard-document-check class="w-4 h-4" />
                            </x-slot>
                            Appraisal
                        </x-filament::tabs.item>

                        <!-- Documents Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'documents'" wire:click="$set('activeTab', 'documents')">
                            <x-slot name="icon">
                                <x-heroicon-o-clipboard-document class="w-4 h-4" />
                            </x-slot>
                            Documents
                        </x-filament::tabs.item>

                        <!-- CMS Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'cms'" wire:click="$set('activeTab', 'cms')">
                            <x-slot name="icon">
                                <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4" />
                            </x-slot>
                            CMS
                        </x-filament::tabs.item>

                        <!-- Company Courses Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'company-courses'" wire:click="$set('activeTab', 'company-courses')">
                            <x-slot name="icon">
                                <x-heroicon-o-bookmark-square class="w-4 h-4" />
                            </x-slot>
                            Company Courses
                        </x-filament::tabs.item>

                        <!-- CDP Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'cdp'" wire:click="$set('activeTab', 'cdp')">
                            <x-slot name="icon">
                                <x-heroicon-o-chart-bar class="w-4 h-4" />
                            </x-slot>
                            CDP
                        </x-filament::tabs.item>

                        <!-- Profile Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'profile'" wire:click="$set('activeTab', 'profile')">
                            <x-slot name="icon">
                                <x-heroicon-o-user class="w-4 h-4" />
                            </x-slot>
                            Profile
                        </x-filament::tabs.item>

                        {{-- <!-- Addresses Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'addresses'" wire:click="$set('activeTab', 'addresses')">
                            <x-slot name="icon">
                                <x-heroicon-o-map-pin class="w-4 h-4" />
                            </x-slot>
                            Addresses
                        </x-filament::tabs.item>

                        <!-- Relatives Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'relatives'" wire:click="$set('activeTab', 'relatives')">
                            <x-slot name="icon">
                                <x-heroicon-o-user-group class="w-4 h-4" />
                            </x-slot>
                            Relatives
                        </x-filament::tabs.item>

                        <!-- Documents Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'certifications'" wire:click="$set('activeTab', 'certifications')">
                            <x-slot name="icon">
                                <x-heroicon-o-document-duplicate class="w-4 h-4" />
                            </x-slot>
                            Certifications
                        </x-filament::tabs.item>

                        <!-- Bank Accounts Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'bank-accounts'" wire:click="$set('activeTab', 'bank-accounts')">
                            <x-slot name="icon">
                                <x-heroicon-o-credit-card class="w-4 h-4" />
                            </x-slot>
                            Bank Accounts
                        </x-filament::tabs.item>

                        <!-- Uniform Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'uniform'" wire:click="$set('activeTab', 'uniform')">
                            <x-slot name="icon">
                                <x-heroicon-o-finger-print class="w-4 h-4" />
                            </x-slot>
                            Uniform
                        </x-filament::tabs.item> --}}
                    </x-filament::tabs>

                    <!-- Tab Content -->
                    <div>
                        @if ($activeTab === 'sea-service')
                            @livewire(\App\Filament\Resources\SeafarerResource\RelationManagers\EmploymentHistoryRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ])
                        @elseif ($activeTab === 'appraisal')
                            @livewire('appraisal-component', ['seafarerId' => $record->id])
                        @elseif ($activeTab === 'documents')

                        @elseif ($activeTab === 'cms')

                        @elseif ($activeTab === 'company-courses')

                        @elseif ($activeTab === 'cdp')

                        @elseif ($activeTab === 'addresses')
                            {{ $this->addressList }}
                        @elseif ($activeTab === 'relatives')
                            @livewire(\App\Filament\Resources\SeafarerResource\RelationManagers\RelativesRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ])
                        @elseif ($activeTab === 'certifications')
                            @livewire(\App\Filament\Resources\SeafarerResource\RelationManagers\CertificationsRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ])
                        @elseif ($activeTab === 'bank-accounts')
                            @livewire(\App\Filament\Resources\SeafarerResource\RelationManagers\BankAccountsRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ])
                        @elseif ($activeTab === 'profile')
                            {{ $this->personalInfoList }}
                        @elseif ($activeTab === 'uniform')
                            {{ $this->uniformList }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
