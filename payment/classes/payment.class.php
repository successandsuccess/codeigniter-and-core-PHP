<?php

// use \PhpPot\Service\StripePayment;
//echo phpinfo();


// require_once 'StripePayment.class.php';


 require 'sdk-php/autoload.php';
  require_once 'sdk-php/constants/SampleCodeConstants.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;

  define("AUTHORIZENET_LOG_FILE", "phplog");

// Common setup for API credentials  
 
class PaymentObject

{

    public function process($requestDetail){



        $exp_date = explode('/', $requestDetail['expire_date']);



        if (count($exp_date) < 2) {

            return 'error';

        }


        //      // Common setup for API credentials  
        //   $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();   
        //   $merchantAuthentication->setName("8s7qEdh4SCdm");   
        //   $merchantAuthentication->setTransactionKey("98j6fB7qnFR72AAX");   
        //   $refId = 'ref' . time();

        // // Create the payment data for a credit card
        //   $creditCard = new AnetAPI\CreditCardType();
        //  // $creditCard->setCardNumber("4111111111111111" );  
        //  // $creditCard->setExpirationDate( "2038-12");
        //  // echo $requestDetail['number'];
        //     $creditCard->setCardNumber($requestDetail['number']);  
        //   $creditCard->setExpirationDate($requestDetail['expire_date']);
        //   $paymentOne = new AnetAPI\PaymentType();
        //   $paymentOne->setCreditCard($creditCard);

        // // Create a transaction
        //   $transactionRequestType = new AnetAPI\TransactionRequestType();
        //   $transactionRequestType->setTransactionType("authCaptureTransaction");   
        //   $transactionRequestType->setAmount(floatval($requestDetail['amount']));
        //   $transactionRequestType->setPayment($paymentOne);
        //   $request = new AnetAPI\CreateTransactionRequest();
        //   $request->setMerchantAuthentication($merchantAuthentication);
        //   $request->setRefId( $refId);
        //   $request->setTransactionRequest($transactionRequestType);
        //   $controller = new AnetController\CreateTransactionController($request);
        //   $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);   

        // if ($response != null) 
        // {
        //   $tresponse = $response->getTransactionResponse();

        //   if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
        //   {
            
        //      echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
        //     echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";

        //      return 'success';
        //   }
        //   else
        //   {
        //     echo "Charge Credit Card ERROR :  Invalid response\n";
        //     echo '<pre>'; print_r($response);
        //     //return 'error';
        //   }
        // }  
        // else
        // {
        //   echo  "Charge Credit Card Null response returned";
        //     return 'error';
        // }






          /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
   // $merchantAuthentication->setName(\SampleCodeConstants::MERCHANT_LOGIN_ID);
   // $merchantAuthentication->setTransactionKey(\SampleCodeConstants::MERCHANT_TRANSACTION_KEY);

    $merchantAuthentication->setName(\SampleCodeConstants::MERCHANT_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(\SampleCodeConstants::MERCHANT_TRANSACTION_KEY);
    
    
    // Set the transaction's refId
    $refId = 'ref' . time();

    // Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($requestDetail['number']);
    $creditCard->setExpirationDate($requestDetail['expire_date']);
    $creditCard->setCardCode($requestDetail['code']);

    // Add the payment data to a paymentType object
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

    // Create order information
    // $order = new AnetAPI\OrderType();
    // $order->setInvoiceNumber("10101");
    // $order->setDescription("Golf Shirts");

   // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName($requestDetail['name']);
    //$customerAddress->setLastName("Johnson");
   // $customerAddress->setCompany("Souveniropolis");
    $customerAddress->setAddress($requestDetail['address']);
    $customerAddress->setCity($requestDetail['city']);
    $customerAddress->setState($requestDetail['state']);
    $customerAddress->setZip($requestDetail['zip']);
   //$customerAddress->setCountry($requestDetail['code']);

    // Set the customer's identifying information
    // $customerData = new AnetAPI\CustomerDataType();
    // $customerData->setType("individual");
    // $customerData->setId("99999456654");
    // $customerData->setEmail("EllenJohnson@example.com");

    // Add values for transaction settings
    // $duplicateWindowSetting = new AnetAPI\SettingType();
    // $duplicateWindowSetting->setSettingName("duplicateWindow");
    // $duplicateWindowSetting->setSettingValue("60");

    // Add some merchant defined fields. These fields won't be stored with the transaction,
    // but will be echoed back in the response.
    // $merchantDefinedField1 = new AnetAPI\UserFieldType();
    // $merchantDefinedField1->setName("customerLoyaltyNum");
    // $merchantDefinedField1->setValue("1128836273");

    // $merchantDefinedField2 = new AnetAPI\UserFieldType();
    // $merchantDefinedField2->setName("favoriteColor");
    // $merchantDefinedField2->setValue("blue");

    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $amountData = $requestDetail['amount'];
    $amtD = str_replace( ',', '', $amountData );
    $transactionRequestType->setAmount(floatval($amtD));
  //  $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    $transactionRequestType->setBillTo($customerAddress);
   // $transactionRequestType->setCustomer($customerData);
   // $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
   // $transactionRequestType->addToUserFields($merchantDefinedField1);
    //$transactionRequestType->addToUserFields($merchantDefinedField2);

    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
    

    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();
        
            if ($tresponse != null && $tresponse->getMessages() != null) {
               // echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
               // echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                //echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
               // echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                //echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
                return array("code"=>"success","msg"=>"Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n");
            } else {
              //  echo "Transaction Failed \n";
                if ($tresponse->getErrors() != null) {
                   // echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                   // echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                   return array("code"=>"error","msg"=>$tresponse->getErrors()[0]->getErrorText() . "\n");
                }
            }
            // Or, print errors if the API request wasn't successful
        } else {
          //  echo "Transaction Failed \n";
            $tresponse = $response->getTransactionResponse();
        
            if ($tresponse != null && $tresponse->getErrors() != null) {
               // echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
               // echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                 return array("code"=>"error","msg"=>$tresponse->getErrors()[0]->getErrorText() . "\n");
            } else {
                //echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                //echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
                 return array("code"=>"error","msg"=>$response->getMessages()->getMessage()[0]->getText() . "\n");
            }
        }
    } else {
       // echo  "No response returned \n";
       // return "No response returned \n";
      return array("code"=>"error","msg"=>"No response returned \n");
    }

    return $response;









        // $stripePayment = new StripePayment();



        // $token = $stripePayment->createToken($requestDetail);



        // if ($token == 'error'){

        //     return 'error';

        // }

        // else {

        //     $requestDetail['token'] = $token;

        //     $stripeResponse = $stripePayment->chargeAmountFromCard($requestDetail);



        //     if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {

        //         return 'success';

        //     }else {

        //         return 'error';

        //     }

        //}

    }

}

?>