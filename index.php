<html>
  <head>
    <title>Nh Checker</title>
   <style type='text/css'>
   @import url('https://fonts.googleapis.com/css?family=Space+Mono');
     html {
       background: black;
       color: grey;
       font-family: 'Space Mono';
	     font-size: 12px;
	     width: 100%;
     }
     input[type=text] {
       background: transparent;
	     color: grey;
	     border: 1px solid grey;
	     margin: 5px auto;
	     padding-left: 5px;
	     font-family: 'Space Mono';
	     font-size: 13px;
     }
     input[type=submit] {
	     background: transparent;
	     color: grey;
	     border: 1px solid grey;
	     margin: 5px auto;
	     padding-left: 5px;
	     font-family: 'Space Mono';
	     font-size: 13px;
	     cursor:pointer;
     }
    </style>
  </head>
<body>
<?php
error_reporting(0);
function get_web_page($url) {
    $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_ENCODING       => "",
        CURLOPT_USERAGENT      => "test",
        CURLOPT_AUTOREFERER    => true,
        CURLOPT_CONNECTTIMEOUT => 120,
        CURLOPT_TIMEOUT        => 120,
    );
    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}

if(!empty($_POST['ips'])) {
    $ips = explode(PHP_EOL, $_POST['ips']);
    foreach ($ips as $ip) {
        $getURL = json_decode(get_web_page("https://nhopener-api.now.sh/". trim($ip)));
        echo "======================== ".$getURL->id." ========================";
        echo "<br>IP: ". $ip;
        echo "<br>Title: ".$getURL->title->display;
        echo "<br>Kode Nuklir: ".$getURL->title->display;
        echo "<br>Tags: ";
        foreach ($getURL->metadata->tags as $tag) {
            echo "<br>[+]".$tag->name;
        }
        echo "<br><br>";
    }
} else {
  echo "<form method='POST' action=''>
    <textarea name='ips' id='ips' cols='30' rows='10'></textarea>
    <input type='submit' name='submit' value='Submit'>";
}
?>
  </body>
</html>
