<?php

    function send($argument) {
        $derp = system("./teensyWrite /dev/ttyACM0 " . $argument);
	echo $derp;
    }

    function poll() {
        // Poll sensor 1
        system("./teensyPoll /dev/ttyACM0 1R");

        // Poll sensor 2
        system("./teensyPoll /dev/ttyACM0 2R");
    }

	send("0ABC");

//    echo "TEST";
//    $handle = fopen("/dev/ttyACM0", "w+b");
//    fwrite($handle, "1R");
//    file("/dev/ttyACM0");
//    exec('echo "140A140B" > /dev/ttyACM0', $derp, $status);
//    var_dump($derp);
//    echo $status;
//    while (!feof($handle)) {
//      echo fread($handle, 1);
//    }
//    $command = escapeshellcmd("/var/www/robot/tpoll");
//    exec($command, $derp, $status);
//    echo time();
//    var_dump($derp);
//    echo "FCK";
//    echo $status;
?>
