// Raga Boutique E-Commerce Global State & Interactivity Handler

// Initialize State
let cart = [];
let wishlist = [];

document.addEventListener("DOMContentLoaded", () => {
  loadState();
  updateCartBadge();
  updateWishlistBadge();
  setupGlobalEventListeners();
});

// Load state from localStorage
function loadState() {
  try {
    const savedCart = localStorage.getItem("raga_cart");
    const savedWishlist = localStorage.getItem("raga_wishlist");
    
    if (savedCart) cart = JSON.parse(savedCart);
    if (savedWishlist) wishlist = JSON.parse(savedWishlist);
  } catch (e) {
    console.error("Error loading localStorage state:", e);
  }
}

// Save state to localStorage
function saveCart() {
  localStorage.setItem("raga_cart", JSON.stringify(cart));
  updateCartBadge();
  updateCartUI();
}

// Save wishlist to localStorage
function saveWishlist() {
  localStorage.setItem("raga_wishlist", JSON.stringify(wishlist));
  updateWishlistBadge();
  updateWishlistButtonsState();
}

// Badge counters update
function updateCartBadge() {
  const badge = document.getElementById("cart-badge");
  if (!badge) return;
  
  const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
  if (totalItems > 0) {
    badge.textContent = totalItems;
    badge.classList.remove("hidden");
    // Scale animation feedback
    badge.classList.add("scale-125", "transition-transform", "duration-200");
    setTimeout(() => {
      badge.classList.remove("scale-125", "transition-transform", "duration-200");
    }, 200);
  } else {
    badge.classList.add("hidden");
  }
}

function updateWishlistBadge() {
  const badge = document.getElementById("wishlist-badge");
  if (!badge) return;
  
  if (wishlist.length > 0) {
    badge.textContent = wishlist.length;
    badge.classList.remove("hidden");
    // Scale animation feedback
    badge.classList.add("scale-125", "transition-transform", "duration-200");
    setTimeout(() => {
      badge.classList.remove("scale-125", "transition-transform", "duration-200");
    }, 200);
  } else {
    badge.classList.add("hidden");
  }
}

// Cart Action Handlers
function buyNow(productId) {
  cart = [{ id: productId, quantity: 1 }];
  saveCart();
  window.location.href = 'cart.html';
}

function addToCart(productId, quantity = 1, showDrawer = true) {
  const existingItem = cart.find(item => item.id === productId);
  if (existingItem) {
    existingItem.quantity += quantity;
  } else {
    cart.push({ id: productId, quantity });
  }
  
  saveCart();
  showToast("Added to Bag!");
  
  if (showDrawer) {
    // Open Cart Drawer automatically
    const cartToggle = document.getElementById("cart-drawer-toggle");
    if (cartToggle) cartToggle.click();
  }
}

function removeFromCart(productId) {
  cart = cart.filter(item => item.id !== productId);
  saveCart();
  showToast("Removed from Bag");
}

function updateCartQuantity(productId, newQty) {
  const item = cart.find(item => item.id === productId);
  if (item) {
    item.quantity = Math.max(1, newQty);
    saveCart();
  }
}

// Wishlist Action Handlers
function toggleWishlist(productId) {
  const index = wishlist.indexOf(productId);
  let added = false;
  if (index > -1) {
    wishlist.splice(index, 1);
  } else {
    wishlist.push(productId);
    added = true;
  }
  saveWishlist();
  showToast(added ? "Added to Wishlist!" : "Removed from Wishlist");
  
  // Bouncy heartbeat transition on heart click
  document.querySelectorAll(`[data-wishlist-toggle="${productId}"]`).forEach(btn => {
    btn.classList.add("animate-heartbeat");
    setTimeout(() => {
      btn.classList.remove("animate-heartbeat");
    }, 350);
  });
  
  // Custom event to update wishlist page if active
  document.dispatchEvent(new CustomEvent("wishlistUpdated"));
}

// Update heart buttons active state across the website
function updateWishlistButtonsState() {
  document.querySelectorAll("[data-wishlist-toggle]").forEach(btn => {
    const pId = btn.getAttribute("data-wishlist-toggle");
    const isWished = wishlist.includes(pId);
    
    // Select the svg path to color
    const svgPath = btn.querySelector("svg path");
    if (svgPath) {
      if (isWished) {
        svgPath.setAttribute("fill", "#702152");
        svgPath.setAttribute("stroke", "#702152");
      } else {
        svgPath.setAttribute("fill", "none");
        svgPath.setAttribute("stroke", "currentColor");
      }
    }
  });
}

