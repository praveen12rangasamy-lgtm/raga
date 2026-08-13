// Reusable Components Injector for Raga Boutique Website

document.addEventListener("DOMContentLoaded", () => {
  injectHeader();
  injectFooter();
  injectDrawersAndModals();
  initializeComponentInteractivity();
});

// 1. Inject Header
function injectHeader() {
  const headerContainer = document.getElementById("global-header");
  if (!headerContainer) return;

  headerContainer.innerHTML = `
    <!-- Top Promotion Bar -->
    <div class="bg-brand-burgundy text-white text-[11px] py-2 px-4 overflow-hidden border-b border-brand-gold/20">
      <div class="ticker-wrap max-w-7xl mx-auto flex justify-between items-center text-center">
        <div class="ticker-content w-full flex justify-around space-x-8">
          <span>✨ Flat 10% OFF on your first order. Use code: <strong class="text-brand-gold">RAGA10</strong></span>
          <span class="hidden md:inline">|</span>
          <span>🚚 Free shipping across India on orders above ₹1,999</span>
          <span class="hidden md:inline">|</span>
          <span>⚜️ 100% Authentic Handlooms - Silk Mark Certified</span>
        </div>
      </div>
    </div>

    <!-- Main Header -->
    <div class="sticky-header sticky top-0 z-40 bg-white/95 border-b border-brand-gold/10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
          
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
            <a href="index.html" class="flex items-center">
              <img src="images/raga_logo.png?v=3" alt="Raga Boutique Logo" class="h-11 w-auto hover:opacity-90 transition duration-300">
            </a>
          </div>

          <!-- Desktop Search Bar + Login/Signup Buttons -->
          <div class="hidden md:flex flex-1 items-center gap-3 mx-6">
            <div class="relative flex-1">
              <input type="text" id="desktop-search-input" placeholder="Search For Sarees, Kurtas, Crafts..."
                class="w-full bg-brand-cream/40 text-xs text-brand-charcoal pl-4 pr-10 py-3 border border-brand-gold/25 rounded-sm focus:outline-none focus:border-brand-burgundy transition-colors duration-300">
              <div class="absolute right-3.5 top-3.5 text-brand-burgundy cursor-pointer">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>
            </div>
            <a href="javascript:void(0)" onclick="openAdminLoginModal()" id="header-login-btn" class="whitespace-nowrap text-[10px] uppercase tracking-[0.12em] font-bold px-4 py-2.5 border border-brand-burgundy text-brand-burgundy hover:bg-brand-burgundy hover:text-white transition-all duration-200 rounded-sm">Login</a>
            <a href="javascript:void(0)" onclick="openAdminLoginModal()" id="header-signup-btn" class="whitespace-nowrap text-[10px] uppercase tracking-[0.12em] font-bold px-4 py-2.5 bg-brand-burgundy text-white hover:bg-brand-burgundyLight transition-all duration-200 rounded-sm border-b-2 border-brand-gold">Sign Up</a>
            <a href="admin.html" id="header-admin-btn" style="display:none;" class="whitespace-nowrap text-[10px] uppercase tracking-[0.12em] font-bold px-4 py-2.5 bg-brand-gold text-brand-burgundy hover:bg-brand-goldDark transition-all duration-200 rounded-sm border-b-2 border-brand-burgundy">Admin Panel</a>
          </div>

          <!-- Right Action Icons -->
          <div class="flex items-center space-x-2 sm:space-x-5">
            
            <!-- User Icon & Tooltip Dropdown (Matching screenshot) -->
            <div class="relative group">
              <button id="account-btn" class="p-2 text-brand-charcoal hover:text-brand-gold transition duration-300" aria-label="Account">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </button>
              
              <!-- User Dropdown Panel -->
              <div class="absolute right-0 mt-2 w-72 bg-white border border-gray-100 shadow-2xl p-6 hidden group-hover:block z-50 text-left rounded-lg transition-all duration-300 animate-toast">
                <!-- Dropdown Header -->
                <div class="flex items-center space-x-3 pb-4 border-b border-gray-100 mb-4">
                  <div class="text-gray-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                  </div>
                  <h4 class="font-serif text-base font-semibold text-brand-charcoal">User</h4>
                </div>
                
                <!-- Options list -->
                <div class="space-y-4 text-xs font-semibold text-brand-charcoal/90 mb-6">
                  <div class="flex justify-between items-center">
                    <span class="text-gray-500 font-medium">Currency</span>
                    <div class="flex items-center space-x-2">
                      <span class="text-brand-burgundy border-b-2 border-brand-burgundy cursor-pointer">₹ INR</span>
                      <span class="text-gray-300">|</span>
                      <span class="text-gray-400 hover:text-brand-burgundy cursor-pointer">$ USD</span>
                    </div>
                  </div>
                  <a href="#" class="block hover:text-brand-burgundy transition">FAQs</a>
                  <a href="#" class="block hover:text-brand-burgundy transition">Terms Of Use</a>
                  <a href="#" class="block hover:text-brand-burgundy transition">Privacy Notice</a>
                </div>

                <!-- Login Button -->
                <a href="javascript:void(0)" onclick="openAdminLoginModal()" class="w-full flex items-center justify-center space-x-2 bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-widest font-bold py-3 px-4 rounded-full transition duration-300">
                  <span>LOGIN/SIGNUP</span>
                  <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3" />
                  </svg>
                </a>
              </div>
            </div>

            <!-- Wishlist Icon -->
            <a href="wishlist.html" class="p-2 text-brand-charcoal hover:text-brand-gold transition duration-300 relative" aria-label="Wishlist">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
              <span id="wishlist-badge" class="absolute top-0.5 right-0.5 bg-brand-burgundy text-white text-[8px] font-bold w-4 h-4 rounded-full flex items-center justify-center hidden">
                0
              </span>
            </a>

            <!-- Cart/Bag Icon -->
            <button id="cart-drawer-toggle" class="p-2 text-brand-charcoal hover:text-brand-gold transition duration-300 relative" aria-label="Shopping Bag">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
              <span id="cart-badge" class="absolute top-0.5 right-0.5 bg-brand-gold text-brand-burgundy text-[8px] font-bold w-4 h-4 rounded-full flex items-center justify-center hidden">
                0
              </span>
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

      <!-- Navigation Bar Links (Desktop Menu - Matching Taneira screenshots with Megamenus) -->
      <nav class="hidden lg:block bg-brand-cream border-t border-b border-l border-r border-brand-gold/15 max-w-7xl mx-auto relative">
        <div class="px-6 relative">
          <div class="flex justify-between items-center w-full">
            
            <!-- HOME LINK -->
            <a href="index.html" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy py-3 hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Home</a>

            <!-- SAREES MEGAMENU ITEM (Full-Width relative wrapper) -->
            <div class="group py-3">
              <a href="sarees.html" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Sarees</a>
              
              <!-- 7-Column Mega Dropdown -->
              <div class="absolute left-0 right-0 w-full bg-white border border-gray-100 shadow-2xl p-8 hidden group-hover:grid grid-cols-7 gap-4 z-50 rounded-lg mt-3 text-left animate-toast">
                
                <!-- Col 1: Shop By Occasion -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Occasion</h5>
                  <ul class="space-y-2 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="sarees.html?fabric=Linen" class="hover:text-brand-burgundy">Summer Sarees</a></li>
                    <li><a href="sarees.html?weave=Banarasi" class="hover:text-brand-burgundy">Summer Wedding Sarees</a></li>
                    <li><a href="sarees.html?fabric=Silk" class="hover:text-brand-burgundy">Formal Sarees</a></li>
                    <li><a href="sarees.html?fabric=Cotton" class="hover:text-brand-burgundy">Casual Sarees</a></li>
                    <li><a href="sarees.html?weave=Chanderi" class="hover:text-brand-burgundy">Festive Sarees</a></li>
                    <li><a href="sarees.html?weave=Banarasi" class="hover:text-brand-burgundy">Bridal Sarees</a></li>
                    <li><a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy">Party Wear Sarees</a></li>
                    <li><a href="sarees.html?color=Yellow" class="hover:text-brand-burgundy">Haldi Sarees</a></li>
                    <li><a href="sarees.html?color=Red" class="hover:text-brand-burgundy">Engagement Sarees</a></li>
                    <li><a href="sarees.html?fabric=Linen" class="hover:text-brand-burgundy">Farewell & Graduation Sarees</a></li>
                  </ul>
                </div>

                <!-- Col 2: Shop By Fabric -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Fabric</h5>
                  <ul class="space-y-2 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="sarees.html?fabric=Cotton" class="hover:text-brand-burgundy">Cotton Sarees</a></li>
                    <li><a href="sarees.html?fabric=Cotton" class="hover:text-brand-burgundy">Kota Sarees</a></li>
                    <li><a href="sarees.html?fabric=Cotton" class="hover:text-brand-burgundy">Khadi Sarees</a></li>
                    <li><a href="sarees.html?fabric=Linen" class="hover:text-brand-burgundy">Linen Sarees</a></li>
                    <li><a href="sarees.html?fabric=Georgette" class="hover:text-brand-burgundy">Crepe Sarees</a></li>
                    <li><a href="sarees.html?fabric=Silk" class="hover:text-brand-burgundy">Silk Sarees</a></li>
                    <li><a href="sarees.html?fabric=Silk" class="hover:text-brand-burgundy">Pattu Sarees</a></li>
                    <li><a href="sarees.html?fabric=Tissue" class="hover:text-brand-burgundy">Tissue Sarees</a></li>
                    <li><a href="sarees.html?fabric=Organza" class="hover:text-brand-burgundy">Chiffon Sarees</a></li>
                  </ul>
                </div>

                <!-- Col 3: Shop By Colour -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Colour</h5>
                  <ul class="space-y-2 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="sarees.html?color=Off-White" class="hover:text-brand-burgundy">White Sarees</a></li>
                    <li><a href="sarees.html?color=Pastel" class="hover:text-brand-burgundy">Pastel-Sarees</a></li>
                    <li><a href="sarees.html?color=Pastel" class="hover:text-brand-burgundy">Pink Sarees</a></li>
                    <li><a href="sarees.html?color=Blue" class="hover:text-brand-burgundy">Blue Sarees</a></li>
                    <li><a href="sarees.html?color=Yellow" class="hover:text-brand-burgundy">Yellow Sarees</a></li>
                    <li><a href="sarees.html?color=Red" class="hover:text-brand-burgundy">Black Sarees</a></li>
                    <li><a href="sarees.html?color=Red" class="hover:text-brand-burgundy">Red Sarees</a></li>
                    <li><a href="sarees.html?color=Gold" class="hover:text-brand-burgundy">Gold Sarees</a></li>
                    <li><a href="sarees.html?color=Green" class="hover:text-brand-burgundy">Green Sarees</a></li>
                    <li><a href="sarees.html?color=Pastel" class="hover:text-brand-burgundy">Peach Sarees</a></li>
                    <li><a href="sarees.html?color=Gold" class="hover:text-brand-burgundy">Multicoloured Sarees</a></li>
                  </ul>
                </div>

                <!-- Col 4: Heirloom Pieces -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Heirloom Pieces</h5>
                  <ul class="space-y-2 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy">Kanchipuram Sarees</a></li>
                    <li><a href="sarees.html?weave=Banarasi" class="hover:text-brand-burgundy">Banarasi Sarees</a></li>
                    <li><a href="sarees.html?weave=Chanderi" class="hover:text-brand-burgundy">Paithani Sarees</a></li>
                    <li><a href="sarees.html?weave=Banarasi" class="hover:text-brand-burgundy">Patola Sarees</a></li>
                  </ul>
                </div>

                <!-- Col 5: Shop By Price -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Price Range</h5>
                  <ul class="space-y-2 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="sarees.html?priceRange=under-2000" class="hover:text-brand-burgundy">Sarees Under 2000</a></li>
                    <li><a href="sarees.html?priceRange=2000-5000" class="hover:text-brand-burgundy">Sarees Under 5000</a></li>
                    <li><a href="sarees.html?priceRange=above-5000" class="hover:text-brand-burgundy">Sarees Under 10000</a></li>
                    <li><a href="sarees.html?priceRange=above-5000" class="hover:text-brand-burgundy">Sarees Under 15000</a></li>
                  </ul>
                </div>

                <!-- Col 6: Shop By Region -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Region</h5>
                  <ul class="space-y-2 text-[11px] font-semibold text-brand-charcoal/80 leading-tight">
                    <li><a href="sarees.html?weave=Printed" class="hover:text-brand-burgundy">Rajasthan Sarees</a></li>
                    <li><a href="sarees.html?weave=Jamdani" class="hover:text-brand-burgundy">Bengal Sarees</a></li>
                    <li><a href="sarees.html?weave=Tussar" class="hover:text-brand-burgundy">Bhagalpuri Sarees</a></li>
                    <li><a href="sarees.html?weave=Printed" class="hover:text-brand-burgundy">Murshidabad Sarees</a></li>
                    <li><a href="sarees.html?weave=Printed" class="hover:text-brand-burgundy">Gujarati Sarees</a></li>
                    <li><a href="sarees.html?weave=Chanderi" class="hover:text-brand-burgundy">Chanderi Sarees</a></li>
                    <li><a href="sarees.html?weave=Chanderi" class="hover:text-brand-burgundy">Maheshwari Sarees</a></li>
                    <li><a href="sarees.html?weave=Jamdani" class="hover:text-brand-burgundy">Pochampalli Sarees</a></li>
                    <li><a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy">Kanjivaram Sarees</a></li>
                    <li><a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy">South Indian Sarees</a></li>
                    <li><a href="sarees.html?weave=Banarasi" class="hover:text-brand-burgundy">Banaras Sarees</a></li>
                    <li><a href="sarees.html?weave=Tussar" class="hover:text-brand-burgundy">Assam Sarees</a></li>
                    <li><a href="sarees.html?weave=Chanderi" class="hover:text-brand-burgundy">Madhya Pradesh Sarees</a></li>
                  </ul>
                </div>

                <!-- Col 7: Shop By Look -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Look</h5>
                  <ul class="space-y-2 text-[11px] font-semibold text-brand-charcoal/80 leading-tight">
                    <li><a href="sarees.html?weave=Printed" class="hover:text-brand-burgundy">Floral Sarees</a></li>
                    <li><a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy">Handloom Sarees</a></li>
                    <li><a href="sarees.html?weave=Printed" class="hover:text-brand-burgundy">Bandhani Sarees</a></li>
                    <li><a href="sarees.html?weave=Chanderi" class="hover:text-brand-burgundy">Chikankari Sarees</a></li>
                    <li><a href="sarees.html" class="hover:text-brand-burgundy">Plain Sarees</a></li>
                    <li><a href="sarees.html?weave=Printed" class="hover:text-brand-burgundy">Ajrakh Sarees</a></li>
                    <li><a href="sarees.html?weave=Banarasi" class="hover:text-brand-burgundy">Embroidery</a></li>
                    <li><a href="sarees.html?weave=Printed" class="hover:text-brand-burgundy">Printed Sarees</a></li>
                    <li><a href="sarees.html?weave=Jamdani" class="hover:text-brand-burgundy">Jamdani Sarees</a></li>
                    <li><a href="sarees.html?weave=Tussar" class="hover:text-brand-burgundy">Kalamkari Sarees</a></li>
                    <li><a href="sarees.html?weave=Printed" class="hover:text-brand-burgundy">Block Printed Sarees</a></li>
                    <li><a href="sarees.html?weave=Printed" class="hover:text-brand-burgundy">Tie And Dye</a></li>
                    <li><a href="sarees.html?weave=Jamdani" class="hover:text-brand-burgundy">Ikat Sarees</a></li>
                  </ul>
                </div>

              </div>
            </div>

            <!-- KURTAS MEGAMENU ITEM (Centered relative wrapper) -->
            <div class="group relative py-3">
              <a href="kurtas.html" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Kurtas</a>
              
              <!-- 3-Column Megamenu Dropdown -->
              <div class="absolute left-0 mt-3 w-144 bg-white border border-gray-100 shadow-2xl p-6 hidden group-hover:grid grid-cols-3 gap-6 z-50 rounded-lg text-left animate-toast">
                <!-- Col 1: Shop By Fabric -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Fabric</h5>
                  <ul class="space-y-2.5 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="kurtas.html?fabric=Cotton" class="hover:text-brand-burgundy">Cotton</a></li>
                    <li><a href="kurtas.html?fabric=Silk%20Blend" class="hover:text-brand-burgundy">Silk</a></li>
                    <li><a href="kurtas.html?fabric=Georgette" class="hover:text-brand-burgundy">Viscose</a></li>
                    <li><a href="kurtas.html?fabric=Chanderi" class="hover:text-brand-burgundy">Linen</a></li>
                  </ul>
                </div>

                <!-- Col 2: Shop By Type -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Type</h5>
                  <ul class="space-y-2.5 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="kurtas.html?weave=Chanderi%20Weave" class="hover:text-brand-burgundy">Embroidered</a></li>
                    <li><a href="kurtas.html?weave=Printed" class="hover:text-brand-burgundy">Printed</a></li>
                    <li><a href="kurtas.html?weave=Printed" class="hover:text-brand-burgundy">Block Printed</a></li>
                    <li><a href="kurtas.html?weave=Khadi%20Weave" class="hover:text-brand-burgundy">Chikankari</a></li>
                  </ul>
                </div>

                <!-- Col 3: Shop By Colour -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Colour</h5>
                  <ul class="space-y-2.5 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="kurtas.html?color=Red" class="hover:text-brand-burgundy">Red</a></li>
                    <li><a href="kurtas.html?color=Pastel" class="hover:text-brand-burgundy">Pink</a></li>
                    <li><a href="kurtas.html?color=Blue" class="hover:text-brand-burgundy">Blue</a></li>
                    <li><a href="kurtas.html?color=Red" class="hover:text-brand-burgundy">Black</a></li>
                    <li><a href="kurtas.html?color=Off-White" class="hover:text-brand-burgundy">White</a></li>
                    <li><a href="kurtas.html?color=Blue" class="hover:text-brand-burgundy">Violet</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- DRESS MATERIALS MEGAMENU ITEM (2 Columns) -->
            <div class="group relative py-3">
              <a href="sarees.html?fabric=Linen" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Dress Materials</a>
              
              <!-- 2-Column Megamenu Dropdown -->
              <div class="absolute left-0 mt-3 w-96 bg-white border border-gray-100 shadow-2xl p-6 hidden group-hover:grid grid-cols-2 gap-6 z-50 rounded-lg text-left animate-toast">
                <!-- Col 1: Shop By Fabric -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Fabric</h5>
                  <ul class="space-y-2.5 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="kurtas.html?fabric=Georgette" class="hover:text-brand-burgundy">Viscose Suits</a></li>
                    <li><a href="kurtas.html?fabric=Silk%20Blend" class="hover:text-brand-burgundy">Silk Cotton Suits</a></li>
                    <li><a href="sarees.html?fabric=Tissue" class="hover:text-brand-burgundy">Tissue Suits</a></li>
                    <li><a href="kurtas.html?fabric=Cotton" class="hover:text-brand-burgundy">Cotton Suits</a></li>
                    <li><a href="kurtas.html?fabric=Cotton" class="hover:text-brand-burgundy">Linen Suits</a></li>
                  </ul>
                </div>

                <!-- Col 2: Shop By Colour -->
                <div>
                  <h5 class="text-xs font-bold text-brand-gold uppercase tracking-wider mb-3">Shop By Colour</h5>
                  <ul class="space-y-2.5 text-[11px] font-semibold text-brand-charcoal/80">
                    <li><a href="kurtas.html?color=Blue" class="hover:text-brand-burgundy">Blue Suits</a></li>
                    <li><a href="kurtas.html?color=Pastel" class="hover:text-brand-burgundy">Pink Suits</a></li>
                    <li><a href="kurtas.html?color=Red" class="hover:text-brand-burgundy">Red Suits</a></li>
                    <li><a href="kurtas.html?color=Yellow" class="hover:text-brand-burgundy">Yellow Suits</a></li>
                    <li><a href="kurtas.html?color=Red" class="hover:text-brand-burgundy">Black Suits</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- OTHER NAV ITEMS -->
            <a href="sarees.html?weave=Chanderi" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy py-3 hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Blouses</a>
            <a href="kurtas.html?weave=Printed" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy py-3 hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Short Kurtis & Tops</a>
            <a href="sarees.html?sort=rating" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy py-3 hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">New Arrivals</a>

            <!-- SALE MEGAMENU ITEM -->
            <div class="group relative py-3">
              <a href="sarees.html?priceRange=under-2000" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Sale</a>
              <div class="absolute left-0 mt-3 w-48 bg-white border border-gray-100 shadow-2xl p-4 hidden group-hover:block z-50 rounded-lg text-left animate-toast">
                <ul class="space-y-3 text-[11px] font-semibold text-brand-charcoal/80">
                  <li><a href="sarees.html?priceRange=under-2000" class="hover:text-brand-burgundy block transition">Sarees Sale</a></li>
                  <li><a href="kurtas.html?priceRange=under-2000" class="hover:text-brand-burgundy block transition">Kurta Sale</a></li>
                </ul>
              </div>
            </div>

            <!-- GIFTING MEGAMENU ITEM -->
            <div class="group relative py-3">
              <a href="sarees.html?weave=Kanjivaram" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Gifting</a>
              <div class="absolute left-0 mt-3 w-48 bg-white border border-gray-100 shadow-2xl p-4 hidden group-hover:block z-50 rounded-lg text-left animate-toast">
                <ul class="space-y-3 text-[11px] font-semibold text-brand-charcoal/80">
                  <li><a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy block transition">Raga Boutique E-Gift Card</a></li>
                  <li><a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy block transition">Gifting For Women</a></li>
                </ul>
              </div>
            </div>

            <!-- COLLECTIONS MEGAMENU ITEM -->
            <div class="group relative py-3">
              <a href="index.html#occasions" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Collections</a>
              <div class="absolute left-0 mt-3 w-56 bg-white border border-gray-100 shadow-2xl p-5 hidden group-hover:block z-50 rounded-lg text-left animate-toast">
                <ul class="space-y-3 text-[11px] font-semibold text-brand-charcoal/80">
                  <li><a href="sarees.html?fabric=Linen" class="hover:text-brand-burgundy block transition">Summer Essentials</a></li>
                  <li><a href="sarees.html" class="hover:text-brand-burgundy block transition">RAAS Collection</a></li>
                  <li><a href="sarees.html?fabric=Cotton" class="hover:text-brand-burgundy block transition">Summer Songs</a></li>
                  <li><a href="sarees.html?fabric=Organza" class="hover:text-brand-burgundy block transition">Miara Collection</a></li>
                  <li><a href="kurtas.html" class="hover:text-brand-burgundy block transition">Tarini Edit</a></li>
                  <li><a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy block transition">Queen's Choice</a></li>
                  <li><a href="sarees.html?priceRange=under-2000" class="hover:text-brand-burgundy block transition">End Of Season Sale</a></li>
                  <li><a href="sarees.html?fabric=Tissue" class="hover:text-brand-burgundy block transition">Inaya Collection</a></li>
                </ul>
              </div>
            </div>

            <!-- WISHLIST LINK -->
            <a href="wishlist.html" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy py-3 hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Wishlist</a>

            <!-- SHOPPING BAG LINK -->
            <a href="cart.html" class="text-[10px] uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy py-3 hover:border-b-2 hover:border-brand-burgundy transition-all duration-200 pb-1">Shopping Bag</a>

            <!-- MORE MEGAMENU ITEM -->
            <div class="group relative py-3">
              <span class="text-[10px] cursor-pointer uppercase tracking-[0.2em] font-semibold text-brand-charcoal hover:text-brand-burgundy pb-1">More</span>
              <div class="absolute right-0 mt-3 w-64 bg-white border border-gray-100 shadow-2xl p-6 hidden group-hover:block z-50 rounded-lg text-left animate-toast">
                <ul class="space-y-3.5 text-[11px] font-semibold text-brand-charcoal/80">
                  <li><a href="#" class="hover:text-brand-burgundy block transition">Track Order</a></li>
                  <li><a href="#" class="hover:text-brand-burgundy block transition">About Us</a></li>
                  <li><a href="#" class="hover:text-brand-burgundy block transition">Blogs</a></li>
                  <li><a href="#" class="hover:text-brand-burgundy block transition">Find A Store</a></li>
                  <li><a href="#" class="hover:text-brand-burgundy block transition">Reviews</a></li>
                  <li><a href="#" class="hover:text-brand-burgundy block transition">Shipping</a></li>
                  <li><a href="#" class="hover:text-brand-burgundy block transition">Golden Cocoon</a></li>
                  <li><a href="#" class="hover:text-brand-burgundy block transition">Delivery Information</a></li>
                  <li><a href="#" class="hover:text-brand-burgundy block transition">Return & Cancellations</a></li>
                  <li><a href="#" class="hover:text-brand-burgundy block transition">Encircle & Raga Boutique NeuPass</a></li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </nav>
    </div>
  `;
}

