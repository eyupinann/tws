<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => UserResource::make($this->user),
            'doctor' =>  DoctorResource::make($this->doctor),
            'clinic' =>  ClinicResource::make($this->clinic),
            'treatment' =>  TreatmentResource::make($this->treatment),
            'appointment_time' => $this->appointment_time,
        ];
    }
}
