<?php
echo "<html>
<head><title>Listowanie odnosnikow z podanej strony www</title>
</head>
<body>
<h1>Sebastian Rutkowski 125NCI_B</h1>
";
	require_once "ultimate-web-scraper/support/http.php";
	require_once "ultimate-web-scraper/support/web_browser.php";
	require_once "ultimate-web-scraper/support/simple_html_dom.php";

	$url = $_GET["adres_strony"];
	$html = file_get_html($url);
	$web = new WebBrowser();
	$result = $web->Process($url);

	if (!$result["success"])  echo "Error retrieving URL.  " . $result["error"] . "\n";
	else if ($result["response"]["code"] != 200)  echo "Error retrieving URL.  Server returned:  " . $result["response"]["code"] . " " . $result["response"]["meaning"] . "\n";
	else
	{
		echo "Wszystkie odnosniki na stronie:\n<br><br>";
			$html->load($result["body"]);
			$links = $html->find('a[href]'); 
			foreach ($links as $link)
			{		
				echo "\t" . $link->href . "\n<br>";
			}
	}
echo "</body>
</html>";
?>