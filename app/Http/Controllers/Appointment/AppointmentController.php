<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Repositories\AppointmentRepository;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Hasokeyk\parampos_php\parampos_php;
use Illuminate\Http\Request;
use App\Http\Custom\Response;
/**
 * @group Appointments
 *
 */
class AppointmentController extends Controller
{
    private $appointmentRepository = null;
    private $response = null;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
        $this->response = new Response();
    }

    /**
     * List Appointment
     *
     * List the appointments of the user.
     *
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function index(AppointmentRepository $appointmentRepository)
    {
        return $this->response->withData(
            true,
            "Appointment list is fetched successfully.",
            [
                'appointments'  => AppointmentResource::collection($appointmentRepository->all())
            ]
        );
    }

    /**
     * Create Appointment
     *
     * Create a appointment for user with given parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function store(Request $request,  AppointmentRepository $appointmentRepository)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:doctors,id',
            'clinic_id' => 'required',
            'treatment_id' => 'required',
            'appointment_time' => 'required',
        ]);

        $parampos = new parampos_php(true);

        $order_id = rand(111111,999999);

        if(isset($_GET['action'])){
            if ($_POST['TURKPOS_RETVAL_Sonuc_Str'] == 'Odeme Islemi Basarili1'){
                $appointment  = $appointmentRepository->create($data);
                return $this->response->withData(
                    true,
                    "Appointment is successfully created.",
                    [
                        'appointment'   => AppointmentResource::make($appointment),
                    ]
                );
            }else{
                return $this->response->withoutData(
                    false,
                    "Appointment is not successfully created.",
                );

            }

        }else{

            $pay_response = $parampos->pay_3d('Test','4546711234567894','12','26','000','','','1',$order_id);
            if ($pay_response->Pos_OdemeResult->Sonuc > 0) {
                echo "<script>window.top.location='".$pay_response->Pos_OdemeResult->UCD_URL."'</script>";
            } else {
                return 'hata oluştu';
            }

        }

    }

    /**
     * View Appointments
     *
     * View the appointments details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function show( Appointment $appointment)
    {
        return $this->response->withData(
            true,
            "Appointment is fetched successfully.",
            [
                'appointment'   => new AppointmentResource($appointment),
            ]
        );
    }

    /**
     * Update Appointment
     *
     * Update the appointment with given paramaters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function update(Appointment $appointment, Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'doctor_id' => 'required',
            'clinic_id' => 'required',
            'treatment_id' => 'required',
            'appointment_time' => 'required',
        ]);

        $appointment = $this->appointmentRepository->update($appointment->id, $data);

        return $this->response->withData(
            true,
            "Appointment successfully updated..",
            [
                'appointment'   => AppointmentResource::make($appointment),
            ]
        );
    }

    /**
     * Delete Appointment
     *
     * Delete the given appointment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function destroy(Appointment $appointment,  AppointmentRepository $appointmentRepository)
    {
        $appointmentRepository->delete($appointment->id);

        return $this->response->withoutData(
            true,
            "Appointment is successfully deleted.",
        );
    }
}
