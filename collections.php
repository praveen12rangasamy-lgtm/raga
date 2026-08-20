<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Handcrafted Collections — Raga Boutique</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="images/raga_favicon.png">
  <meta name="description" content="Explore handcrafted Indian ethnic collections at Raga Boutique. Discover sarees, kurtas, blouses, dress materials, and luxury festive drapes.">

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

<body class="bg-gradient-to-b from-[#340b25] via-[#4a1236] to-[#25061b] text-white min-h-screen flex flex-col selection:bg-brand-gold selection:text-brand-burgundy">

  <!-- Global Dynamic Header (Pinned Top) -->
  <header id="global-header" class="w-full bg-white z-40"></header>

  <!-- Main Content -->
  <main class="flex-grow py-10 sm:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Compact Top Header -->
      <div class="text-center mb-10">
        <span class="text-[11px] uppercase tracking-[0.3em] text-brand-gold font-bold block mb-2">Curated Categories & Weaves</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Our Handcrafted Collections</h1>
        <div class="h-0.5 w-16 bg-brand-gold mx-auto mt-3 mb-3"></div>
        <p class="text-xs sm:text-sm text-white/80 max-w-xl mx-auto font-light leading-relaxed">
          Discover our curated ranges of authentic handloom attire, categorized for every grand celebration and daily elegance.
        </p>
      </div>

      <!-- Compact Collections Grid -->
      <div id="collections-page-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Injected dynamically via JS from Admin Categories -->
      </div>

    </div>
  </main>

  <!-- Global Dynamic Footer (Without Popular Searches) -->
  <footer id="global-footer" class="w-full no-popular-searches" data-no-popular-searches="true"></footer>

  <!-- Scripts -->
  <script src="js/products.js"></script>
  <script src="js/components.js"></script>
  <script src="js/main.js"></script>

  <script>
    // Fetch and render admin categories in compact cards
    async function loadCollectionsPage() {
      const container = document.getElementById("collections-page-grid");
      if (!container) return;

      let categories = [];
      try {
        const res = await fetch("api/get_categories.php");
        if (res.ok) {
          categories = await res.json();
        }
      } catch (e) {
        console.warn("API fetch error, falling back to local cache:", e);
      }

      if (!categories || categories.length === 0) {
        const local = localStorage.getItem("raga_admin_categories_v2");
        if (local) {
          try { categories = JSON.parse(local); } catch(e){}
        }
      }

      if (!categories || categories.length === 0) {
        categories = [
          { id: 'sarees', name: 'Sarees', image: 'images/img-saree-red.jpg' },
          { id: 'kurtas', name: 'Kurtas & Suits', image: 'images/img-kurta-anarkali.jpg' },
          { id: 'dress-materials', name: 'Dress Materials', image: 'images/img-saree-organza.jpg' },
          { id: 'blouses', name: 'Blouses', image: 'images/img-saree-banarasi.jpg' },
          { id: 'short-kurtis', name: 'Short Kurtis & Tops', image: 'images/img-kurta-blue.jpg' },
          { id: 'new-arrivals', name: 'New Arrivals', image: 'images/img-saree-gold.jpg' },
          { id: 'sale', name: 'Sale', image: 'images/img-saree-tussar.jpg' },
          { id: 'gifting', name: 'Gifting', image: 'images/banner1.jpg' }
        ];
      }

      const allProducts = typeof ProductsDB !== "undefined" ? ProductsDB.getAll() : [];

      // Filter: Only display categories that have at least 1 product (0-product categories are only visible in admin panel)
      const visibleCategories = categories.filter(cat => {
        const prodCount = allProducts.filter(p => String(p.category || '').toLowerCase().trim() === String(cat.id || '').toLowerCase().trim()).length;
        return prodCount > 0;
      });

      if (visibleCategories.length === 0) {
        container.innerHTML = `
          <div class="col-span-full text-center py-16 bg-[#24061a] border border-brand-gold/20 rounded-lg p-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-brand-gold/10 text-brand-gold mb-4">
              <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
              </svg>
            </div>
            <h3 class="font-serif text-xl font-bold text-white mb-2">No Active Collections Available</h3>
            <p class="text-xs text-white/70 max-w-sm mx-auto">Categories with published products will automatically appear here once added from the admin panel.</p>
          </div>
        `;
        return;
      }

      container.innerHTML = visibleCategories.map(cat => {
        const prodCount = allProducts.filter(p => String(p.category || '').toLowerCase().trim() === String(cat.id || '').toLowerCase().trim()).length;
        
        let targetHref = `sarees.php?category=${encodeURIComponent(cat.id)}`;
        if (cat.id === 'sarees') {
          targetHref = 'sarees.php?category=sarees';
        } else if (cat.id === 'kurtas') {
          targetHref = 'kurtas.php?category=kurtas';
        } else if (cat.id === 'new-arrivals') {
          targetHref = 'index.php#new-arrivals';
        }

        const imgUrl = cat.image && cat.image.trim() !== '' ? cat.image : 'images/img-saree-red.jpg';

        return `
          <div class="group rounded-lg overflow-hidden border border-brand-gold/30 bg-[#2d0921] shadow-lg hover:shadow-2xl hover:border-brand-gold transition-all duration-300 flex flex-col justify-between">
            <!-- Clean Image without any text on top -->
            <a href="${targetHref}" class="aspect-[3/4] overflow-hidden relative block bg-black/40">
              <img src="${imgUrl}" alt="${cat.name}" class="w-full h-full object-cover zoom-image opacity-95 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
            </a>
            
            <!-- Category Title, Product Count, and Clean Button Below Image -->
            <div class="p-3.5 sm:p-4 bg-gradient-to-b from-[#24061a] to-[#180312] flex flex-col justify-between flex-grow">
              <div class="flex items-center justify-between gap-1.5 mb-3">
                <h3 class="font-serif text-sm sm:text-base font-bold text-white group-hover:text-brand-gold transition-colors duration-200 line-clamp-1">
                  <a href="${targetHref}">${cat.name}</a>
                </h3>
                <span class="text-[9px] sm:text-[10px] font-semibold text-brand-gold bg-brand-gold/10 border border-brand-gold/25 px-2 py-0.5 rounded-full whitespace-nowrap">
                  ${prodCount} ${prodCount === 1 ? 'Product' : 'Products'}
                </span>
              </div>

              <div class="pt-2.5 border-t border-brand-gold/15 mt-auto">
                <a href="${targetHref}" class="w-full block text-center py-2 px-3 bg-[#702152] hover:bg-brand-gold hover:text-brand-burgundy text-white font-semibold text-[8.5px] sm:text-[9px] uppercase tracking-wider rounded transition-all duration-300 border border-brand-gold/30">
                  EXPLORE COLLECTION
                </a>
              </div>
            </div>
          </div>
        `;
      }).join('');
    }

    document.addEventListener("DOMContentLoaded", loadCollectionsPage);
    window.addEventListener("ragaProductsLoaded", loadCollectionsPage);
  </script>
</body>

</html>
