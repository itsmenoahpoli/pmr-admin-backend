<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Repositories\PaymentsRepository;
use App\Models\Transactions\TransactionPayment;
use App\Enums\PaymentTypes;
use App\Enums\PaymentStatuses;


class PaymentsService extends PaymentsRepository
{
    public function __construct()
    {
        parent::__construct(new TransactionPayment(), []);
    }

    private function createPaymongoHeader()
    {
        $publicKey = config('payment.paymongo.api_public_key');
        $secretKey = config('payment.paymongo.api_secret_key');

        if (!$publicKey || !$secretKey)
        {
            throw new \Exception('Paymongo API keys are not set');
        }

        $header = 'Basic '.base64_encode($secretKey.':');

        return [
            'Authorization' => $header,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json'
        ];
    }

    public function createPaymongoPayment($paymentData)
    {
        try
        {
            $payload = json_encode([
                'data' => [
                    'attributes' => [
                        'amount'        => $paymentData['amount'] * 100,
                        'description'   => $paymentData['description']
                    ]
                ]
            ]);

            $url = config('payment.paymongo.api_url');
            $result = Http::withHeaders(
                $this->createPaymongoHeader()
            )
            ->withBody($payload)
            ->post($url);

            Log::channel('payments')->info('Payment result: '. $result->body());
            return $result->json();
        } catch (\Exception $e)
        {
            Log::channel('payments')->error('Failed payment: '. $e->getMessage());
            throw $e;
        }
    }

    public function create($data)
    {
        if ($data['type'] === PaymentTypes::ONLINE)
        {
            $paymentResult = $this->createPaymongoPayment($data);
            $data['provider'] = 'paymongo';
            $data['provider_payment_id'] = $paymentResult['data']['id'];
            $data['provider_payment_type'] = $paymentResult['data']['type'];
            $data['provider_payment_attributes'] = json_encode($paymentResult['data']['attributes']);
        } else
        {
            $data['provider'] = null;
            $data['type'] = PaymentTypes::CASH;
            $data['status'] = PaymentStatuses::PAID;
        }

        return parent::create($data);
    }
}
