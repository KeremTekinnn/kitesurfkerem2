<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\Course;
use Carbon\Carbon;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\User;
use App\Mail\ReservationUpdated;
use Illuminate\Support\Facades\Mail;

class ClientReservationEdit extends Component
{
    public $course;
    public $course_id;
    public $location_id;
    public $date;
    public $selectedTimeSlot;
    public $duo_name;
    public $duo_email;
    public $courses;
    public $locations;
    public $reservation;
    public $timeSlots = [];

    protected $dates = ['date'];

    public function mount($reservationId)
    {
        $this->reservation = Reservation::find($reservationId);
        $this->courses = Course::all();
        $this->locations = Location::all();
        $this->course_id = $this->reservation->course_id;
        $this->location_id = $this->reservation->location_id;
        $this->duo_name = $this->reservation->duo_name;
        $this->duo_email = $this->reservation->duo_email;
        $this->date = Carbon::parse($this->reservation->date)->format('Y-m-d');
        $this->selectedTimeSlot = implode(',', [substr($this->reservation->start_time, 0, 5), substr($this->reservation->end_time, 0, 5)]);
        $this->getTimeSlots();
        $this->course = Course::find($this->reservation->course_id);
        session()->put('previous_page', url()->previous());
    }

    public function updatedCourseId()
    {
        // Kurs ID'si güncellendiğinde zaman dilimlerini yeniden al
        $this->getTimeSlots();

        // Seçili zaman dilimini ilk zaman dilimine ayarla
        if (!empty($this->timeSlots)) {
            $this->selectedTimeSlot = implode(',', [$this->timeSlots[0]['start_time'], $this->timeSlots[0]['end_time']]);
        }
            // Kursu güncelle
        $this->course = Course::find($this->course_id);
    }

    private function updateDuoInfoRequirement()
    {
        $course = Course::find($this->course_id);

        // Gereksinimleri dinamik olarak güncelle
        $rules = $this->rules;
        if ($course->max_persons > 1) {
            $rules['duo_name'] = 'required';
            $rules['duo_email'] = 'required|email';
        } else {
            unset($rules['duo_name']);
            unset($rules['duo_email']);
        }

        // Yeni kuralları ayarla
        $this->rules = $rules;
    }

    public function getTimeSlots()
    {
        $this->timeSlots = []; // reset timeSlots array

        if (!empty($this->timeSlots)) {
            $this->selectedTimeSlot = implode(',', [$this->timeSlots[0]['start_time'], $this->timeSlots[0]['end_time']]);
        }

        $startTime = Carbon::createFromTime(8, 0); // start at 08:00
        $endTime = Carbon::createFromTime(18, 0); // end at 18:00
        $course = Course::find($this->course_id); // get the selected course
        $courseDuration = $course->duration; // get duration of the selected course

        while ($startTime->lessThan($endTime)) {
            $endInterval = $startTime->copy()->addMinutes($courseDuration * 60); // calculate end of current interval

            // add current interval to timeSlots array
            $this->timeSlots[] = [
                'start_time' => $startTime->format('H:i'),
                'end_time' => $endInterval->format('H:i'),
            ];

            // set start time for next interval
            $startTime = $endInterval;
        }
    }

    public function updateReservation()
    {
        $course = Course::find($this->course_id);

        $rules = [
            'course_id' => 'required',
            'location_id' => 'required',
            'date' => 'required|date',
            'selectedTimeSlot' => 'required',
        ];

        if ($course->max_persons > 1) {
            $rules['duo_name'] = 'required';
            $rules['duo_email'] = 'required|email';
        }

        $this->validate($rules);

        list($start_time, $end_time) = explode(',', $this->selectedTimeSlot);

        $loggedInInstructorId = auth()->user()->id;

        // Check if the selected instructor has another reservation at the selected date and time
        $existingReservation = Reservation::where('instructor_id', $loggedInInstructorId)
        ->where('date', $this->date)
        ->where('start_time', '<=', $start_time)
        ->where('end_time', '>=', $end_time)
        ->where('id', '!=', $this->reservation->id) // Exclude the current reservation
        ->first();

        if ($existingReservation) {
            // If there is, return an error message
            session()->flash('error', 'You already have a reservation for the selected date and time.');
            return;
        }

        // If the selected course's max_persons is 1, remove the duo's info
        if ($course->max_persons == 1) {
            $this->duo_name = null;
            $this->duo_email = null;
        }

        $this->reservation->update([
            'course_id' => $this->course_id,
            'location_id' => $this->location_id,
            'date' => $this->date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'duo_name' => $this->duo_name,
            'duo_email' => $this->duo_email,
        ]);

            // Send an email to the instructor and the client
            $client = User::find($this->reservation->client_id); // get the client
            $client_email = $client ? $client->email : null; // get the client's email if the client exists

            // Send an email to the instructor and the client
            $emails = [];
            if ($this->duo_email) {
                $emails[] = $this->duo_email;
            }
            if ($client_email) {
                $emails[] = $client_email;
            }

            foreach ($emails as $email) {
                Mail::to($email)->send(new ReservationUpdated($this->reservation));
            }


        return redirect()->to(session()->get('previous_page'));
    }

    public function render()
    {
        return view('livewire.instructor.client-reservation-edit', [
            'courses' => $this->courses,
            'locations' => $this->locations,
            'timeSlots' => $this->timeSlots,
        ]);
    }
}
