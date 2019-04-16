<?php 
    $devKey        = ""; 
    $password    = ""; 
    $accountId    = ""; 
    
    // Create the SoapClient instance 
    try {
        // $url = "DDRService.wsdl"; 
        // $endpointURI = "https://auctiondata.iaai.com/Service.svc";
        // // $options = array('login' => 'autosubastausa', 'password' => 'junior27', 'location' => $endpointURI);
        // $sc = new SoapClient($url, array('location' => $endpointURI));

        function getLocationForPort($wsdl, $portName) {

            $file = file_get_contents($wsdl);
        
            $xml = new SimpleXmlElement($file);
        
            $query = "wsdl:service/wsdl:port[@name='$portName']/soap:address";
            $address = $xml->xpath($query);

            var_dump($address);
            if (!empty($address)) {
                $location = (string)$address[0]['location'];
                return $location;
            }
        
            return false;
        }
        
        $wsdl = "DDRService.wsdl"; 
        $endpointURI = "https://auctiondata.iaai.com/Service.svc";
        $client = new SoapClient($wsdl);
        $sslLocation = getLocationForPort($wsdl, 'BasicHttpBinding_IDDRService');
        var_dump($sslLocation);
        
        if ($sslLocation) {
            $client->__setLocation($location);
        }
    
        var_dump($client);
    } catch (exception $exc) {
        var_dump($exc);
    }
?>