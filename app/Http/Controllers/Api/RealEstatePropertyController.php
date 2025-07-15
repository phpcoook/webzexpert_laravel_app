<?php

namespace App\Http\Controllers\Api;

use App\Models\RealEstateProperty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RealEstatePropertyResource;
use Illuminate\Validation\Rule;

class RealEstatePropertyController extends Controller
{
    public function index()
    {
        return RealEstatePropertyResource::collection(
            RealEstateProperty::all()
        );
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $property = RealEstateProperty::create($data);

        return new RealEstatePropertyResource($property);
    }

    public function show(RealEstateProperty $realEstate)
    {
        return new RealEstatePropertyResource($realEstate);
    }

    public function update(Request $request, RealEstateProperty $realEstate)
    {
        $data = $this->validateData($request, $realEstate->id);

        $realEstate->update($data);

        return new RealEstatePropertyResource($realEstate);
    }

    public function destroy(RealEstateProperty $realEstate)
    {
        $realEstate->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    private function validateData(Request $request, $id = null)
    {
        return $request->validate([
            'name' => 'required|string|min:1|max:128',
            'real_estate_type' => ['required', Rule::in(['house', 'land', 'department', 'commercial_ground'])],
            'street' => 'required|string|min:1|max:128',
            'external_number' => ['required', 'regex:/^[A-Za-z0-9\-]{1,12}$/'],
            'internal_number' => [
                'nullable',
                'required_if:real_estate_type,department,commercial_ground',
                'regex:/^[A-Za-z0-9\- ]*$/'
            ],
            'neighborhood' => 'required|string|min:1|max:128',
            'city' => 'required|string|min:1|max:64',
            'country' => ['required', 'regex:/^[A-Z]{2}$/'], // ISO 3166 Alpha-2
            'rooms' => 'required|integer|min:0',
            'bathrooms' => [
                'required', 'numeric', 'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if (in_array($request->real_estate_type, ['house', 'department']) && $value == 0) {
                        $fail('Bathrooms cannot be zero for this type.');
                    }
                }
            ],
            'comments' => 'nullable|string|max:128',
        ]);
    }
}
