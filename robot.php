<?php
    $script = $_POST["script"];
    //var_dump($script);

    header("Content-type: text/plain");

    foreach ($script as $operation) {
        $opcode = $operation["opcode"];
        $arg    = $operation["arg"];

        switch ($opcode) {
            case "fd":
                echo "Forward ho!\n";
                send("200A200B");
                wait($arg);
                send("0A0B");
                break;
            case "bw":
                echo "Backward ho!\n";
                send("-200A-200B");
                wait($arg);
                send("0A0B");
                break;
            case "rt":
                echo "Right Turn ho!\n";
                send("180A-180B");
                wait($arg);
                send("0A0B");
                break;
            case "lt":
                echo "Left Turn ho!\n";
                send("-180A180B");
                wait($arg);
                send("0A0B");
                break;
            case "pu":
                echo "Pen Up!\n";
                break;
            case "pd":
                echo "Pen Down!\n";
                break;
            default:
                echo "DERP!!\n";
                break;
        }
    }

    function wait($time) {
        echo "Waiting for " . $time . "...";
        $timeInMicroSeconds = $time * 1000;
        $timeWaited = 0;
        while ($timeWaited <= $timeInMicroSeconds)
        {
            poll();
            usleep(500);
            $timeWaited += 500;
        }
//        usleep($time * 1000);
        echo "Done!";
        echo "\n";
    }

    function send($argument) {
        system("teensyWrite /dev/ttyACM0" . $argument);
    }

    function poll() {
        // Poll sensor 1
        system("teensyPoll /dev/ttyACM0 1R");

        // Poll sensor 2
        system("teensyPoll /dev/ttyACM0 2R");
    }
?>
