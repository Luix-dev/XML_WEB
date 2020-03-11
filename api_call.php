
    <?php
    if (!(file_exists("sports.pdf"))){

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
        $pdfFile = $serviceClient->processFile($foFile);
    } else {
        $pdfFile = 'sports.pdf';
    }

    // generate HTML output and show results of service request
    echo sprintf('<p><strong><a href="download.php?file=sports.pdf">download PDF</a></strong></p>');

    ?>
