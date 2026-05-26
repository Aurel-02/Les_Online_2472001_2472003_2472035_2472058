<?php
$queries = ['Matematika SMA', 'Fisika SMA', 'Kimia SMA', 'Biologi Sel', 'Sejarah Kemerdekaan', 'Bahasa Indonesia SMA', 'Bahasa Inggris SMA', 'Ekonomi SMA'];
$results = [];

foreach ($queries as $q) {
    $url = 'https://www.youtube.com/results?search_query=' . urlencode($q);
    $html = @file_get_contents($url, false, stream_context_create(['http' => ['header' => 'User-Agent: Mozilla/5.0']]));
    if ($html) {
        preg_match_all('/"videoId":"([^"]{11})"/', $html, $matches);
        $ids = array_unique($matches[1]);
        $results[$q] = array_slice($ids, 0, 2);
    }
}
echo json_encode($results, JSON_PRETTY_PRINT);
