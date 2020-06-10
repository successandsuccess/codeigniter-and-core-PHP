<?php
namespace PhpPot\Service;

require_once '../payment/vendor/autoload.php';

use Exception;
use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;

class StripePayment
{
    private $apiKey;

    private $stripeService;

    public function __construct()
    {
        require_once "../payment/config.php";
        $this->apiKey = STRIPE_SECRET_KEY;
        $this->stripeService = new \Stripe\Stripe();
        $this->stripeService->setVerifySslCerts(false);
        $this->stripeService->setApiKey($this->apiKey);
    }

    public function addCustomer($customerDetailsAry)
    {
        
        $customer = new Customer();
        
        $customerDetails = $customer->create($customerDetailsAry);
        
        return $customerDetails;
    }

    public function createToken($details){

        Stripe::setApiKey($this->apiKey);

        $exp_date = explode('/', $details['expire_date']);

        try{
            $result = \Stripe\Token::create([
                'card' => [
                    "number" => $details['number'],
                    "exp_month" => $exp_date[0],
                    "exp_year" => $exp_date[1],
                    "cvc" => $details['code']
                ]
            ]);

        } catch (Exception $e) {
            $result = 'error';
        }
        return $result;
    }

    public function chargeAmountFromCard($cardDetails)
    {
        $customerDetailsAry = array(
            'customer' => $cardDetails['name'],
            'source' => $cardDetails['token']
        );
        $customerResult = $this->addCustomer($customerDetailsAry);
        $charge = new Charge();
        $cardDetailsAry = array(
            'customer' => $customerResult->id,
            'amount' => $cardDetails['amount']*100 ,
            'currency' => $cardDetails['currency_code'],
            'description' => $cardDetails['item_name'],
            'metadata' => array(
                'order_id' => $cardDetails['item_number']
            )
        );
        $result = $charge->create($cardDetailsAry);

        return $result->jsonSerialize();
    }
}
