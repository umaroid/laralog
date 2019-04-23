<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'filename' => 'image',
        ], [], [
            'name' => 'ユーザー名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'filename' => 'アバタ―画像',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $fileName = $data['filename']->getClientOriginalName();
        $image = Image::make($data['filename']->getRealPath());
        $path = public_path() . '/images';
        $image->save($path . $fileName);
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'filename' => $data['filename'],
        ]);
        
        $fileName = $data['filename']->getClientOriginalName();
        $image = Image::make($data['filename']->getRealPath());
        $path = public_path(sprintf('image/%d/%s', $user->id, $fileName));
        $dir = dirname($path);
        mkdir($dir, 0777, true);
        $image->save($path);
        
        $image_path_array = explode("/", $path);
        $image_path = '/' . $image_path_array[6] . '/' . $image_path_array[7] . '/' . $image_path_array[8];
        
        $user->filename = $image_path;
        $user->save();
        
        return $user;
    }
    
}
