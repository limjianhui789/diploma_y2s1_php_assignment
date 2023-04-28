<?php
ini_set('max_execution_time', 0); // Disable time limit

while (true) {
    // Start a loop that will run indefinitely
    for ($i=0; $i<100000; $i++) {
        // Perform a large number of calculations
        sqrt($i) * atan($i);
    }
}
?>
