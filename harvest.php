<?php

$access_token = getenv('GITHUB_TOKEN'); // https://github.com/settings/tokens -> Personal access token

$searchUrl = "https://api.github.com/search/code?q=filename:codefornl.yml";

$context = stream_context_create([
	'http' => [
		'method' => 'GET',
		'header' => [
			'User-Agent: PHP',
			'Authorization: token ' . $access_token
		]
	]
]);

$searchResults = json_decode(file_get_contents($searchUrl, false, $context), true);

foreach ($searchResults['items'] as $searchResult) {
	$fileInfo = json_decode(file_get_contents($searchResult['url'], false, $context), true);
	$memberInfo = file_get_contents($fileInfo['download_url'], false, $context);
	//$resume = file_get_contens($memberInfo["resume"]);
	//var_dump($memberInfo);
  //call API or push to queue or put in DB
}

