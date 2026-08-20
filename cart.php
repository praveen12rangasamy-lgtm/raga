<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Bag & Checkout — Raga Boutique</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="images/raga_favicon.png">
  <meta name="description" content="Review your shopping cart items, apply promo discount codes, and complete your purchase securely at Raga Boutique.">
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              burgundy: '#702152',
              burgundyLight: '#8b2968',
              gold: '#d4b270',
              goldDark: '#bfa061',
              cream: '#faf6f0',
              charcoal: '#2c2c2c',
            }
          },
          fontFamily: {
            serif: ['"Playfair Display"', 'serif'],
            sans: ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>
  
  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-brand-cream text-brand-charcoal min-h-screen flex flex-col">

  <!-- Global Dynamic Header -->
  <header id="global-header" class="w-full bg-white z-40"></header>

  <!-- Title section -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-6 w-full">
    <h1 class="font-serif text-3xl font-bold text-brand-burgundy">Shopping Bag & Checkout</h1>
    <div class="h-0.5 w-16 bg-brand-gold mt-3"></div>
  </section>

  <!-- Main section -->
  <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
    
    <!-- Empty Cart state -->
    <div id="cart-empty-state" class="hidden flex flex-col items-center justify-center py-20 text-center text-gray-500 bg-white border border-brand-gold/10 max-w-xl mx-auto shadow-sm">
      <div class="p-4 bg-brand-cream/40 border border-brand-gold/15 rounded-full mb-4">
        <svg class="h-12 w-12 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
      </div>
      <h3 class="font-serif text-lg font-bold text-brand-burgundy mb-2">Your Shopping Bag is Empty</h3>
      <p class="text-xs text-gray-400 max-w-[280px] mb-6">You haven't added any traditional Indian weaves to your bag yet.</p>
      <a href="collections.php" class="bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-widest font-bold py-3.5 px-8 border-b-2 border-brand-gold transition duration-300">
        Browse Collections
      </a>
    </div>

    <!-- Active Cart contents layout (Two columns) -->
    <div id="cart-main-layout" class="hidden flex flex-col lg:flex-row gap-8 items-start">
      
      <!-- Left Column: Cart Items List -->
      <div class="w-full lg:flex-1 bg-white p-6 border border-brand-gold/15 shadow-sm space-y-6">
        <div class="flex items-center justify-between border-b border-brand-gold/10 pb-3">
          <div class="flex items-center space-x-2.5">
            <button type="button" onclick="if(window.history.length > 1){ window.history.back(); } else { window.location.href='collections.php'; }" class="p-1.5 text-brand-burgundy hover:text-brand-gold transition-colors duration-200 focus:outline-none flex items-center justify-center rounded-full hover:bg-brand-cream/60" title="Go Back">
              <svg class="h-5 w-5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
            </button>
            <h3 class="font-serif text-lg font-bold text-brand-burgundy">Bag Items</h3>
          </div>
        </div>
        <div id="cart-page-items-list" class="divide-y divide-brand-gold/10">
          <!-- Dynamically populated via JS -->
        </div>
      </div>

      <!-- Right Column: Summary & Checkout Forms -->
      <div class="w-full lg:w-[420px] space-y-6">
        
        <!-- Summary block -->
        <div class="bg-white p-6 border border-brand-gold/15 shadow-sm">
          <h3 class="font-serif text-lg font-bold text-brand-burgundy border-b border-brand-gold/10 pb-3 mb-4">Price details</h3>
          <div class="space-y-3.5 text-sm">
            <div class="flex justify-between">
              <span class="text-gray-600">Subtotal:</span>
              <span id="summary-subtotal" class="font-semibold">₹ 0</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Shipping Fee:</span>
              <span id="summary-shipping" class="font-semibold text-green-700">FREE</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">GST / Taxes (Included):</span>
              <span id="summary-tax" class="font-semibold text-gray-400">Included</span>
            </div>
            <div id="summary-discount-row" class="hidden flex justify-between text-green-700 font-semibold">
              <span>Discount Applied:</span>
              <span id="summary-discount">- ₹ 0</span>
            </div>

            <hr class="border-brand-gold/15 my-4">

            <div class="flex justify-between text-base font-bold text-brand-burgundy pt-1">
              <span>Order Total:</span>
              <span id="summary-total" class="text-brand-burgundy">₹ 0</span>
            </div>
          </div>
        </div>

        <!-- Checkout Details Form -->
        <div class="bg-white p-6 border border-brand-gold/15 shadow-sm">
          <h3 class="font-serif text-lg font-bold text-brand-burgundy border-b border-brand-gold/10 pb-3 mb-4">Delivery details</h3>
          <form id="checkout-form" onsubmit="handlePlaceOrder(event)" class="space-y-4 text-xs">
            
            <div>
              <label for="ship-full" class="block font-semibold mb-1">Full Name *</label>
              <input type="text" id="ship-full" required class="w-full bg-brand-cream/20 p-2.5 border border-brand-gold/20 focus:outline-none focus:border-brand-burgundy">
            </div>

            <div>
              <label for="ship-email" class="block font-semibold mb-1">Email Address *</label>
              <input type="email" id="ship-email" required class="w-full bg-brand-cream/20 p-2.5 border border-brand-gold/20 focus:outline-none focus:border-brand-burgundy">
            </div>

            <div>
              <label for="ship-phone" class="block font-semibold mb-1">Mobile Number *</label>
              <input type="tel" id="ship-phone" required class="w-full bg-brand-cream/20 p-2.5 border border-brand-gold/20 focus:outline-none focus:border-brand-burgundy" placeholder="10-digit number">
            </div>

            <div>
              <label for="ship-address" class="block font-semibold mb-1">Street Address *</label>
              <textarea id="ship-address" required rows="2" class="w-full bg-brand-cream/20 p-2.5 border border-brand-gold/20 focus:outline-none focus:border-brand-burgundy"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label for="ship-pin" class="block font-semibold mb-1">Pincode *</label>
                <input type="text" id="ship-pin" required class="w-full bg-brand-cream/20 p-2.5 border border-brand-gold/20 focus:outline-none focus:border-brand-burgundy" placeholder="6-digit PIN">
              </div>
              <div>
                <label for="ship-city" class="block font-semibold mb-1">City/State *</label>
                <input type="text" id="ship-city" required class="w-full bg-brand-cream/20 p-2.5 border border-brand-gold/20 focus:outline-none focus:border-brand-burgundy">
              </div>
            </div>

            <!-- Payment Methods -->
            <div class="pt-4 border-t border-brand-gold/10">
              <label class="block font-bold text-brand-burgundy uppercase mb-2">Payment Method</label>
              <div class="space-y-2">
                <label class="flex items-center justify-between p-3 border-2 border-brand-burgundy bg-brand-cream/30 cursor-pointer rounded">
                  <div class="flex items-center">
                    <input type="radio" name="payment" value="upi" checked class="custom-checkbox h-4 w-4 mr-3 text-brand-burgundy focus:ring-brand-burgundy">
                    <div>
                      <span class="font-bold text-brand-burgundy text-xs block">UPI Payment (Instant & Secure)</span>
                      <span class="text-[10px] text-gray-500 block mt-0.5">Google Pay / PhonePe / Paytm / BHIM / Cred UPI</span>
                    </div>
                  </div>
                  <div class="flex items-center space-x-1.5 bg-white px-2 py-1 border border-brand-gold/30 rounded shadow-xs">
                    <span class="text-[11px] font-bold text-brand-burgundy tracking-wider">UPI</span>
                  </div>
                </label>
              </div>
            </div>

            <button type="submit" class="w-full bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-sm uppercase tracking-widest font-bold py-3.5 transition duration-300 border-b-2 border-brand-gold mt-4">
              Place Order
            </button>
          </form>
        </div>

      </div>

    </div>

  </main>

  <!-- Global Dynamic Footer -->
  <div id="global-footer"></div>

  <!-- Order Success Modal Overlay -->
  <div id="success-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-brand-charcoal/60 transition-opacity duration-300"></div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
      <div class="inline-block align-middle bg-white p-8 max-w-md w-full shadow-2xl border border-brand-gold/20 text-center space-y-6 transform transition-all">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 text-green-600">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <div class="space-y-2">
          <h3 class="font-serif text-2xl font-bold text-brand-burgundy">Order Placed Successfully!</h3>
          <p class="text-xs text-gray-500">Thank you for shopping at Raga Boutique. Your order has been placed and is currently being processed.</p>
        </div>
        
        <!-- Order info summary details -->
        <div class="bg-brand-cream/40 p-4 border border-brand-gold/15 text-left text-xs space-y-2">
          <div class="flex justify-between">
            <span class="text-gray-500">Order Reference:</span>
            <span id="order-ref" class="font-bold text-brand-burgundy uppercase">#RAGA-18239023</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-500">Delivery To:</span>
            <span id="order-name" class="font-semibold text-brand-charcoal">Preeti Sharma</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-500">Paid Via:</span>
            <span id="order-pay" class="font-semibold text-brand-charcoal uppercase">COD</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-500">Total Amount:</span>
            <span id="order-amount" class="font-bold text-brand-burgundy">₹ 0</span>
          </div>
        </div>

        <button onclick="closeSuccessModal()" class="w-full bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-widest font-bold py-3 transition duration-300 border-b-2 border-brand-gold">
          Continue Shopping
        </button>
      </div>
    </div>
  </div>

  <!-- Javascript Modules -->
  <script src="js/products.js"></script>
  <script src="js/components.js"></script>
  <script src="js/main.js"></script>

  <!-- Checkout implementation scripts -->
  <script>
    let checkoutSubtotal = 0;
    let couponDiscountRate = 0;
    let discountAppliedVal = 0;

    function initCartPage() {
      if (typeof loadState === "function") loadState();
      renderCartPage();
    }

    document.addEventListener("DOMContentLoaded", initCartPage);
    document.addEventListener("ragaProductsLoaded", initCartPage);
    window.addEventListener("ragaProductsLoaded", initCartPage);
    document.addEventListener("ragaCartUpdated", initCartPage);
    window.addEventListener("storage", initCartPage);

    // Immediate attempt
    initCartPage();

    // Render cart items listing and totals
    function renderCartPage() {
      const itemsList = document.getElementById("cart-page-items-list");
      const emptyState = document.getElementById("cart-empty-state");
      const layout = document.getElementById("cart-main-layout");
      
      if (!itemsList || !emptyState || !layout) return;

      // Ensure state is loaded
      let cartItems = (typeof cart !== "undefined" && Array.isArray(cart)) ? cart : [];
      if (cartItems.length === 0) {
        try {
          const saved = sessionStorage.getItem("raga_cart") || localStorage.getItem("raga_cart");
          if (saved) {
            cartItems = JSON.parse(saved);
            if (typeof cart !== "undefined") cart = cartItems;
          }
        } catch(e) {}
      }

      if (cartItems.length === 0) {
        layout.classList.add("hidden");
        emptyState.classList.remove("hidden");
        return;
      }

      let allProducts = [];
      if (typeof ProductsDB !== "undefined" && ProductsDB.getAll().length > 0) {
        allProducts = ProductsDB.getAll();
      } else {
        try {
          allProducts = JSON.parse(localStorage.getItem('raga_admin_products_v2') || '[]');
        } catch(e) {}
      }

      emptyState.classList.add("hidden");
      layout.classList.remove("hidden");

      let html = "";
      checkoutSubtotal = 0;

      const isSingle = cartItems.length === 1;
      const countBadge = document.getElementById("cart-items-count-badge");
      if (countBadge) {
        countBadge.textContent = `${cartItems.length} ${cartItems.length === 1 ? 'Item' : 'Items'}`;
      }

      // If more than 1 item, fix the height to align harmoniously with the right side summary box
      if (isSingle) {
        itemsList.className = "divide-y divide-brand-gold/10";
      } else {
        itemsList.className = "divide-y divide-brand-gold/10 max-h-[640px] overflow-y-auto pr-1.5 custom-scrollbar";
      }

      cartItems.forEach(item => {
        let product = allProducts.find(p => String(p.id).trim() === String(item.id).trim());
        if (!product) {
          product = {
            id: item.id,
            name: item.name || 'Handcrafted Traditional Saree / Garment',
            price: Number(item.price) || 2899,
            image: item.image || 'images/img-saree-red.jpg',
            fabric: item.fabric || 'Silk',
            weave: item.weave || 'Traditional Weave'
          };
        }

        const sub = product.price * (item.quantity || 1);
        checkoutSubtotal += sub;

        if (isSingle) {
          // 1 Item: Prominent Full-Size Presentation
          html += `
            <div class="flex flex-col sm:flex-row py-6 first:pt-0 last:pb-0 gap-6">
              <!-- Full Size Image Container -->
              <div class="h-80 w-full sm:h-[450px] sm:w-[320px] flex-shrink-0 flex overflow-x-auto snap-x snap-mandatory no-scrollbar border border-brand-gold/10 relative shadow-sm">
                <img src="${product.image}" alt="${product.name}" class="h-full w-full object-cover flex-shrink-0 snap-center">
                ${product.hoverImage ? `<img src="${product.hoverImage}" alt="${product.name} Alternate" class="h-full w-full object-cover flex-shrink-0 snap-center">` : ''}
              </div>
              <div class="flex-1 flex flex-col justify-between py-1">
                <div>
                  <div class="flex justify-between items-start text-brand-charcoal mb-1 sm:block">
                    <h4 class="text-lg sm:text-2xl font-bold pr-2 sm:pr-0 hover:text-brand-burgundy transition-colors leading-tight">${product.name}</h4>
                    <p class="sm:hidden text-brand-burgundy text-lg font-bold whitespace-nowrap">₹ ${(product.price * item.quantity).toLocaleString("en-IN")}</p>
                  </div>
                  <p class="text-xs sm:text-sm text-brand-gold uppercase tracking-widest font-semibold mt-1 sm:mt-2">${product.fabric} | ${product.weave}</p>
                  
                  <div class="hidden sm:block mt-3">
                    <p class="text-brand-burgundy text-2xl font-extrabold whitespace-nowrap">₹ ${(product.price * item.quantity).toLocaleString("en-IN")}</p>
                  </div>
                </div>
                <div class="flex items-center justify-between text-sm pt-5">
                  <div class="flex items-center border border-brand-gold/30 bg-brand-cream/30 text-sm">
                    <button onclick="updateCartQuantityPage('${product.id}', ${item.quantity - 1})" class="px-3 py-1 font-semibold text-brand-charcoal hover:bg-brand-gold/10">-</button>
                    <span class="px-3 py-1 font-semibold text-brand-burgundy">${item.quantity}</span>
                    <button onclick="updateCartQuantityPage('${product.id}', ${item.quantity + 1})" class="px-3 py-1 font-semibold text-brand-charcoal hover:bg-brand-gold/10">+</button>
                  </div>
                  
                  <button type="button" onclick="removeFromCartPage('${product.id}')" class="font-semibold text-brand-burgundy/80 hover:text-brand-burgundy flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Remove item
                  </button>
                </div>
              </div>
            </div>
          `;
        } else {
          // Multiple Items: Adjustable Compact Layout matching right box height
          html += `
            <div class="flex flex-row py-4 first:pt-0 last:pb-0 gap-4 sm:gap-5 items-center">
              <!-- Compact Item Image -->
              <div class="h-28 w-24 sm:h-36 sm:w-28 flex-shrink-0 overflow-hidden border border-brand-gold/15 relative shadow-xs">
                <img src="${product.image}" alt="${product.name}" class="h-full w-full object-cover">
              </div>
              <div class="flex-1 flex flex-col justify-between py-0.5 min-w-0">
                <div>
                  <div class="flex justify-between items-start text-brand-charcoal mb-0.5">
                    <h4 class="text-sm sm:text-base font-bold pr-2 hover:text-brand-burgundy transition-colors leading-snug line-clamp-2">${product.name}</h4>
                  </div>
                  <p class="text-[11px] sm:text-xs text-brand-gold uppercase tracking-wider font-semibold truncate">${product.fabric} | ${product.weave}</p>
                  <p class="text-brand-burgundy text-base sm:text-lg font-bold mt-1 whitespace-nowrap">₹ ${(product.price * item.quantity).toLocaleString("en-IN")}</p>
                </div>

                <div class="flex items-center justify-between text-xs pt-2.5 mt-1 border-t border-brand-gold/5">
                  <div class="flex items-center border border-brand-gold/30 bg-brand-cream/30">
                    <button onclick="updateCartQuantityPage('${product.id}', ${item.quantity - 1})" class="px-2.5 py-0.5 font-semibold text-brand-charcoal hover:bg-brand-gold/10">-</button>
                    <span class="px-2.5 py-0.5 font-semibold text-brand-burgundy">${item.quantity}</span>
                    <button onclick="updateCartQuantityPage('${product.id}', ${item.quantity + 1})" class="px-2.5 py-0.5 font-semibold text-brand-charcoal hover:bg-brand-gold/10">+</button>
                  </div>
                  
                  <button type="button" onclick="removeFromCartPage('${product.id}')" class="text-xs font-semibold text-brand-burgundy/80 hover:text-brand-burgundy flex items-center">
                    <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Remove
                  </button>
                </div>
              </div>
            </div>
          `;
        }
      });

      itemsList.innerHTML = html;
      calculateCheckoutTotals();
    }

    // Calculations logic
    function calculateCheckoutTotals() {
      const subtotalField = document.getElementById("summary-subtotal");
      const shippingField = document.getElementById("summary-shipping");
      const discountRow = document.getElementById("summary-discount-row");
      const discountField = document.getElementById("summary-discount");
      const totalField = document.getElementById("summary-total");

      // Calculate shipping (FREE on all orders or threshold >= 1999)
      const shippingFee = (typeof checkoutSubtotal === 'number' && checkoutSubtotal > 0) ? (checkoutSubtotal >= 1999 ? 0 : 0) : 0;
      
      // Calculate discount
      discountAppliedVal = (typeof checkoutSubtotal === 'number') ? checkoutSubtotal * couponDiscountRate : 0;
      
      const grandTotal = Math.max(0, (checkoutSubtotal || 0) + shippingFee - discountAppliedVal);

      if (subtotalField) {
        subtotalField.textContent = `₹ ${(checkoutSubtotal || 0).toLocaleString("en-IN")}`;
      }
      
      if (shippingField) {
        shippingField.textContent = shippingFee === 0 ? "FREE" : `₹ ${shippingFee}`;
        shippingField.className = shippingFee === 0 ? "font-semibold text-green-700" : "font-semibold text-brand-charcoal";
      }

      if (discountRow && discountField) {
        if (discountAppliedVal > 0) {
          discountRow.classList.remove("hidden");
          discountField.textContent = `- ₹ ${discountAppliedVal.toLocaleString("en-IN")}`;
        } else {
          discountRow.classList.add("hidden");
        }
      }

      if (totalField) {
        totalField.textContent = `₹ ${grandTotal.toLocaleString("en-IN")}`;
      }
    }

    // Intermediary logic wrapping cart updates
    function updateCartQuantityPage(id, qty) {
      if (typeof updateCartQuantity === "function") {
        updateCartQuantity(id, qty);
        renderCartPage();
      }
    }

    function removeFromCartPage(id) {
      if (typeof removeFromCart === "function") {
        removeFromCart(id);
        renderCartPage();
      }
    }

    // Apply coupon code logic
    function applyCoupon() {
      const input = document.getElementById("coupon-input").value.trim().toUpperCase();
      const msg = document.getElementById("coupon-message");
      
      if (input === "RAGA10" || input === "TANEIRA10") {
        couponDiscountRate = 0.10;
        msg.textContent = "Coupon RAGA10 applied! 10% OFF discount granted.";
        msg.className = "text-[10px] mt-1.5 font-semibold text-green-700";
      } else {
        couponDiscountRate = 0;
        msg.textContent = "Invalid Coupon Code.";
        msg.className = "text-[10px] mt-1.5 font-semibold text-red-600";
      }
      
      calculateCheckoutTotals();
    }

    // Place Order handler
    function handlePlaceOrder(event) {
      event.preventDefault();
      
      // Extract form values
      const fullName = document.getElementById("ship-full")?.value || '';
      const email = document.getElementById("ship-email")?.value || '';
      const phone = document.getElementById("ship-phone")?.value || '';
      const address = document.getElementById("ship-address")?.value || '';
      const pincode = document.getElementById("ship-pin")?.value || '';
      const city = document.getElementById("ship-city")?.value || '';
      const payMethod = document.querySelector('input[name="payment"]:checked')?.value || 'upi';
      
      // Calculate final total
      const shippingFee = checkoutSubtotal >= 1999 ? 0 : 150;
      const finalAmount = checkoutSubtotal + shippingFee - discountAppliedVal;

      // Determine next Raga order ID (e.g., Raga-001, Raga-002...)
      let existingOrders = [];
      try {
        existingOrders = JSON.parse(localStorage.getItem('raga_orders') || '[]');
      } catch(e){}

      const nextIndex = existingOrders.length + 1;
      const orderId = `Raga-${String(nextIndex).padStart(3, '0')}`;

      // Populate success modal info
      document.getElementById("order-ref").textContent = orderId;
      document.getElementById("order-name").textContent = fullName;
      document.getElementById("order-pay").textContent = payMethod === 'upi' ? 'UPI Payment' : (payMethod === 'cod' ? 'Cash on Delivery' : 'Prepaid Card');
      document.getElementById("order-amount").textContent = `₹ ${finalAmount.toLocaleString("en-IN")}`;

      const prodIds = (typeof cart !== 'undefined' && Array.isArray(cart)) ? cart.map(i => i.id) : [];
      const prodNames = (typeof cart !== 'undefined' && Array.isArray(cart)) ? cart.map(i => i.name).join(', ') : '';
      const itemsDetail = (typeof cart !== 'undefined' && Array.isArray(cart)) ? cart.map(item => ({
        id: item.id,
        name: item.name,
        price: item.price,
        quantity: item.quantity,
        image: item.image,
        fabric: item.fabric || '',
        weave: item.weave || ''
      })) : [];

      // Save order to database & localStorage
      const newOrder = {
        id: orderId,
        date: new Date().toISOString(),
        customer: fullName,
        email: email,
        phone: phone,
        address: address,
        pincode: pincode,
        city: city,
        items: itemsDetail.length > 0 ? itemsDetail.reduce((sum, i) => sum + (i.quantity || 1), 0) : 1,
        amount: finalAmount,
        subtotal: checkoutSubtotal,
        discount: discountAppliedVal,
        shipping: shippingFee,
        payment: payMethod,
        product_ids: prodIds,
        product_name: prodNames,
        items_detail: itemsDetail,
        status: 'Processing'
      };

      try {
        existingOrders.unshift(newOrder);
        localStorage.setItem('raga_orders', JSON.stringify(existingOrders));
      } catch(e){}
      
      fetch('api/place_order.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(newOrder)
      }).then(res => res.json()).then(data => {
        if (data.order_id && document.getElementById("order-ref")) {
          document.getElementById("order-ref").textContent = data.order_id;
        }
      }).catch(err => console.error('Failed to save order to database', err));

      // Open Success modal
      const modal = document.getElementById("success-modal");
      if (modal) modal.classList.remove("hidden");
    }

    // Close success checkout, reset cart
    function closeSuccessModal() {
      // Clear cart array in JS memory and localStorage
      if (typeof cart !== "undefined") {
        cart = [];
        localStorage.setItem("raga_cart", JSON.stringify(cart));
      }
      
      // Update badging UI
      if (typeof updateCartBadge === "function") {
        updateCartBadge();
      }

      // Redirect to home
      window.location.href = "index.php";
    }
  </script>
</body>
</html>
