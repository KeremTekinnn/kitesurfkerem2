<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Request;
use App\Models\Reservation;
use LivewireUI\Modal\ModalComponent;
use Carbon\Carbon;

class ReservationCancelModal extends ModalComponent
{
    public $reservation;
    public $timeSlots = [];
    public $date;
    public $reason = '';
    public $selectedTimeSlot = 0;

    public function mount(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->date = $reservation->date;
        $this->timeSlots = $this->getTimeSlots();
    }

    public function getTimeSlots()
    {
        $course = $this->reservation->course;

        $courseDuration = $course->duration;

        $endTime = Carbon::createFromFormat('H:i', '18:00');
        $interval = $courseDuration * 60;

        $timeSlots = [];
        while (true) {
            $startTime = Carbon::createFromFormat('H:i', '08:00')->addMinutes($interval * count($timeSlots));
            $endSlotTime = $startTime->copy()->addMinutes($interval);

            if ($endSlotTime > $endTime) {
                break;
            }

            $timeSlots[] = [
                'start_time' => $startTime->format('H:i'),
                'end_time' => $endSlotTime->format('H:i'),
            ];
        }

        return $timeSlots;
    }
    public function submit()
    {
        $validatedData = $this->validate([
            'selectedTimeSlot' => 'required',
            'reason' => 'required',
        ]);

        // Check if a request with the same parameters already exists
        $existingRequest = Request::where('reservation_id', $this->reservation['id'])->first();

        if ($existingRequest) {
            $this->addError('error', 'You can send only 1 cancel request per reservation.');
            return;
        }

        // Find the selected time slot from the timeSlots array
        $selectedTimeSlot = $this->timeSlots[$validatedData['selectedTimeSlot']];

        // Create a new request
        Request::create([
            'reservation_id' => $this->reservation['id'],
            'new_date' => $this->date,
            'new_start_time' => $selectedTimeSlot['start_time'],
            'new_end_time' => $selectedTimeSlot['end_time'],
            'reason' => $validatedData['reason'],
        ]);

        // Dispatch event and close modal
        $this->dispatch('requestSended');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.client.reservation-cancel-modal' , [
            'reservation' => $this->reservation,
            'timeSlots' => $this->timeSlots,
            'selectedTimeSlot' => $this->selectedTimeSlot,
            'reason' => $this->reason,
            'date' => $this->date,
        ]);
    }
}
