<?php

namespace App\Http\Controllers;

use App\Flightreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlightreviewController extends Controller
{

    public function index()
    {
        return Flightreview::all();
    }

    public function show($id)
    {
        $flightReview = FlightReview::find($id);
        if(empty($flightReview)) {
            return response()->json(['message' => 'Flight Review Not Found!'], 404);
        }
        return $flightReview;
    }

    public function store(Request $request)
    {

        $validator = $this->validateFlightReview($request);
        if($validator->fails()) {
            $errorMsg = empty($validator->errors()->all()[0]) ? "N/A" : $validator->errors()->all()[0];
            return response()->json(['message' => 'Validation Error: '.$errorMsg], 400);
        }

        return FlightReview::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $flightReview = Flightreview::find($id);
        if(empty($flightReview)) {
            return response()->json(['message' => 'Flight Review Not Found!'], 404);
        }

        $validator = $this->validateFlightReview($request);
        if($validator->fails()) {
            $errorMsg = empty($validator->errors()->all()[0]) ? "N/A" : $validator->errors()->all()[0];
            return response()->json(['message' => 'Validation Error: '.$errorMsg], 400);
        }

        $flightReview->update($request->all());

        return $flightReview;
    }

    public function delete(Request $request, $id)
    {
        $flightReview = Flightreview::find($id);
        if(empty($flightReview)) {
            return response()->json(['message' => 'Flight Review Not Found!'], 404);
        }

        if($flightReview->delete()) {
            return response()->json([],204);
        }

    }

    protected function validateFlightReview(Request $request) {

        $request->only('passenger_id', 'airline', 'flight_number', 'review_points', 'review_title', 'review_body');

        return Validator::make($request->all(), [
            'passenger_id' => 'required|integer',
            'airline' => 'required',
            'flight_number' => 'required|integer',
            'review_points' => 'required|integer|between:1,10',
            'review_title' => 'required',
            'review_body' => 'required'
        ]);

    }
}
