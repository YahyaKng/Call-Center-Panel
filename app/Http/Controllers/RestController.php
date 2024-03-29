<?php

namespace App\Http\Controllers;

use App\Rest;
use App\Team;
use App\User;
use App\RestHistory;
use Illuminate\Http\Request;

class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Rest $model)
    {
        return view('rests.index', ['rests' => $model->paginate(15)]);
    }

    /**
     * Request a rest break
     * $rest_status 0 = waiting
     * $rest_status -1 = cancelled
     * $rest_status 1 = rest accepted and away(paused from queue)
     * $rest_status 2 = back from break and online (unpaused from queue)
     */
    public function rest(Request $request, $type)
    {
        $restTableId = NULL;
        $restStatusNumber = NULL;
        $user = User::findOrFail(auth()->user()->id);
        if ($user->rest) {
            $rests = Rest::where('user_id', $user->id)->orderBy('id', 'desc')->get();
            
            foreach ($rests as $rest) 
            {
                if ($rest->rest_status == 0 || $rest->rest_status == 1) {
                    if($type != $rest->rest_type) {
                        // message: ye no dige darkhast dari
                        $request->session()->flash('message', 'You have another type of break request active.');
                        return redirect('profile');
                    } else {
                        $restEndTime = now();
                        if($rest->rest_status == 0) {
                            $request->session()->flash('message', 'Your request is CANCELED');
                            $restStatusNumber = -1;
                            $restEndTime = NULL;
                        } else {
                            /**
                             * unpause from asterisk
                             * function astersikUnpause returns true or false depending
                             * on wether the extension was successfuly unpaused or not
                             */
                            if(asteriskUnpause($user->line)) {
                                $restStatusNumber = 2;
                                $request->session()->flash('message', 'You are ONLINE.');
                            } else {
                                // dd("Problem unpausing from asterisk, please try again");
                                // $request->session()->flash('message', 'Problem unpausing from asterisk, please try again');
                            };
                        }        
                        Rest::where('id', $rest->id)->update(['rest_status' => $restStatusNumber, 'break_end' => $restEndTime]);
                        if($restStatusNumber == 2) {
                            RestHistory::create([
                                                    'user_id'     => $user->id, 
                                                    'rest_type'   => $rest->rest_type, 
                                                    'end_status'  => $restStatusNumber, 
                                                    'break_start' => $rest->break_start,
                                                    'end'         => $rest->break_end,
                                                    ]);
                        }
                    }
                }
            }
        } 
        if($restStatusNumber == NULL) {
            $restTableId = Rest::create(['user_id' => $user->id, 'team_id' => $user->team->id, 'rest_type' => $type, 'rest_status' => 0]);
            $restStatusNumber = 0;
            $request->session()->flash('message', 'You are in waitlist now.');
        }
        $this->updateQueue($request, $user->team->id, $type, $user->id, $restStatusNumber, $restTableId);
        return redirect('profile');
    }

    private function updateQueue(Request $request, $teamId, $statusType, $userId, $restStatusNumber, $restTableId = NULL)
    {
        // check konim 2 ya 0
        if($restStatusNumber == 2) {
            $selectedRestRequest = Rest::where('team_id', $teamId)->where('rest_type', $statusType)->where('rest_status', 0)->first();
            if($selectedRestRequest) {
                $rest_object = Rest::where('id', $selectedRestRequest->id);
                $rest_object->update(['rest_status' => 1, 'break_start' => now()]);

                /**
                 * unpause from asterisk
                 * function astersikUnpause returns true or false depending
                 * on wether the extension was successfuly unpaused or not
                 */
                if(asteriskPause($rest_object->first()->user()->first()->line)) {
                    $restStatusNumber = 2;
                    $request->session()->flash('message', 'You are ONLINE.');
                } else {
                    // dd("Problem pausing from asterisk, please try again");
                    // $request->session()->flash('message', 'Problem pausing from asterisk, please try again');
                };
            }
        } elseif($restStatusNumber == 0) {
            
            $maxNumber = Team::findOrFail($teamId)["max_{$statusType}_break"];
            $teamUsersRestCount = Rest::where('team_id', $teamId)->where('rest_type', $statusType)->where('rest_status', 1)->count();
            if($teamUsersRestCount < $maxNumber) {
                $rest_object = Rest::where('id', $restTableId->id);
                $rest_object->update(['rest_status' => 1, 'break_start' => now()]);
                /**
                 * unpause from asterisk
                 * function astersikUnpause returns true or false depending
                 * on wether the extension was successfuly unpaused or not
                 */
                if(asteriskPause($rest_object->first()->user()->first()->line)) {
                    $restStatusNumber = 2;
                    $request->session()->flash('message', 'You are ONLINE.');
                } else {
                    // dd("Problem pausing from asterisk, please try again");
                    // $request->session()->flash('message', 'Problem pausing from asterisk, please try again');
                };
            }
        }
        return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
