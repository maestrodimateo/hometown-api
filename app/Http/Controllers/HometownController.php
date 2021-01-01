<?php

namespace App\Http\Controllers;

use App\Models\Hometown;
use App\Services\Staffservice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HometownController extends Controller
{

    /**
     * Create a hometown
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'label' => 'required',
            'base_url' => 'url|nullable|unique:hometowns'
        ]);

        Hometown::create($request->all());

        return response()->json(['message' => 'Mairie ajoutée avec succès'], 201);
    }

    /**
     * Get all the hometowns
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $hometowns = Hometown::all();

        return response()->json($hometowns, 200);
    }

    /**
     * Get all the staff of an hometown
     *
     * @param integer $id if of the hometoxn
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function hometown_staff(int $id)
    {
        $hometown = Hometown::findOrFail($id);

        $staff = $hometown->staff;

        return response()->json($staff, 200);
    }

    /**
     * Delete a hometown
     *
     * @param integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        $hometown = Hometown::findOrFail($id);

        $hometown->delete();

        return response()->json(['message' => 'Mairie supprimée avec succès'], 200);
    }

    /**
     * Update a hometown
     *
     * @param Request $request
     * 
     * @param integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
                'label' => 'required',
                'base_url' => [ 'url', 'nullable',
                Rule::unique('hometowns')->ignore($id)
            ],
        ]);

        $hometown = Hometown::find($id);

        // check if the saved base_url is the same as the form base_url
        $same = $request->base_url === $hometown->base_url;
        $hometown->update($request->all());
        
        if (!$same) {
            // update the staff qrcode
            $hometown->staff->each(function ($item) use ($hometown){
               $qrcode = Staffservice::create_qrcode($hometown->base_url, $item->fullname);
               $item->update(['qrcode' => $qrcode]);
            });
        }

        return response()->json(['message' => 'Mairie mise à jour avec succès'], 200);
    }

    /**
     * Search users
     *
     * @param Request $request
     * @return Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'label' => 'nullable|string'
        ]);

        $response = Hometown::where('label', 'LIKE', "%{$request->label}%")->get();

        return response()->json(['users' => $response], 200);
    }
}
