<?php
declare(strict_types=1);

namespace App\Drivers\Payment;

use Spatie\LaravelData\DataCollection;
use App\Contract\PaymentDriverInterface;
use App\Data\PaymentData;
use App\Data\SalesOrderData;

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

      public function process(SalesOrderData $sales_order){

      }
  
      public function shouldShowPayNowButton(SalesOrderData $sales_order) : bool
      {
        return false;
      }
  
      public function getRedirectUrl(SalesOrderData $sales_order) : ?string
      {
        return null;
      }

}