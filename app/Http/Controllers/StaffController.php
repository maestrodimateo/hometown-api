<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Hometown;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StaffController extends Controller
{

    /**
     * Create a staff's member
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        // validate the data
        $this->validate(
            $request,
            [
                'fullname' => 'required',
                'photo' => 'required|image',
            ]
        );

        // upload the file
        $photo = $request->file('photo')
            ->move('pictures', $request->file('photo')->hashName());
        Image::make($photo->getRealPath())->resize(500, 600)->save();

        $hometown = Hometown::find($request->hometown_id);
        
        // Create the qrcode
        $base_url = trim('/', $hometown->base_url);
        $qrcode = (!is_null($base_url)) ? 
        QrCode::size(250)->generate($base_url .'/'. Str::slug($request->fullname)) : null;



        // Create a staff's member
        $hometown->staff()->create(
            [
                'fullname' => $request->fullname,
                'photo' => $photo->getFilename(),
                'qrcode' => $qrcode,
            ]
        );
        return response()->json(['message' => 'Agent ajouté avec succès'], 201);
    }

    /**
     * List all the staff
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $all_staff = Staff::all();
        return response()->json($all_staff, 200);
    }

    /**
     * Delete an agent
     *
     * @param int $id id of the agent
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $member = Staff::find($id);
        
        if (is_null($member)) {
            return response()->json(['error' => 'staff not found'], 500);
        }
        // delete the file of the user
        unlink(public_path() . "/pictures/$member->photo");
        $response = $member->delete();

        return response()->json(['response' => $response], 200);
    }

}
