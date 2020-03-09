<?php
 $res = $_REQUEST['res'];
 if (file_exists('wassersport_vote.xml')) {
    $xml = simplexml_load_file('wassersport_vote.xml');
} else {
    exit('Konnte wassersport_vote.xml nicht öffnen.');
}
$y = $xml->activity[0]->Vote;
$n = $xml->activity[1]->Vote;
$z = $xml->activity[2]->Vote;

if ($res == 0) {
    $y = $y + 1;
}
if ($res == 1) {
    $n = $n + 1;
}
if ($res == 2) {
    $z = $z + 1;
}
$xml->activity[0]->Vote = $y;
$xml->activity[1]->Vote = $n;
$xml->activity[2]->Vote = $z;
$xml->asXML('wassersport_vote.xml');
?>
Danke für Ihre Stimme!
<iframe src="wassersport_vote.xml" width="1000" height="1000" frameborder="0" allowTransparency="true"></iframe>