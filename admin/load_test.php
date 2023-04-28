<?php
ini_set('max_execution_time', 0); // Disable time limit

$threads = array(); 

// Functions executed in each thread
function run() {
    while (true) {
        // Perform a large number of calculations
        for ($i=0; $i<100000; $i++) {
            sqrt($i) * atan($i);
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
