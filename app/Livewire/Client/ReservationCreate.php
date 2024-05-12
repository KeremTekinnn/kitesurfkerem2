<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Course;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationCreate extends Component
{
    public $courses;
    public $locations;
    public $course_id;
    public $location_id;
    public $date;
    public $error;
    public $timeSlots = [];

    public $selectedTimeSlot;

    protected $rules = [
        'course_id' => 'required|exists:courses,id',
        'location_id' => 'required|exists:locations,id',
        'date' => 'required',
        'duo_name' => 'nullable|string|unique:users',
        'selectedTimeSlot' => 'required|integer|min:0|max:23',
    ];

    public function mount()
    {
        $this->courses = Course::all();
        $this->locations = Location::all();
    }

    public function getTimeSlots()
    {
        if (!$this->course_id || !$this->location_id || !$this->date) {
            $this->timeSlots = [];
            return;
        }

        // Find the course with the given course_id
        $course = Course::find($this->course_id);

        // Check if the course exists
        if (!$course) {
            throw new \Exception('Course not found');
        }

        // Get the duration of the selected course
        $courseDuration = $course->duration;

        $endTime = Carbon::createFromFormat('H:i', '18:00');
        $interval = $courseDuration * 60; // convert course duration to minutes

        $this->timeSlots = [];
        while (true) {
            $startTime = Carbon::createFromFormat('H:i', '08:00')->addMinutes($interval * count($this->timeSlots));
            $endSlotTime = $startTime->copy()->addMinutes($interval);

            // Check if the end time exceeds '18:00'
            if ($endSlotTime->format('H:i') > '18:00') {
                break;
            }

            $instructor = $this->getAvailableInstructor($this->date, $startTime->format('H:i'), $endSlotTime->format('H:i'));

            // Only add the time slot if an instructor is available
            if ($instructor) {
                $this->timeSlots[] = [
                    'start_time' => $startTime->format('H:i'),
                    'end_time' => $endSlotTime->format('H:i'),
                    'instructor_id' => $instructor, // Change 'instructor' to 'instructor_id'
                ];
            }
        }
    }

    public function getAvailableInstructor($date, $start_time, $end_time)
    {
        // Get all available instructors
        $availableInstructors = DB::table('users')
            ->where('role', 'instructor')
            ->whereNotIn('id', function ($query) use ($date, $start_time, $end_time) {
                $query->select('instructor_id')
                    ->from('reservations')
                    ->where('date', $date)
                    ->where(function ($query) use ($start_time, $end_time) {
                        $query->where('start_time', $start_time)
                            ->orWhere('end_time', $end_time);
                    });
            })
            ->get()
            ->shuffle(); // Shuffle the instructors

        // If no instructors are found, return null
        if ($availableInstructors->isEmpty()) {
            return null;
        }

        // If there are instructors, return the ID of the next one
        $nextInstructorIndex = count($this->timeSlots) % $availableInstructors->count();
        return $availableInstructors[$nextInstructorIndex]->id;
    }

    public function render()
    {
        return view('livewire.client.reservation-create', [
            'courses' => $this->courses,
            'locations' => $this->locations,
            'timeSlots' => $this->timeSlots,
        ]);
    }
}
