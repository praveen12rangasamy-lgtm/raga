// Reusable Components Injector for Raga Boutique Website

document.addEventListener("ragaProductsLoaded", () => {
  injectHeader();
  injectFooter();
  injectDrawersAndModals();
  initializeComponentInteractivity();
});

// 1. Inject Header
function injectHeader() {
  const headerContainer = document.getElementById("global-header");
  if (!headerContainer) return;

  headerContainer.className = "sticky top-0 z-50 w-full bg-white shadow-md transition-all duration-300";

  headerContainer.innerHTML = `
    <!-- Top Promotion Bar -->
    <div class="bg-brand-burgundy text-white text-[11px] py-2 px-4 overflow-hidden border-b border-brand-gold/20">
      <div class="ticker-wrap max-w-7xl mx-auto flex justify-between items-center text-center">
        <div class="ticker-content w-full flex justify-around space-x-8">
          <span>✨ Flat 10% OFF on your first order. Use code: <strong class="text-brand-gold">RAGA10</strong></span>
          <span class="hidden md:inline">|</span>
          <span>🚚 Free shipping across India on orders above ₹1,999</span>
          <span class="hidden md:inline">|</span>
          <span>🏷️ 100% Authentic Handlooms - Silk Mark Certified</span>
        </div>
      </div>
    </div>

    <!-- Main Header -->
    <div class="relative z-40 bg-white border-b border-brand-gold/10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14 py-1">
          
          <!-- Hamburger menu (Mobile) -->
          <div class="flex items-center lg:hidden">
            <button id="mobile-menu-toggle" type="button" class="text-brand-burgundy hover:text-brand-gold p-2" aria-label="Toggle menu">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>

          <!-- Brand Logo -->
          <div class="flex-shrink-0 flex items-center">
            <a href="index.php" class="flex items-center">
              <img src="images/raga_logo.png?v=3" alt="Raga Boutique Logo" class="h-11 w-auto hover:opacity-90 transition duration-300">
            </a>
          </div>
          <!-- Desktop Nav Links -->
          <nav class="hidden lg:flex flex-1 justify-center space-x-8 xl:space-x-10">
            <a href="index.php" class="text-[15px] font-logo text-brand-burgundy hover:text-brand-gold transition-all duration-200 tracking-wide">Home</a>
            <a href="index.php#new-arrivals" class="text-[15px] font-logo text-brand-burgundy hover:text-brand-gold transition-all duration-200 tracking-wide">New Arrivals</a>
            <a href="collections.php" class="text-[15px] font-logo text-brand-burgundy hover:text-brand-gold transition-all duration-200 tracking-wide">Collections</a>
            <a href="index.php#about" class="text-[15px] font-logo text-brand-burgundy hover:text-brand-gold transition-all duration-200 tracking-wide">About Us</a>
            <a href="contact.php" class="text-[15px] font-logo text-brand-burgundy hover:text-brand-gold transition-all duration-200 tracking-wide">Contact Us</a>
          </nav>

          <!-- Desktop Search Bar & Cart Icon (Right of Search Bar) -->
          <div class="hidden md:flex items-center gap-4">
            <div class="relative w-64 xl:w-80">
              <input type="text" id="desktop-search-input" placeholder="Search..."
                class="w-full bg-brand-cream/40 text-xs text-brand-charcoal pl-4 pr-10 py-2.5 border border-brand-gold/25 rounded-md focus:outline-none focus:border-brand-burgundy transition-colors duration-300">
              <div class="absolute right-3.5 top-2.5 text-brand-burgundy cursor-pointer">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>
            </div>

            <!-- Cart Icon (Right of Search Bar) -->
            <button id="cart-drawer-toggle" type="button" class="relative p-2 text-brand-burgundy hover:text-brand-gold transition duration-200 focus:outline-none flex items-center justify-center flex-shrink-0" aria-label="Shopping Bag" title="View Shopping Bag">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
              <span id="cart-badge" class="absolute -top-0.5 -right-0.5 bg-brand-burgundy text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center border border-white hidden shadow-sm">0</span>
            </button>
          </div>

          <!-- Mobile Cart Icon (Header Right) -->
          <div class="flex items-center md:hidden">
            <button id="mobile-cart-toggle" type="button" class="relative p-2 text-brand-burgundy hover:text-brand-gold transition duration-200 focus:outline-none flex items-center justify-center" aria-label="Shopping Bag" title="View Shopping Bag">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
              <span id="mobile-cart-badge" class="absolute -top-0.5 -right-0.5 bg-brand-burgundy text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center border border-white hidden shadow-sm">0</span>
            </button>
          </div>
        </div>
        <!-- Mobile Search (only visible on small screens under md) -->
        <div class="md:hidden pb-4 px-2">
          <div class="relative">
            <input type="text" id="mobile-search-input" placeholder="Search For Sarees, Kurtas..." 
              class="w-full bg-brand-cream/50 text-xs text-brand-charcoal pl-4 pr-10 py-2.5 border border-brand-gold/20 focus:outline-none focus:border-brand-burgundy">
            <div class="absolute right-3 top-2.5 text-brand-burgundy">
              <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
          </div>
        </div>

      </div>
    </div>
  `;
}

