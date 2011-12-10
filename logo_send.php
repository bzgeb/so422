<?php
    function send($argument) {
        $derp = system("./teensyWrite /dev/ttyACM0 " . $argument);
	echo $derp;
    }
?>
