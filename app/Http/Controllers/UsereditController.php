<?php

namespace App\Http\Controllers;

use App\User;
use App\Folder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\EditUser;


class UsereditController extends Controller
{
    
    public function showEditForm(Folder $folder)
    {
        $user = Auth::user();
        
        return view('user/edit', [
            'current_folder_id' => $folder->id,
            'user' => $user,
            ]);
    }
    
    protected function edit(EditUser $request, User $user, Folder $folder)
    {
        $user = Auth::user();

        /*$user = User::edit([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'filename' => $user->filename,
        ]);*/
        
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->filename = $request->filename;
        
        $fileName = $user->filename->getClientOriginalName();
        $image = Image::make($user->filename->getRealPath());
        $path = public_path(sprintf('image/%d/%s', $user->id, $fileName));
        $dir = dirname($path);
        //mkdir($dir, 0777, true);
        $image->save($path);
        
        $image_path_array = explode("/", $path);
        $image_path = '/' . $image_path_array[6] . '/' . $image_path_array[7] . '/' . $image_path_array[8];
        
        $user->filename = $image_path;
        $user->save();
        
        return redirect()->route('tasks.index', [
            'current_folder_id' => $folder->id,
            ]);
    }
}
