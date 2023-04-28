<?php
$iterations = 1000000;

$start_time = 0;

$output = '';

if (isset($_POST['start'])) {
    $start_time = microtime(true);
  
    function doWork() {
      global $iterations;
      for ($i = 0; $i < $iterations; $i++) {
        $j = $i * $i;
      }
    }
    
    set_time_limit(0);
    while (1) {
        if (isset($_POST['stop'])) {
            break;
        }
        
        doWork();
        
        $cpu_usage = shell_exec("top -b -n 1 | grep \"Cpu(s)\" | awk '{print $2 + $4}'");
        $cpu_usage = trim($cpu_usage);
        
        echo "CPU 使用率: " . $cpu_usage . "%<br />";
        
        flush();
        ob_flush();
        
        sleep(1);
    }
    
    $duration = microtime(true) - $start_time;
    
    $output = "测试已停止。总时间: " . $duration . " 秒";
} else {
    $output = '<form action="" method="post">
              <input type="submit" name="start" value="开始测试">
              </form>';
}

// 显示测试结果
echo $output;
?>
