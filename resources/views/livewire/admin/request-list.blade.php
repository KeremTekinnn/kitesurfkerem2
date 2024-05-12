<div>

    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col p-20">
        <div class="mt-10 -my-2 -mx-4 sm:-mx-6 lg:-mx-8 overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden md:rounded-lg">
                    <div class="flex space-x-4 sm:justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold">Requests</h2>
                    </div>
                    <table class="min-w-full divide-y divide-gray-300" style="min-height: 200px;">
                        <thead class="bg-orange-500">
                            <tr>
                                <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Client
                                </th>
                                <th scope="col"
                                    class="lg:hidden py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    New Times
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    New Date
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    New Start Time
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    New End Time
                                </th>
                                <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Reason
                                </th>
                                <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Actions
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $request)
                                <tr class="bg-white">
                                    <td class="py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">

                                        {{ $request->reservation->client->name }}
                                    </td>
                                    <td class=" py-4 pl-2 lg:pl-4 lg:pr-3 text-xs lg:text-sm sm:pl-6">
                                        <dl class="lg:hidden pt-2">
                                            <dt class="" style="font-weight: bold !important;">Date</dt>
                                            <dd>{{ \Carbon\Carbon::parse($request->new_date)->format('d-m-Y') }}</dd>
                                            <dt class="" style="font-weight: bold !important;">Start</dt>
                                            <dd>{{ $request->new_start_time }}</dd>
                                            <dt class="pt-2" style="font-weight: bold !important;">End</dt>
                                            <dd>{{ $request->new_end_time }}</dd>
                                        </dl>
                                        <div class="hidden lg:block">
                                            {{ \Carbon\Carbon::parse($request->new_date)->format('d-m-Y') }}
                                        </div>
                                    </td>
                                    <td
                                        class="hidden lg:table-cell py-4 pl-2 lg:pl-4 lg:pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $request->new_start_time }}
                                    </td>
                                    <td
                                        class="hidden lg:table-cell py-4 pl-2 lg:pl-4 lg:pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $request->new_end_time }}
                                    </td>
                                    <td class="py-4 pl-2 lg:pl-4 lg:pr-3 text-xs lg:text-sm sm:pl-6">

                                        {{ $request->reason }}
                                    </td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <div class="flex flex-col lg:flex-row items-center gap-3">
                                            <button wire:click="acceptRequest({{ $request->id }})"
                                                class="px-2 py-1 text-white bg-green-500 rounded">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button wire:click="cancelRequest({{ $request->id }})"
                                                class="px-2 py-1 text-white bg-red-500 rounded">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white">
                                    <td class="p-3 text-gray-700 text-center" colspan="11">No requests found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $requests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
