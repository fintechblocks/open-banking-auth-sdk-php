<?php
    $dataByAccountAccessConsent = ""; //Output
    if ($_SESSION["loggedIn"]) {
        $dataByAccountAccessConsent .= "<H2>Accounts - Accounts By Id</H2>\n";
        $accounts = $functions->getAccounts($_SESSION["user_access_token"]);
        foreach ($accounts->Data->Account as $i=>$val){
            $accountById = $functions->getAccountByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$accountById->Data->Account[0]->AccountId."<br />";
            $dataByAccountAccessConsent .= "<b>Currency</b>: ".$accountById->Data->Account[0]->Currency."<br />";
            $dataByAccountAccessConsent .= "<b>Nickname</b>: ".$accountById->Data->Account[0]->Nickname."<br />";
            $dataByAccountAccessConsent .= "<b>Account SchemeName</b>: ".$accountById->Data->Account[0]->Account->SchemeName."<br />";
            $dataByAccountAccessConsent .= "<b>Account Identification</b>: ".$accountById->Data->Account[0]->Account->Identification."<br />";
            $dataByAccountAccessConsent .= "<b>Account Name</b>: ".$accountById->Data->Account[0]->Account->Name."<br />";
            $dataByAccountAccessConsent .= "<b>Servicer SchemeName</b>: ".$accountById->Data->Account[0]->Servicer->SchemeName."<br />";
            $dataByAccountAccessConsent .= "<b>Servicer Identification</b>: ".$accountById->Data->Account[0]->Servicer->Identification."<br />";
            $dataByAccountAccessConsent .= "<hr />";
        }

        $dataByAccountAccessConsent .= "<H2>Get transactions</H2>\n";
        $transactions = $functions->getTransactions($_SESSION["user_access_token"]);
        foreach ($transactions->Data->Transaction as $i => $val) {
            $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$transactions->Data->Transaction[$i]->AccountId."<br />";
            $dataByAccountAccessConsent .= "<b>TransactionId</b>: ".$transactions->Data->Transaction[$i]->TransactionId."<br />";
            $dataByAccountAccessConsent .= "<b>Amount</b>: ".$transactions->Data->Transaction[$i]->Amount->Amount." ".$transactions->Data->Transaction[$i]->Amount->Currency."<br />";
            $dataByAccountAccessConsent .= "<b>CreditDebitIndicator</b>: ".$transactions->Data->Transaction[$i]->CreditDebitIndicator."<br />";
            $dataByAccountAccessConsent .= "<b>Status</b>: ".$transactions->Data->Transaction[$i]->Status."<br />";
            $dataByAccountAccessConsent .= "<b>BookingDateTime</b>: ".$transactions->Data->Transaction[$i]->BookingDateTime."<br />";
            $dataByAccountAccessConsent .= "<b>ValueDateTime</b>: ".$transactions->Data->Transaction[$i]->ValueDateTime."<br />";
            $dataByAccountAccessConsent .= "<b>AddressLine</b>: ".$transactions->Data->Transaction[$i]->AddressLine."<br />";
            $dataByAccountAccessConsent .= "<b>BookingDateTime</b>: ".$transactions->Data->Transaction[$i]->BookingDateTime."<br />";
            $dataByAccountAccessConsent .= "<b>ProprietaryBankTransactionCode</b>: ".$transactions->Data->Transaction[$i]->ProprietaryBankTransactionCode->Code."<br />";
            $dataByAccountAccessConsent .= "<hr />";
        }

        $dataByAccountAccessConsent .= "<H2>Get Transactions By AccountId</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $transactionsByAccount = $functions->getTransactionsByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $dataByAccountAccessConsent .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $dataByAccountAccessConsent .= "<hr />";
            foreach ($transactionsByAccount->Data->Transaction as $j => $jv) {
                $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$transactionsByAccount->Data->Transaction[$j]->AccountId."<br />";
                $dataByAccountAccessConsent .= "<b>TransactionId</b>: ".$transactionsByAccount->Data->Transaction[$j]->TransactionId."<br />";
                $dataByAccountAccessConsent .= "<b>Amount</b>: ".$transactionsByAccount->Data->Transaction[$j]->Amount->Amount." ".$transactionsByAccount->Data->Transaction[$j]->Amount->Currency."<br />";
                $dataByAccountAccessConsent .= "<b>CreditDebitIndicator</b>: ".$transactionsByAccount->Data->Transaction[$j]->CreditDebitIndicator."<br />";
                $dataByAccountAccessConsent .= "<b>Status</b>: ".$transactionsByAccount->Data->Transaction[$j]->Status."<br />";
                $dataByAccountAccessConsent .= "<b>BookingDateTime</b>: ".$transactionsByAccount->Data->Transaction[$j]->BookingDateTime."<br />";
                $dataByAccountAccessConsent .= "<b>ValueDateTime</b>: ".$transactionsByAccount->Data->Transaction[$j]->ValueDateTime."<br />";
                $dataByAccountAccessConsent .= "<b>AddressLine</b>: ".$transactionsByAccount->Data->Transaction[$j]->AddressLine."<br />";
                $dataByAccountAccessConsent .= "<b>BookingDateTime</b>: ".$transactionsByAccount->Data->Transaction[$j]->BookingDateTime."<br />";
                $dataByAccountAccessConsent .= "<b>ProprietaryBankTransactionCode</b>: ".$transactionsByAccount->Data->Transaction[$j]->ProprietaryBankTransactionCode->Code."<br />";
                $dataByAccountAccessConsent .= "<hr />";
            }
        }
        
        $dataByAccountAccessConsent .= "<H2>Get Beneficiaries</H2>";
        $beneficiaries = $functions->getBeneficiaries($_SESSION["user_access_token"]);
        foreach ($beneficiaries->Data->Beneficiary as $i => $val) {
            $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$beneficiaries->Data->Beneficiary[$i]->AccountId."<br />";
            $dataByAccountAccessConsent .= "<b>BeneficiaryId</b>: ".$beneficiaries->Data->Beneficiary[$i]->BeneficiaryId."<br />";
            $dataByAccountAccessConsent .= "<b>Reference</b>: ".$beneficiaries->Data->Beneficiary[$i]->Reference."<br />";
            $dataByAccountAccessConsent .= "<b>Servicer SchemeName</b>: ".$beneficiaries->Data->Beneficiary[$i]->AccountId->Servicer->SchemeName."<br />";
            $dataByAccountAccessConsent .= "<b>Servicer Identification</b>: ".$beneficiaries->Data->Beneficiary[$i]->AccountId->Servicer->Identification."<br />";
            $dataByAccountAccessConsent .= "<b>CreditorAccount SchemeName</b>: ".$beneficiaries->Data->Beneficiary[$i]->CreditorAccount->SchemeName."<br />";
            $dataByAccountAccessConsent .= "<b>CreditorAccount Identification</b>: ".$beneficiaries->Data->Beneficiary[$i]->CreditorAccount->Identification."<br />";
            $dataByAccountAccessConsent .= "<b>CreditorAccount Name</b>: ".$beneficiaries->Data->Beneficiary[$i]->CreditorAccount->Name."<br />";
            $dataByAccountAccessConsent .= "<b>CreditorAccount SecondaryIdentification</b>: ".$beneficiaries->Data->Beneficiary[$i]->CreditorAccount->SecondaryIdentification."<br />";
            $dataByAccountAccessConsent .= "<hr />";
        }

        $dataByAccountAccessConsent .= "<H2>Get Beneficiaries By Account Id</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $beneficiariesByAccount = $functions->getBeneficiariesByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $dataByAccountAccessConsent .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $dataByAccountAccessConsent .= "<hr />";
            foreach ($beneficiariesByAccount->Data->Beneficiary as $j => $jv) {
                $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->AccountId."<br />";
                $dataByAccountAccessConsent .= "<b>Amount</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->Amount->Amount." ".$beneficiariesByAccount->Data->Beneficiary[$j]->Amount->Currency."<br />";
                $dataByAccountAccessConsent .= "<b>CreditDebitIndicator</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->CreditDebitIndicator."<br />";
                $dataByAccountAccessConsent .= "<b>Type</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->Type."<br />";
                $dataByAccountAccessConsent .= "<b>DateTime</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->DateTime."<br />";
                $dataByAccountAccessConsent .= "<b>CreditLine</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->CreditLine[0]."<br />";
                $dataByAccountAccessConsent .= "<hr />";
            }
        }

        $dataByAccountAccessConsent .= "<H2>Get Balances</H2>";
        $balances = $functions->getBalances($_SESSION["user_access_token"]);
        foreach ($balances->Data->Balance as $i => $val) {
            $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$balances->Data->Balance[$i]->AccountId."<br />";
            $dataByAccountAccessConsent .= "<b>Amount</b>: ".$balances->Data->Balance[$i]->Amount->Amount." ".$transactions->Data->Balance[$i]->Amount->Currency."<br />";
            $dataByAccountAccessConsent .= "<b>CreditDebitIndicator</b>: ".$balances->Data->Balance[$i]->CreditDebitIndicator."<br />";
            $dataByAccountAccessConsent .= "<b>Type</b>: ".$balances->Data->Balance[$i]->Type."<br />";
            $dataByAccountAccessConsent .= "<b>DateTime</b>: ".$balances->Data->Balance[$i]->DateTime."<br />";
            $dataByAccountAccessConsent .= "<b>CreditLine</b>: ".$balances->Data->Balance[$i]->CreditLine[0]."<br />";
            $dataByAccountAccessConsent .= "<hr />";
        }

        $dataByAccountAccessConsent .= "<H2>Get Balances By AccountId</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $balancesByAccount = $functions->getBalancesByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $dataByAccountAccessConsent .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $dataByAccountAccessConsent .= "<hr />";
            foreach ($balancesByAccount->Data->Balance as $j => $jv) {
                $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$balancesByAccount->Data->Balance[$i]->AccountId."<br />";
                $dataByAccountAccessConsent .= "<b>Amount</b>: ".$balancesByAccount->Data->Balance[$i]->Amount->Amount." ".$balancesByAccount->Data->Balance[$i]->Amount->Currency."<br />";
                $dataByAccountAccessConsent .= "<b>CreditDebitIndicator</b>: ".$balancesByAccount->Data->Balance[$i]->CreditDebitIndicator."<br />";
                $dataByAccountAccessConsent .= "<b>Type</b>: ".$balancesByAccount->Data->Balance[$i]->Type."<br />";
                $dataByAccountAccessConsent .= "<b>DateTime</b>: ".$balancesByAccount->Data->Balance[$i]->DateTime."<br />";
                $dataByAccountAccessConsent .= "<b>CreditLine</b>: ".$balancesByAccount->Data->Balance[$i]->CreditLine[0]."<br />";
                $dataByAccountAccessConsent .= "<hr />";
            }
        }

        $dataByAccountAccessConsent .= "<H2>Get Direct Debits</H2>";
        $directDebits = $functions->getDirectDebits($_SESSION["user_access_token"]);
        foreach ($directDebits->Data->DirectDebit as $i => $val) {
            $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$directDebits->Data->DirectDebit[$i]->AccountId."<br />";
            $dataByAccountAccessConsent .= "<b>DirectDebitId</b>: ".$directDebits->Data->DirectDebit[$i]->DirectDebitId."<br />";
            $dataByAccountAccessConsent .= "<b>MandateIdentification</b>: ".$directDebits->Data->DirectDebit[$i]->MandateIdentification."<br />";
            $dataByAccountAccessConsent .= "<b>DirectDebitStatusCode</b>: ".$directDebits->Data->DirectDebit[$i]->DirectDebitStatusCode."<br />";
            $dataByAccountAccessConsent .= "<b>Name</b>: ".$directDebits->Data->DirectDebit[$i]->Name."<br />";
            $dataByAccountAccessConsent .= "<b>PreviousPaymentDateTime</b>: ".$directDebits->Data->DirectDebit[$i]->PreviousPaymentDateTime."<br />";
            $dataByAccountAccessConsent .= "<b>PreviousPaymentAmount</b>: ".$directDebits->Data->DirectDebit[$i]->PreviousPaymentAmount->Amount." ".$directDebits->Data->DirectDebit[$i]->PreviousPaymentAmount->Currency."<br />";
            $dataByAccountAccessConsent .= "<hr />";
        }

        $dataByAccountAccessConsent .= "<H2>Get Direct Debits By AccountId</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $directDebitsByAccount = $functions->getDirectDebitsByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $dataByAccountAccessConsent .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $dataByAccountAccessConsent .= "<hr />";
            foreach ($directDebitsByAccount->Data->DirectDebit as $j => $jv) {
                $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->AccountId."<br />";
                $dataByAccountAccessConsent .= "<b>DirectDebitId</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->DirectDebitId."<br />";
                $dataByAccountAccessConsent .= "<b>MandateIdentification</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->MandateIdentification."<br />";
                $dataByAccountAccessConsent .= "<b>DirectDebitStatusCode</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->DirectDebitStatusCode."<br />";
                $dataByAccountAccessConsent .= "<b>Name</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->Name."<br />";
                $dataByAccountAccessConsent .= "<b>PreviousPaymentDateTime</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->PreviousPaymentDateTime."<br />";
                $dataByAccountAccessConsent .= "<b>PreviousPaymentAmount</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->PreviousPaymentAmount->Amount." ".$directDebitsByAccount->Data->DirectDebit[$j]->PreviousPaymentAmount->Currency."<br />";
                $dataByAccountAccessConsent .= "<hr />";
            }
        }

        $dataByAccountAccessConsent .= "<H2>Get Standing Orders</H2>";
        $standingOrders = $functions->getStandingOrders($_SESSION["user_access_token"]);
        foreach ($standingOrders->Data->StandingOrder as $i => $val) {
            $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$standingOrders->Data->StandingOrder[$i]->AccountId."<br />";
            $dataByAccountAccessConsent .= "<b>StandingOrderId</b>: ".$standingOrders->Data->StandingOrder[$i]->StandingOrderId."<br />";
            $dataByAccountAccessConsent .= "<b>Frequency</b>: ".$standingOrders->Data->StandingOrder[$i]->Frequency."<br />";
            $dataByAccountAccessConsent .= "<b>Reference</b>: ".$standingOrders->Data->StandingOrder[$i]->Reference."<br />";
            $dataByAccountAccessConsent .= "<b>FirstPaymentDateTime</b>: ".$standingOrders->Data->StandingOrder[$i]->FirstPaymentDateTime."<br />";
            $dataByAccountAccessConsent .= "<b>FirstPaymentAmount</b>: ".$standingOrders->Data->StandingOrder[$i]->FirstPaymentAmount->Amount." ".$transactions->Data->StandingOrder[$i]->FirstPaymentAmount->Currency."<br />";
            $dataByAccountAccessConsent .= "<b>NextPaymentDateTime</b>: ".$standingOrders->Data->StandingOrder[$i]->NextPaymentDateTime."<br />";
            $dataByAccountAccessConsent .= "<b>NextPaymentAmount</b>: ".$standingOrders->Data->StandingOrder[$i]->NextPaymentAmount->Amount." ".$transactions->Data->StandingOrder[$i]->NextPaymentAmount->Currency."<br />";
            $dataByAccountAccessConsent .= "<b>FinalPaymentDateTime</b>: ".$standingOrders->Data->StandingOrder[$i]->FinalPaymentDateTime."<br />";
            $dataByAccountAccessConsent .= "<b>FinalPaymentAmount</b>: ".$standingOrders->Data->StandingOrder[$i]->FinalPaymentAmount->Amount." ".$transactions->Data->StandingOrder[$i]->FinalPaymentAmount->Currency."<br />";
            $dataByAccountAccessConsent .= "<b>Servicer SchemeName</b>: ".$standingOrders->Data->StandingOrder[$i]->Servicer->SchemeName."<br />";
            $dataByAccountAccessConsent .= "<b>Servicer Identification</b>: ".$standingOrders->Data->StandingOrder[$i]->Servicer->Identification."<br />";
            $dataByAccountAccessConsent .= "<b>CreditorAccount SchemeName</b>: ".$standingOrders->Data->StandingOrder[$i]->CreditorAccount->SchemeName."<br />";
            $dataByAccountAccessConsent .= "<b>CreditorAccount Identification</b>: ".$standingOrders->Data->StandingOrder[$i]->CreditorAccount->Identification."<br />";
            $dataByAccountAccessConsent .= "<b>CreditorAccount Name</b>: ".$standingOrders->Data->StandingOrder[$i]->CreditorAccount->Name."<br />";
            $dataByAccountAccessConsent .= "<b>CreditorAccount SecondaryIdentification</b>: ".$standingOrders->Data->StandingOrder[$i]->CreditorAccount->SecondaryIdentification."<br />";
            $dataByAccountAccessConsent .= "<hr />";
        }

        $dataByAccountAccessConsent .= "<H2>Get Standing Orders By AccountId</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $standingOrdersByAccount = $functions->getStandingOrdersByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $dataByAccountAccessConsent .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $dataByAccountAccessConsent .= "<hr />";
            foreach ($standingOrdersByAccount->Data->StandingOrder as $j => $jv) {
                $dataByAccountAccessConsent .= "<b>AccountId</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->AccountId."<br />";
                $dataByAccountAccessConsent .= "<b>StandingOrderId</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->StandingOrderId."<br />";
                $dataByAccountAccessConsent .= "<b>Frequency</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->Frequency."<br />";
                $dataByAccountAccessConsent .= "<b>Reference</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->Reference."<br />";
                $dataByAccountAccessConsent .= "<b>FirstPaymentDateTime</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->FirstPaymentDateTime."<br />";
                $dataByAccountAccessConsent .= "<b>FirstPaymentAmount</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->FirstPaymentAmount->Amount." ".$standingOrdersByAccount->Data->StandingOrder[$j]->FirstPaymentAmount->Currency."<br />";
                $dataByAccountAccessConsent .= "<b>NextPaymentDateTime</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->NextPaymentDateTime."<br />";
                $dataByAccountAccessConsent .= "<b>NextPaymentAmount</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->NextPaymentAmount->Amount." ".$standingOrdersByAccount->Data->StandingOrder[$j]->NextPaymentAmount->Currency."<br />";
                $dataByAccountAccessConsent .= "<b>FinalPaymentDateTime</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->FinalPaymentDateTime."<br />";
                $dataByAccountAccessConsent .= "<b>FinalPaymentAmount</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->FinalPaymentAmount->Amount." ".$standingOrdersByAccount->Data->StandingOrder[$j]->FinalPaymentAmount->Currency."<br />";
                $dataByAccountAccessConsent .= "<b>Servicer SchemeName</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->Servicer->SchemeName."<br />";
                $dataByAccountAccessConsent .= "<b>Servicer Identification</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->Servicer->Identification."<br />";
                $dataByAccountAccessConsent .= "<b>CreditorAccount SchemeName</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->CreditorAccount->SchemeName."<br />";
                $dataByAccountAccessConsent .= "<b>CreditorAccount Identification</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->CreditorAccount->Identification."<br />";
                $dataByAccountAccessConsent .= "<b>CreditorAccount Name</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->CreditorAccount->Name."<br />";
                $dataByAccountAccessConsent .= "<b>CreditorAccount SecondaryIdentification</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->CreditorAccount->SecondaryIdentification."<br />";
                $dataByAccountAccessConsent .= "<hr />";
            }
        }
    }
?>
<div style="width:50%;"><?php echo $dataByAccountAccessConsent; ?></div>