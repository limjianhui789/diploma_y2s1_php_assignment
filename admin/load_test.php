<?php
ini_set('max_execution_time', 0); // Disable time limit

$threads = array(); 

// Functions executed in each thread
function run() {
    while (true) {
        // Perform a large number of calculations
        for ($i=0; $i<1000000; $i++) {
            for ($j=0; $j<500; $j++) {
                sin($i) * exp($j);
            }
        }
    }
}

// Create 10 threads and start them
for ($i=0; $i<10; $i++) {
    $thread = new Thread('run');
    $thread->start();
    $threads[] = $thread;
}

// Wait for all threads to finish
foreach ($threads as $thread) {
    $thread->join();
}
?>
