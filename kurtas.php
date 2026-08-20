<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kurtas & Suits Collection — Raga Boutique</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="images/raga_favicon.png">
  <meta name="description" content="Explore our collection of designer women's Kurtas, Salwar Suit sets, and short kurtis for casual or festive wear.">
  
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
  <!-- Main Grid container -->
  <main class="flex-grow max-w-7xl mx-auto px-2.5 sm:px-6 lg:px-8 py-6 sm:py-8 w-full">
    <div class="flex flex-col lg:flex-row gap-8">
      
      <!-- Mobile Filter toggle button (only visible on mobile lg:hidden) -->
      <div class="lg:hidden flex justify-between items-center bg-white p-4 border border-brand-gold/15 shadow-sm">
        <button id="mobile-filter-btn" class="flex items-center text-sm font-bold text-brand-burgundy hover:text-brand-gold transition duration-200">
          <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
          </svg>
          Filter & Refine
        </button>
        <span class="text-xs text-gray-500 font-semibold" id="mobile-product-count">0 Products</span>
      </div>

      <!-- Left Sidebar: Filters Panel -->
      <aside id="filter-sidebar" class="hidden lg:block lg:w-64 bg-white p-6 border border-brand-gold/15 sticky top-28 max-h-[calc(100vh-8rem)] overflow-y-auto shadow-sm z-30 flex-shrink-0">
        
        <!-- Sidebar Header (only for mobile drawer view) -->
        <div class="flex items-center justify-between border-b border-brand-gold/15 pb-4 mb-4 lg:hidden">
          <h3 class="font-serif text-lg font-bold text-brand-burgundy">Filters</h3>
          <button id="mobile-filter-close" class="text-brand-charcoal hover:text-brand-gold">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div class="space-y-6">
          
          <!-- Filter: Dynamic Categories & Sub-Categories -->
          <div>
            <h4 class="font-serif text-sm font-bold text-brand-burgundy uppercase tracking-wider mb-3">Categories</h4>
            <div id="sidebar-categories-tree" class="space-y-3 text-sm text-brand-charcoal/95">
              <!-- Dynamically populated via JS -->
            </div>
          </div>

          <hr class="border-brand-gold/10">

          <!-- Filter: Price Range -->
          <div>
            <h4 class="font-serif text-sm font-bold text-brand-burgundy uppercase tracking-wider mb-3">Price Range</h4>
            <div class="space-y-2.5 text-sm text-brand-charcoal/95">
              <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="priceRange" value="under-2000" class="custom-checkbox h-4 w-4 mr-2.5">
                <span>Under ₹2,000</span>
              </label>
              <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="priceRange" value="2000-5000" class="custom-checkbox h-4 w-4 mr-2.5">
                <span>₹2,000 - ₹5,000</span>
              </label>
              <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="priceRange" value="above-5000" class="custom-checkbox h-4 w-4 mr-2.5">
                <span>Above ₹5,000</span>
              </label>
            </div>
          </div>

          <!-- Reset Button -->
          <div class="pt-4">
            <button onclick="resetFilters()" class="w-full text-center text-xs font-semibold uppercase tracking-wider text-brand-burgundy hover:text-brand-gold py-2 border border-brand-gold/45 hover:border-brand-burgundy transition duration-300">
              Clear All Filters
            </button>
          </div>

        </div>
      </aside>

      <!-- Right Side: Product Grid & Sorting header -->
      <section id="catalog-top" class="flex-grow flex flex-col min-h-[500px]">
        
        <!-- Sorting and Count Header -->
        <div class="flex items-center justify-between pb-6 border-b border-brand-gold/15 mb-6">
          <div class="hidden lg:block text-sm font-medium text-brand-charcoal">
            Showing <span id="desktop-product-count" class="font-bold text-brand-burgundy">0</span> beautiful pieces
          </div>
          
          <div class="flex items-center space-x-2.5 ml-auto w-full lg:w-auto justify-between lg:justify-end">
            <label for="sort-select" class="text-xs uppercase tracking-wider font-semibold text-gray-500 whitespace-nowrap">Sort By:</label>
            <select id="sort-select" onchange="handleSortChange(this.value)" class="bg-white text-xs border border-brand-gold/20 text-brand-charcoal focus:outline-none focus:border-brand-burgundy px-3.5 py-2 rounded">
              <option value="price-low-high">Price: Low to High</option>
              <option value="price-high-low">Price: High to Low</option>
              <option value="discount">Highest Discount</option>
            </select>
          </div>
        </div>

        <!-- Filter Tags bar (shows active filters) -->
        <div id="active-filter-tags" class="flex flex-wrap gap-2 mb-6">
          <!-- Dynamically populated via JS -->
        </div>

        <!-- Kurtas Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-2.5 sm:gap-6" id="kurtas-listing-grid">
          <!-- Populated Dynamically via JS -->
        </div>

        <!-- Empty State (fallback if no products match) -->
        <div id="empty-state" class="hidden text-center py-16 bg-white border border-brand-gold/15 p-8">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-brand-cream text-brand-gold mb-4">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
          </div>
          <h3 class="font-serif text-xl font-bold text-brand-burgundy mb-2">No Matching Products Found</h3>
          <p class="text-xs text-gray-500 max-w-sm mx-auto mb-6">We could not find any products matching your selected filters. Try clearing some filters to explore our collection.</p>
          <button onclick="resetFilters()" class="inline-block bg-brand-burgundy hover:bg-brand-burgundy/90 text-white font-bold py-2.5 px-6 rounded-md text-xs uppercase tracking-widest transition duration-300">
            Clear All Filters
          </button>
        </div>

      </section>

    </div>
  </main>

  <!-- Global Dynamic Footer -->
  <footer id="global-footer" class="w-full"></footer>

  <!-- Javascript Modules -->
  <script src="js/products.js"></script>
  <script src="js/components.js"></script>
  <script src="js/main.js"></script>

  <!-- Catalog and Filter Interactivity script -->
  <script>
    // State management for Catalog Filters
    let activeFilters = {
      categories: ['kurtas'],
      subcategories: [],
      priceRange: [],
      searchQuery: ""
    };
    
    let currentSort = "price-low-high";

    function initCatalog() {
      try { initializeQueryParameters(); } catch(e) { console.warn(e); }
      try { renderSidebarCategoryTree(); } catch(e) { console.warn(e); }
      try { setupPriceCheckboxListeners(); } catch(e) { console.warn(e); }
      try { setupMobileSidebar(); } catch(e) { console.warn(e); }
      try { renderCatalog(false); } catch(e) { console.warn(e); }
    }

    document.addEventListener("DOMContentLoaded", initCatalog);
    document.addEventListener("ragaProductsLoaded", initCatalog);
    window.addEventListener("ragaProductsLoaded", initCatalog);

    // If products are already in memory, run immediately
    if (typeof ProductsDB !== "undefined" && ProductsDB.getAll().length > 0) {
      initCatalog();
    }

    // 1. Process URL search/filter parameters on load
    function initializeQueryParameters() {
      const params = new URLSearchParams(window.location.search);
      const categories = (typeof ProductsDB !== "undefined" && ProductsDB.getCategories()) ? ProductsDB.getCategories() : [];
      
      // Active Category: From URL ?category=... or default 'kurtas'
      const urlCat = params.get("category");
      let activeCatId = 'kurtas';
      if (urlCat && urlCat.trim() !== '') {
        activeCatId = urlCat.toLowerCase().trim();
      }
      activeFilters.categories = [activeCatId];

      // Subcategory filter parameter
      const subcatParam = params.get("subcategory");
      if (subcatParam) {
        const cleanSub = subcatParam.trim();
        if (!activeFilters.subcategories.includes(cleanSub)) {
          activeFilters.subcategories.push(cleanSub);
        }
      }

      // Price Range filter parameter e.g. ?priceRange=under-2000
      const priceRangeParam = params.get("priceRange");
      if (priceRangeParam) {
        if (!activeFilters.priceRange.includes(priceRangeParam)) {
          activeFilters.priceRange.push(priceRangeParam);
        }
        const checkbox = document.querySelector(`input[name="priceRange"][value="${priceRangeParam}"]`);
        if (checkbox) checkbox.checked = true;
      }

      // Sort parameter
      const sortParam = params.get("sort");
      if (sortParam) {
        currentSort = sortParam;
        const select = document.getElementById("sort-select");
        if (select) select.value = sortParam;
      }

      // Search parameter e.g. ?search=Kanjivaram
      const searchParam = params.get("search");
      if (searchParam) {
        activeFilters.searchQuery = searchParam;
        setTimeout(() => {
          const deskSearch = document.getElementById("desktop-search-input");
          const mobSearch = document.getElementById("mobile-search-input");
          if (deskSearch) deskSearch.value = searchParam;
          if (mobSearch) mobSearch.value = searchParam;
        }, 500);
      }
    }

    function getSubcategoriesForCategory(cat, allProducts) {
      if (!cat) return [];
      const list = [];
      
      // 1. From cat.groups
      if (Array.isArray(cat.groups)) {
        cat.groups.forEach(g => {
          if (!g) return;
          if (typeof g === 'string') {
            list.push(g.trim());
          } else if (typeof g === 'object') {
            if (Array.isArray(g.items)) {
              g.items.forEach(item => { if (item) list.push(String(item).trim()); });
            } else if (g.name) {
              list.push(String(g.name).trim());
            }
          }
        });
      }
      
      // 2. From products tagged with this category and subcategory
      if (Array.isArray(allProducts)) {
        const catId = String(cat.id || '').toLowerCase().trim();
        const catName = String(cat.name || '').toLowerCase().trim();
        allProducts.forEach(p => {
          const pCat = String(p.category || '').toLowerCase().trim();
          if (pCat === catId || pCat === catName) {
            if (p.subcategory && String(p.subcategory).trim() !== '') {
              list.push(String(p.subcategory).trim());
            }
          }
        });
      }
      
      return Array.from(new Set(list)).filter(Boolean);
    }

    // 2. Render dynamic category and sub-category sidebar tree (Show ONLY active category)
    function renderSidebarCategoryTree() {
      const treeContainer = document.getElementById("sidebar-categories-tree");
      if (!treeContainer || typeof ProductsDB === "undefined") return;

      const categories = ProductsDB.getCategories() || [];
      const allProducts = ProductsDB.getAll() || [];

      if (categories.length === 0 && allProducts.length === 0) {
        treeContainer.innerHTML = '<div class="text-xs text-gray-400 py-1">Loading category…</div>';
        return;
      }

      // Identify currently active category ID
      const activeCatId = (activeFilters.categories && activeFilters.categories.length > 0)
        ? String(activeFilters.categories[0]).toLowerCase().trim()
        : 'kurtas';

      // Find matched category object
      let matchedCat = categories.find(c => String(c.id).toLowerCase().trim() === activeCatId);
      if (!matchedCat) {
        matchedCat = categories.find(c => String(c.name).toLowerCase().trim() === activeCatId);
      }
      if (!matchedCat) {
        matchedCat = {
          id: activeCatId,
          name: activeCatId.charAt(0).toUpperCase() + activeCatId.slice(1),
          groups: []
        };
      }

      const subcats = getSubcategoriesForCategory(matchedCat, allProducts);

      treeContainer.innerHTML = `
        <div class="category-tree-item border-b border-brand-gold/15 pb-2.5 last:border-0">
          <!-- Category Title Header (Only the active category) -->
          <div class="py-1">
            <span class="font-bold text-brand-burgundy text-xs uppercase tracking-wider select-none block">${matchedCat.name}</span>
          </div>

          <!-- Subcategories with Checkboxes -->
          ${subcats.length > 0 ? `
            <div id="subcat-list-${matchedCat.id}" class="pl-2 pt-1 pb-1 space-y-1.5 text-xs text-brand-charcoal/85">
              ${subcats.map(sub => {
                const isSubChecked = activeFilters.subcategories.some(s => s.toLowerCase().trim() === sub.toLowerCase().trim());
                return `
                  <label class="flex items-center cursor-pointer select-none hover:text-brand-burgundy py-0.5">
                    <input type="checkbox" name="subcategory" data-cat="${matchedCat.id}" value="${sub}" ${isSubChecked ? 'checked' : ''} class="custom-checkbox h-3.5 w-3.5 mr-2" onchange="toggleSubcategoryFilter('${matchedCat.id}', '${sub}', this.checked)">
                    <span class="capitalize">${sub}</span>
                  </label>
                `;
              }).join('')}
            </div>
          ` : `
            <div class="pl-2 pt-0.5 text-[11px] text-gray-400 italic">No sub-categories</div>
          `}
        </div>
      `;
    }

    function toggleSubcategoryFilter(catId, subName, checked) {
      const target = String(subName).trim();
      if (checked) {
        if (!activeFilters.subcategories.some(s => s.toLowerCase().trim() === target.toLowerCase())) {
          activeFilters.subcategories.push(target);
        }
      } else {
        activeFilters.subcategories = activeFilters.subcategories.filter(s => s.toLowerCase().trim() !== target.toLowerCase());
      }
      renderCatalog(true);
    }

    // 3. Set up event listeners for price range checkboxes
    function setupPriceCheckboxListeners() {
      document.querySelectorAll('#filter-sidebar input[name="priceRange"]').forEach(box => {
        box.addEventListener("change", (e) => {
          const value = e.target.value;
          if (e.target.checked) {
            if (!activeFilters.priceRange.includes(value)) activeFilters.priceRange.push(value);
          } else {
            activeFilters.priceRange = activeFilters.priceRange.filter(v => v !== value);
          }
          renderCatalog(true);
        });
      });
    }

    // 4. Render Catalog matching filters and sorts
    function renderCatalog(shouldScroll = false) {
      const grid = document.getElementById("kurtas-listing-grid");
      const emptyState = document.getElementById("empty-state");
      
      if (!grid || typeof ProductsDB === "undefined") return;

      const allProducts = ProductsDB.getAll();
      
      // Apply filters
      const filtered = ProductsDB.filterProducts(allProducts, activeFilters);
      
      // Apply sorting
      const sorted = ProductsDB.sortProducts(filtered, currentSort);

      // Update counters
      const count = sorted.length;
      const countEl = document.getElementById("desktop-product-count");
      if (countEl) countEl.textContent = count;
      const mobCount = document.getElementById("mobile-product-count");
      if (mobCount) mobCount.textContent = `${count} Products`;

      // Render items
      if (count === 0) {
        grid.classList.add("hidden");
        emptyState.classList.remove("hidden");
      } else {
        emptyState.classList.add("hidden");
        grid.classList.remove("hidden");
        
        let html = "";
        sorted.forEach(product => {
          html += createCatalogCardHTML(product);
        });
        
        grid.innerHTML = html;
        document.dispatchEvent(new CustomEvent("wishlistButtonsSync"));
      }

      renderFilterTags();

      // Smoothly bring first product into view if user changed filter while scrolled down
      if (shouldScroll) {
        const topSection = document.getElementById("catalog-top");
        if (topSection && window.scrollY > topSection.offsetTop) {
          window.scrollTo({
            top: Math.max(0, topSection.offsetTop - 80),
            behavior: "smooth"
          });
        }
      }
    }

    // 5. Handle Sorting Selection Changes
    function handleSortChange(val) {
      currentSort = val;
      renderCatalog(false);
    }

    // 6. Reset/Clear all filters
    function resetFilters() {
      document.querySelectorAll('#filter-sidebar input[type="checkbox"]').forEach(box => {
        box.checked = false;
      });

      const deskSearch = document.getElementById("desktop-search-input");
      const mobSearch = document.getElementById("mobile-search-input");
      if (deskSearch) deskSearch.value = "";
      if (mobSearch) mobSearch.value = "";

      const currentCat = (activeFilters.categories && activeFilters.categories.length > 0) ? activeFilters.categories[0] : 'kurtas';

      activeFilters = {
        categories: [currentCat],
        subcategories: [],
        priceRange: [],
        searchQuery: ""
      };

      renderCatalog(true);
    }

    // 7. Draw active filter tags at the top (Only subcategories, price range, search query)
    function renderFilterTags() {
      const tagsContainer = document.getElementById("active-filter-tags");
      if (!tagsContainer) return;

      let html = "";

      // Subcategory tags
      activeFilters.subcategories.forEach(sub => {
        html += createTagHTML("subcategories", sub, `${sub}`);
      });

      // Price range tags
      activeFilters.priceRange.forEach(val => {
        const label = val === "under-2000" ? "Under ₹2,000" : val === "2000-5000" ? "₹2,000-₹5,000" : "Above ₹5,000";
        html += createTagHTML("priceRange", val, label);
      });

      // Search term tag
      if (activeFilters.searchQuery && activeFilters.searchQuery.trim() !== "") {
        html += createTagHTML("searchQuery", activeFilters.searchQuery, `Search: "${activeFilters.searchQuery}"`);
      }

      tagsContainer.innerHTML = html;
    }

    function createTagHTML(filterKey, value, displayLabel = "") {
      const label = displayLabel || value;
      return `
        <span class="inline-flex items-center bg-brand-burgundy/10 text-brand-burgundy border border-brand-gold/30 text-xs px-2.5 py-1 rounded">
          <span>${label}</span>
          <button onclick="removeFilterTag('${filterKey}', '${value}')" class="ml-1.5 font-bold hover:text-brand-gold text-brand-burgundy focus:outline-none">×</button>
        </span>
      `;
    }

    // Remove single filter tag when 'x' clicked
    function removeFilterTag(key, val) {
      if (key === "searchQuery") {
        activeFilters.searchQuery = "";
        const deskSearch = document.getElementById("desktop-search-input");
        const mobSearch = document.getElementById("mobile-search-input");
        if (deskSearch) deskSearch.value = "";
        if (mobSearch) mobSearch.value = "";
      } else if (key === "subcategories") {
        activeFilters.subcategories = activeFilters.subcategories.filter(s => s.toLowerCase().trim() !== String(val).toLowerCase().trim());
        const checkbox = document.querySelector(`input[name="subcategory"][value="${val}"]`) || document.querySelector(`input[value="${val}"]`);
        if (checkbox) checkbox.checked = false;
      } else if (key === "priceRange") {
        activeFilters.priceRange = activeFilters.priceRange.filter(v => v !== val);
        const checkbox = document.querySelector(`input[name="priceRange"][value="${val}"]`);
        if (checkbox) checkbox.checked = false;
      }
      renderCatalog(true);
    }

    // 8. Mobile Filters slide-over menu toggle
    function setupMobileSidebar() {
      const openBtn = document.getElementById("mobile-filter-btn");
      const closeBtn = document.getElementById("mobile-filter-close");
      const sidebar = document.getElementById("filter-sidebar");

      const closeFilterDrawer = () => {
        if (sidebar) {
          sidebar.className = "hidden lg:block lg:w-64 bg-white p-6 border border-brand-gold/15 sticky top-28 max-h-[calc(100vh-8rem)] overflow-y-auto shadow-sm z-30 flex-shrink-0";
        }
        const overlay = document.getElementById("filter-overlay");
        if (overlay) overlay.remove();
      };

      if (openBtn && sidebar) {
        openBtn.addEventListener("click", () => {
          sidebar.classList.remove("hidden", "lg:block");
          sidebar.className = "fixed inset-y-0 left-0 w-72 bg-white p-6 shadow-2xl overflow-y-auto z-50 drawer-transition translate-x-0";
          
          let filterOverlay = document.getElementById("filter-overlay");
          if (!filterOverlay) {
            filterOverlay = document.createElement("div");
            filterOverlay.id = "filter-overlay";
            filterOverlay.className = "fixed inset-0 bg-brand-charcoal/50 z-40 transition-opacity duration-300";
            document.body.appendChild(filterOverlay);
            filterOverlay.addEventListener("click", closeFilterDrawer);
          }
        });
      }

      if (closeBtn) {
        closeBtn.addEventListener("click", closeFilterDrawer);
      }
    }

    // Card Template for Catalog Grid
    function createCatalogCardHTML(product) {
      const discountPercentage = product.discount > 0 
        ? `<span class="bg-green-700 text-white text-[9px] font-bold px-1.5 py-0.5 absolute top-2 left-2 z-10 uppercase tracking-widest">${product.discount}% OFF</span>` 
        : "";

      return `
        <div class="bg-white border border-brand-gold/10 group relative flex flex-col justify-between shadow-sm fade-in">
          <div class="relative h-80 overflow-hidden bg-brand-cream/10">
            ${discountPercentage}

            <!-- Product Images -->
            <div class="h-full w-full">
              <img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover zoom-image absolute inset-0">
            </div>
          </div>

          <!-- Info description -->
          <div class="p-2.5 sm:p-4 bg-white flex-grow flex flex-col justify-between border-t border-brand-gold/5">
            <div>
              <p class="text-[9px] sm:text-[10px] text-brand-gold uppercase tracking-widest font-semibold mb-1 truncate">${product.fabric} | ${product.weave}</p>
              <h3 class="font-serif text-xs sm:text-sm font-semibold text-brand-charcoal line-clamp-2 hover:text-brand-burgundy transition-colors duration-200 leading-tight">
                ${product.name}
              </h3>
            </div>
            
            <div class="flex items-center justify-between pt-2.5 sm:pt-3 mt-2.5 sm:mt-3 border-t border-brand-gold/10 gap-1.5 sm:gap-2">
              <div class="flex flex-col min-w-0">
                <span class="text-xs sm:text-base font-extrabold text-brand-burgundy whitespace-nowrap tracking-tight">₹ ${product.price.toLocaleString("en-IN")}</span>
                ${(product.originalPrice > 0 && product.originalPrice !== product.price) ? `
                  <span class="text-[9px] sm:text-xs text-gray-400 line-through whitespace-nowrap mt-0.5">₹ ${product.originalPrice.toLocaleString("en-IN")}</span>
                ` : ""}
              </div>
              <button onclick="addToCart('${product.id}', 1, true)" class="bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-[9px] sm:text-[11px] uppercase tracking-wider font-bold py-1.5 px-2.5 sm:px-3 rounded-sm shadow-xs transition duration-300 whitespace-nowrap flex-shrink-0 ml-auto">
                Add to Cart
              </button>
            </div>
          </div>
        </div>
      `;
    }
  </script>
</body>
</html>