// 2. Inject Footer (Matching Footer screenshot exactly)
function injectFooter() {
  const footerContainer = document.getElementById("global-footer");
  if (!footerContainer) return;

  const isCollectionsPage = window.location.pathname.endsWith('collections.php') || 
                            footerContainer.hasAttribute('data-no-popular-searches') ||
                            footerContainer.classList.contains('no-popular-searches');

  footerContainer.innerHTML = `
    <!-- Main Footer -->
    <footer class="bg-brand-cream border-t border-brand-gold/15 pt-16 pb-8 text-brand-charcoal">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-brand-gold/15">
          
          <!-- Column 1: Quick Links -->
          <div>
            <h4 class="font-serif text-[13px] font-bold text-brand-burgundy uppercase tracking-wider mb-6">Quick Links</h4>
            <ul class="space-y-3.5 text-xs font-semibold text-brand-charcoal/80">
              <li><a href="sarees.php" class="hover:text-brand-burgundy transition">Sarees</a></li>
              <li><a href="sarees.php?weave=Chanderi" class="hover:text-brand-burgundy transition">Blouses</a></li>
              <li><a href="kurtas.php" class="hover:text-brand-burgundy transition">Kurtas & Kurta Sets</a></li>
              <li><a href="kurtas.php?weave=Printed" class="hover:text-brand-burgundy transition">Short Kurtis & Tops</a></li>
              <li><a href="sarees.php?fabric=Linen" class="hover:text-brand-burgundy transition">Dress Materials</a></li>
              <li><a href="kurtas.php" class="hover:text-brand-burgundy transition">Lehengas & Skirts</a></li>
              <li><a href="sarees.php" class="hover:text-brand-burgundy transition">Inskirts</a></li>
              <li><a href="kurtas.php" class="hover:text-brand-burgundy transition">Trousers</a></li>
              <li><a href="sarees.php?weave=Kanjivaram" class="hover:text-brand-burgundy transition">Giftings</a></li>
            </ul>
          </div>

          <!-- Column 2: Customer Policies -->
          <div>
            <h4 class="font-serif text-[13px] font-bold text-brand-burgundy uppercase tracking-wider mb-6">Customer Policies</h4>
            <ul class="space-y-3.5 text-xs font-semibold text-brand-charcoal/80">
              <li><a href="javascript:void(0)" onclick="openInfoModal('return')" class="hover:text-brand-burgundy transition">Return & Exchanges</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('shipping')" class="hover:text-brand-burgundy transition">Shipping</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('cancellation')" class="hover:text-brand-burgundy transition">Cancellation</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('delivery')" class="hover:text-brand-burgundy transition">Delivery Information</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('terms')" class="hover:text-brand-burgundy transition">Terms of use</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('faqs')" class="hover:text-brand-burgundy transition">Help & FAQS</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('cyber')" class="hover:text-brand-burgundy transition">Cyber Security Policy</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('privacy')" class="hover:text-brand-burgundy transition">Privacy Notice</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('cookie')" class="hover:text-brand-burgundy transition">Cookie Policy</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('rights')" class="hover:text-brand-burgundy transition">Exercise Your Rights</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('california')" class="hover:text-brand-burgundy transition">Your California Privacy Choices</a></li>
            </ul>
          </div>

          <!-- Column 3: About Raga Boutique -->
          <div>
            <h4 class="font-serif text-[13px] font-bold text-brand-burgundy uppercase tracking-wider mb-6">About Raga Boutique</h4>
            <ul class="space-y-3.5 text-xs font-semibold text-brand-charcoal/80">
              <li><a href="javascript:void(0)" onclick="openInfoModal('about')" class="hover:text-brand-burgundy transition">About Us</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('track')" class="hover:text-brand-burgundy transition">Track Order</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('blogs')" class="hover:text-brand-burgundy transition">Blogs</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('corporate')" class="hover:text-brand-burgundy transition">Corporate</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('careers')" class="hover:text-brand-burgundy transition">Careers</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('encircle')" class="hover:text-brand-burgundy transition">Encircle Program</a></li>
              <li><a href="javascript:void(0)" onclick="openInfoModal('sitemap')" class="hover:text-brand-burgundy transition">Site Map</a></li>
            </ul>
          </div>

          <!-- Column 4: Contact Us & Socials -->
          <div>
            <h4 class="font-serif text-[13px] font-bold text-brand-burgundy uppercase tracking-wider mb-6">Contact Us</h4>
            <ul class="space-y-3.5 text-xs font-semibold text-brand-charcoal/80 mb-6">
              <li><a href="tel:+918754291999" class="hover:text-brand-burgundy transition">+91 87542 91999</a></li>
              <li><a href="mailto:customercare@ragaboutique.co.in" class="hover:text-brand-burgundy transition">customercare@ragaboutique.co.in</a></li>
              <li class="leading-relaxed">No.21,22 & 23, Municipality Building,<br>Santhaipettai Bus Stop, Erode Main Road,<br>Tiruchengode - 637 211.</li>
            </ul>
            
            <!-- Social Icons (Burgundy fill matching screenshot) -->
            <div class="flex space-x-3 pt-4">
              <a href="#" class="p-2 bg-brand-burgundy text-white hover:bg-brand-burgundyLight transition duration-300 rounded-full w-8 h-8 flex items-center justify-center" aria-label="Facebook">
                <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z"/></svg>
              </a>
              <a href="https://www.instagram.com/ragaboutique_?igsh=MXdqdmczNXdkMHIyeQ%3D%3D&utm_source=qr" target="_blank" class="p-2 bg-brand-burgundy text-white hover:bg-brand-burgundyLight transition duration-300 rounded-full w-8 h-8 flex items-center justify-center" aria-label="Instagram">
                <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
              </a>
              <a href="#" class="p-2 bg-brand-burgundy text-white hover:bg-brand-burgundyLight transition duration-300 rounded-full w-8 h-8 flex items-center justify-center" aria-label="Pinterest">
                <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.947-.199-2.399.041-3.429.218-.927 1.408-5.968 1.408-5.968s-.359-.719-.359-1.781c0-1.663.967-2.909 2.167-2.909 1.02 0 1.517.769 1.517 1.687 0 1.029-.652 2.564-.992 3.993-.285 1.193.6 2.169 1.777 2.169 2.133 0 3.771-2.247 3.771-5.485 0-2.868-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.166-1.495-.69-2.433-2.878-2.433-4.617 0-3.766 2.737-7.229 7.892-7.229 4.145 0 7.372 2.956 7.372 6.9 0 4.12-2.597 7.433-6.202 7.433-1.212 0-2.35-.63-2.739-1.378l-.747 2.846c-.27 1.037-.999 2.337-1.49 3.138 1.122.35 2.31.54 3.541.54 6.621 0 11.988-5.367 11.988-11.987S18.638 0 12.017 0z"/></svg>
              </a>
              <a href="#" class="p-2 bg-brand-burgundy text-white hover:bg-brand-burgundyLight transition duration-300 rounded-full w-8 h-8 flex items-center justify-center" aria-label="YouTube">
                <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.517 0-9.388.508a3.003 3.003 0 00-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 002.11 2.11c1.871.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 002.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Copyright & Payment Logo icons (Matching bottom row of Taneira screenshot) -->
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center text-xs font-semibold text-brand-charcoal/60 mt-6 border-t border-brand-gold/15">
          <p>© 2026 Raga Boutique E-commerce. All Rights Reserved.</p>
          <div class="flex items-center space-x-4 mt-4 md:mt-0">
            <!-- Payment Icons -->
            <span class="text-[10px] text-gray-400">Secure Payments:</span>
            <!-- VISA -->
            <svg class="h-4 w-8" viewBox="0 0 24 15" fill="none"><rect width="24" height="15" rx="2" fill="#1A1F71"/><path d="M7.8 11.2l1.1-4.8h1.2l-1.1 4.8H7.8zm5.3-4.8c-.3-.2-.8-.4-1.3-.4-.9 0-1.7.5-1.7 1.4 0 .9.8 1 1.3 1.3.4.2.5.4.5.7 0 .4-.5.7-1 .7-.6 0-1-.2-1.3-.4l-.2-.1-.2 1c.3.1.8.3 1.4.3 1 0 1.9-.5 1.9-1.5 0-1-.7-1.1-1.3-1.4-.4-.2-.5-.3-.5-.6 0-.3.3-.6.9-.6.5 0 .9.1 1.2.3l.2.1.2-.8zm4.4-.1l-1 4.9h-1.1l-1-4.9h1.1l.5 2.8.5-2.8h1zm-12.7.1l-1.1 4.8H2.7L4 6.4h1.1z" fill="#FFF"/></svg>
            <!-- Mastercard -->
            <svg class="h-4 w-8" viewBox="0 0 24 15" fill="none"><rect width="24" height="15" rx="2" fill="#222"/><circle cx="10" cy="7.5" r="4.5" fill="#EB001B" fill-opacity="0.85"/><circle cx="14" cy="7.5" r="4.5" fill="#F79E1B" fill-opacity="0.85"/><path d="M12 5.2a4.5 4.5 0 000 4.6 4.5 4.5 0 000-4.6z" fill="#FF5F00"/></svg>
            <!-- PayPal -->
            <svg class="h-4 w-8" viewBox="0 0 24 15" fill="none"><rect width="24" height="15" rx="2" fill="#003087"/><path d="M9.8 4.2h2c.8 0 1.2.3 1.2.9s-.4 1.2-1.1 1.2h-1l-.5 2.1H9.2l1.1-4.8zm3.2.7c.6 0 1 .3 1 .8s-.3 1-1.1 1h-1l-.3 1.4h1c1 0 1.6-.5 1.6-1.5 0-.8-.6-1.7-1.2-1.7z" fill="#0079C1"/></svg>
          </div>
        </div>
      </div>
    </footer>
  `;
}

