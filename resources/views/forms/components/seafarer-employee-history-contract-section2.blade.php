{{-- <div {{ $attributes }}>
    {{ $getChildComponentContainer() }}
</div> --}}

<div class="w-full overflow-x-auto border border-slate-200 rounded-xl">
    <table class="w-full divide-y divide-slate-200">
        <thead class="bg-slate-100 text-slate-800">
            <tr>
                <th class="px-4 py-2 text-start">Field</th>
                <th class="px-4 py-2 text-start">Details</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200 text-slate-800">
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Agent</td>
                <td class="px-4 py-2">{{ $getRecord()->seafarer->full_name }}</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Principal/Ship Owner</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Address of Ship Owner</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Vessel Name</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">IMO Number</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Flag</td>
                <td class="px-4 py-2">Row</td>
            </tr>
            <tr class="cursor-pointer hover:bg-slate-100 odd:bg-white even:bg-slate-50">
                <td class="px-4 py-2">Type of Vessel</td>
                <td class="px-4 py-2">Row</td>
            </tr>

        </tbody>
    </table>
</div>
