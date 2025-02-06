<?php
use App\Models\Seafarer;
use function Livewire\Volt\{state};

state([
    'seafarer' => fn() => Seafarer::find(6022), // Replace 1 with the actual seafarer ID
    'progress1' => 50,
    'progress2' => 25,
    'progress3' => 80,
]);

function getContractDays($record)
{
    $days = $record;
    $years = floor($days / 365);
    $months = floor(($days % 365) / 30);
    $remainingDays = ($days % 365) % 30;

    return $years ? "{$years} year/s, {$months} months, {$remainingDays} days" : "{$months} months, {$remainingDays} days";
}
?>

<div>
    <div class="w-full md:flex md:flex-wrap">
        <div class="max-w-full px-3 mt-4 sm:w-full shrink-0 md:w-4/12 md:flex-0 md:mt-4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <img class="w-full rounded-t-2xl" src="{{ asset('assets/img/bg-profile.jpg') }}" alt="profile cover image">
                <div class="flex flex-wrap justify-center -mx-3">
                    <div class="w-4/12 max-w-full px-3 flex-0 ">
                        <div class="mb-6 -mt-6 lg:mb-0 lg:-mt-16">
                            <a href="javascript:;">
                                <img class="h-auto max-w-full border-2 border-white border-solid rounded-circle"
                                    src="{{ asset('assets/img/team-2.jpg') }}" alt="profile image">
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <div class="border-black/12.5 rounded-t-2xl p-6 text-center pt-0 pb-6 lg:pt-2 lg:pb-4">
                    <div class="flex justify-between">
                        <button type="button"
                            class="hidden px-8 py-2 text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer bg-cyan-500 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Connect</button>
                        <button type="button"
                            class="block px-8 py-2 text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer bg-cyan-500 lg:hidden tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                            <i class="ni ni-collection text-2.8"></i>
                        </button>
                        <button type="button"
                            class="hidden px-8 py-2 text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer bg-slate-700 lg:block tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Message</button>
                        <button type="button"
                            class="block px-8 py-2 text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer bg-slate-700 lg:hidden tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                            <i class="ni ni-email-83 text-2.8"></i>
                        </button>
                    </div>
                </div> --}}

                <div class="flex-auto p-6 pt-0">
                    {{-- <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 flex-1-0">
                            <div class="flex justify-center">
                                <div class="grid text-center">
                                    <span class="text-lg font-bold dark:text-white">22</span>
                                    <span class="text-sm leading-normal dark:text-white opacity-80">Friends</span>
                                </div>
                                <div class="grid mx-6 text-center">
                                    <span class="text-lg font-bold dark:text-white">10</span>
                                    <span class="text-sm leading-normal dark:text-white opacity-80">Photos</span>
                                </div>
                                <div class="grid text-center">
                                    <span class="text-lg font-bold dark:text-white">89</span>
                                    <span class="text-sm leading-normal dark:text-white opacity-80">Comments</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="mt-6 text-center">
                        <h5 class="dark:text-white ">
                            {{ $seafarer->full_name }}
                            {{-- <span class="font-light">{{ $seafarer->pp_dob->format('M d, Y') }}</span> --}}
                        </h5>
                        <div
                            class="mt-6 mb-2 text-base font-semibold leading-relaxed dark:text-white/80 text-slate-700">
                            <div class="flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>{{ $seafarer->pp_pob }}, {{ $seafarer->pp_country_name }}
                            </div>
                        </div>
                        <div class="mb-2 text-base font-semibold leading-relaxed dark:text-white/80 text-slate-700">
                            <div class="flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                </svg>
                                <span class="font-bold">Rank: &nbsp;</span>{{ $seafarer->rank_name }}
                            </div>

                        </div>
                        <div class="mb-2 text-base font-semibold leading-relaxed dark:text-white/80 text-slate-700">
                            <div class="flex justify-center">
                                <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    stroke-width="1.5" stroke="currentColor" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 519 519" class="size-6">
                                    <g>
                                        <path d="M517.845,235.501c-1.374-2.18-3.77-3.501-6.345-3.501H399.265c-21.692,0-42.364,6.631-59.706,18.929l-14.034-46.78
                                    C320.474,187.313,305.27,176,287.691,176H239v-17h32.5c8.547,0,15.5-6.953,15.5-15.5v-16c0-8.547-6.953-15.5-15.5-15.5H239V95.5
                                    c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5V112h-32.5c-8.547,0-15.5,6.953-15.5,15.5v16c0,8.547,6.953,15.5,15.5,15.5H224v17
                                    h-80.5c-12.958,0-23.5,10.542-23.5,23.5V296H7.5c-2.33,0-4.528,1.083-5.947,2.931c-1.42,1.848-1.9,4.25-1.299,6.502L22.752,389.8
                                    C29.22,414.058,51.273,431,76.377,431H393.25c21.248,0,40.901-12.386,50.068-31.554l74.948-156.71
                                    C519.378,240.412,519.218,237.681,517.845,235.501z M191,143.5v-16c0-0.276,0.224-0.5,0.5-0.5h80c0.276,0,0.5,0.224,0.5,0.5v16
                                    c0,0.276-0.224,0.5-0.5,0.5h-80C191.224,144,191,143.776,191,143.5z M325.42,256H287.5c-13.509,0-24.5-10.991-24.5-24.5v-8
                                    c0-0.276,0.224-0.5,0.5-0.5h52.02L325.42,256z M215.5,223c0.276,0,0.5,0.224,0.5,0.5v32c0,0.276-0.224,0.5-0.5,0.5H183v-33H215.5z
                                        M168,256h-33v-33h33V256z M135,271h80.5c8.547,0,15.5-6.953,15.5-15.5v-32c0-8.547-6.953-15.5-15.5-15.5H135v-8.5
                                    c0-4.687,3.813-8.5,8.5-8.5h144.191c10.742,0,20.055,6.812,23.324,17H263.5c-8.547,0-15.5,6.953-15.5,15.5v8
                                    c0,21.78,17.72,39.5,39.5,39.5h29.894l-25,25H135V271z M429.786,392.974C423.096,406.962,408.755,416,393.25,416H76.377
                                    c-18.32,0-34.412-12.363-39.133-30.065L17.262,311H295.5c1.989,0,3.897-0.79,5.303-2.197l35.882-35.882
                                    C353.401,256.206,375.626,247,399.265,247H499.6L429.786,392.974z" />
                                        <path
                                            d="M127.5,336c-12.958,0-23.5,10.542-23.5,23.5s10.542,23.5,23.5,23.5s23.5-10.542,23.5-23.5S140.458,336,127.5,336z
                                        M127.5,368c-4.687,0-8.5-3.813-8.5-8.5s3.813-8.5,8.5-8.5s8.5,3.813,8.5,8.5S132.187,368,127.5,368z" />
                                        <path
                                            d="M271.5,336c-12.958,0-23.5,10.542-23.5,23.5s10.542,23.5,23.5,23.5s23.5-10.542,23.5-23.5S284.458,336,271.5,336z
                                        M271.5,368c-4.687,0-8.5-3.813-8.5-8.5s3.813-8.5,8.5-8.5s8.5,3.813,8.5,8.5S276.187,368,271.5,368z" />
                                        <path
                                            d="M199.5,336c-12.958,0-23.5,10.542-23.5,23.5s10.542,23.5,23.5,23.5s23.5-10.542,23.5-23.5S212.458,336,199.5,336z
                                        M199.5,368c-4.687,0-8.5-3.813-8.5-8.5s3.813-8.5,8.5-8.5s8.5,3.813,8.5,8.5S204.187,368,199.5,368z" />
                                        <path d="M404.448,389.169c1.044,0.499,2.146,0.736,3.23,0.736c2.798,0,5.483-1.573,6.771-4.266l31.817-66.526
                                    c1.787-3.737,0.207-8.215-3.53-10.002c-3.736-1.786-8.215-0.207-10.002,3.53l-31.817,66.526
                                    C399.13,382.904,400.711,387.382,404.448,389.169z" />
                                        <path d="M449.836,294.267c1.044,0.499,2.146,0.736,3.23,0.736c2.798,0,5.483-1.573,6.771-4.266l7.652-16
                                    c1.787-3.737,0.207-8.215-3.53-10.002c-3.736-1.787-8.215-0.207-10.002,3.53l-7.652,16
                                    C444.519,288.001,446.099,292.48,449.836,294.267z" />
                                    </g>
                                </svg><span class="font-bold">Vessel: &nbsp;</span>{{ $seafarer->vessel_name ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-full px-3 mt-4 sm:w-full shrink-0 md:w-8/12 md:flex-0 md:mt-4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="px-3 text-left basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-blue-500 to-violet-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-12">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                                </svg>

                            </div>
                            <h1 class="mr-2 text-xl font-semibold leading-normal capitalize">Training KPI</span>
                        </div>
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="w-full">
                                        <div class="flex mb-2">
                                            <span class="mr-2 text-sm font-semibold leading-normal capitalize">IMA
                                                Company Requirements KPI</span>
                                            <span
                                                class="ml-auto text-sm font-semibold leading-normal">{{ $progress1 }}%</span>
                                        </div>
                                        <div>
                                            <div class="h-0.75 text-xs flex overflow-visible rounded-lg bg-gray-200">
                                                <div
                                                    class="{{ $progress1 < 50 ? 'bg-red-500' : 'bg-green-500' }} w-{{ $progress1 }} transition-width duration-600 ease rounded-1 -mt-0.4 -ml-px flex h-1.5 flex-col justify-center overflow-hidden whitespace-nowrap text-center text-white">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <div class="flex mb-2">
                                            <span
                                                class="mr-2 text-sm font-semibold leading-normal capitalize">Ship/Class,
                                                Flag Requirements</span>
                                            <span
                                                class="ml-auto text-sm font-semibold leading-normal">{{ $progress2 }}%</span>
                                        </div>
                                        <div>
                                            <div class="h-0.75 text-xs flex overflow-visible rounded-lg bg-gray-200">
                                                <div
                                                    class="{{ $progress2 < 50 ? 'bg-red-500' : 'bg-green-500' }} w-25 transition-width duration-600 ease rounded-1 -mt-0.4 -ml-px flex h-1.5 flex-col justify-center overflow-hidden whitespace-nowrap text-center text-white">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <div class="flex mb-2">
                                            <span class="mr-2 text-sm font-semibold leading-normal capitalize">Owner
                                                Recommended Trainings</span>
                                            <span
                                                class="ml-auto text-sm font-semibold leading-normal">{{ $progress3 }}%</span>
                                        </div>
                                        <div>
                                            <div class="h-0.75 text-xs flex overflow-visible rounded-lg bg-gray-200">
                                                <div
                                                    class="{{ $progress3 < 50 ? 'bg-red-500' : 'bg-green-500' }} w-{{ $progress3 }} transition-width duration-600 ease rounded-1 -mt-0.4 -ml-px flex h-1.5 flex-col justify-center overflow-hidden whitespace-nowrap text-center text-white">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mt-8 md:flex md:flex-wrap">
        <div
            class="flex flex-col w-full p-4 m-4 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="h-[400px] w-full rounded-lg relative group flex flex-col p-4 overflow-hidden group">
                <div class="relative z-0 flex-grow w-full overflow-hidden">

                    <div class="absolute left-0 z-0 flex w-full h-full">
                        <div class="absolute left-0 right-0 content-scroll">
                            <!-- Timeline line with fade -->
                            <div class="fixed left-6 w-[1px] h-[calc(100%-153px)] "></div>

                            <!-- Content boxes -->
                            <div class="pl-16">
                                @foreach ($seafarer->employmentHistory()->get() as $s)
                                    <div class="h-[304px] flex items-center justify-center">
                                        <div
                                            class="relative z-30 flex flex-col w-full p-3 mr-6 bg-blue-900 border border-blue-600 rounded-md border-opacity-40 isolate">
                                            <div
                                                class="absolute -left-[44px] top-1/2 -translate-y-1/2 h-[1px] bg-blue-600 w-[44px] opacity-70">
                                            </div>
                                            <div
                                                class="absolute -left-[45px] top-1/2 -translate-y-1/2 h-[10px] w-[10px] bg-purple-600 border-blue-600 border rounded-full">
                                            </div>
                                            <div class="flex flex-col space-y-3">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-3">
                                                        <div
                                                            class="relative w-12 h-12 overflow-hidden border border-blue-600 rounded-md border-opacity-40">
                                                            <div
                                                                class="absolute top-3/4 right-0 -translate-y-1/2 w-5 h-5 bg-purple-600 blur-[13px]">
                                                            </div>
                                                            <svg class="p-[7px] isolate"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 22 22">
                                                                <path fill="white"
                                                                    d="M20 19H2v-2h2V9H2V7h1V6h2V5h2V4h2V3h4v1h2v1h2v1h2v1h1v2h-2v8h2m-3-8V7h-2V6h-2V5H9v1H7v1H5v2m3 8v-6H6v6m6 0v-6h-2v6m6 0v-6h-2v6Z" />
                                                            </svg>
                                                        </div>
                                                        <div class="flex flex-col items-start justify-start">
                                                            <div class="text-xl text-white">{{ $s->rank_name }}
                                                            </div>
                                                            <div class="text-gray-200 text-md">{{ $s->vessel_name }} -
                                                                {{ $s->vessel_type_name }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="italic font-semibold text-md text-gray-50">
                                                        {{ getContractDays($s->service_days) }}</div>
                                                </div>
                                                <div
                                                    class="flex items-center pl-3 space-x-2 border-l-2 border-purple-600/30">
                                                    <div class="text-sm italic text-gray-300">
                                                        <div class="flex flex-col">
                                                            <div class="text-sm text-gray-100"><span
                                                                    class="font-semibold">Sign
                                                                    On:</span>{{ ' ' . $s->on_date }}</div>
                                                            <div class="text-sm text-gray-100"><span
                                                                    class="font-semibold">Sign
                                                                    Off:</span>{{ ' ' . $s->off_date }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
