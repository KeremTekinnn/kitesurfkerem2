<div>
    <div class="flex flex-col p-20">
        <div class="mt-10 -my-2 -mx-4 sm:-mx-6 lg:-mx-8 overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden md:rounded-lg">
                    <div class="flex space-x-4 sm:justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold">Reservations</h2>
                        <div class="col-12 md:col-auto">
                            <select id="filter" wire:model="filter" wire:change="filterChanged($event.target.value)">
                                <option value="all">All</option>
                                <option value="today">Today</option>
                                <option value="thisWeek">This Week</option>
                                <option value="thisMonth">This Month</option>
                            </select>
                        </div>
                    </div>
                    <table class="min-w-full divide-y divide-gray-300" style="min-height: 200px;">
                        <thead class="bg-orange-500">
                            <tr>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Date</th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Client</th>
                                <th scope="col"
                                    class="lg:hidden py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Date&Time</th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Course</th>
                                <th scope="col"
                                    class="lg:hidden py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">Course
                                    Info</th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Location</th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Start Time</th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    End Time</th>
                                <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $reservation)
                                <tr class="bg-white">
                                    <td class="hidden lg:table-cell  py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('d-m-Y') }}</td>
                                    <td class="pl-2 lg:hidden text-xs lg:text-sm sm:pl-6">
                                        <dt style="font-weight: bold !important;">Date</dt>
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('d-m-Y') }}
                                        <dl class="lg:hidden pt-2">
                                            <dt class="" style="font-weight: bold !important;">Start</dt>
                                            <dd>{{ $reservation->start_time }}</dd>
                                            <dt class="pt-2" style="font-weight: bold !important;">End</dt>
                                            <dd>{{ $reservation->end_time }}</dd>
                                        </dl>
                                    </td>
                                    <td class="pl-2 lg:hidden text-xs lg:text-sm sm:pl-6">
                                        <dt style="font-weight: bold !important;">Client</dt>
                                        {{ $reservation->client->name }}
                                        <dl class="lg:hidden pt-2">
                                            <dt class="" style="font-weight: bold !important;">Location</dt>
                                            {{ $reservation->location->meetingplace }}
                                            <dt style="font-weight: bold !important;">Course</dt>
                                            {{ $reservation->course->name }}
                                        </dl>
                                    </td>
                                    <td
                                        class="hidden lg:table-cell whitespace-nowrap py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $reservation->client->name }}</td>
                                    <td
                                        class="hidden lg:table-cell whitespace-nowrap py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $reservation->course->name }}</td>
                                    <td
                                        class="hidden lg:table-cell whitespace-nowrap py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $reservation->location->meetingplace }}</td>
                                    <td
                                        class="hidden lg:table-cell whitespace-nowrap py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $reservation->start_time }}</td>
                                    <td
                                        class="hidden lg:table-cell whitespace-nowrap py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $reservation->end_time }}</td>
                                    <td class="p-4 border-b border-blue-gray-50">
                                        <div class="flex items-center gap-3">
                                            <button wire:click="sendIllnessMail({{ $reservation->id }})"
                                                class="px-2 py-1 text-white bg-red-500 rounded"><i
                                                    class="fas fa-medkit"></i></button>
                                            <button wire:click="sendBadWeatherMail({{ $reservation->id }})"
                                                class="px-2 py-1 text-white bg-blue-500 rounded"><i
                                                    class="fas fa-cloud"></i></button>
                                            <a href="{{ route('client.reservation.edit', $reservation->id) }}"
                                                class="px-2 py-1 text-white bg-green-500 rounded"><i
                                                    class="fas fa-pen"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white">
                                    <td class="p-3 text-gray-700 text-center" colspan="7">No reservations found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $reservations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
