<?php
   $paymentTestDatas = ""; //Output
   if ($_SESSION["loggedIn"]) {
      $paymentById = $functions->getPaymentById($_SESSION["user_access_token"],$_SESSION["example_payment_id"]);
      $paymentTestDatas .= "<H2>Get Payment By PaymentId</H2>\n";
      $paymentTestDatas .= "<b>Payment Id</b>: ".$paymentById->Data->PaymentId."<br />";
      $paymentTestDatas .= "<b>CreationDateTime</b>: ".$paymentById->Data->CreationDateTime."<br />";
      $paymentTestDatas .= "<b>Status</b>: ".$paymentById->Data->Status."<br />";
      $paymentTestDatas .= "<b>Initiation InstructionIdentification</b>: ".$paymentById->Data->Initiation->InstructionIdentification."<br />";
      $paymentTestDatas .= "<b>Initiation EndToEndIdentification</b>: ".$paymentById->Data->Initiation->EndToEndIdentification."<br />";
      $paymentTestDatas .= "<b>Initiation CreditorAccount SchemeName</b>: ".$paymentById->Data->Initiation->CreditorAccount->SchemeName."<br />";
      $paymentTestDatas .= "<b>Initiation CreditorAccount Identification</b>: ".$paymentById->Data->Initiation->CreditorAccount->Identification."<br />";
      $paymentTestDatas .= "<b>Initiation CreditorAccount Name</b>: ".$paymentById->Data->Initiation->CreditorAccount->Name."<br />";
      $paymentTestDatas .= "<b>Initiation CreditorAgent SchemeName</b>: ".$paymentById->Data->Initiation->CreditorAgent->SchemeName."<br />";
      $paymentTestDatas .= "<b>Initiation CreditorAgent Identification</b>: ".$paymentById->Data->Initiation->CreditorAgent->Identification."<br />";
      $paymentTestDatas .= "<b>Initiation InstructedAmount Amount</b>: ".$paymentById->Data->Initiation->InstructedAmount->Amount."<br />";
      $paymentTestDatas .= "<b>Initiation InstructedAmount Currency</b>: ".$paymentById->Data->Initiation->InstructedAmount->Currency."<br />";
   }
?>
<div style="width:50%;"><?php echo $paymentTestDatas; ?></div>