// Redraw Cart Drawer Content
function updateCartUI() {
  const listContainer = document.getElementById("cart-drawer-items-list");
  const summaryBlock = document.getElementById("cart-drawer-summary");
  const subtotalField = document.getElementById("cart-drawer-subtotal");
  
  if (!listContainer) return;
  
  if (cart.length === 0) {
    listContainer.innerHTML = `
      <div class="flex flex-col items-center justify-center h-full text-center text-gray-500 py-12">
        <svg class="h-16 w-16 text-brand-gold/45 mb-4 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        <p class="text-sm font-semibold mb-2">Your shopping bag is empty</p>
        <p class="text-xs text-gray-400 max-w-[200px] mb-4">Add some beautiful handcrafted garments to your bag.</p>
        <a href="sarees.html" class="bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-wider font-bold py-2.5 px-6 border-b-2 border-brand-gold transition duration-300">Shop Sarees</a>
      </div>
    `;
    if (summaryBlock) summaryBlock.classList.add("hidden");
    return;
  }
  
  if (summaryBlock) summaryBlock.classList.remove("hidden");
  
  let totalAmount = 0;
  let html = `<div class="divide-y divide-brand-gold/10">`;
  
  cart.forEach(item => {
    // Look up product in Mock DB (PRODUCTS array is globally accessible if products.js is loaded)
    const product = typeof ProductsDB !== "undefined" ? ProductsDB.getById(item.id) : null;
    if (!product) return;
    
    const itemSubtotal = product.price * item.quantity;
    totalAmount += itemSubtotal;
    
    html += `
      <div class="flex py-4 group/item">
        <div class="h-20 w-16 flex-shrink-0 overflow-hidden border border-brand-gold/10">
          <img src="${product.image}" alt="${product.name}" class="h-full w-full object-cover object-center">
        </div>
        <div class="ml-4 flex-1 flex flex-col justify-between">
          <div>
            <div class="flex justify-between text-xs font-semibold text-brand-charcoal">
              <h4 class="line-clamp-2 pr-2 hover:text-brand-burgundy transition-colors">
                <a href="${product.category === 'sarees' ? 'sarees.html' : 'kurtas.html'}">${product.name}</a>
              </h4>
              <p class="ml-4 text-brand-burgundy whitespace-nowrap">₹ ${product.price.toLocaleString("en-IN")}</p>
            </div>
            <p class="mt-1 text-xs text-gray-500">${product.fabric} | ${product.weave}</p>
          </div>
          <div class="flex items-center justify-between text-xs pt-2">
            <!-- Quantity adjustment controls -->
            <div class="flex items-center border border-brand-gold/30 bg-brand-cream/30">
              <button onclick="updateCartQuantity('${product.id}', ${item.quantity - 1})" class="px-2 py-0.5 text-brand-charcoal hover:bg-brand-gold/10">-</button>
              <span class="px-2 py-0.5 text-brand-burgundy font-semibold">${item.quantity}</span>
              <button onclick="updateCartQuantity('${product.id}', ${item.quantity + 1})" class="px-2 py-0.5 text-brand-charcoal hover:bg-brand-gold/10">+</button>
            </div>
            
            <button type="button" onclick="removeFromCart('${product.id}')" class="font-medium text-brand-burgundy/80 hover:text-brand-burgundy flex items-center">
              <svg class="h-4 w-4 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
              Remove
            </button>
          </div>
        </div>
      </div>
    `;
  });
  
  html += `</div>`;
  listContainer.innerHTML = html;
  
  if (subtotalField) {
    subtotalField.textContent = `₹ ${totalAmount.toLocaleString("en-IN")}`;
  }
}

// Global Event Listeners Delegation
function setupGlobalEventListeners() {
  document.addEventListener("click", (event) => {
    
    // 1. Wishlist toggle delegation
    const wishlistBtn = event.target.closest("[data-wishlist-toggle]");
    if (wishlistBtn) {
      event.preventDefault();
      const productId = wishlistBtn.getAttribute("data-wishlist-toggle");
      toggleWishlist(productId);
      return;
    }
    
    // 2. Add to cart delegation
    const addToCartBtn = event.target.closest("[data-add-to-cart]");
    if (addToCartBtn) {
      event.preventDefault();
      const productId = addToCartBtn.getAttribute("data-add-to-cart");
      // Check if inside PDP/modal with selected qty
      const qtyInput = document.getElementById(`qty-${productId}`);
      const quantity = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
      addToCart(productId, quantity);
      return;
    }
    
    // 3. Quick View toggle delegation
    const quickViewBtn = event.target.closest("[data-quick-view]");
    if (quickViewBtn) {
      event.preventDefault();
      const productId = quickViewBtn.getAttribute("data-quick-view");
      openQuickView(productId);
      return;
    }
  });
  
  // Custom listener to sync wishlist buttons
  document.addEventListener("wishlistButtonsSync", updateWishlistButtonsState);
}

