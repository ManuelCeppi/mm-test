#!/bin/sh

echo $STRIPE_API_KEY
config --set test_mode_api_key $STRIPE_API_KEY
listen $STRIPE_API_KEY