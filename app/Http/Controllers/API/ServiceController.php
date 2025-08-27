<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceBookingRequest;
use App\Models\Service;
use App\Models\ServiceBooking;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Get a paginated list of active services.
     *
     * This method fetches services with status = ACTIVE_STATUS,
     * orders them by latest, and returns a paginated list in JSON format.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function serviceList(): \Illuminate\Http\JsonResponse
    {
        $availableServices = Service::where('status', ACTIVE_STATUS)
            ->orderByDesc('id')
            ->paginate(10);

        return response()->json([
            'status' => true,
            'message' => null,
            'data' => $availableServices
        ], 200);
    }


    /**
     * Get a paginated list of active services booked by the logged user.
     *
     * This method fetches services with status = ACTIVE_STATUS,
     * orders them by latest, and returns a paginated list in JSON format.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userBookingServiceList(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::guard('api')->user();

        $userServices = ServiceBooking::whereHas('service', function ($q) {
            $q->where('status', ACTIVE_STATUS);
        })->with(['service' => function ($q) {
            $q->select('id','name','description','price');
            $q->where('status', ACTIVE_STATUS);
        }])
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->paginate(10);

        return response()->json([
            'status' => true,
            'message' => null,
            'data' => $userServices,
        ], 200);
    }

    /**
     * Book a service for the authenticated user.
     *
     * This method creates a new service booking using the provided service_id
     * and booking_date. The authenticated user's ID is automatically associated
     * with the booking.
     *
     * @param ServiceBookingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookService(ServiceBookingRequest $request): \Illuminate\Http\JsonResponse
    {
        try {

            $user = Auth::guard('api')->user();

            $checkService = Service::where('id', $request->service_id)->first();

            if (empty($checkService)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Service not found',
                    'data' => []
                ], 404);
            }

            $checkServiceBooking = ServiceBooking::where('user_id', $user->id)
                ->where('service_id', $request->service_id)
                ->where('status', PENDING_STATUS)
                ->first();

            if ($checkServiceBooking) {
                return response()->json([
                    'status' => false,
                    'message' => 'Service already booked',
                    'data' => []
                ], 409);
            }

            $booking = ServiceBooking::create([
                'user_id' => $user->id,
                'service_id' => $request->post('service_id'),
                'booking_date' => now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Service booked successfully',
                'data' => [
                    $booking
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to book service: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

}
