{{-- <div {{ $attributes }}>
    {{ $getChildComponentContainer() }}
</div> --}}

<div class="w-full overflow-x-auto border border-slate-200 rounded-xl">
    <table class="w-full divide-y divide-slate-200">
        <thead class="bg-slate-100 text-slate-800">
            <tr>
                <th class="px-4 py-2 text-start">Term</th>
                <th class="px-4 py-2 text-start">Details</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200 text-slate-800">
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Position</td>
                <td class="px-4 py-2">{{ $getRecord()->seafarer->full_name }}</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Contract Duration</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Basic Monthly Salary</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Overtime Pay</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Vacation Leave w/ Pay</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Service Incentive</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Supplement Bonus</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Owner's Bonus</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Hours of Work</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Point of Hire</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">CBA (Collective Agreement)</td>
                <td class="px-4 py-2">Row</td>
            </tr>
        </tbody>
    </table>
</div>