// 3. Inject Drawers and Modals
function injectDrawersAndModals() {
  let container = document.getElementById("drawers-and-modals-root");
  if (!container) {
    container = document.createElement("div");
    container.id = "drawers-and-modals-root";
    document.body.appendChild(container);
  }

  container.innerHTML = `
    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu-drawer" class="fixed inset-0 z-50 overflow-hidden hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
      <div class="absolute inset-0 overflow-hidden">
        <!-- Overlay -->
        <div id="mobile-menu-overlay" class="absolute inset-0 bg-brand-charcoal/50 opacity-0 transition-opacity duration-300 ease-in-out"></div>

        <div class="pointer-events-none fixed inset-y-0 left-0 flex max-w-full pr-10">
          <div id="mobile-menu-panel" class="pointer-events-auto w-screen max-w-xs transform -translate-x-full drawer-transition bg-white shadow-xl flex flex-col justify-between">
            <div class="py-6 px-4 sm:px-6 border-b border-brand-gold/15">
              <div class="flex items-center justify-between">
                <span class="font-serif text-xl font-bold tracking-widest text-brand-burgundy">MENU</span>
                <button id="mobile-menu-close" type="button" class="text-brand-charcoal hover:text-brand-gold p-1" aria-label="Close menu">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Menu Links list (Matching screenshot links) -->
            <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
              <nav class="space-y-4 text-sm font-semibold">
                <a href="index.php" class="block font-logo text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Home</a>
                <a href="index.php#new-arrivals" class="block font-logo text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">New Arrivals</a>
                <a href="collections.php" class="block font-logo text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Collections</a>
                <a href="index.php#about" class="block font-logo text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">About Us</a>
                <a href="contact.php" class="block font-logo text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Contact Us</a>
              </nav>

              <div class="mt-8 pt-8 border-t border-brand-gold/15 space-y-4 text-xs font-semibold">
                <a href="contact.php" class="flex items-center text-brand-charcoal hover:text-brand-burgundy">
                  <svg class="h-5 w-5 text-brand-gold mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <span>Store Locator</span>
                </a>
                <a href="tel:+918754291999" class="flex items-center text-brand-charcoal hover:text-brand-burgundy">
                  <svg class="h-5 w-5 text-brand-gold mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                  <span>+91 87542 91999</span>
                </a>
              </div>
            </div>
            
            <div class="bg-brand-burgundy text-white p-4 text-center">
              <span class="text-xs text-brand-gold tracking-widest font-semibold uppercase">100% Authentic Indian Weaves</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Shopping Cart Drawer (Right Side) -->
    <div id="cart-drawer" class="fixed inset-0 z-50 overflow-hidden hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
      <div class="absolute inset-0 overflow-hidden">
        <div id="cart-overlay" class="absolute inset-0 bg-brand-charcoal/50 opacity-0 transition-opacity duration-300 ease-in-out"></div>

        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
          <div id="cart-panel" class="pointer-events-auto w-screen max-w-md transform translate-x-full drawer-transition bg-white shadow-xl flex flex-col">
            
            <!-- Header -->
            <div class="py-6 px-4 sm:px-6 border-b border-brand-gold/15 bg-brand-cream/40">
              <div class="flex items-center justify-between">
                <h3 class="font-serif text-lg font-bold text-brand-burgundy flex items-center">
                  <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                  </svg>
                  Shopping Bag
                </h3>
                <button id="cart-close" type="button" class="text-brand-charcoal hover:text-brand-gold p-1" aria-label="Close cart">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Cart Items list -->
            <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6" id="cart-drawer-items-list">
              <div class="flex flex-col items-center justify-center h-full text-center text-gray-500 py-12">
                <svg class="h-16 w-16 text-brand-gold/45 mb-4 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <p class="text-sm font-semibold mb-2">Your shopping bag is empty</p>
                <a href="collections.php" class="bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-wider font-bold py-2.5 px-6 border-b-2 border-brand-gold transition duration-300">Shop Collections</a>
              </div>
            </div>

            <!-- Footer summary -->
            <div id="cart-drawer-summary" class="border-t border-brand-gold/15 py-6 px-4 sm:px-6 bg-brand-cream/20 hidden">
              <div class="flex justify-between text-base font-semibold text-brand-charcoal mb-2">
                <span>Subtotal:</span>
                <span id="cart-drawer-subtotal">₹ 0</span>
              </div>
              <p class="text-xs text-gray-500 mb-4">Shipping and taxes calculated at checkout.</p>
              <div class="space-y-3">
                <a href="cart.php" class="w-full flex items-center justify-center bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-widest font-bold py-3.5 transition duration-300 border-b-2 border-brand-gold shadow-md rounded-sm">
                  Buy Now
                </a>
                <button id="cart-drawer-continue" class="w-full text-center text-xs font-semibold text-brand-burgundy hover:text-brand-gold transition duration-200">
                  Continue Shopping
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Quick View Modal -->
    <div id="quick-view-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div id="quick-view-overlay" class="fixed inset-0 bg-brand-charcoal/50 opacity-0 transition-opacity duration-300 ease-out"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div id="quick-view-panel" class="inline-block align-bottom bg-white text-left shadow-xl transform scale-95 opacity-0 transition-all duration-300 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
          
          <div class="absolute right-4 top-4 z-10">
            <button id="quick-view-close" type="button" class="text-brand-charcoal hover:text-brand-burgundy p-1.5 bg-white border border-brand-gold/15" aria-label="Close details">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2" id="quick-view-modal-content">
            <!-- Dynamically populated via JS -->
          </div>
        </div>
      </div>
    </div>

    <!-- Shop The Look Video Modal -->
    <div id="stl-video-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
        <!-- Overlay -->
        <div id="stl-video-overlay" class="fixed inset-0 bg-brand-charcoal/60 opacity-0 transition-opacity duration-300 ease-out"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <!-- Modal panel -->
        <div id="stl-video-panel" class="inline-block align-middle bg-white text-left shadow-2xl transform scale-95 opacity-0 transition-all duration-300 sm:my-8 sm:max-w-4xl sm:w-full overflow-hidden rounded-lg">
          
          <!-- Close button -->
          <div class="absolute right-4 top-4 z-20">
            <button id="stl-video-close" type="button" class="text-white md:text-brand-charcoal hover:text-brand-burgundy p-2 bg-brand-burgundy/80 md:bg-white rounded-full md:rounded-none border border-brand-gold/15 shadow-md transition duration-200" aria-label="Close modal">
              <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-12" id="stl-video-modal-content">
            <!-- Dynamically populated via JS -->
          </div>
        </div>
      </div>
    </div>

    <!-- Info/Policy Modal -->
    <div id="info-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
        <div id="info-overlay" class="fixed inset-0 bg-brand-charcoal/60 opacity-0 transition-opacity duration-300 ease-out"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div id="info-panel" class="inline-block align-middle bg-white text-left shadow-2xl transform scale-95 opacity-0 transition-all duration-300 sm:my-8 sm:max-w-xl sm:w-full overflow-hidden rounded-lg">
          <div class="absolute right-4 top-4 z-10">
            <button id="info-close" type="button" class="text-brand-charcoal hover:text-brand-burgundy p-1.5 bg-brand-cream/30 border border-brand-gold/15 rounded-full" aria-label="Close modal">
              <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <div class="p-8" id="info-modal-content">
            <!-- Dynamically populated via JS -->
          </div>
        </div>
      </div>
    </div>
  `;
}

