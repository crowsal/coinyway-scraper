<?php
// Basit proxy scraper: Yenibeygir at araması

$horseName = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($horseName === '') {
    http_response_code(400);
    echo json_encode(['error' => 'At ismi girilmedi.']);
    exit;
}

$query = urlencode($horseName);
$url = "https://www.yenibeygir.com/arama?q={$query}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; CoinywayBot/1.0)');
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Veri çekilemedi: ' . $error]);
    exit;
}

header('Content-Type: text/html; charset=utf-8');
echo $response;
?>
