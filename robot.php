<?php
    $script = $_POST["script"];
    //var_dump($script);

    header("Content-type: text/plain");

    foreach ($script as $operation) {
	$crash  = 0;
        $opcode = $operation["opcode"];
        $arg    = $operation["arg"];

        switch ($opcode) {
            case "fd":
                echo "Forward ho!</br>";
                send("250A250B");
                $crash = wait($arg);
                send("AABB");
                break;
            case "bw":
                echo "Backward ho!</br>";
                send("-250A-250B");
                $crash = wait($arg);
                send("AABB");
                break;
            case "rt":
                echo "Right Turn ho!</br>";
                send("250A-250B");
                $crash = wait($arg);
                send("AABB");
                break;
            case "lt":
                echo "Left Turn ho!</br>";
                send("-250A250B");
                $crash = wait($arg);
                send("AABB");
                break;
            case "pu":
                echo "Pen Up!</br>";
		send("255C");
		$crash = wait($arg);
		send("CC");
                break;
            case "pd":
                echo "Pen Down!</br>";
		send("-255C");
		$crash = wait($arg);
		send("CC");
                break;
            default:
                echo "DERP!!</br>";
                break;
        }

	if ($crash == 1) {
	    echo "CRASH";
	    return;
	}
    }

    function wait($time) {

        $timeInMicroSeconds = $time * 1000;
        $timeWaited = 0;
        while ($timeWaited <= $timeInMicroSeconds)
        {
	    $timeTaken = -1;
            $timeTaken = poll();

	    if ($timeTaken == -1) {
		return 1;
	    }

            usleep(250 - $timeTaken);
            $timeWaited += 250;
        }

	return 0;
    }

    function send($argument) {
        $ret = system("teensyWrite /dev/ttyACM0 " . $argument);
    }

    function poll() {
	$time_start = microtime(true);
	$sensor1 = 0;
	$sensor2 = 0;

        // Poll sensor 1
        $sensor1 = system("teensyPoll /dev/ttyACM0 1R");

        // Poll sensor 2
        $sensor2 = system("teensyPoll /dev/ttyACM0 2R");
	$time_end = microtime(true);

	if ($sensor1 > 400) {
	    return -1;
	}

	if ($sensor2 > 400) {
            return -1;
        }

	return $time_end - $time_start;
    }
?>
