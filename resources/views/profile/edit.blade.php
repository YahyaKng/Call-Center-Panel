@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __(''),
        'class' => 'col-lg-12'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow" id="live-status-box">
                    <div class="alert alert-primary" style="margin: 0px 10px; margin-top: -20px; margin-left: 23px; width: 91%; font-size:30px; text-align:center;" role="alert">
                        <strong>Status</strong> : {{ $userStatusText }}
                    </div>
                    &nbsp
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                {!! $restButton !!}
                                &nbsp;
                                {!! $mealButton !!}
                            </div>
                        </div>
                        &nbsp
                        @if(session('message'))
                            <div class="alert alert-info" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                </div>
              
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Breaks History') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center" id="rests-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Type</th>
                                        <th scope="col">Start Time</th>
                                        <th scope="col">End Time</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($rests))
                                        @foreach($rests as $rest)
                                            <tr>
                                                <td>
                                                    {{ ucfirst($rest->rest_type) }}
                                                </td>
                                                <td>
                                                    
                                                    {{ $rest->break_start ? $rest->break_start : "--" }}
                                                </td>
                                                <td>
                                                    {{ $rest->break_end ? $rest->break_end : "--" }}
                                                </td>
                                                <td>
                                                    <?php 
                                                        if ($rest->break_start) {
                                                            $endTime = $rest->break_end ? $rest->break_end : now(); 
                                                            $endTime = \Carbon\Carbon::parse($endTime);
                                                            $restDuration = $endTime->diffForHumans($rest->break_start);
                                                            $last_space_position = strrpos($restDuration, ' ');
                                                            $restDuration = substr($restDuration, 0, $last_space_position);
                                                            echo $restDuration;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        switch ($rest->rest_status) {
                                                            case -1:
                                                                echo "Cancelled";
                                                                break;
                                                            case 0:
                                                                echo "Queue";
                                                                break;
                                                            case 1:
                                                                echo "Start";
                                                                break;
                                                            case 2:
                                                                echo "Done";
                                                                break;
                                                            default:
                                                                echo "--";
                                                                break;
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-4" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Update rests table -->
        <script type="text/javascript">
        function triggerLoc() {

            $.ajax({
                type : "GET",
                url : window.location,                
                success : function(data) {
                    $("#live-status-box").html($("#live-status-box",$(data)).html());
                    $("#rests-table").html($("#rests-table",$(data)).html());
                    setTimeout(triggerLoc, 5000); 
                }

            })
        }

            $(document).ready(function() {
                triggerLoc();
                // setInterval(function() {
                //     // $('#rests').append(
                //     //     "<tr><td>hello</td></tr>"
                //     // )
                //     // location.reload();
                // }, 3000);
            })
        </script>
        
        @include('layouts.footers.auth')
    </div>
@endsection