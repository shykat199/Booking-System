<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceBookingRequest;
use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\ServiceBooking;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            $q->select('id', 'name', 'description', 'price');
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


            $bookingDate = $request->post('date');
            if (strtotime($bookingDate) < strtotime(now()->toDateString())) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot book a service on a past date',
                    'data' => []
                ], 422);
            }
            

            $booking = ServiceBooking::create([
                'user_id' => $user->id,
                'service_id' => $request->post('service_id'),
                'booking_date' => $bookingDate,
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


    /**
     * Save a new service in the database.
     *
     * This method takes service details from the request (name, description, price, status),
     * creates a new service record, and returns a JSON response with the created service.
     *
     * @param ServiceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveService(ServiceRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $service = Service::create([
                'name' => $request->post('name'),
                'description' => $request->post('description'),
                'price' => $request->post('price'),
                'status' => $request->post('status', ACTIVE_STATUS),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Service created successfully',
                'data' => $service
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to save service: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }


    /**
     * Update an existing service.
     *
     * This method handles a PUT request to update a service's details.
     * It validates the incoming JSON data and updates the service record in the database if validation passes.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $role
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateService(HttpRequest $request, $role, $id)
    {
        $data = $request->json()->all();

        $validator = Validator::make($data, [
            'name' => [
                'required',
                Rule::unique('services')->ignore($id),
            ],
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $service = Service::findOrFail($id);

        $service->update($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'Service updated successfully.',
            'data' => [$service],
        ]);
    }


    /**
     * Get a paginated list of service bookings.
     *
     * This method fetches all service bookings with related service and user information.
     * Only active services are included. Results are paginated (10 per page) and ordered
     * by newest bookings first.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function listOfBookings()
    {
        $bookings = ServiceBooking::with([
            'service' => function ($q) {
                $q->select('id', 'name', 'description', 'price');
                $q->where('status', ACTIVE_STATUS);
            },
            'user' => function ($q) {
                $q->select('id', 'name');
            }
        ])->orderByDesc('id')
        ->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Bookings fetched successfully.',
            'data' => [$bookings]
        ]);
    }


    /**
     * Delete an existing service.
     *
     * This method handles a DELETE request to remove a service record
     * from the database based on its ID. It returns a JSON response indicating success or failure.
     *
     * @param string $role
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteService($role, $id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return response()->json([
            'status' => true,
            'message' => 'Service deleted successfully.',
            'data' => [],
        ]);
    }

}
