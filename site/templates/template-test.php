<?php
 //$query = new atk4\dsql\Query();
 $pdf = 'SOPICK-0060218100,000.pdf';
 use Interfax\Client;
 
$interfax = new Client(['username' => 'cptechno', 'password' => '8628eag1e']);


 try {
	 $fax = $interfax->deliver([
	   // a valid fax number
	   'faxNumber' => '+19526532860',
	   // a path to an InterFAX
	   // compatible file
	   'file' => $config->documentstoragedirectory.$pdf,
	   'reference' => 'SO PICK 0060218100',
	   'replyAddress' => 'paul@cptechinc.com'
	 ]);
	 /*
	 // wait for the fax to send
// successfully
while(true) {
  // reload the fax data
  $fax = $fax->refresh();
  // sleep if pending
  if ($fax->status < 0) {
    sleep(10);
  } else {
    if ($fax->status == 0) {
      print "Sent!";
    } else {
      print "Error: ".$fax->status;
    }
    break;
  }
}
*/

 } catch (Interfax\Exception\RequestException $e) {
     echo $e->getMessage();
     // contains text detail that is available
     echo $e->getStatusCode();
     // the http status code that was received
     throw $e->getWrappedException();
     // The underlying Guzzle exception that was caught by the Interfax Client.
 }
