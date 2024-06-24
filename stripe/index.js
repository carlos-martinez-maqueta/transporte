// Initialize Stripe.js
const stripe = Stripe('pk_test_51PHp94P8D8E0X1o3tCvURXEzagUkuFeinlYJIJCD4LWqj0YwMKYxvKI5sByqYdFm8hUrmRjDVr2l7ZVf0pO35lvo00WXNfKcfn');
 
  var valor = localStorage.getItem('totalBoletos');
  var viaje = localStorage.getItem('viaje');
  var destino = localStorage.getItem('destino');
  var pasajeros = localStorage.getItem('asientos_reservados');
  console.log('El valor de miClave es:', valor);
  console.log('ID:', destino);
initialize();

// Fetch Checkout Session and retrieve the client secret
async function initialize() {
  try {
    if (!valor) {
      throw new Error('El valor de totalBoletos no está definido en localStorage.');
    }
    const fetchClientSecret = async () => {
      const response = await fetch(`https://transportesafe.com/stripe/checkout.php?destino=${encodeURIComponent(destino)}&monto=${encodeURIComponent(valor)}&viaje=${encodeURIComponent(viaje)}&pasajeros=${encodeURIComponent(pasajeros)}`, {
        method: "POST",
      });
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      const { clientSecret } = await response.json();
      return clientSecret;
    };

    // Initialize Checkout
    const checkout = await stripe.initEmbeddedCheckout({
      fetchClientSecret,
    });

    // Mount Checkout
    checkout.mount('#checkout');

  } catch (error) {
    console.error('Error during Stripe initialization:', error);
  }
}