// 4. Initialize component togglers
function initializeComponentInteractivity() {
  // Mobile menu drawer interactivity
  const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
  const mobileMenuDrawer = document.getElementById("mobile-menu-drawer");
  const mobileMenuClose = document.getElementById("mobile-menu-close");
  const mobileMenuOverlay = document.getElementById("mobile-menu-overlay");
  const mobileMenuPanel = document.getElementById("mobile-menu-panel");

  if (mobileMenuToggle && mobileMenuDrawer) {
    mobileMenuToggle.addEventListener("click", () => {
      mobileMenuDrawer.classList.remove("hidden");
      setTimeout(() => {
        mobileMenuOverlay.classList.remove("opacity-0");
        mobileMenuOverlay.classList.add("opacity-100");
        mobileMenuPanel.classList.remove("-translate-x-full");
        mobileMenuPanel.classList.add("translate-x-0");
      }, 50);
    });

    const closeMobileMenu = () => {
      mobileMenuOverlay.classList.remove("opacity-100");
      mobileMenuOverlay.classList.add("opacity-0");
      mobileMenuPanel.classList.remove("translate-x-0");
      mobileMenuPanel.classList.add("-translate-x-full");
      setTimeout(() => {
        mobileMenuDrawer.classList.add("hidden");
      }, 300);
    };

    if (mobileMenuClose) mobileMenuClose.addEventListener("click", closeMobileMenu);
    if (mobileMenuOverlay) mobileMenuOverlay.addEventListener("click", closeMobileMenu);
  }

// Global Cart Drawer Open / Close
function openCartDrawer() {
  const cartDrawer = document.getElementById("cart-drawer");
  const cartOverlay = document.getElementById("cart-overlay");
  const cartPanel = document.getElementById("cart-panel");
  if (!cartDrawer) return;

  cartDrawer.classList.remove("hidden");
  if (typeof updateCartUI === "function") {
    updateCartUI();
  }
  setTimeout(() => {
    if (cartOverlay) {
      cartOverlay.classList.remove("opacity-0");
      cartOverlay.classList.add("opacity-100");
    }
    if (cartPanel) {
      cartPanel.classList.remove("translate-x-full");
      cartPanel.classList.add("translate-x-0");
    }
  }, 50);
}
window.openCartDrawer = openCartDrawer;

function closeCartDrawer() {
  const cartDrawer = document.getElementById("cart-drawer");
  const cartOverlay = document.getElementById("cart-overlay");
  const cartPanel = document.getElementById("cart-panel");
  if (!cartDrawer) return;

  if (cartOverlay) {
    cartOverlay.classList.remove("opacity-100");
    cartOverlay.classList.add("opacity-0");
  }
  if (cartPanel) {
    cartPanel.classList.remove("translate-x-0");
    cartPanel.classList.add("translate-x-full");
  }
  setTimeout(() => {
    cartDrawer.classList.add("hidden");
  }, 300);
}
window.closeCartDrawer = closeCartDrawer;

  // Cart drawer interactivity
  const cartToggle = document.getElementById("cart-drawer-toggle");
  const mobileCartToggle = document.getElementById("mobile-cart-toggle");
  const cartClose = document.getElementById("cart-close");
  const cartOverlay = document.getElementById("cart-overlay");
  const cartContinue = document.getElementById("cart-drawer-continue");

  if (cartToggle) cartToggle.addEventListener("click", openCartDrawer);
  if (mobileCartToggle) mobileCartToggle.addEventListener("click", openCartDrawer);
  if (cartClose) cartClose.addEventListener("click", closeCartDrawer);
  if (cartContinue) cartContinue.addEventListener("click", closeCartDrawer);
  if (cartOverlay) cartOverlay.addEventListener("click", closeCartDrawer);

  // Search input interactivity
  const desktopSearchInput = document.getElementById("desktop-search-input");
  const mobileSearchInput = document.getElementById("mobile-search-input");

  const handleSearchSubmit = (event) => {
    if (event.key === "Enter") {
      const query = event.target.value.trim();
      if (query !== "") {
        window.location.href = `sarees.php?search=${encodeURIComponent(query)}`;
      }
    }
  };

  if (desktopSearchInput) {
    desktopSearchInput.addEventListener("keydown", handleSearchSubmit);
  }
  if (mobileSearchInput) {
    mobileSearchInput.addEventListener("keydown", handleSearchSubmit);
  }
}
