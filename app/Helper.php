<?php  

use PAMI\Client\Impl\ClientImpl;
use PAMI\Listener\IEventListener;
use PAMI\Message\Event\EventMessage;
use PAMI\Message\Action\ListCommandsAction;
use PAMI\Message\Action\ListCategoriesAction;
use PAMI\Message\Action\CoreShowChannelsAction;
use PAMI\Message\Action\CoreSettingsAction;
use PAMI\Message\Action\CoreStatusAction;
use PAMI\Message\Action\StatusAction;
use PAMI\Message\Action\ReloadAction;
use PAMI\Message\Action\CommandAction;
use PAMI\Message\Action\HangupAction;
use PAMI\Message\Action\LogoffAction;
use PAMI\Message\Action\AbsoluteTimeoutAction;
use PAMI\Message\Action\OriginateAction;
use PAMI\Message\Action\BridgeAction;
use PAMI\Message\Action\CreateConfigAction;
use PAMI\Message\Action\GetConfigAction;
use PAMI\Message\Action\GetConfigJSONAction;
use PAMI\Message\Action\AttendedTransferAction;
use PAMI\Message\Action\RedirectAction;
use PAMI\Message\Action\DAHDIShowChannelsAction;
use PAMI\Message\Action\DAHDIHangupAction;
use PAMI\Message\Action\DAHDIRestartAction;
use PAMI\Message\Action\DAHDIDialOffHookAction;
use PAMI\Message\Action\DAHDIDNDOnAction;
use PAMI\Message\Action\DAHDIDNDOffAction;
use PAMI\Message\Action\AgentsAction;
use PAMI\Message\Action\AgentLogoffAction;
use PAMI\Message\Action\MailboxStatusAction;
use PAMI\Message\Action\MailboxCountAction;
use PAMI\Message\Action\VoicemailUsersListAction;
use PAMI\Message\Action\PlayDTMFAction;
use PAMI\Message\Action\DBGetAction;
use PAMI\Message\Action\DBPutAction;
use PAMI\Message\Action\DBDelAction;
use PAMI\Message\Action\DBDelTreeAction;
use PAMI\Message\Action\GetVarAction;
use PAMI\Message\Action\SetVarAction;
use PAMI\Message\Action\PingAction;
use PAMI\Message\Action\ParkedCallsAction;
use PAMI\Message\Action\SIPQualifyPeerAction;
use PAMI\Message\Action\SIPShowPeerAction;
use PAMI\Message\Action\SIPPeersAction;
use PAMI\Message\Action\SIPShowRegistryAction;
use PAMI\Message\Action\SIPNotifyAction;
use PAMI\Message\Action\QueuesAction;
use PAMI\Message\Action\QueueAddAction;
use PAMI\Message\Action\QueueStatusAction;
use PAMI\Message\Action\QueueSummaryAction;
use PAMI\Message\Action\QueuePauseAction;
use PAMI\Message\Action\QueueRemoveAction;
use PAMI\Message\Action\QueueUnpauseAction;
use PAMI\Message\Action\QueueLogAction;
use PAMI\Message\Action\QueuePenaltyAction;
use PAMI\Message\Action\QueueReloadAction;
use PAMI\Message\Action\QueueResetAction;
use PAMI\Message\Action\QueueRuleAction;
use PAMI\Message\Action\MonitorAction;
use PAMI\Message\Action\PauseMonitorAction;
use PAMI\Message\Action\UnpauseMonitorAction;
use PAMI\Message\Action\StopMonitorAction;
use PAMI\Message\Action\ExtensionStateAction;
use PAMI\Message\Action\JabberSendAction;
use PAMI\Message\Action\LocalOptimizeAwayAction;
use PAMI\Message\Action\ModuleCheckAction;
use PAMI\Message\Action\ModuleLoadAction;
use PAMI\Message\Action\ModuleUnloadAction;
use PAMI\Message\Action\ModuleReloadAction;
use PAMI\Message\Action\ShowDialPlanAction;
use PAMI\Message\Action\ParkAction;
use PAMI\Message\Action\MeetmeListAction;
use PAMI\Message\Action\MeetmeMuteAction;
use PAMI\Message\Action\MeetmeUnmuteAction;
use PAMI\Message\Action\EventsAction;
use PAMI\Message\Action\VGMSMSTxAction;
use PAMI\Message\Action\DongleSendSMSAction;
use PAMI\Message\Action\DongleShowDevicesAction;
use PAMI\Message\Action\DongleReloadAction;
use PAMI\Message\Action\DongleStartAction;
use PAMI\Message\Action\DongleRestartAction;
use PAMI\Message\Action\DongleStopAction;
use PAMI\Message\Action\DongleResetAction;
use PAMI\Message\Action\DongleSendUSSDAction;
use PAMI\Message\Action\DongleSendPDUAction;

$host = '192.168.110.10';
$username = 'vmanager';
$pass ='0757040ae47aec3438395437bfa4dbc8';

if(!class_exists('class A implements IEventListener')) {
    class A implements IEventListener
    {
        public function handle(EventMessage $event)
        {
            // dd($event->getPaused());
        }
    }
}


if (!function_exists('asteriskConnect')) {
    function asteriskConnect() {

        $options = array(
            'host' => '192.168.110.10',
            'scheme' => 'tcp://',
            'port' => 5038,
            'username' => 'vmanager',
            'secret' => '0757040ae47aec3438395437bfa4dbc8',
            'connect_timeout' => 10,
            'read_timeout' => 10
        );
        $client = new ClientImpl($options);
        $client->open();
        $client->registerEventListener(function (EventMessage $event) {
            
        });
        return $client;
    }
}


