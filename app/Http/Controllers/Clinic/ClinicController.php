<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ClinicRepository;
use App\Http\Resources\ClinicResource;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Custom\Response;

/**
 * @group Clinics
 *
 */
class ClinicController extends Controller
{
    private $clinicRepository = null;
    private $response = null;

    public function __construct(ClinicRepository $clinicRepository)
    {
        $this->clinicRepository = $clinicRepository;
        $this->response = new Response();
    }

    /**
     * List Clinics
     *
     * List the clinics of the user.
     *
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function index(ClinicRepository $clinicRepository)
    {
        return $this->response->withData(
            true,
            "Clinic list is fetched successfully.",
            [
                'clinics'  => ClinicResource::collection($clinicRepository->all())
            ]
        );
    }

    /**
     * Create Clinic
     *
     * Create a clinics for user with given parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function store(Request $request,ClinicRepository $clinicRepository)
    {
        $data = $request->validate([
            'name' => 'required',
            'opening_hour' => 'required',
            'closing_hour' => 'required',
        ]);

        $clinic     = $clinicRepository->create($data);

        return $this->response->withData(
            true,
            "Clinic is successfully created.",
            [
                'clinic'   => ClinicResource::make($clinic),
            ]
        );
    }

    /**
     * View Clinic
     *
     * View the clinic details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function show(Clinic $clinic)
    {
        return $this->response->withData(
            true,
            "Clinic list is fetched successfully.",
            [
                new ClinicResource($clinic)
            ]
        );
    }

    /**
     * Update Clinic
     *
     * Update the clinic with given paramaters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function update(Clinic $clinic, Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable',
            'opening_hour' => 'nullable',
            'closing_hour' => 'nullable',
        ]);

        $clinic = $this->clinicRepository->update($clinic->id, $data);

        return $this->response->withData(
            true,
            "Clinic successfully updated.",
            [
                'clinic'   => ClinicResource::make($clinic),
            ]
        );
    }

    /**
     * Delete Clinic
     *
     * Delete the given clinic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function destroy(Clinic $clinic,ClinicRepository $clinicRepository)
    {
        $clinicRepository->delete($clinic->id);

        return $this->response->withoutData(
            true,
            "Clinic is successfully deleted.",
        );
    }
}
