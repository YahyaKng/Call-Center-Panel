<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Rest;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $rests = Rest::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        if ($rests->count() != 0) {
            $userStatus = $rests[0]->rest_status;
            $userStatusText = $userStatus == 1 ? 'Rest' : ($userStatus == 0 ? 'Waiting' : 'Online');
            $restButton = $this->generateRestButton('rest' ,$rests[0]);
            $mealButton = $this->generateRestButton('meal' ,$rests[0]);
            return view('profile.edit', compact('rests', 'restButton', 'mealButton', 'userStatusText'));
        } else {
            $userStatusText = 'Online';
            $restButton = $this->generateRestButton('rest');
            $mealButton = $this->generateRestButton('meal');
            return view('profile.edit', compact('restButton', 'mealButton', 'userStatusText'));
        }
    }

    private function generateRestButton($type, $rest=NULL) 
    {
        $colorClass = 'primary';
        $disabled = '';
        if($rest) {
            if(in_array($rest->rest_status, [0,1])) {
                if ($rest->rest_type != $type) {
                    $disabled = 'disabled';
                    $colorClass = 'dark';
                } else {
                    $colorClass = 'warning';
                }
            } 
        }
        return '<a href="/check-rest/' . $type . '"><button type="submit" class="btn btn-' . $colorClass . ' btn-block"' . $disabled . '>' . ucfirst($type). ' Break Request</button></a>';
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
