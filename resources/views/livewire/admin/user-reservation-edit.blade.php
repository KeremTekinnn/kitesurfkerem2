
<div>
    @if (session()->has('error'))
    <div id="error-message" class="bg-red-500 text-white px-4 py-2 fixed bottom-0 right-0 mb-4 mr-4 rounded-md shadow-md"
         x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 3000)"
         x-show="show">
        {{ session('error') }}
    </div>
@endif
<div class="flex items-center justify-center h-screen">
    <div class="max-w-md mx-auto p-8 bg-gray-800 rounded-md shadow-md form-container" style="width: 700px; height: auto;">
        <form wire:submit="updateReservation" class="w-full max-w-xl mx-auto overflow-hidden">
            @csrf
            <div class="mb-4">
                <label for="course_id" class="block text-gray-300 text-sm font-bold mb-2">Course</label>
                <select wire:model="course_id" wire:change="getTimeSlots" id="course_id" name="course_id" required class="w-full">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
            @error('course_id')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="location_id" class="block text-gray-300 text-sm font-bold mb-2">Location</label>
            <select wire:model="location_id" name="location_id" id="location_id" required class="w-full">
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->city }}</option>
                @endforeach
            </select>
            @error('location_id')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="instructor_id" class="block text-gray-300 text-sm font-bold mb-2">instructor</label>
            <select wire:model="instructor_id" name="instructor_id" id="instructor_id" required class="w-full">
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                @endforeach
            </select>
            @error('instructor_id')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror

        </div>
    <div class="mb-4">
        <label for="date" class="block text-gray-300 text-sm font-bold mb-2">Date</label>
        <input wire:model="date" wire:change="getTimeSlots" type="date" name="date" id="startDate" required class="w-full">
        @error('date')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="time_slot" class="block text-gray-300 text-sm font-bold mb-2">Time</label>
        <select wire:model="selectedTimeSlot" id="time_slot" name="time_slot" required>
            @foreach($timeSlots as $index => $timeSlot)
            <option value="{{ implode(',', [$timeSlot['start_time'], $timeSlot['end_time']]) }}" {{ implode(',', [$timeSlot['start_time'], $timeSlot['end_time']]) == $selectedTimeSlot ? 'selected' : '' }}>{{ $timeSlot['start_time'] }} - {{ $timeSlot['end_time'] }}</option>
        @endforeach
        </select>
    </div>
    @if($course_id && $courses->find($course_id)->max_persons == 1)
    <div class="items-center justify-center overflow-hidden">
            <button class="w-full px-4 py-2 bg-orange-500 border hover:bg-sky-600 border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition transform ease-in-out duration-150 hover:scale-110 mx-auto" type="submit">Update</button>
        </div>
    </form>
    @endif

    @if ($course_id && $courses->find($course_id)->max_persons > 1)
        <div class="my-8">
            <hr>
        </div>
    <div>
        <h2 class="text-gray-300 text-lg font-bold mb-4">Duo Information</h2>
        <div class="mb-4">
            <label for="duo_name" class="block text-gray-300 text-sm font-bold mb-2">Name</label>
            <input type="text" wire:model="duo_name" id="duo_name" name="duo_name" class="w-full" required>
            @error('duo_name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="duo_email" class="block text-gray-300 text-sm font-bold mb-2">Email</label>
            <input type="email" wire:model="duo_email" id="duo_email" name="duo_email" class="w-full" required>
            @error('duo_email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
        <div class="items-center justify-center overflow-hidden">
            <button class="w-full px-4 py-2 bg-orange-500 border hover:bg-sky-600 border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition transform ease-in-out duration-150 hover:scale-110 mx-auto" type="submit">Update</button>
        </div>
    </form>
    @endif
</div>
</div>

