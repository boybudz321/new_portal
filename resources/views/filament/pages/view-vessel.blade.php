<x-filament-panels::page>
    <div class="w-full mx-auto rounded-lg">
        <div class="space-y-0 sm:space-y-6">
            <div class="flex flex-col items-center justify-center gap-6 sm:items-start sm:flex-row">
                <div class="w-full min-w-0 space-y-6">
                    <!-- Skill Details -->
                    <div class="flex flex-col items-center justify-between w-full gap-4 xl:flex-row">
                        <!-- Overall Rating -->
                        <div
                            class="w-full p-4 bg-white shadow-sm rounded-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 min-h-[298px] items-center sm:items-start justify-center flex flex-col h-full">
                            <!-- Header Section -->
                            <div>
                                <div class="flex flex-col items-center justify-center w-full h-full gap-6 sm:flex-row">
                                    <img src="@if ($record->avatar == null) {{ __('https://picsum.photos/200') }}
											   @else
												{{ config('app.url') . '/storage/' . $record->avatar }} @endif"
                                        alt="Profile picture" class="object-cover w-full h-full rounded-lg max-w-96" />
                                    <div class="flex flex-col items-start w-full gap-1">
                                        <div class="flex flex-row gap-2">
                                            <h1
                                                class="font-normal tracking-tight text-gray-700 text-md dark:text-gray-100">
                                                Vessel Name:
                                            </h1>
                                            <h1 class="font-semibold text-black dark:text-white text-md">
                                                {{ Str::upper($record->Name) }}
                                            </h1>
                                        </div>
                                        <div class="flex flex-row gap-2">
                                            <h1
                                                class="font-normal tracking-tight text-gray-700 text-md dark:text-gray-100">
                                                IMO Number:
                                            </h1>
                                            <h1 class="font-semibold text-black dark:text-white text-md">
                                                {{ Str::title(Str::upper($record->OffNbr)) }}
                                            </h1>
                                        </div>
                                        <div class="flex flex-row gap-2">
                                            <h1
                                                class="font-normal tracking-tight text-gray-700 text-md dark:text-gray-100">
                                                Engine Type:
                                            </h1>
                                            <h1 class="font-semibold text-black dark:text-white text-md">
                                                {{ Str::title(Str::upper($record->EngType)) }}
                                            </h1>
                                        </div>
                                        <div class="flex flex-row gap-2">
                                            <h1
                                                class="font-normal tracking-tight text-gray-700 text-md dark:text-gray-100">
                                                Year Built:
                                            </h1>
                                            <h1 class="font-semibold text-black dark:text-white text-md">
                                                {{ Str::title(Str::upper($record->YearBuilt)) }}
                                            </h1>
                                        </div>
                                        <div class="flex flex-row gap-2">
                                            <h1
                                                class="font-normal tracking-tight text-gray-700 text-md dark:text-gray-100">
                                                Flag:
                                            </h1>
                                            <h1 class="font-semibold text-black dark:text-white text-md">
                                                {{ Str::title(Str::upper($record->flag2)) }}
                                            </h1>
                                        </div>
                                        <div class="flex flex-row gap-2">
                                            <h1
                                                class="font-normal tracking-tight text-gray-700 text-md dark:text-gray-100">
                                                Registered Port:
                                            </h1>
                                            <h1 class="font-semibold text-black dark:text-white text-md">
                                                {{ Str::title(Str::upper($record->PortofReg)) }}
                                            </h1>
                                        </div>
                                        <div class="flex flex-row gap-2">
                                            <h1
                                                class="font-normal tracking-tight text-gray-700 text-md dark:text-gray-100">
                                                Principal:
                                            </h1>
                                            <h1 class="font-semibold text-black dark:text-white text-md">
                                                {{ Str::title(Str::upper($record->principal->Name)) }}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Traning KPI Details -->
                        <div
                            class="w-full p-6 bg-white shadow-sm rounded-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 min-h-[298px]">
                            <h3 class="mb-4 text-lg font-semibold text-black dark:text-white">VESSEL PERFORMANCE</h3>

                            <div class="flex flex-col items-center justify-between w-full gap-4 sm:flex-row">
                                <!-- Gauge -->
                                <div class="flex flex-col items-center justify-center w-full md:w-2/3">
                                    <svg width="266.25" height="216.2628173828125">
                                        <g transform="translate(33.61750000000002, 24.990000000000002)">
                                            <g class="doughnut" transform="translate(99.5075, 99.5075)">
                                                <g class="subArc">
                                                    <path
                                                        d="M-69.934,60.007A7,7,0,0,1,-80.204,58.899A99.508,99.508,0,0,1,-93.385,34.366A7,7,0,0,1,-88.64,25.191L-73.262,21.039A7,7,0,0,1,-64.914,25.259A69.655,69.655,0,0,0,-56.894,40.186A7,7,0,0,1,-57.983,49.477Z"
                                                        style="fill: rgb(234, 66, 40);"></path>
                                                </g>
                                                <g class="subArc">
                                                    <path
                                                        d="M-89.273,22.846A7,7,0,0,1,-97.991,17.305A99.508,99.508,0,0,1,-84.063,-53.246A7,7,0,0,1,-73.893,-55.058L-61.247,-45.374A7,7,0,0,1,-59.522,-36.18A69.655,69.655,0,0,0,-68.806,10.846A7,7,0,0,1,-73.896,18.694Z"
                                                        style="fill: rgb(232, 143, 41);"></path>
                                                </g>
                                                <g class="subArc">
                                                    <path
                                                        d="M-72.416,-56.987A7,7,0,0,1,-73.318,-67.277A99.508,99.508,0,0,1,6.36,-99.304A7,7,0,0,1,12.831,-91.252L10.405,-75.51A7,7,0,0,1,3.169,-69.583A69.655,69.655,0,0,0,-50.445,-48.033A7,7,0,0,1,-59.77,-47.303Z"
                                                        style="fill: rgb(230, 218, 42);"></path>
                                                </g>
                                                <g class="subArc">
                                                    <path
                                                        d="M15.232,-90.882A7,7,0,0,1,23.826,-96.613A99.508,99.508,0,0,1,90.169,-42.088A7,7,0,0,1,86.211,-32.546L71.237,-27.117A7,7,0,0,1,62.564,-30.621A69.655,69.655,0,0,0,17.923,-67.31A7,7,0,0,1,12.806,-75.14Z"
                                                        style="fill: rgb(165, 227, 43);"></path>
                                                </g>
                                                <g class="subArc">
                                                    <path
                                                        d="M87.039,-30.262A7,7,0,0,1,96.192,-25.473A99.508,99.508,0,0,1,80.204,58.899A7,7,0,0,1,69.934,60.007L57.983,49.477A7,7,0,0,1,56.894,40.186A69.655,69.655,0,0,0,67.652,-16.586A7,7,0,0,1,72.065,-24.834Z"
                                                        style="fill: rgb(91, 225, 44);"></path>
                                                </g>
                                            </g>
                                            <g class="pointer" transform="translate(99.5075, 99.5075)">
                                                <path
                                                    d="M 3.3558925510266513 -13.101545892035777 L 64.81114063994157 20.942449406583588 L -3.355892551026654 3.942545892035775"
                                                    fill="#5A5A5A"></path>
                                                <circle cx="0" cy="-4.5795" r="9.159" fill="#5A5A5A"></circle>
                                            </g>
                                        </g>
                                    </svg>
                                </div>

                                <!-- Legend -->
                                <div class="flex flex-row flex-wrap w-full gap-2 space-y-2 sm:flex-col">
                                    <div class="flex items-center gap-3 mt-2 sm:mt-0">
                                        <div class="w-1 h-1 bg-green-500 sm:w-3 sm:h-3"></div>
                                        <span class="text-xs text-black dark:text-white sm:text-sm">EXCELLENT</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-1 h-1 sm:w-3 sm:h-3 bg-lime-300"></div>
                                        <span class="text-xs text-black dark:text-white sm:text-sm">ABOVE AVERAGE</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-1 h-1 bg-yellow-400 sm:w-3 sm:h-3"></div>
                                        <span class="text-xs text-black dark:text-white sm:text-sm">AVERAGE</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-1 h-1 bg-orange-400 sm:w-3 sm:h-3"></div>
                                        <span class="text-xs text-black dark:text-white sm:text-sm">BELOW AVERAGE</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-1 h-1 bg-red-500 sm:w-3 sm:h-3"></div>
                                        <span class="text-xs text-black dark:text-white sm:text-sm">POOR</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <x-filament::tabs>
                        <!-- Employment History Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'seafarers-onboard'" wire:click="$set('activeTab', 'seafarers-onboard')">
                            <x-slot name="icon">
                                <x-heroicon-o-briefcase class="w-4 h-4" />
                            </x-slot>
                            Seafarers Onboard
                        </x-filament::tabs.item>

                        <!-- Appraisal Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'vessel-documents'" wire:click="$set('activeTab', 'vessel-documents')">
                            <x-slot name="icon">
                                <x-heroicon-o-clipboard-document-check class="w-4 h-4" />
                            </x-slot>
                            Vessel Documents
                        </x-filament::tabs.item>

                        <!-- Documents Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'vessel-inspections'" wire:click="$set('activeTab', 'vessel-inspections')">
                            <x-slot name="icon">
                                <x-heroicon-o-clipboard-document class="w-4 h-4" />
                            </x-slot>
                            Vessel Inspections
                        </x-filament::tabs.item>

                        <!-- CMS Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'drill-exercise'" wire:click="$set('activeTab', 'drill-exercise')">
                            <x-slot name="icon">
                                <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4" />
                            </x-slot>
                            Drills and Exercise
                        </x-filament::tabs.item>

                        <!-- Company Courses Tab -->
                        <x-filament::tabs.item :active="$activeTab === 'safety'" wire:click="$set('activeTab', 'safety')">
                            <x-slot name="icon">
                                <x-heroicon-o-bookmark-square class="w-4 h-4" />
                            </x-slot>
                            Safety
                        </x-filament::tabs.item>

                    </x-filament::tabs>

                    <!-- Tab Content -->
                    <div>
                        @if ($activeTab === 'seafarers-onboard')
                            @livewire(\App\Filament\Resources\VesselResource\RelationManagers\SeafarersRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ])
                        @elseif ($activeTab === 'vessel-documents')
                            @livewire(\App\Filament\Resources\VesselResource\RelationManagers\DocumentsRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ])
                        @elseif ($activeTab === 'vessel-inspections')
                            {{-- @livewire(\App\Filament\Resources\VesselResource\RelationManagers\SeafarersRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ]) --}}
                        @elseif ($activeTab === 'drill-exercise')
                            @livewire(\App\Filament\Resources\VesselResource\RelationManagers\DrillexercisesRelationManager::class, [
                                'ownerRecord' => $record,
                                'pageClass' => get_class($this),
                            ])
                        @elseif ($activeTab === 'safety')
                            @livewire(\App\Filament\Resources\VesselResource\RelationManagers\SafetiesRelationManager::class, [
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

<script src="https://acrobatservices.adobe.com/view-sdk/viewer.js"></script>
