<?php
    $accountTestDatas = ""; //Output
    if ($_SESSION["loggedIn"]) {
        //Get accounts
        $accountTestDatas .= "<H2>Accounts - Accounts By Id</H2>\n";
        $accounts = $functions->getAccounts($_SESSION["user_access_token"]);
 
        foreach ($accounts->Data->Account as $i=>$val){
            $accountById = $functions->getAccountByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $accountTestDatas .= "<b>AccountId</b>: ".$accountById->Data->Account[0]->AccountId."<br />";
            $accountTestDatas .= "<b>Currency</b>: ".$accountById->Data->Account[0]->Currency."<br />";
            $accountTestDatas .= "<b>Nickname</b>: ".$accountById->Data->Account[0]->Nickname."<br />";
            $accountTestDatas .= "<b>Account SchemeName</b>: ".$accountById->Data->Account[0]->Account->SchemeName."<br />";
            $accountTestDatas .= "<b>Account Identification</b>: ".$accountById->Data->Account[0]->Account->Identification."<br />";
            $accountTestDatas .= "<b>Account Name</b>: ".$accountById->Data->Account[0]->Account->Name."<br />";
            $accountTestDatas .= "<b>Servicer SchemeName</b>: ".$accountById->Data->Account[0]->Servicer->SchemeName."<br />";
            $accountTestDatas .= "<b>Servicer Identification</b>: ".$accountById->Data->Account[0]->Servicer->Identification."<br />";
            $accountTestDatas .= "<hr />";
        }

        $accountTestDatas .= "<H2>Get transactions</H2>\n";
        $transactions = $functions->getTransactions($_SESSION["user_access_token"]);
        foreach ($transactions->Data->Transaction as $i => $val) {
            $accountTestDatas .= "<b>AccountId</b>: ".$transactions->Data->Transaction[$i]->AccountId."<br />";
            $accountTestDatas .= "<b>TransactionId</b>: ".$transactions->Data->Transaction[$i]->TransactionId."<br />";
            $accountTestDatas .= "<b>Amount</b>: ".$transactions->Data->Transaction[$i]->Amount->Amount." ".$transactions->Data->Transaction[$i]->Amount->Currency."<br />";
            $accountTestDatas .= "<b>CreditDebitIndicator</b>: ".$transactions->Data->Transaction[$i]->CreditDebitIndicator."<br />";
            $accountTestDatas .= "<b>Status</b>: ".$transactions->Data->Transaction[$i]->Status."<br />";
            $accountTestDatas .= "<b>BookingDateTime</b>: ".$transactions->Data->Transaction[$i]->BookingDateTime."<br />";
            $accountTestDatas .= "<b>ValueDateTime</b>: ".$transactions->Data->Transaction[$i]->ValueDateTime."<br />";
            $accountTestDatas .= "<b>AddressLine</b>: ".$transactions->Data->Transaction[$i]->AddressLine."<br />";
            $accountTestDatas .= "<b>BookingDateTime</b>: ".$transactions->Data->Transaction[$i]->BookingDateTime."<br />";
            $accountTestDatas .= "<b>ProprietaryBankTransactionCode</b>: ".$transactions->Data->Transaction[$i]->ProprietaryBankTransactionCode->Code."<br />";
            $accountTestDatas .= "<hr />";
        }

        $accountTestDatas .= "<H2>Get Transactions By AccountId</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $transactionsByAccount = $functions->getTransactionsByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $accountTestDatas .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $accountTestDatas .= "<hr />";
            foreach ($transactionsByAccount->Data->Transaction as $j => $jv) {
                $accountTestDatas .= "<b>AccountId</b>: ".$transactionsByAccount->Data->Transaction[$j]->AccountId."<br />";
                $accountTestDatas .= "<b>TransactionId</b>: ".$transactionsByAccount->Data->Transaction[$j]->TransactionId."<br />";
                $accountTestDatas .= "<b>Amount</b>: ".$transactionsByAccount->Data->Transaction[$j]->Amount->Amount." ".$transactionsByAccount->Data->Transaction[$j]->Amount->Currency."<br />";
                $accountTestDatas .= "<b>CreditDebitIndicator</b>: ".$transactionsByAccount->Data->Transaction[$j]->CreditDebitIndicator."<br />";
                $accountTestDatas .= "<b>Status</b>: ".$transactionsByAccount->Data->Transaction[$j]->Status."<br />";
                $accountTestDatas .= "<b>BookingDateTime</b>: ".$transactionsByAccount->Data->Transaction[$j]->BookingDateTime."<br />";
                $accountTestDatas .= "<b>ValueDateTime</b>: ".$transactionsByAccount->Data->Transaction[$j]->ValueDateTime."<br />";
                $accountTestDatas .= "<b>AddressLine</b>: ".$transactionsByAccount->Data->Transaction[$j]->AddressLine."<br />";
                $accountTestDatas .= "<b>BookingDateTime</b>: ".$transactionsByAccount->Data->Transaction[$j]->BookingDateTime."<br />";
                $accountTestDatas .= "<b>ProprietaryBankTransactionCode</b>: ".$transactionsByAccount->Data->Transaction[$j]->ProprietaryBankTransactionCode->Code."<br />";
                $accountTestDatas .= "<hr />";
            }
        }
        
        $accountTestDatas .= "<H2>Get Beneficiaries</H2>";
        $beneficiaries = $functions->getBeneficiaries($_SESSION["user_access_token"]);
        foreach ($beneficiaries->Data->Beneficiary as $i => $val) {
            $accountTestDatas .= "<b>AccountId</b>: ".$beneficiaries->Data->Beneficiary[$i]->AccountId."<br />";
            $accountTestDatas .= "<b>BeneficiaryId</b>: ".$beneficiaries->Data->Beneficiary[$i]->BeneficiaryId."<br />";
            $accountTestDatas .= "<b>Reference</b>: ".$beneficiaries->Data->Beneficiary[$i]->Reference."<br />";
            $accountTestDatas .= "<b>Servicer SchemeName</b>: ".$beneficiaries->Data->Beneficiary[$i]->AccountId->Servicer->SchemeName."<br />";
            $accountTestDatas .= "<b>Servicer Identification</b>: ".$beneficiaries->Data->Beneficiary[$i]->AccountId->Servicer->Identification."<br />";
            $accountTestDatas .= "<b>CreditorAccount SchemeName</b>: ".$beneficiaries->Data->Beneficiary[$i]->CreditorAccount->SchemeName."<br />";
            $accountTestDatas .= "<b>CreditorAccount Identification</b>: ".$beneficiaries->Data->Beneficiary[$i]->CreditorAccount->Identification."<br />";
            $accountTestDatas .= "<b>CreditorAccount Name</b>: ".$beneficiaries->Data->Beneficiary[$i]->CreditorAccount->Name."<br />";
            $accountTestDatas .= "<b>CreditorAccount SecondaryIdentification</b>: ".$beneficiaries->Data->Beneficiary[$i]->CreditorAccount->SecondaryIdentification."<br />";
            $accountTestDatas .= "<hr />";
        }

        $accountTestDatas .= "<H2>Get Beneficiaries By Account Id</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $beneficiariesByAccount = $functions->getBeneficiariesByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $accountTestDatas .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $accountTestDatas .= "<hr />";
            foreach ($beneficiariesByAccount->Data->Beneficiary as $j => $jv) {
                $accountTestDatas .= "<b>AccountId</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->AccountId."<br />";
                $accountTestDatas .= "<b>Amount</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->Amount->Amount." ".$beneficiariesByAccount->Data->Beneficiary[$j]->Amount->Currency."<br />";
                $accountTestDatas .= "<b>CreditDebitIndicator</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->CreditDebitIndicator."<br />";
                $accountTestDatas .= "<b>Type</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->Type."<br />";
                $accountTestDatas .= "<b>DateTime</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->DateTime."<br />";
                $accountTestDatas .= "<b>CreditLine</b>: ".$beneficiariesByAccount->Data->Beneficiary[$j]->CreditLine[0]."<br />";
                $accountTestDatas .= "<hr />";
            }
        }

        $accountTestDatas .= "<H2>Get Balances</H2>";
        $balances = $functions->getBalances($_SESSION["user_access_token"]);
        foreach ($balances->Data->Balance as $i => $val) {
            $accountTestDatas .= "<b>AccountId</b>: ".$balances->Data->Balance[$i]->AccountId."<br />";
            $accountTestDatas .= "<b>Amount</b>: ".$balances->Data->Balance[$i]->Amount->Amount." ".$transactions->Data->Balance[$i]->Amount->Currency."<br />";
            $accountTestDatas .= "<b>CreditDebitIndicator</b>: ".$balances->Data->Balance[$i]->CreditDebitIndicator."<br />";
            $accountTestDatas .= "<b>Type</b>: ".$balances->Data->Balance[$i]->Type."<br />";
            $accountTestDatas .= "<b>DateTime</b>: ".$balances->Data->Balance[$i]->DateTime."<br />";
            $accountTestDatas .= "<b>CreditLine</b>: ".$balances->Data->Balance[$i]->CreditLine[0]."<br />";
            $accountTestDatas .= "<hr />";
        }

        $accountTestDatas .= "<H2>Get Balances By AccountId</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $balancesByAccount = $functions->getBalancesByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $accountTestDatas .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $accountTestDatas .= "<hr />";
            foreach ($balancesByAccount->Data->Balance as $j => $jv) {
                $accountTestDatas .= "<b>AccountId</b>: ".$balancesByAccount->Data->Balance[$i]->AccountId."<br />";
                $accountTestDatas .= "<b>Amount</b>: ".$balancesByAccount->Data->Balance[$i]->Amount->Amount." ".$balancesByAccount->Data->Balance[$i]->Amount->Currency."<br />";
                $accountTestDatas .= "<b>CreditDebitIndicator</b>: ".$balancesByAccount->Data->Balance[$i]->CreditDebitIndicator."<br />";
                $accountTestDatas .= "<b>Type</b>: ".$balancesByAccount->Data->Balance[$i]->Type."<br />";
                $accountTestDatas .= "<b>DateTime</b>: ".$balancesByAccount->Data->Balance[$i]->DateTime."<br />";
                $accountTestDatas .= "<b>CreditLine</b>: ".$balancesByAccount->Data->Balance[$i]->CreditLine[0]."<br />";
                $accountTestDatas .= "<hr />";
            }
        }

        $accountTestDatas .= "<H2>Get Direct Debits</H2>";
        $directDebits = $functions->getDirectDebits($_SESSION["user_access_token"]);
        foreach ($directDebits->Data->DirectDebit as $i => $val) {
            $accountTestDatas .= "<b>AccountId</b>: ".$directDebits->Data->DirectDebit[$i]->AccountId."<br />";
            $accountTestDatas .= "<b>DirectDebitId</b>: ".$directDebits->Data->DirectDebit[$i]->DirectDebitId."<br />";
            $accountTestDatas .= "<b>MandateIdentification</b>: ".$directDebits->Data->DirectDebit[$i]->MandateIdentification."<br />";
            $accountTestDatas .= "<b>DirectDebitStatusCode</b>: ".$directDebits->Data->DirectDebit[$i]->DirectDebitStatusCode."<br />";
            $accountTestDatas .= "<b>Name</b>: ".$directDebits->Data->DirectDebit[$i]->Name."<br />";
            $accountTestDatas .= "<b>PreviousPaymentDateTime</b>: ".$directDebits->Data->DirectDebit[$i]->PreviousPaymentDateTime."<br />";
            $accountTestDatas .= "<b>PreviousPaymentAmount</b>: ".$directDebits->Data->DirectDebit[$i]->PreviousPaymentAmount->Amount." ".$directDebits->Data->DirectDebit[$i]->PreviousPaymentAmount->Currency."<br />";
            $accountTestDatas .= "<hr />";
        }

        $accountTestDatas .= "<H2>Get Direct Debits By AccountId</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $directDebitsByAccount = $functions->getDirectDebitsByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $accountTestDatas .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $accountTestDatas .= "<hr />";
            foreach ($directDebitsByAccount->Data->DirectDebit as $j => $jv) {
                $accountTestDatas .= "<b>AccountId</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->AccountId."<br />";
                $accountTestDatas .= "<b>DirectDebitId</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->DirectDebitId."<br />";
                $accountTestDatas .= "<b>MandateIdentification</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->MandateIdentification."<br />";
                $accountTestDatas .= "<b>DirectDebitStatusCode</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->DirectDebitStatusCode."<br />";
                $accountTestDatas .= "<b>Name</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->Name."<br />";
                $accountTestDatas .= "<b>PreviousPaymentDateTime</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->PreviousPaymentDateTime."<br />";
                $accountTestDatas .= "<b>PreviousPaymentAmount</b>: ".$directDebitsByAccount->Data->DirectDebit[$j]->PreviousPaymentAmount->Amount." ".$directDebitsByAccount->Data->DirectDebit[$j]->PreviousPaymentAmount->Currency."<br />";
                $accountTestDatas .= "<hr />";
            }
        }

        $accountTestDatas .= "<H2>Get Standing Orders</H2>";
        $standingOrders = $functions->getStandingOrders($_SESSION["user_access_token"]);
        foreach ($standingOrders->Data->StandingOrder as $i => $val) {
            $accountTestDatas .= "<b>AccountId</b>: ".$standingOrders->Data->StandingOrder[$i]->AccountId."<br />";
            $accountTestDatas .= "<b>StandingOrderId</b>: ".$standingOrders->Data->StandingOrder[$i]->StandingOrderId."<br />";
            $accountTestDatas .= "<b>Frequency</b>: ".$standingOrders->Data->StandingOrder[$i]->Frequency."<br />";
            $accountTestDatas .= "<b>Reference</b>: ".$standingOrders->Data->StandingOrder[$i]->Reference."<br />";
            $accountTestDatas .= "<b>FirstPaymentDateTime</b>: ".$standingOrders->Data->StandingOrder[$i]->FirstPaymentDateTime."<br />";
            $accountTestDatas .= "<b>FirstPaymentAmount</b>: ".$standingOrders->Data->StandingOrder[$i]->FirstPaymentAmount->Amount." ".$transactions->Data->StandingOrder[$i]->FirstPaymentAmount->Currency."<br />";
            $accountTestDatas .= "<b>NextPaymentDateTime</b>: ".$standingOrders->Data->StandingOrder[$i]->NextPaymentDateTime."<br />";
            $accountTestDatas .= "<b>NextPaymentAmount</b>: ".$standingOrders->Data->StandingOrder[$i]->NextPaymentAmount->Amount." ".$transactions->Data->StandingOrder[$i]->NextPaymentAmount->Currency."<br />";
            $accountTestDatas .= "<b>FinalPaymentDateTime</b>: ".$standingOrders->Data->StandingOrder[$i]->FinalPaymentDateTime."<br />";
            $accountTestDatas .= "<b>FinalPaymentAmount</b>: ".$standingOrders->Data->StandingOrder[$i]->FinalPaymentAmount->Amount." ".$transactions->Data->StandingOrder[$i]->FinalPaymentAmount->Currency."<br />";
            $accountTestDatas .= "<b>Servicer SchemeName</b>: ".$standingOrders->Data->StandingOrder[$i]->Servicer->SchemeName."<br />";
            $accountTestDatas .= "<b>Servicer Identification</b>: ".$standingOrders->Data->StandingOrder[$i]->Servicer->Identification."<br />";
            $accountTestDatas .= "<b>CreditorAccount SchemeName</b>: ".$standingOrders->Data->StandingOrder[$i]->CreditorAccount->SchemeName."<br />";
            $accountTestDatas .= "<b>CreditorAccount Identification</b>: ".$standingOrders->Data->StandingOrder[$i]->CreditorAccount->Identification."<br />";
            $accountTestDatas .= "<b>CreditorAccount Name</b>: ".$standingOrders->Data->StandingOrder[$i]->CreditorAccount->Name."<br />";
            $accountTestDatas .= "<b>CreditorAccount SecondaryIdentification</b>: ".$standingOrders->Data->StandingOrder[$i]->CreditorAccount->SecondaryIdentification."<br />";
            $accountTestDatas .= "<hr />";
        }

        $accountTestDatas .= "<H2>Get Standing Orders By AccountId</H2>";
        foreach ($accounts->Data->Account as $i=>$iv){
            $standingOrdersByAccount = $functions->getStandingOrdersByAccountId($_SESSION["user_access_token"],$accounts->Data->Account[$i]->AccountId);
            $accountTestDatas .= "<H3>Account id: ".$accounts->Data->Account[$i]->AccountId."</H3>";
            $accountTestDatas .= "<hr />";
            foreach ($standingOrdersByAccount->Data->StandingOrder as $j => $jv) {
                $accountTestDatas .= "<b>AccountId</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->AccountId."<br />";
                $accountTestDatas .= "<b>StandingOrderId</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->StandingOrderId."<br />";
                $accountTestDatas .= "<b>Frequency</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->Frequency."<br />";
                $accountTestDatas .= "<b>Reference</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->Reference."<br />";
                $accountTestDatas .= "<b>FirstPaymentDateTime</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->FirstPaymentDateTime."<br />";
                $accountTestDatas .= "<b>FirstPaymentAmount</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->FirstPaymentAmount->Amount." ".$standingOrdersByAccount->Data->StandingOrder[$j]->FirstPaymentAmount->Currency."<br />";
                $accountTestDatas .= "<b>NextPaymentDateTime</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->NextPaymentDateTime."<br />";
                $accountTestDatas .= "<b>NextPaymentAmount</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->NextPaymentAmount->Amount." ".$standingOrdersByAccount->Data->StandingOrder[$j]->NextPaymentAmount->Currency."<br />";
                $accountTestDatas .= "<b>FinalPaymentDateTime</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->FinalPaymentDateTime."<br />";
                $accountTestDatas .= "<b>FinalPaymentAmount</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->FinalPaymentAmount->Amount." ".$standingOrdersByAccount->Data->StandingOrder[$j]->FinalPaymentAmount->Currency."<br />";
                $accountTestDatas .= "<b>Servicer SchemeName</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->Servicer->SchemeName."<br />";
                $accountTestDatas .= "<b>Servicer Identification</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->Servicer->Identification."<br />";
                $accountTestDatas .= "<b>CreditorAccount SchemeName</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->CreditorAccount->SchemeName."<br />";
                $accountTestDatas .= "<b>CreditorAccount Identification</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->CreditorAccount->Identification."<br />";
                $accountTestDatas .= "<b>CreditorAccount Name</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->CreditorAccount->Name."<br />";
                $accountTestDatas .= "<b>CreditorAccount SecondaryIdentification</b>: ".$standingOrdersByAccount->Data->StandingOrder[$j]->CreditorAccount->SecondaryIdentification."<br />";
                $accountTestDatas .= "<hr />";
            }
        }
    }
?>
<div style="width:50%;"><?php echo $accountTestDatas; ?></div>