// Quick View Modal Core Logic
function openQuickView(productId) {
  if (typeof ProductsDB === "undefined") return;
  const product = ProductsDB.getById(productId);
  if (!product) return;
  
  const modal = document.getElementById("quick-view-modal");
  const overlay = document.getElementById("quick-view-overlay");
  const panel = document.getElementById("quick-view-panel");
  const content = document.getElementById("quick-view-modal-content");
  
  if (!modal || !content) return;
  
  // Populate Quick View HTML
  content.innerHTML = `
    <!-- Image block -->
    <div class="relative bg-brand-cream/20 flex items-center justify-center p-6 border-r border-brand-gold/15">
      <div class="w-full h-[400px] overflow-hidden">
        <img id="qv-main-img-${product.id}" src="${product.image}" alt="${product.name}" class="w-full h-full object-cover transition-all duration-300">
      </div>
      
      <!-- Alternate Thumbnail selectors -->
      <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 bg-white/70 backdrop-blur-sm p-1.5 border border-brand-gold/25">
        <button onclick="document.getElementById('qv-main-img-${product.id}').src='${product.image}'" class="w-10 h-12 overflow-hidden border border-brand-gold/40 focus:outline-none">
          <img src="${product.image}" class="w-full h-full object-cover">
        </button>
        <button onclick="document.getElementById('qv-main-img-${product.id}').src='${product.hoverImage}'" class="w-10 h-12 overflow-hidden border border-brand-gold/20 focus:outline-none hover:border-brand-gold">
          <img src="${product.hoverImage}" class="w-full h-full object-cover">
        </button>
      </div>
    </div>
    
    <!-- Info block -->
    <div class="p-8 flex flex-col justify-between h-[450px] overflow-y-auto">
      <div>
        <div class="flex items-center space-x-1.5 text-xs text-brand-gold font-bold uppercase tracking-wider mb-2">
          <span>${product.fabric}</span>
          <span>•</span>
          <span>${product.weave}</span>
        </div>
        <h2 class="font-serif text-xl font-bold text-brand-burgundy mb-2.5">${product.name}</h2>
        
        <!-- Ratings -->
        <div class="flex items-center space-x-2 mb-4">
          <div class="flex items-center text-amber-500 text-sm">
            ${"★".repeat(Math.floor(product.rating))}${"☆".repeat(5 - Math.floor(product.rating))}
          </div>
          <span class="text-xs text-gray-500">(${product.reviews} reviews)</span>
        </div>
        
        <!-- Price Block -->
        <div class="flex items-baseline space-x-3 mb-6 bg-brand-cream/40 p-3 border-l-2 border-brand-gold">
          <span class="text-xl font-bold text-brand-burgundy">₹ ${product.price.toLocaleString("en-IN")}</span>
          ${product.originalPrice > product.price ? `
            <span class="text-sm text-gray-400 line-through">₹ ${product.originalPrice.toLocaleString("en-IN")}</span>
            <span class="text-xs font-bold text-green-700">(${product.discount}% OFF)</span>
          ` : ""}
        </div>
        
        <p class="text-xs text-brand-charcoal/80 leading-relaxed mb-6">${product.description}</p>
        
        <!-- Product Highlights list -->
        <ul class="text-[11px] text-brand-charcoal/80 space-y-1 mb-6 bg-brand-cream/20 p-3 border border-brand-gold/10">
          <h4 class="font-bold text-brand-burgundy mb-1 text-xs uppercase tracking-wider">Specifications</h4>
          ${product.highlights.map(h => `<li class="flex items-center"><span class="text-brand-gold mr-1.5">✦</span> ${h}</li>`).join("")}
        </ul>
      </div>
      
      <!-- Action buttons -->
      <div class="grid grid-cols-2 gap-4">
        <button data-add-to-cart="${product.id}" class="w-full flex items-center justify-center bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-widest font-bold py-3 transition duration-300 border-b-2 border-brand-gold">
          Add To Bag
        </button>
        <button data-wishlist-toggle="${product.id}" class="w-full flex items-center justify-center bg-white hover:bg-brand-cream text-brand-burgundy text-xs uppercase tracking-widest font-bold py-3 border border-brand-gold transition duration-300">
          Wishlist
        </button>
      </div>
    </div>
  `;
  
  // Open modal animation
  modal.classList.remove("hidden");
  setTimeout(() => {
    overlay.classList.remove("opacity-0");
    overlay.classList.add("opacity-100");
    panel.classList.remove("scale-95", "opacity-0");
    panel.classList.add("scale-100", "opacity-100");
  }, 50);
  
  // Close event listener setup
  const closeQV = () => {
    overlay.classList.remove("opacity-100");
    overlay.classList.add("opacity-0");
    panel.classList.remove("scale-100", "opacity-100");
    panel.classList.add("scale-95", "opacity-0");
    setTimeout(() => {
      modal.classList.add("hidden");
    }, 300);
  };
  
  document.getElementById("quick-view-close").addEventListener("click", closeQV);
  overlay.addEventListener("click", closeQV);
  
  // Sync wishlist toggler state inside the loaded modal HTML
  updateWishlistButtonsState();
}