if (!function_exists('asteriskPause')) {   
    function asteriskPause($extension) {
        $client = asteriskConnect();
        $response = $client->send(new QueuePauseAction($extension));
        $client->process();
        $client->close();
        return $response->isSuccess();
    }
}

if (!function_exists('asteriskUnpause')) {   
    function asteriskUnpause($extension) {
        $client = asteriskConnect();
        $response = $client->send(new QueueUnpauseAction($extension));
        $client->process();
        $client->close();
        // $response->isSuccess() ? return true : return false;
        return $response->isSuccess();
    }
}

if (!function_exists('asteriskQueues')) {
    function asteriskQueues() {
        $options = array(
            'host' => '192.168.110.10',
            'scheme' => 'tcp://',
            'port' => 5038,
            'username' => 'vmanager',
            'secret' => '0757040ae47aec3438395437bfa4dbc8',
            'connect_timeout' => 10,
            'read_timeout' => 10
        );
        $client = new ClientImpl($options);
        $client->registerEventListener(function (EventMessage $event) {
        });
        $client->open();
        $response = $client->send(new QueueStatusAction());
        $queues = [];
        $client->process();
        $client->close();
        // generate queues array
        foreach ($response->getEvents() as $event) {
            array_push($queues, $event->getKey('Queue'));
            // dd($event->getKey('Queue'));
        }
        $queues = array_unique($queues);
        array_pop($queues);
        return $queues;
    }
}


if (!function_exists('asteriskAddToQueues')) {
    function asteriskAddToQueues($queues, $extension) {
        $client = asteriskConnect();
        // $response->isSuccess() ? return true : return false;
        foreach ($queues as $queue) {
            $response = $client->send(new QueueAddAction($queue, $extension));
            $client->process();
            // if ($response->getMessage == 'Unable to add interface: Already there') {
            //     $request->session()->flash('asteriskStatus', 'Member already in queue');
            // }
        }
        // dd($response);
        $client->close();
        return $response;
    }
}

if (!function_exists('asteriskRemoveFromQueues')) {
    function asteriskRemoveFromQueues($queues, $extension) {
        $client = asteriskConnect();
        // $response->isSuccess() ? return true : return false;
        foreach ($queues as $queue) {
            $response = $client->send(new QueueRemoveAction($queue, $extension));
            $client->process();
        }
        $client->close();
        return $response;
    }
}

if (!function_exists('asteriskStatusAction')) {
    function asteriskStatusAction() {
        $client = asteriskConnect();
        $client->send(new QueueLogAction(1000, 300));
        $client->process();
        $client->close();
    }
}

// if (!function_exists('asteriskQueuesList')) {
//     function asteriskQueuesList() {

//     }
// }


// if (!function_exists('qAction')) {   
//     function qAction() {
//         $options = array(
//             'host' => '192.168.110.10',
//             'scheme' => 'tcp://',
//             'port' => 5038,
//             'username' => 'vmanager',
//             'secret' => '0757040ae47aec3438395437bfa4dbc8',
//             'connect_timeout' => 10,
//             'read_timeout' => 10
//         );
//         $client = new ClientImpl($options);
//         $client->open();
//         $client->send(new QueueAction());
//     }
// }

// $sock = connect("192.168.110.10", "callcenter", "callcenter");
// $response = get_response($sock);
// echo $response;
// $sock = queue_pause_switch($sock, 300, true, 1000);
// echo get_response($sock);
// fputs($sock, "Action: Queues\r\n\r\n");
// // fputs($scok, "Queue: 1000\r\n");
// echo get_response($sock);

// if (!function_exists('connect_manager')) {
//     function connect_manager($host="192.168.110.10", $user, $pass) {
//         $tmout = 3;
//         $sock = fsockopen($host, 5038, $errno, $errstr, $tmout);
//         fputs($sock, "Action: Login\r\n");
//         fputs($sock, "UserName: {$user}\r\n");
//         fputs($sock, "Secret: {$pass}\r\n\r\n");
//         return $sock;
//     }
// }

// if (!function_exists('queue_pause_switch')) {
//     function queue_pause_switch($sock, $interface, $paused, $queue=NULL, $reason='test') {
//         fputs($sock, "Action: QueuePause\r\n");
//         // fputs($sock, "ActionID: 123456789\r\n");
//         fputs($sock, "Interface: {$interface}\r\n");
//         if (!$paused) {
//             fputs($sock, "Paused: false\r\n");
//         } else {
//             fputs($sock, "Paused: true\r\n");
//         }
//         fputs($sock, "Reason: {$reason}\r\n");
//         if ($queue) {
//             fputs($sock, "Queue: {$queue}\r\n\r\n");
//         } else {
//             fputs($sock, "\r\n");
//         }
        
//         return $sock;   
//     }
// }

// if (!function_exists('get_response')) {
//     function get_response($sock) {
//         $line = "";
//         $response = "";
//         while($line != "\r\n") {
//             $line = fgets($sock, 128);
//             $response .= $line;
//         }
//         return $response;
//     }
// }

// if (!function_exists('parse_response')) {
//     function parse_response($response, $event) {
//         $exploded = explode("\r\n", $response);
//         foreach ($exploded as $line) {
//             if (strlen($line) >= strlen($event)) {
//                 if (substr($line,0,strlen($event)) == $event) {
//                     return substr($line, strlen($event)+2);
//                 }
//             }
//         }
//     }
// }


?>