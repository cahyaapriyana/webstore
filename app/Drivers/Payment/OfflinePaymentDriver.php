<?php
declare(strict_types=1);

namespace App\Drivers\Payment;

use Spatie\LaravelData\DataCollection;
use App\Contract\PaymentDriverInterface;
use App\Data\PaymentData;

class OfflinePaymentDriver implements PaymentDriverInterface
{

    public readonly string $driver;

    public function __construct()
    {
        $this->driver = 'offline';
    }

      /** @return DataCollection<PaymentData> */
      public function getMethods() : DataCollection
    {
        return PaymentData::collect([
            PaymentData::from([
                'driver' => $this->driver,
                'method' => 'bank-bca-transfer',
                'label' => " Bank Transfer BCA",
                'payload' => [
                    'account_number' => '123123123',
                    'account_holder_name' => 'Cahya Apriyana',

                ]
            ])
                ], DataCollection::class);
    }

      public function process($sales_order){

      }
  
      public function shouldShowPayNowButton($sales_order) : bool
      {
        return false;
      }
  
      public function getRedirectUrl($sales_order) : ?string
      {
        return null;
      }

}