// Elegant Toast Notifications helper
function showToast(message) {
  let container = document.getElementById("toast-container");
  if (!container) {
    container = document.createElement("div");
    container.id = "toast-container";
    container.className = "fixed bottom-5 right-5 z-50 flex flex-col space-y-2";
    document.body.appendChild(container);
  }
  
  const toast = document.createElement("div");
  toast.className = "bg-brand-burgundy text-white border-l-4 border-brand-gold px-4 py-3 shadow-lg flex items-center justify-between space-x-4 animate-toast";
  toast.innerHTML = `
    <span class="text-xs tracking-wider uppercase font-semibold">${message}</span>
    <button onclick="this.parentElement.remove()" class="text-brand-gold hover:text-white focus:outline-none">
      <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  `;
  
  container.appendChild(toast);
  
  // Auto remove toast after 3 seconds
  setTimeout(() => {
    toast.style.opacity = "0";
    toast.style.transform = "translateY(10px)";
    toast.style.transition = "all 0.3s ease-out";
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

// Shop The Look Video Shopping Modal Logic
function openShopTheLook(productId, videoSrc) {
  if (typeof ProductsDB === "undefined") return;
  const product = ProductsDB.getById(productId);
  if (!product) return;

  const modal = document.getElementById("stl-video-modal");
  const overlay = document.getElementById("stl-video-overlay");
  const panel = document.getElementById("stl-video-panel");
  const content = document.getElementById("stl-video-modal-content");

  if (!modal || !content) return;

  // Populate dynamic split content
  content.innerHTML = `
    <!-- Video Player Column (5/12 cols) -->
    <div class="col-span-1 md:col-span-5 relative bg-brand-charcoal flex items-center justify-center min-h-[400px] md:h-[550px] overflow-hidden video-container">
      <video id="stl-active-video" src="${videoSrc}" class="w-full h-full object-cover" autoplay loop muted playsinline></video>
      
      <!-- Video controls overlay -->
      <div class="absolute inset-0 flex flex-col justify-between p-4 video-controls-overlay pointer-events-none">
        <div class="flex justify-between items-center w-full">
          <span class="bg-black/40 text-white text-[10px] tracking-widest font-semibold py-1 px-2.5 rounded-full backdrop-blur-sm uppercase">Shop The Look</span>
        </div>
        
        <!-- Video control buttons -->
        <div class="flex items-center justify-between w-full pointer-events-auto">
          <!-- Play / Pause Button -->
          <button id="stl-video-play-btn" class="bg-white/95 hover:bg-white text-brand-burgundy p-2.5 rounded-full shadow-lg transition duration-200 focus:outline-none">
            <svg id="stl-play-svg" class="h-4 w-4 fill-current hidden" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            <svg id="stl-pause-svg" class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
          </button>
          
          <!-- Mute / Unmute Button -->
          <button id="stl-video-mute-btn" class="bg-white/95 hover:bg-white text-brand-burgundy p-2.5 rounded-full shadow-lg transition duration-200 focus:outline-none flex items-center justify-center">
            <svg id="stl-unmute-svg" class="h-4 w-4 fill-current hidden" viewBox="0 0 24 24">
              <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/>
            </svg>
            <svg id="stl-mute-svg" class="h-4 w-4 fill-current" viewBox="0 0 24 24">
              <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.21.05-.42.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Product Info Column (7/12 cols) -->
    <div class="col-span-1 md:col-span-7 p-6 md:p-8 flex flex-col justify-between md:h-[550px] overflow-y-auto bg-brand-cream/10">
      <div>
        <div class="flex items-center space-x-1.5 text-xs text-brand-gold font-bold uppercase tracking-wider mb-2">
          <span>${product.fabric}</span>
          <span>•</span>
          <span>${product.weave}</span>
        </div>
        <h2 class="font-serif text-xl sm:text-2xl font-bold text-brand-burgundy mb-2.5 leading-tight">${product.name}</h2>
        
        <!-- Ratings -->
        <div class="flex items-center space-x-2 mb-4">
          <div class="flex items-center text-amber-500 text-sm">
            ${"★".repeat(Math.floor(product.rating))}${"☆".repeat(5 - Math.floor(product.rating))}
          </div>
          <span class="text-xs text-gray-500">(${product.reviews} reviews)</span>
        </div>
        
        <!-- Price Block -->
        <div class="flex items-baseline space-x-3 mb-6 bg-brand-cream/60 p-3 border-l-2 border-brand-gold">
          <span class="text-xl font-bold text-brand-burgundy">₹ ${product.price.toLocaleString("en-IN")}</span>
          ${product.originalPrice > product.price ? `
            <span class="text-sm text-gray-400 line-through">₹ ${product.originalPrice.toLocaleString("en-IN")}</span>
            <span class="text-xs font-bold text-green-700">(${product.discount}% OFF)</span>
          ` : ""}
        </div>
        
        <p class="text-xs text-brand-charcoal/80 leading-relaxed mb-6">${product.description}</p>
        
        <!-- Product Highlights list -->
        <ul class="text-[11px] text-brand-charcoal/80 space-y-1 mb-6 bg-brand-cream/20 p-3 border border-brand-gold/10">
          <h4 class="font-bold text-brand-burgundy mb-1 text-xs uppercase tracking-wider">Specifications</h4>
          ${product.highlights.map(h => `<li class="flex items-center"><span class="text-brand-gold mr-1.5">✦</span> ${h}</li>`).join("")}
        </ul>
      </div>
      
      <!-- Action buttons -->
      <div class="grid grid-cols-2 gap-4 pt-4 border-t border-brand-gold/10">
        <button data-add-to-cart="${product.id}" class="w-full flex items-center justify-center bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-widest font-bold py-3.5 transition duration-300 border-b-2 border-brand-gold">
          Add To Bag
        </button>
        <button data-wishlist-toggle="${product.id}" class="w-full flex items-center justify-center bg-white hover:bg-brand-cream text-brand-burgundy text-xs uppercase tracking-widest font-bold py-3.5 border border-brand-gold transition duration-300">
          Wishlist
        </button>
      </div>
    </div>
  `;

  const video = document.getElementById("stl-active-video");
  const playBtn = document.getElementById("stl-video-play-btn");
  const muteBtn = document.getElementById("stl-video-mute-btn");
  const playSvg = document.getElementById("stl-play-svg");
  const pauseSvg = document.getElementById("stl-pause-svg");
  const muteSvg = document.getElementById("stl-mute-svg");
  const unmuteSvg = document.getElementById("stl-unmute-svg");

  // Play / Pause event
  if (playBtn && video) {
    playBtn.addEventListener("click", () => {
      if (video.paused) {
        video.play();
        playSvg.classList.add("hidden");
        pauseSvg.classList.remove("hidden");
      } else {
        video.pause();
        playSvg.classList.remove("hidden");
        pauseSvg.classList.add("hidden");
      }
    });
  }

  // Mute / Unmute event
  if (muteBtn && video) {
    muteBtn.addEventListener("click", () => {
      video.muted = !video.muted;
      if (video.muted) {
        muteSvg.classList.remove("hidden");
        unmuteSvg.classList.add("hidden");
      } else {
        muteSvg.classList.add("hidden");
        unmuteSvg.classList.remove("hidden");
      }
    });
  }

  // Open modal animation
  modal.classList.remove("hidden");
  setTimeout(() => {
    overlay.classList.remove("opacity-0");
    overlay.classList.add("opacity-100");
    panel.classList.remove("scale-95", "opacity-0");
    panel.classList.add("scale-100", "opacity-100");
  }, 50);

  // Close event listener setup
  const closeSTL = () => {
    if (video) {
      video.pause();
    }
    overlay.classList.remove("opacity-100");
    overlay.classList.add("opacity-0");
    panel.classList.remove("scale-100", "opacity-100");
    panel.classList.add("scale-95", "opacity-0");
    setTimeout(() => {
      modal.classList.add("hidden");
      content.innerHTML = ""; // Clear content to free resources
    }, 300);
  };

  document.getElementById("stl-video-close").addEventListener("click", closeSTL);
  overlay.addEventListener("click", closeSTL);

  // Sync wishlist toggler state inside loaded modal
  updateWishlistButtonsState();
}

// Info and Policy Modal Data & Logic
const INFO_DATA = {
  return: {
    title: "Return & Exchanges",
    content: `
      <p class="mb-4">At Raga Boutique, we strive to bring you the highest quality handcrafted fabrics. If you are not fully satisfied with your purchase, we offer a simple <strong>7-day Return and Exchange policy</strong>.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Guidelines:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li>Products must be returned in their original condition, unused, with all brand tags and price labels attached.</li>
        <li>Authentic Handloom products and customized orders are eligible for exchanges only.</li>
        <li>For hygiene reasons, custom-stitched blouses and accessories cannot be returned.</li>
      </ul>
      <p>To initiate a return, please log in to your account, go to 'My Orders', select the item you wish to return, and click 'Request Return'.</p>
    `
  },
  shipping: {
    title: "Shipping & Handling",
    content: `
      <p class="mb-4">We are pleased to offer shipping across all major locations in India and internationally.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Rates & Timelines:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li><strong>Free Shipping</strong> across India on all orders above ₹1,999.</li>
        <li>For orders below ₹1,999, a flat shipping fee of ₹150 is applied.</li>
        <li>Orders are processed and dispatched from our Bengaluru warehouse within <strong>2-3 business days</strong>.</li>
        <li>Standard delivery takes <strong>5-7 business days</strong> depending on your location.</li>
      </ul>
      <p>International shipping is calculated at checkout based on weight and country of destination.</p>
    `
  },
  cancellation: {
    title: "Cancellation Policy",
    content: `
      <p class="mb-4">You can request to cancel your order as long as it has not been dispatched from our facility.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Important Conditions:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li>Cancellations can be made within <strong>12 hours</strong> of order placement.</li>
        <li>Once the product is shipped, order cancellations are not possible. You may refuse the delivery or request a return after receiving the package.</li>
        <li>Full refund will be processed back to the original payment method within 5-7 business days for successful cancellations.</li>
      </ul>
    `
  },
  delivery: {
    title: "Delivery Information",
    content: `
      <p class="mb-4">We partner with India's leading courier services to ensure your handlooms reach you safely and quickly.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Delivery Partners:</h4>
      <p class="mb-4">Our deliveries are handled securely by BlueDart, Delhivery, ExpressBees, and DHL for international orders.</p>
      <p>Once dispatched, you will receive an SMS and email containing the tracking link. You can track your package in real-time on our Tracking page.</p>
    `
  },
  terms: {
    title: "Terms of Use",
    content: `
      <p class="mb-4">Welcome to Raga Boutique. By accessing or using our platform, you agree to comply with and be bound by our website terms and conditions.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Key Terms:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li><strong>Copyright:</strong> All digital assets, photography, designs, and logo marks are properties of Raga Boutique E-commerce.</li>
        <li><strong>Pricing:</strong> Product prices are subject to change. We ensure pricing accuracy but reserve the right to cancel orders placed with erroneous pricing.</li>
        <li><strong>Usage Limit:</strong> Users may use the platform for personal, non-commercial shopping purposes only.</li>
      </ul>
    `
  },
  faqs: {
    title: "Help & FAQs",
    content: `
      <p class="mb-4">Find fast answers to common questions about shopping at Raga Boutique.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Frequently Asked Questions:</h4>
      <div class="space-y-3 text-xs">
        <div>
          <h5 class="font-bold text-brand-charcoal">Q: Are the sarees certified?</h5>
          <p class="text-gray-500">A: Yes! All our pure silk products are backed by the Silk Mark, and handloom products are backed by the Handloom Mark.</p>
        </div>
        <div>
          <h5 class="font-bold text-brand-charcoal">Q: Can I pay cash on delivery (COD)?</h5>
          <p class="text-gray-500">A: Yes, we offer Cash on Delivery across most pin codes in India on orders up to ₹10,000.</p>
        </div>
      </div>
    `
  },
  cyber: {
    title: "Cyber Security Policy",
    content: `
      <p class="mb-4">We are dedicated to safeguarding your online transactions and sensitive data.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Our Security Measures:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li>All browser interactions are encrypted using <strong>SSL/TLS (HTTPS) technology</strong>.</li>
        <li>We never store credit/debit card numbers on our servers. Transactions are handled securely via PCI-DSS compliant payment gateways.</li>
        <li>We run periodic audits to identify and patch system vulnerabilities to protect user data.</li>
      </ul>
    `
  },
  privacy: {
    title: "Privacy Notice",
    content: `
      <p class="mb-4">Your privacy is important to us. This privacy policy explains what data we collect and how we utilize it.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Data We Collect:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li>Personal identifiers (name, delivery address, phone, email) to complete your order.</li>
        <li>Browsing statistics to enhance performance and search matching.</li>
        <li>We do not sell, rent, or lease your personal information to third parties.</li>
      </ul>
    `
  },
  cookie: {
    title: "Cookie Policy",
    content: `
      <p class="mb-4">We use cookies to make our platform more intuitive and responsive.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">How We Use Cookies:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li><strong>Essential Cookies:</strong> Save your Shopping Bag state and wishlist across browsing sessions.</li>
        <li><strong>Performance Cookies:</strong> Provide analytics to help us resolve load speeds and layouts.</li>
        <li>You can choose to turn off cookies in your browser settings, though this will affect cart functionality.</li>
      </ul>
    `
  },
  rights: {
    title: "Exercise Your Rights",
    content: `
      <p class="mb-4">Under data protection rules, you have full ownership over how your data is processed.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Your Rights:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li>Right to access: Request a copy of all personal details saved in our databases.</li>
        <li>Right to rectification: Request updates to invalid address or contact entries.</li>
        <li>Right to erasure: Request immediate deletion of your user account and details.</li>
      </ul>
      <p>To exercise any rights, please email us at <a href="mailto:privacy@ragaboutique.co.in" class="text-brand-burgundy font-bold hover:underline">privacy@ragaboutique.co.in</a>.</p>
    `
  },
  california: {
    title: "California Privacy Choices",
    content: `
      <p class="mb-4">This section outlines specific rights for California residents under CCPA guidelines.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Your Choices:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li><strong>Right to Know:</strong> Request disclosures of personal data collected during the past 12 months.</li>
        <li><strong>Right to Opt-Out:</strong> Click 'Do Not Sell or Share My Info' to stop data collection for third-party ads.</li>
        <li><strong>Non-Discrimination:</strong> We do not alter pricing or availability based on your privacy requests.</li>
      </ul>
    `
  },
  about: {
    title: "About Raga Boutique",
    content: `
      <p class="mb-4">Raga Boutique represents the fine art of Indian handlooms, showcasing months of hard work and ancestral weaving traditions from all corners of India.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Our Heritage:</h4>
      <p class="mb-4">Backed by the legacy of authentic weaves, we partner directly with master weavers to present certified Banarasi jaals, South Kanjivaram silks, linen Jamdanis, and Khadi styles.</p>
      <p>Every purchase directly supports our community of master artisans, keeping the legacy of the handloom alive.</p>
    `
  },
  track: {
    title: "Track Your Order",
    content: `
      <p class="mb-4">Track the shipping status of your parcel directly in the panel below.</p>
      <div class="bg-brand-cream/30 p-4 border border-brand-gold/15 rounded-md mb-4 text-xs space-y-3">
        <div>
          <label class="block font-bold text-brand-burgundy mb-1">ORDER ID</label>
          <input type="text" placeholder="e.g., RG-29384" class="w-full bg-white border border-brand-gold/20 p-2.5 rounded focus:outline-none focus:border-brand-burgundy">
        </div>
        <div>
          <label class="block font-bold text-brand-burgundy mb-1">MOBILE NUMBER / EMAIL</label>
          <input type="text" placeholder="e.g., customer@email.com" class="w-full bg-white border border-brand-gold/20 p-2.5 rounded focus:outline-none focus:border-brand-burgundy">
        </div>
        <button onclick="showToast('Fetching order details...')" class="w-full bg-brand-burgundy text-white font-bold py-2.5 uppercase tracking-wider hover:bg-brand-burgundyLight transition">Track Shipments</button>
      </div>
    `
  },
  blogs: {
    title: "Raga Boutique Blogs & Stories",
    content: `
      <p class="mb-4">Immerse yourself in our designer guides, fabric history, and style notes.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Latest Articles:</h4>
      <div class="space-y-3 text-xs">
        <div class="border-b border-brand-gold/10 pb-2">
          <span class="text-brand-gold font-bold">1. Silk Care Guide</span>
          <p class="text-gray-500">How to wash and preserve your Kanjivaram and Banarasi silk sarees for years.</p>
        </div>
        <div class="border-b border-brand-gold/10 pb-2">
          <span class="text-brand-gold font-bold">2. The Weaving of Zari</span>
          <p class="text-gray-500">An inside look at Varanasi zari-drawing master artisans.</p>
        </div>
      </div>
    `
  },
  corporate: {
    title: "Corporate Relations",
    content: `
      <p class="mb-4">Raga Boutique offers premium handcrafted Indian ethnic wear. For bulk inquiries or partnership proposals, discover more details below.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Partnerships:</h4>
      <p class="mb-4">We offer custom curation for corporate gifting, wedding favors, and uniform commissions using authentic handloom fabrics.</p>
      <p>For partnership requests, please email us at <a href="mailto:corporate@ragaboutique.co.in" class="text-brand-burgundy font-bold hover:underline">corporate@ragaboutique.co.in</a>.</p>
    `
  },
  careers: {
    title: "Careers at Raga Boutique",
    content: `
      <p class="mb-4">We are constantly seeking creative, dedicated minds to help shape the future of ethical fashion and heritage handlooms.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Open Roles:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li><strong>Textile Designer</strong> (Location: Bengaluru)</li>
        <li><strong>Visual Merchandiser</strong> (Location: Chennai)</li>
        <li><strong>Social Media Executive</strong> (Location: Mumbai)</li>
      </ul>
      <p>Share your portfolio and cover letter with us at <a href="mailto:careers@ragaboutique.co.in" class="text-brand-burgundy font-bold hover:underline">careers@ragaboutique.co.in</a>.</p>
    `
  },
  encircle: {
    title: "Raga Gold Club Loyalty Program",
    content: `
      <p class="mb-4">Shopping at Raga Boutique unlocks unique rewards and exclusive benefits.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Member Benefits:</h4>
      <ul class="list-disc pl-5 mb-4 text-xs space-y-1.5">
        <li>Earn Raga points on every purchase at Raga Boutique.</li>
        <li>Redeem accumulated points on future purchases at Raga Boutique.</li>
        <li>Get early access to collection launches, sales, and special birthday discounts.</li>
      </ul>
    `
  },
  sitemap: {
    title: "Platform Site Map",
    content: `
      <p class="mb-4">Navigate easily through the major branches of our store.</p>
      <div class="grid grid-cols-2 gap-4 text-xs font-semibold text-brand-charcoal font-sans">
        <ul class="space-y-1.5">
          <li><a href="index.html" class="hover:text-brand-burgundy">✦ Home Page</a></li>
          <li><a href="sarees.html" class="hover:text-brand-burgundy">✦ Sarees</a></li>
          <li><a href="kurtas.html" class="hover:text-brand-burgundy">✦ Kurtas</a></li>
        </ul>
        <ul class="space-y-1.5">
          <li><a href="wishlist.html" class="hover:text-brand-burgundy">✦ Wishlist</a></li>
          <li><a href="cart.html" class="hover:text-brand-burgundy">✦ Shopping Bag</a></li>
        </ul>
      </div>
    `
  },
  store: {
    title: "Our Retail Stores",
    content: `
      <p class="mb-4">Experience the rich textures of our handlooms in person at our flagship experience centers.</p>
      <h4 class="font-bold text-brand-burgundy mb-2 uppercase text-xs tracking-wider">Locations:</h4>
      <div class="space-y-3 text-xs">
        <div>
          <h5 class="font-bold text-brand-charcoal">1. Bengaluru Flagship</h5>
          <p class="text-gray-500">12, 100 Feet Rd, 4th Block, Jayanagar, Bengaluru - 560011</p>
        </div>
        <div>
          <h5 class="font-bold text-brand-charcoal">2. Chennai Flagship</h5>
          <p class="text-gray-500">88, Usman Road, T. Nagar, Chennai - 600017</p>
        </div>
        <div>
          <h5 class="font-bold text-brand-charcoal">3. Hyderabad Flagship</h5>
          <p class="text-gray-500">Banjara Hills Rd Number 2, Hyderabad - 500034</p>
        </div>
      </div>
    `
  }
};

function openInfoModal(topic) {
  const modal = document.getElementById("info-modal");
  const overlay = document.getElementById("info-overlay");
  const panel = document.getElementById("info-panel");
  const content = document.getElementById("info-modal-content");
  
  if (!modal || !content) return;
  
  const data = INFO_DATA[topic];
  if (!data) return;
  
  content.innerHTML = `
    <h2 class="font-serif text-2xl font-bold text-brand-burgundy mb-4 border-b border-brand-gold/15 pb-2.5">${data.title}</h2>
    <div class="text-xs text-brand-charcoal/80 leading-relaxed max-h-[380px] overflow-y-auto pr-2">
      ${data.content}
    </div>
  `;
  
  modal.classList.remove("hidden");
  setTimeout(() => {
    overlay.classList.remove("opacity-0");
    overlay.classList.add("opacity-100");
    panel.classList.remove("scale-95", "opacity-0");
    panel.classList.add("scale-100", "opacity-100");
  }, 50);
  
  const closeInfo = () => {
    overlay.classList.remove("opacity-100");
    overlay.classList.add("opacity-0");
    panel.classList.remove("scale-100", "opacity-100");
    panel.classList.add("scale-95", "opacity-0");
    setTimeout(() => {
      modal.classList.add("hidden");
      content.innerHTML = "";
    }, 300);
  };
  
  document.getElementById("info-close").addEventListener("click", closeInfo);
  overlay.addEventListener("click", closeInfo);
}

// Expose internal functions to click handlers
window.removeFromCart = removeFromCart;
window.updateCartQuantity = updateCartQuantity;
window.toggleWishlist = toggleWishlist;
window.addToCart = addToCart;
window.updateCartUI = updateCartUI;
window.openShopTheLook = openShopTheLook;
window.openInfoModal = openInfoModal;
