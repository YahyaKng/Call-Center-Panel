<?php  
if (!function_exists('connect_manager')) {
    function connect_manager($host, $user, $pass) {
        $tmout = 3;
        $sock = fsockopen($host, 5038, $errno, $errstr, $tmout);
        fputs($sock, "Action: Login\r\n");
        fputs($sock, "UserName: {$user}\r\n");
        fputs($sock, "Secret: {$pass}\r\n\r\n");
        return $sock;
    }
}

if (!function_exists('queue_pause_switch')) {
    function queue_pause_switch($sock, $interface, $paused, $queue=NULL, $reason='test') {
        fputs($sock, "Action: QueuePause\r\n");
        // fputs($sock, "ActionID: 123456789\r\n");
        fputs($sock, "Interface: {$interface}\r\n");
        if (!$paused) {
            fputs($sock, "Paused: false\r\n");
        } else {
            fputs($sock, "Paused: true\r\n");
        }
        fputs($sock, "Reason: {$reason}\r\n");
        if ($queue) {
            fputs($sock, "Queue: {$queue}\r\n\r\n");
        } else {
            fputs($sock, "\r\n");
        }
        
        return $sock;   
    }
}

if (!function_exists('get_response')) {
    function get_response($sock) {
        $line = "";
        $response = "";
        while($line != "\r\n") {
            $line = fgets($sock, 128);
            $response .= $line;
        }
        return $response;
    }
}

if (!function_exists('parse_response')) {
    function parse_response($response, $event) {
        $exploded = explode("\r\n", $response);
        foreach ($exploded as $line) {
            if (strlen($line) >= strlen($event)) {
                if (substr($line,0,strlen($event)) == $event) {
                    return substr($line, strlen($event)+2);
                }
            }
        }
    }
}

// $sock = connect("192.168.110.218", "callcenter", "callcenter");
// $response = get_response($sock);
// echo $response;
// $sock = queue_pause_switch($sock, 300, true, 1000);
// echo get_response($sock);
// fputs($sock, "Action: Queues\r\n\r\n");
// // fputs($scok, "Queue: 1000\r\n");
// echo get_response($sock);

?>