// 2. Inject Footer (Matching Footer screenshot exactly)
function injectFooter() {
  const footerContainer = document.getElementById("global-footer");
  if (!footerContainer) return;

  footerContainer.innerHTML = `
    <!-- Top Footer Bar - Popular Searches -->
    <div class="bg-[#702152]/5 border-t border-brand-gold/15 py-10 text-xs">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-3 leading-relaxed">
          <h4 class="font-serif text-sm font-bold text-brand-burgundy uppercase tracking-wider mb-2">Popular Searches</h4>
          <p class="text-brand-charcoal/80 space-x-1.5 flex-wrap">
            <a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy transition">Summer Wedding Sarees</a> |
            <a href="sarees.html" class="hover:text-brand-burgundy transition">RAAS Collection</a> |
            <a href="sarees.html?fabric=Linen" class="hover:text-brand-burgundy transition">Summer Essentials</a> |
            <a href="sarees.html" class="hover:text-brand-burgundy transition">Formal Sarees</a> |
            <a href="sarees.html?fabric=Cotton" class="hover:text-brand-burgundy transition">Casual Sarees</a> |
            <a href="sarees.html" class="hover:text-brand-burgundy transition">Farewell Sarees</a> |
            <a href="sarees.html?fabric=Silk" class="hover:text-brand-burgundy transition">Festive Sarees</a> |
            <a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy transition">Wedding sarees</a> |
            <a href="sarees.html?weave=Banarasi" class="hover:text-brand-burgundy transition">Bridal Saree</a> |
            <a href="sarees.html?color=Yellow" class="hover:text-brand-burgundy transition">Yellow saree for haldi</a> |
            <a href="sarees.html?weave=Banarasi" class="hover:text-brand-burgundy transition">Banarasi sarees</a>
          </p>
          <a href="javascript:void(0)" onclick="openInfoModal('about')" class="inline-block text-brand-burgundy font-bold hover:underline">Read More</a>
        </div>
      </div>
    </div>

    <!-- Main Footer -->
    <footer class="bg-brand-cream border-t border-brand-gold/15 pt-16 pb-8 text-brand-charcoal">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-brand-gold/15">
          
          <!-- Column 1: Quick Links -->
          <div>
            <h4 class="font-serif text-[13px] font-bold text-brand-burgundy uppercase tracking-wider mb-6">Quick Links</h4>
            <ul class="space-y-3.5 text-xs font-semibold text-brand-charcoal/80">
              <li><a href="sarees.html" class="hover:text-brand-burgundy transition">Sarees</a></li>
              <li><a href="sarees.html?weave=Chanderi" class="hover:text-brand-burgundy transition">Blouses</a></li>
              <li><a href="kurtas.html" class="hover:text-brand-burgundy transition">Kurtas & Kurta Sets</a></li>
              <li><a href="kurtas.html?weave=Printed" class="hover:text-brand-burgundy transition">Short Kurtis & Tops</a></li>
              <li><a href="sarees.html?fabric=Linen" class="hover:text-brand-burgundy transition">Dress Materials</a></li>
              <li><a href="kurtas.html" class="hover:text-brand-burgundy transition">Lehengas & Skirts</a></li>
              <li><a href="sarees.html" class="hover:text-brand-burgundy transition">Inskirts</a></li>
              <li><a href="kurtas.html" class="hover:text-brand-burgundy transition">Trousers</a></li>
              <li><a href="sarees.html?weave=Kanjivaram" class="hover:text-brand-burgundy transition">Giftings</a></li>
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
                <a href="index.html" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Home</a>
                <a href="sarees.html" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Sarees</a>
                <a href="kurtas.html" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Kurtas</a>
                <a href="sarees.html?fabric=Linen" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Dress Materials</a>
                <a href="sarees.html?weave=Chanderi" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Blouses</a>
                <a href="kurtas.html?weave=Printed" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Short Kurtis & Tops</a>
                <a href="sarees.html?sort=rating" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">New Arrivals</a>
                <a href="sarees.html?priceRange=under-2000" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Sale</a>
                <a href="sarees.html?weave=Kanjivaram" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Gifting</a>
                <a href="wishlist.html" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">My Wishlist</a>
                <a href="cart.html" class="block text-brand-charcoal hover:text-brand-burgundy py-2 border-b border-brand-gold/5">Shopping Bag</a>
              </nav>

              <div class="mt-8 pt-8 border-t border-brand-gold/15 space-y-4 text-xs font-semibold">
                <a href="#" class="flex items-center text-brand-charcoal hover:text-brand-burgundy">
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
                <a href="sarees.html" class="bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-wider font-bold py-2.5 px-6 border-b-2 border-brand-gold transition duration-300">Shop Sarees</a>
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
                <a href="cart.html" class="w-full flex items-center justify-center bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-sm uppercase tracking-widest font-bold py-3 transition duration-300 border-b-2 border-brand-gold">
                  Proceed to Checkout
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

    <!-- In-Page Admin Login Modal -->
    <div id="admin-login-modal" class="fixed inset-0 z-[100] overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/60 transition-opacity" onclick="closeAdminLoginModal()"></div>

        <!-- Modal panel -->
        <div class="relative inline-block align-middle text-left shadow-2xl transform transition-all sm:my-8 sm:max-w-[420px] w-full rounded-2xl overflow-hidden" style="background-color: #311124; border: 1px solid rgba(212,178,112,0.15);">
          
          <div class="p-8 pb-6 flex flex-col items-center border-b border-white/5">
            <img src="images/raga_logo_silver.png?v=3" alt="Raga Boutique" class="h-12 mb-6" onerror="this.style.display='none'">
            <h2 class="text-[10px] font-bold tracking-[0.25em] text-[#d4b270] uppercase mb-3">Admin Portal</h2>
            <h1 class="font-serif text-3xl font-bold text-white mb-2">Welcome Back</h1>
            <p class="text-[13px] text-white/60">Sign in to manage your boutique</p>
          </div>

          <div class="p-8 pt-6">
            <form id="admin-login-form-modal" onsubmit="handleAdminLoginSubmit(event)">
              <div id="login-error-modal" class="hidden mb-4 p-3 bg-red-900/30 border border-red-500/30 rounded-lg text-red-200 text-xs text-center"></div>
              
              <div class="mb-5">
                <label class="block text-[11px] font-bold text-[#d4b270] tracking-widest uppercase mb-2">Username</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-[#d4b270]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                  </div>
                  <input type="text" id="admin-user-modal" required placeholder="Enter username" 
                    class="block w-full pl-11 pr-4 py-3.5 bg-[#421731] border border-[#d4b270]/30 rounded-xl text-white text-sm placeholder-white/30 focus:outline-none focus:border-[#d4b270] transition-colors"
                    value="admin">
                </div>
              </div>

              <div class="mb-8">
                <label class="block text-[11px] font-bold text-[#d4b270] tracking-widest uppercase mb-2">Password</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-[#d4b270]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                  </div>
                  <input type="password" id="admin-pass-modal" required placeholder="Enter password" 
                    class="block w-full pl-11 pr-11 py-3.5 bg-[#421731] border border-[#d4b270]/30 rounded-xl text-white text-sm placeholder-white/30 focus:outline-none focus:border-[#d4b270] transition-colors"
                    value="raga@admin2024">
                  <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer text-[#d4b270]/60 hover:text-[#d4b270]" onclick="togglePasswordVisibilityModal()">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="eye-icon-modal">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </div>
                </div>
              </div>

              <button type="submit" class="w-full py-4 bg-[#d4b270] hover:bg-[#bfa061] text-[#311124] text-xs font-bold tracking-[0.15em] uppercase rounded-xl transition duration-300">
                Sign in to Admin Panel
              </button>
            </form>
            
            <div class="mt-6 text-center">
              <a href="javascript:void(0)" onclick="closeAdminLoginModal()" class="text-xs text-white/50 hover:text-white transition flex items-center justify-center gap-2">
                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Back to Raga Boutique
              </a>
            </div>
          </div>
          
          <div class="bg-black/20 py-4 text-center">
            <p class="text-[9px] font-bold text-white/30 tracking-[0.2em] uppercase">Raga Boutique • Admin Portal • Restricted Access</p>
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

    mobileMenuClose.addEventListener("click", closeMobileMenu);
    mobileMenuOverlay.addEventListener("click", closeMobileMenu);
  }

  // Cart drawer interactivity
  const cartToggle = document.getElementById("cart-drawer-toggle");
  const cartDrawer = document.getElementById("cart-drawer");
  const cartClose = document.getElementById("cart-close");
  const cartOverlay = document.getElementById("cart-overlay");
  const cartPanel = document.getElementById("cart-panel");
  const cartContinue = document.getElementById("cart-drawer-continue");

  if (cartToggle && cartDrawer) {
    const openCart = () => {
      cartDrawer.classList.remove("hidden");
      if (typeof updateCartUI === "function") {
        updateCartUI();
      }
      setTimeout(() => {
        cartOverlay.classList.remove("opacity-0");
        cartOverlay.classList.add("opacity-100");
        cartPanel.classList.remove("translate-x-full");
        cartPanel.classList.add("translate-x-0");
      }, 50);
    };

    cartToggle.addEventListener("click", openCart);

    const closeCart = () => {
      cartOverlay.classList.remove("opacity-100");
      cartOverlay.classList.add("opacity-0");
      cartPanel.classList.remove("translate-x-0");
      cartPanel.classList.add("translate-x-full");
      setTimeout(() => {
        cartDrawer.classList.add("hidden");
      }, 300);
    };

    cartClose.addEventListener("click", closeCart);
    cartContinue.addEventListener("click", closeCart);
    cartOverlay.addEventListener("click", closeCart);
  }

  // Search input interactivity
  const desktopSearchInput = document.getElementById("desktop-search-input");
  const mobileSearchInput = document.getElementById("mobile-search-input");

  const handleSearchSubmit = (event) => {
    if (event.key === "Enter") {
      const query = event.target.value.trim();
      if (query !== "") {
        window.location.href = `sarees.html?search=${encodeURIComponent(query)}`;
      }
    }
  };

  if (desktopSearchInput) {
    desktopSearchInput.addEventListener("keydown", handleSearchSubmit);
  }
  if (mobileSearchInput) {
    mobileSearchInput.addEventListener("keydown", handleSearchSubmit);
  }

  // ── Auth-aware header buttons ──
  // Show Admin Panel link and hide Login/Signup when admin session is active
  (function updateHeaderAuthState() {
    const isAdmin = sessionStorage.getItem('raga_admin_auth') === 'true';
    const loginBtn = document.getElementById('header-login-btn');
    const signupBtn = document.getElementById('header-signup-btn');
    const adminBtn = document.getElementById('header-admin-btn');
    if (isAdmin) {
      if (loginBtn) loginBtn.style.display = 'none';
      if (signupBtn) signupBtn.style.display = 'none';
      if (adminBtn) adminBtn.style.display = '';
    } else {
      if (loginBtn) loginBtn.style.display = '';
      if (signupBtn) signupBtn.style.display = '';
      if (adminBtn) adminBtn.style.display = 'none';
    }
  })();
}

// ── Admin Login Modal Logic ──
window.openAdminLoginModal = function() {
  const modal = document.getElementById('admin-login-modal');
  if (modal) modal.classList.remove('hidden');
};

window.closeAdminLoginModal = function() {
  const modal = document.getElementById('admin-login-modal');
  if (modal) modal.classList.add('hidden');
};

window.togglePasswordVisibilityModal = function() {
  const input = document.getElementById('admin-pass-modal');
  const eye = document.getElementById('eye-icon-modal');
  if (input.type === 'password') {
    input.type = 'text';
    eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
  } else {
    input.type = 'password';
    eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
  }
};

window.handleAdminLoginSubmit = function(e) {
  e.preventDefault();
  const u = document.getElementById('admin-user-modal').value.trim();
  const p = document.getElementById('admin-pass-modal').value;
  const err = document.getElementById('login-error-modal');
  
  if (u === 'admin' && p === 'raga@admin2024') {
    err.classList.add('hidden');
    sessionStorage.setItem('raga_admin_auth', 'true');
    sessionStorage.setItem('raga_admin_user', u);
    window.location.href = 'admin.html';
  } else {
    err.textContent = 'Invalid username or password.';
    err.classList.remove('hidden');
  }
};
