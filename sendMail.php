<?php
    if(!empty($_POST["email"]) {
        //recipient
        $to = $_POST["email"];

        //sender
        $from = 'fabio.stuber@stud.hslu.ch';
        $fromName = 'Wassersport Hotel';

        //email subject
        $subject = 'Unsere Angebote als PDF';

        //attachment file path
            // load the FOP client.
            require_once 'fop_service_client.php';

            // load XML
            $data = file_get_contents('wassersport.xml');
            $xml = new DOMDocument();
            $xml->loadXML($data);

            // load XSL
            $xsl = new DOMDocument();
            $xsl->load('xsl/wassersport_fo.xsl');

            // transform
            $processor = new XSLTProcessor();
            $processor->importStylesheet($xsl);
            $newDom = $processor->transformToDoc($xml);

            $newDom->save("sports.fo");

            // locate the source FO file.
            $foFile = 'sports.fo';

            // create an instance of the FOP client and perform service request.
            $serviceClient = new FOPServiceClient();
            $file = $serviceClient->processFile($foFile);

        //email body content
        $htmlContent = '<h1>Unsere Angebote für Sie</h1>
            <p>Das PDF mit unseren Angeboten finden sie im Anhang</p>';

        //header for sender info
        $headers = "From: $fromName"." <".$from.">";

        //boundary
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

        //headers for attachment
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        //multipart boundary
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

        //preparing attachment
        if(!empty($file) > 0){
            if(is_file($file)){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($file,"rb");
                $data =  @fread($fp,filesize($file));

                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .
                "Content-Description: ".basename($file)."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $from;

        //send email
        $mail = @mail($to, $subject, $message, $headers, $returnpath);

        //email sending status
        echo $mail?"<h1>Mail gesendet an " + $to + "</h1>":"<h1>Mail sending failed.</h1>";
    }
?>