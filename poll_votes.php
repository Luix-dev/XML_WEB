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
<?php

function libxml_display_error($error)
{
    $return = "<br/>\n";
    switch ($error->level) {
        case LIBXML_ERR_WARNING:
            $return .= "<b>Warning $error->code</b>: ";
            break;
        case LIBXML_ERR_ERROR:
            $return .= "<b>Error $error->code</b>: ";
            break;
        case LIBXML_ERR_FATAL:
            $return .= "<b>Fatal Error $error->code</b>: ";
            break;
    }
    $return .= trim($error->message);
    if ($error->file) {
        $return .=    " in <b>$error->file</b>";
    }
    $return .= " on line <b>$error->line</b>\n";

    return $return;
}

function libxml_display_errors() {
    $errors = libxml_get_errors();
    foreach ($errors as $error) {
        print libxml_display_error($error);
    }
    libxml_clear_errors();
}

// Enable user error handling
libxml_use_internal_errors(true);

$xml = new DOMDocument();
$xml->load('wassersport_vote.xml');

if (!$xml->schemaValidate('xsd/event.xsd')) {
    print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
    libxml_display_errors();
}

?>
Danke für Ihre Stimme!
<iframe src="wassersport_vote.xml" width="1000" height="1000" frameborder="0" allowTransparency="true"></iframe>