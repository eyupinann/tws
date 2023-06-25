<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Repositories\DoctorRepository;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Custom\Response;

/**
 * @group Doctors
 *
 */
class DoctorController extends Controller
{
    private $doctorRepository = null;
    private $response = null;

    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
        $this->response = new Response();
    }

    /**
     * List Doctors
     *
     * List the doctors of the user.
     *
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function index(DoctorRepository $doctorRepository)
    {
        return $this->response->withData(
            true,
            "Doctors list is fetched successfully.",
            [
                'doctors'  => DoctorResource::collection($doctorRepository->all())
            ]
        );
    }

    /**
     * Create Doctor
     *
     * Create a doctor for user with given parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function store(Request $request,DoctorRepository $doctorRepository)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $doctor   = $doctorRepository->create($data);

        return $this->response->withData(
            true,
            "Doctor is successfully created.",
            [
                'doctor'   => DoctorResource::make($doctor),
            ]
        );
    }

    /**
     * View Doctor
     *
     * View the doctor details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function show(Doctor $doctor)
    {
        return $this->response->withData(
            true,
            "Doctor is fetched successfully.",
            [
                'doctor'   => new DoctorResource($doctor),
            ]
        );
    }

    /**
     * Update Doctor
     *
     * Update the doctor with given paramaters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function update(Doctor $doctor, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $doctor = $this->doctorRepository->update($doctor->id, $data);

        return $this->response->withData(
            true,
            "Doctor successfully updated.",
            [
                'doctor'   => DoctorResource::make($doctor),
            ]
        );
    }

    /**
     * Delete Doctor
     *
     * Delete the given doctor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function destroy(Doctor $doctor,DoctorRepository $doctorRepository)
    {
        $doctorRepository->delete($doctor->id);

        return $this->response->withoutData(
            true,
            "Doctor is successfully deleted.",
        );
    }
}
