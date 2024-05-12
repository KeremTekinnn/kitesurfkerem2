<div>
    <div class="flex flex-col p-20">
        <div class="mt-10 -my-2 -mx-4 sm:-mx-6 lg:-mx-8 overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden md:rounded-lg">
                    <div class="flex space-x-4 sm:justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold">Clients</h2>
                    </div>
                    <table class="min-w-full divide-y divide-gray-300" style="min-height: 200px;">
                        <thead class="bg-orange-500">
                            <tr>
                                <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Name
                                </th>
                                <th scope="col"
                                    class="gidden lg-table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Address
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Residence
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Birthdate
                                </th>
                                <th scope="col"
                                    class="lg:hidden py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Personal Info
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Mobile
                                </th>
                                <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Actions
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                                <tr class="bg-white">
                                    <td class="py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $client->name }}
                                    </td>
                                    <td class="pl-2 lg:hidden text-xs lg:text-sm sm:pl-6">
                                        <dt style="font-weight: bold !important;">Address</dt>
                                        {{ $client->address }}
                                        <dl class="lg:hidden pt-2">
                                            <dt class="" style="font-weight: bold !important;">Residence</dt>
                                            {{ $client->residence }}
                                        </dl>
                                    </td>
                                    <td class="hidden lg:table-cell py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $client->address }}
                                    </td>
                                    <td class="hidden lg:table-cell py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $client->residence }}
                                    </td>
                                    <td class="pl-2 lg:hidden text-xs lg:text-sm sm:pl-6">
                                        <dt style="font-weight: bold !important;">Birthdate</dt>
                                        {{ \Carbon\Carbon::parse($client->birhtdate)->format('d-m-Y') }}
                                        <dl class="lg:hidden pt-2">
                                            <dt class="" style="font-weight: bold !important;">Mobile</dt>
                                            {{ $client->mobile }}
                                        </dl>
                                    </td>
                                    <td class="hidden lg:table-cell py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ \Carbon\Carbon::parse($client->birhtdate)->format('d-m-Y') }}
                                    </td>

                                    <td class="hidden lg:table-cell py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $client->mobile }}
                                    </td>
                                    <td class="py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        <x-secondary-button class="bg-sky-600"
                                            wire:click="$dispatch('openModal', {
                        component: 'instructor.client-edit-modal',
                        arguments: {
                            user: {{ json_encode($client) }}
                        }
                    })">
                                            {{ __('Edit Profile') }}
                                        </x-secondary-button>
                                        <x-secondary-button class="bg-orange-500" wire:navigate
                                            href="/client/{{ $client->id }}/reservations">
                                            {{ __('Reservations') }}
                                        </x-secondary-button>
                                    </td>
                                @empty
                                <tr class="bg-white">
                                    <td class="p-3 text-gray-700 text-center" colspan="7">No clients found</td>
                                </tr>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
