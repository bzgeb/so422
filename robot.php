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
                wait($arg);
                break;
            case "bw":
                echo "Backward ho!\n";
                wait($arg);
                break;
            case "rt":
                echo "Right Turn ho!\n";
                break;
            case "lt":
                echo "Left Turn ho!\n";
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

//        echo $operation["opcode"];
//        echo " ";
//        echo $operation["arg"];
//        echo "\n";
    }

    function wait($time) {
        echo "Waiting for " . $time . "...";
        usleep($time * 1000);
        echo "Done!";
        echo "\n";
    }

    function send($argument) {

    }
?>
