<?php

namespace App\Http\Controllers\Treatment;

use App\Http\Controllers\Controller;
use App\Http\Repositories\TreatmentRepository;
use App\Http\Resources\TreatmentResource;
use App\Models\Treatment;
use Illuminate\Http\Request;
use App\Http\Custom\Response;

/**
 * @group Treatments
 *
 */
class TreatmentController extends Controller
{
    private $treatmentRepository = null;
    private $response = null;

    public function __construct(TreatmentRepository $treatmentRepository)
    {
        $this->treatmentRepository = $treatmentRepository;
        $this->response = new Response();
    }

    /**
     * List Treatments
     *
     * List the treatments of the user.
     *
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function index(TreatmentRepository $treatmentRepository)
    {
        return $this->response->withData(
            true,
            "Treatment list is fetched successfully.",
            [
                'treatment'  => TreatmentResource::collection($treatmentRepository->all())
            ]
        );
    }

    /**
     * Create Role
     *
     * Create a roles for user with given parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function store(Request $request,TreatmentRepository $treatmentRepository)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $treatment     = $treatmentRepository->create($data);

        return $this->response->withData(
            true,
            "Treatment is successfully created.",
            [
                'role'   => TreatmentResource::make($treatment),
            ]
        );
    }

    /**
     * View Treatment
     *
     * View the treatment details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function show(Treatment $treatment)
    {
        return $this->response->withData(
            true,
            "Treatment is fetched successfully.",
            [
                'treatment'   => new TreatmentResource($treatment),
            ]
        );
    }

    /**
     * Update Treatment
     *
     * Update the treatment with given paramaters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function update(Treatment $treatment, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $role = $this->treatmentRepository->update($treatment->id, $data);

        return $this->response->withData(
            true,
            "Treatment successfully updated.",
            [
                'treatment'   => TreatmentResource::make($role),
            ]
        );
    }

    /**
     * Delete Treatment
     *
     * Delete the given treatment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function destroy(Treatment $treatment,TreatmentRepository $treatmentRepository)
    {
        $treatmentRepository->delete($treatment->id);


        return $this->response->withoutData(
            true,
            "Treatment is successfully deleted.",
        );
    }
}
