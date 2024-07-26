<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Document;
use App\Models\Requirement;
use App\Models\RequirementDocument;
use App\Models\RequirementRemark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InfoUserController extends Controller
{
    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'phone_number' => 'required|string|max:11',
            'address' => 'required|string',
            'course' => 'required|string',
            'class_year' => 'required|string',
            'lrn_number' => 'required|string',
            'student_number' => 'nullable|string',
        ]);
    
        $user = User::where('lrn_number', $validated['lrn_number'])
                    ->orWhere('email', $validated['email'])
                    ->first();
        if (!$user) {
            $validated['password'] = bcrypt(uniqid());
            $validated['type'] = 'Student';
            $created = User::create($validated);
            if($created){
                if ($request->hasFile('image')) {
                    $relativePath = $this->saveImage($request->file('image'), 'avatars');
                    if ($relativePath) {
                        $created->image = $relativePath;
                        $created->save();
                    } 
                }

                session()->flash('success', 'User created successfully!');
            } else {
                session()->flash('failed', 'User creation failed!');
                return redirect()->route('edit.student');
            }
        }
    
        return redirect()->route('Student-List');
    }

    public function update(Request $request){
        $validated = $request->validate([
            'student_id' => 'exists:users,id',
            'name' => 'required|string',
            'email' => 'required|email|string',
            'phone_number' => 'nullable|string|max:11',
            'address' => 'nullable|string',
            'course' => 'required|string',
            'class_year' => 'required|string',
            'lrn_number' => 'nullable|string',
            'student_number' => 'required|string',
        ]);

        $user = User::findOrFail($validated['student_id']);
        if ($user) {
            $update = $user->update($validated);
            if($update){
                if ($request->hasFile('image')) {
                    $old_image = $user->image;
                    $relativePath = $this->saveImage($request->file('image'), 'avatars');
                    if ($relativePath) {
                        $user->image = $relativePath;
                        $user->save();
                    } 

                    if (!empty($old_image)) {
                        $absolutePath = 'images/avatars/';
                        $this->deleteImage($absolutePath,$old_image);
                    }
                }
                session()->flash('success', 'User update successfully!');
            } else {
                session()->flash('failed', 'User update failed!');
                return redirect()->route('edit.student');
            }
        } 

        return redirect()->route('show.requirements', ['id'=> 'All']);
    }

    public function destroy(Request $request){
        $user = User::findOrFail($request->id);
        $user->deleted_flag = 1;
        $user->save();
        return redirect()->route('Student-List');
    }

    private function saveImage($image, $folderpath) {
        $folder = 'images/'.$folderpath;
        $filename = uniqid() . '_' . time();
        
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0777, true); // Recursively create directory
        }
        $extension = $image->getClientOriginalExtension();
        $filenameWithExtension = $filename . '.' . $extension;
        $file = $image;
        $file-> move(public_path($folder), $filenameWithExtension);
        return $filenameWithExtension;
    }

    private function deleteImage($folderpath, $image){
        $filePath = public_path($folderpath . '/' . $image);
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }
        return false;
    }

}
