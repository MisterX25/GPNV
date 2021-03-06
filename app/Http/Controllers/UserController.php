<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Memberships;
use Auth;
use Illuminate\Support\Facades\Input;
use Storage;
use Validator;
use DB;

use App\Http\Requests;

class UserController extends Controller
{
    /**
    * Return the user
    * @param $user The user item
    * @param $request Define the request data send by POST
    * @return view to see user
    */
    public function show(User $user) {
        return view('user.show', compact('user'));
    }

    public function storeAvatar(User $user, Request $request)
    {
        $file = Input::file('avatar');

        $destinationPath = 'avatar/';

        $fileArray = array('image' => $file);
        
        $validatedData = $request->validate([
            'avatar' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        $extension = $file->getClientOriginalExtension();
        $fileName = md5(date('YmdHis') . rand(11111, 99999)) . '.' . $extension;
        $file->move($destinationPath, $fileName);
        $user->update(['avatar' => $fileName]);

        return redirect()->route("user.show", compact('user'));
    }
}
