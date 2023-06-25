<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Repositories\PaymentRepository;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Custom\Response;

/**
 * @group Payments
 *
 */
class PaymentController extends Controller
{
    private $paymentRepository = null;
    private $response = null;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->response = new Response();
    }

    /**
     * List Payments
     *
     * List the payments of the user.
     *
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function index(PaymentRepository $paymentRepository)
    {
        return $this->response->withData(
            true,
            "Payments list is fetched successfully.",
            [
                'payments'  => PaymentResource::collection($paymentRepository->all())
            ]
        );
    }

}
