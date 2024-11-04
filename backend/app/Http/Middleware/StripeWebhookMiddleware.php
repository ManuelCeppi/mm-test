<?php

namespace App\Http\Middleware;

use App\Models\PaymentGatewayEvent;
use Stripe\Event;
use Stripe\Webhook;

class StripeWebhookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, \Closure $next)
    {
        $payload = $request->json();
        // Get the signature header
        $signatureHeader = $request->header('Stripe-Signature');
        // Check if it's live mode or not: this way, we can understand which secret key to use
        $livemode = $payload->get('livemode') ?? false;
        $eventType = $payload->get('type');

        switch ($eventType) {
            case Event::PAYMENT_INTENT_SUCCEEDED:
                if (!$livemode) {
                    $endpointSecret = env('STRIPE_WEBHOOK_PI_TEST_SK');
                } else {
                    $endpointSecret = env('STRIPE_WEBHOOK_PI_LIVE_SK');
                }
                break;
            case Event::PAYMENT_INTENT_PAYMENT_FAILED:
                if (!$livemode) {
                    $endpointSecret = env('STRIPE_WEBHOOK_PI_FAILED_TEST_SK');
                } else {
                    $endpointSecret = env('STRIPE_WEBHOOK_PI_FAILED_LIVE_SK');
                }
                break;
            case Event::SETUP_INTENT_SUCCEEDED:
                if (!$livemode) {
                    $endpointSecret = env('STRIPE_WEBHOOK_SI_TEST_SK');
                } else {
                    $endpointSecret = env('STRIPE_WEBHOOK_SI_LIVE_SK');
                }
            default:
                throw new \Exception('Invalid stripe event type');
        }

        /**
         * Build event with signature key
         */
        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $signatureHeader,
                $endpointSecret
            );
        } catch (\UnexpectedValueException $e) {
            throw new \Exception("Unexpected value on Stripe webhook: {$e->getMessage()}");
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            throw new \Exception("Invalid signature on Stripe webhook: {$e->getMessage()}");
        }

        // Add the event to db
        $paymentGatewayEvent = new PaymentGatewayEvent();

        $paymentGatewayEvent->payment_gateway_event_id = $event->id;
        $paymentGatewayEvent->payment_gateway = 'stripe';
        $paymentGatewayEvent->type = $eventType;
        $paymentGatewayEvent->data = $payload;
        $paymentGatewayEvent->processed = false;

        $paymentGatewayEvent->save();
        // Add the event to the request
        $request->merge(['webhookEvent' => $event]);

        return $next($request);
    }
}
