
<?php
require 'vendor/autoload.php';
 
$stripe = new \Stripe\StripeClient([
  "api_key" => 'sk_test_51PHp94P8D8E0X1o3lrxDHu79N0ql7bUkiGjbHaYoavzdOxf1hIUhKY9h4jzBlMHAL0LB8zjgPTDjrk8OGclQCXee00msXLjbzL'
]);

try {
  // Datos del producto
  $productData = [
    'name' => 'VIAJE',
    'description' => 'PERU - COLOMBIA',
    'images' => ['https://kingdomyouube.com/esencia/assets/img/place.png']
  ];

  $checkout_session = $stripe->checkout->sessions->create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'mxn',
        'product_data' => $productData,
        'unit_amount' => 240000, // El precio en centavos (2000 centavos = 20 USD)
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'ui_mode' => 'embedded',
  
 
    'phone_number_collection' => [
      'enabled' => true,
    ],
    'return_url' => 'http://localhost:8012/transportesafio/pago-realizado?idviaje=2&pasajeros=1&session_id={CHECKOUT_SESSION_ID}',
  ]);

  header('Content-Type: application/json');
  echo json_encode(['clientSecret' => $checkout_session->client_secret]);

} catch (Exception $e) {
  header('Content-Type: application/json', true, 500);
  echo json_encode(['error' => $e->getMessage()]);
}
?>
