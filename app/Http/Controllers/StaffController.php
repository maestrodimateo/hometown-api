<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Hometown;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
        $picture = $this->store_file($request->file('photo'));

        $hometown = Hometown::find($request->hometown_id);

        // Create the qrcode
        $qrcode = $this->create_qrcode($hometown->base_url, $request->fullname);



        // Create a staff's member
        $hometown->staff()->create(
            [
                'fullname' => $request->fullname,
                'photo' => $picture->basename,
                'qrcode' => $qrcode,
                'status' => $request->status
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
        delete_file("pictures/$member->photo");
        $response = $member->delete();

        return response()->json(['response' => $response], 200);
    }

    /**
     * Update a staff
     *
     * @param integer $id staff's id
     * @return @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        // validate the data
        $this->validate(
            $request,
            [
                'fullname' => 'required',
                'photo' => 'nullable|image',
            ]
        );

        // find the staff to update
        $member = Staff::find($id);
        if (is_null($member)) {
            return response()->json(['error' => 'staff not found'], 500);
        }

        // replace the file if exist
        $photo = $request->file('photo');
        if (!is_null($photo)) {
            $replacer = $this->replace_file("pictures/{$member->photo}", $photo);
        }

        // update the qrcode
        $qrcode = $this->create_qrcode($member->hometown->base_url, $request->fullname);

        $member->update([
            'fullname' => $request->fullname,
            'photo'  => $replacer->basename ?? $member->photo,
            'qrcode' => $qrcode,
            'status' => $request->status
        ]);

        return response()->json(['message' => "{$member->fullname} aa bien été mis à jour"], 200);
    }

    /**
     * store a file in the file System
     *
     * @param UploadedFile $photo
     * 
     * @return Intervention\Image\Image
     */
    private function store_file(UploadedFile $photo)
    {
        $added_picture = $photo->move('pictures', $photo->hashName());
        return Image::make($added_picture->getRealPath())->resize(500, 600)->save();
    }

    /**
     * Create a Qrcode
     *
     * @param string $base_url
     * 
     * @param string $slug
     * 
     * @return void|Illuminate\Support\HtmlString|string|null
     */
    private function create_qrcode(string $base_url, string $slug)
    {
        // Create the qrcode
        $base_url = trim('/', $base_url);
        return (!is_null($base_url)) ?
        QrCode::size(250)->generate($base_url . '/' . Str::slug($slug)) : null;
    }

    /**
     * Undocumented function
     *
     * @param string $path_to_old
     * @param UploadedFile $new
     * @return void
     */
    private function replace_file(string $path_to_old, UploadedFile $new)
    {
        delete_file($path_to_old);
        return $this->store_file($new);
    }
}
