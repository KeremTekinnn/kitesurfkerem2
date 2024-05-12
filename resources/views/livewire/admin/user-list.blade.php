<div>

    <div class="flex flex-col p-20">
        <div class="mt-10 -my-2 -mx-4 sm:-mx-6 lg:-mx-8 overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden md:rounded-lg">
                    <div class="flex space-x-4 sm:justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold">Users</h2>
                        <div class="col-12 md:col-auto">
                            <select id="filter" wire:model="filter" wire:change="filterChanged($event.target.value)">
                                <option value="all">All</option>
                                <option value="client">Client</option>
                                <option value="instructor">Instructor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <table class="min-w-full divide-y divide-gray-300" style="min-height: 200px;">
                        <thead class="bg-orange-500">
                            <tr>
                                <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Name
                                </th>
                                <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Address
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Residence
                                </th>
                                <th scope="col"
                                    class="lg:hidden py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Details
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    Birthdate
                                </th>
                                <th scope="col"
                                    class="hidden lg:table-cell py-3.5 pl-6 pr-3 text-left text-xs lg:text-sm text-gray-900">
                                    BSN Number
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
                            @forelse($users as $user)
                                <tr class="bg-white">
                                    <td class=" py-4 pl-2 lg:pl-4 lg:pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $user->name }}
                                    </td>
                                    <td class="hidden lg:table-cell py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $user->address }}
                                    </td>
                                    <td class="hidden lg:table-cell  py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $user->residence }}
                                    </td>
                                    <td class="pl-2 lg:hidden text-xs lg:text-sm sm:pl-6">
                                        <dt style="font-weight: bold !important;">Address</dt>
                                        {{ $user->address }}
                                        <dl class="lg:hidden pt-2">
                                            <dt class="" style="font-weight: bold !important;">Residence</dt>
                                            <dd>{{ $user->residence }}</dd>
                                        </dl>
                                    </td>
                                    <td class="pl-2 lg:hidden text-xs lg:text-sm sm:pl-6">
                                        <dt style="font-weight: bold !important;">Birthdate</dt>
                                        {{ \Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') }}
                                        <dl class="lg:hidden pt-2">
                                            <dt class="" style="font-weight: bold !important;">BSN Number</dt>
                                            {{ $user->bsn_number }}
                                        </dl>
                                        <dl class="lg:hidden pt-2">
                                            <dt class="" style="font-weight: bold !important;">Mobile</dt>
                                            {{ $user->mobile }}</dd>
                                        </dl>
                                    </td>
                                    <td class="hidden lg:table-cell pl-2 text-xs lg:text-sm sm:pl-6">
                                        {{ \Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') }}
                                    </td>
                                    <td
                                        class="hidden lg:table-cell py-4 pl-2 lg:pl-4 lg:pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $user->bsn_number }}
                                    </td>
                                    <td class="hidden lg:table-cell  py-4 pl-4 pr-3 text-xs lg:text-sm sm:pl-6">
                                        {{ $user->mobile }}
                                    </td>

                                    <td class="p-4 border-b border-blue-gray-50">
                                        <div class="flex flex-col lg:flex-row items-center gap-3">
                                            <x-secondary-button class="bg-sky-600"
                                                wire:click="$dispatch('openModal', {
                                component: 'admin.user-edit-modal',
                                arguments: {
                                    user: {{ json_encode($user) }}
                                }
                            })">
                                                {{ __('Edit Profile') }}
                                            </x-secondary-button>
                                            <x-secondary-button class="bg-orange-500" wire:navigate
                                                href="/user/{{ $user->id }}/reservations">
                                                {{ __('Reservations') }}
                                            </x-secondary-button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white">
                                    <td class="p-3 text-gray-700 text-center" colspan="11">No reservations found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
