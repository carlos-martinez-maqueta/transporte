// Initialize Stripe.js
const stripe = Stripe('pk_test_51PHp94P8D8E0X1o3tCvURXEzagUkuFeinlYJIJCD4LWqj0YwMKYxvKI5sByqYdFm8hUrmRjDVr2l7ZVf0pO35lvo00WXNfKcfn');

initialize();

// Fetch Checkout Session and retrieve the client secret
async function initialize() {
  try {
    const fetchClientSecret = async () => {
      const response = await fetch("http://localhost:8012/transportesafio/stripe/checkout.php", {
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
