<?php
   $domesticPaymentConsent = ""; //Output
   if ($_SESSION["loggedIn"]) {
      $paymentById = $functions->getDomesticPaymentConsentByConsentId($_SESSION["user_access_token"],$_SESSION["example_payment_id"]);
      $domesticPaymentConsent .= "<H2>Get PaymentConsent By ConsentId</H2>\n";
      $domesticPaymentConsent .= "<b>ConsentId</b>: ".$paymentById->Data->ConsentId."<br />";
      $domesticPaymentConsent .= "<b>CreationDateTime</b>: ".$paymentById->Data->CreationDateTime."<br />";
      $domesticPaymentConsent .= "<b>Status</b>: ".$paymentById->Data->Status."<br />";
      $domesticPaymentConsent .= "<b>Initiation InstructionIdentification</b>: ".$paymentById->Data->Initiation->InstructionIdentification."<br />";
      $domesticPaymentConsent .= "<b>Initiation EndToEndIdentification</b>: ".$paymentById->Data->Initiation->EndToEndIdentification."<br />";
      $domesticPaymentConsent .= "<b>Initiation CreditorAccount SchemeName</b>: ".$paymentById->Data->Initiation->CreditorAccount->SchemeName."<br />";
      $domesticPaymentConsent .= "<b>Initiation CreditorAccount Identification</b>: ".$paymentById->Data->Initiation->CreditorAccount->Identification."<br />";
      $domesticPaymentConsent .= "<b>Initiation CreditorAccount Name</b>: ".$paymentById->Data->Initiation->CreditorAccount->Name."<br />";
      $domesticPaymentConsent .= "<b>Initiation CreditorAgent SchemeName</b>: ".$paymentById->Data->Initiation->CreditorAgent->SchemeName."<br />";
      $domesticPaymentConsent .= "<b>Initiation CreditorAgent Identification</b>: ".$paymentById->Data->Initiation->CreditorAgent->Identification."<br />";
      $domesticPaymentConsent .= "<b>Initiation InstructedAmount Amount</b>: ".$paymentById->Data->Initiation->InstructedAmount->Amount."<br />";
      $domesticPaymentConsent .= "<b>Initiation InstructedAmount Currency</b>: ".$paymentById->Data->Initiation->InstructedAmount->Currency."<br />";
   }
?>
<div style="width:50%;"><?php echo $domesticPaymentConsent; ?></div>