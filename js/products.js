let PRODUCTS = [];
let APP_CATEGORIES = [];
window.RAGA_PRODUCTS_READY = false;

const DEFAULT_STORE_CATEGORIES = [
  { id: 'sarees', name: 'Sarees', image: 'images/img-saree-red.jpg', icon: '🥻', groups: ['Silk', 'Banarasi', 'Kanjivaram', 'Organza', 'Linen', 'Tussar', 'Cotton', 'Chanderi', 'Tissue', 'Georgette'] },
  { id: 'kurtas', name: 'Kurtas & Suits', image: 'images/img-kurta-anarkali.jpg', icon: '👗', groups: ['Anarkali', 'Cotton', 'Chanderi', 'Georgette', 'Khadi', 'Straight Cut'] },
  { id: 'dress-materials', name: 'Dress Materials', image: 'images/img-saree-organza.jpg', icon: '🧵', groups: ['Pure Silk', 'Organic Cotton', 'Chanderi'] },
  { id: 'blouses', name: 'Blouses', image: 'images/img-saree-banarasi.jpg', icon: '✂️', groups: ['Embroidered', 'Silk', 'Sleeveless'] }
];

// ── Liked Products / Wishlist Manager ──
function getLikedProductIds() {
  try {
    const s = localStorage.getItem('raga_liked_products');
    if (s) {
      const parsed = JSON.parse(s);
      if (Array.isArray(parsed)) return parsed;
    }
  } catch(e) {}
  return [];
}

function isProductLiked(id) {
  const list = getLikedProductIds();
  return list.includes(String(id).trim());
}

function toggleProductLike(id, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }
  const cleanId = String(id).trim();
  let list = getLikedProductIds();
  const isLiked = list.includes(cleanId);
  
  if (isLiked) {
    list = list.filter(item => item !== cleanId);
  } else {
    list.push(cleanId);
  }
  
  try {
    localStorage.setItem('raga_liked_products', JSON.stringify(list));
  } catch(e) {}
  
  // Sync all heart buttons on current page
  syncAllHeartButtons();
  
  // Notify listeners (e.g. New Arrivals section)
  document.dispatchEvent(new CustomEvent('ragaLikesUpdated', { detail: { likedIds: list } }));
  window.dispatchEvent(new CustomEvent('ragaLikesUpdated', { detail: { likedIds: list } }));
  
  return !isLiked;
}

function syncAllHeartButtons() {
  const likedList = getLikedProductIds();
  document.querySelectorAll('[data-like-btn]').forEach(btn => {
    const prodId = btn.getAttribute('data-like-btn');
    const isLiked = likedList.includes(String(prodId).trim());
    const icon = btn.querySelector('.heart-icon');
    if (isLiked) {
      btn.classList.add('liked');
      btn.setAttribute('title', 'Remove from New Arrivals');
      if (icon) {
        icon.setAttribute('fill', '#e11d48');
        icon.setAttribute('stroke', '#e11d48');
        icon.classList.add('text-[#e11d48]', 'scale-110');
        icon.classList.remove('text-brand-burgundy');
      }
    } else {
      btn.classList.remove('liked');
      btn.setAttribute('title', 'Add to New Arrivals');
      if (icon) {
        icon.setAttribute('fill', 'none');
        icon.setAttribute('stroke', 'currentColor');
        icon.classList.remove('text-[#e11d48]', 'scale-110');
        icon.classList.add('text-brand-burgundy');
      }
    }
  });
}

function createHeartButtonHTML(productId) {
  const liked = isProductLiked(productId);
  return `
    <button type="button" 
      data-like-btn="${productId}" 
      onclick="toggleProductLike('${productId}', event)" 
      class="like-btn absolute top-2.5 right-2.5 z-20 w-8 h-8 rounded-full bg-white/90 backdrop-blur-sm shadow-md flex items-center justify-center transition-all duration-300 hover:scale-110 hover:bg-white ${liked ? 'liked' : ''}" 
      title="${liked ? 'Remove from New Arrivals' : 'Add to New Arrivals'}"
      aria-label="Like product">
      <svg class="heart-icon w-4 h-4 transition-all duration-200 ${liked ? 'text-[#e11d48] scale-110' : 'text-brand-burgundy'}" 
        fill="${liked ? '#e11d48' : 'none'}" 
        stroke="${liked ? '#e11d48' : 'currentColor'}" 
        stroke-width="2" 
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
      </svg>
    </button>
  `;
}

// Helper functions for E-commerce State and filtering
function getActiveProducts() {
  if (Array.isArray(PRODUCTS) && PRODUCTS.length > 0) return PRODUCTS;
  try {
    const s = localStorage.getItem('raga_admin_products_v2') || localStorage.getItem('raga_products');
    if (s) {
      const parsed = JSON.parse(s);
      if (Array.isArray(parsed) && parsed.length > 0) return parsed;
    }
  } catch(e) {}
  return [];
}

function getActiveCategories() {
  if (Array.isArray(APP_CATEGORIES) && APP_CATEGORIES.length > 0) return APP_CATEGORIES;
  try {
    const s = localStorage.getItem('raga_admin_categories_v2') || localStorage.getItem('raga_categories');
    if (s) {
      const parsed = JSON.parse(s);
      if (Array.isArray(parsed) && parsed.length > 0) return parsed;
    }
  } catch(e) {}
  return DEFAULT_STORE_CATEGORIES;
}

const ProductsDB = {
  getAll: () => getActiveProducts(),
  
  getById: (id) => getActiveProducts().find(p => String(p.id).trim() === String(id).trim()),
  
  getByCategory: (category) => getActiveProducts().filter(p => String(p.category || '').toLowerCase().trim() === String(category || '').toLowerCase().trim()),
  
  getCategories: () => getActiveCategories(),

  getLikedProducts: () => {
    const likedIds = getLikedProductIds();
    const all = getActiveProducts();
    const liked = all.filter(p => p.is_liked === true || likedIds.includes(String(p.id).trim()));
    if (liked.length > 0) return liked;
    return all.slice(0, 8);
  },

  getLiked: function() {
    return this.getLikedProducts();
  },

  getCustomerFavourites: (orders) => {
    const all = getActiveProducts();
    if (!all || all.length === 0) return [];

    let ordersList = orders;
    if (!ordersList || !Array.isArray(ordersList)) {
      try {
        ordersList = JSON.parse(localStorage.getItem('raga_orders') || '[]');
      } catch(e) {}
    }

    const favList = [];
    const addedIds = new Set();

    if (Array.isArray(ordersList) && ordersList.length > 0) {
      ordersList.slice(0, 4).forEach(order => {
        if (favList.length >= 4) return;
        
        // 1. Match by product_ids array
        if (Array.isArray(order.product_ids) && order.product_ids.length > 0) {
          order.product_ids.forEach(pId => {
            if (favList.length < 4 && !addedIds.has(String(pId).trim())) {
              const matched = all.find(p => String(p.id).trim() === String(pId).trim());
              if (matched) {
                favList.push(matched);
                addedIds.add(String(pId).trim());
              }
            }
          });
        }
        
        // 2. Match by product_name
        if (favList.length < 4 && order.product_name) {
          const matched = all.find(p => !addedIds.has(String(p.id).trim()) && (order.product_name.toLowerCase().includes(p.name.toLowerCase()) || p.name.toLowerCase().includes(order.product_name.toLowerCase())));
          if (matched) {
            favList.push(matched);
            addedIds.add(String(matched.id).trim());
          }
        }
      });
    }

    // Fallback: If fewer than 4 favourites matched from orders, backfill with top/popular products from all
    if (favList.length < 4) {
      all.forEach(p => {
        if (favList.length < 4 && !addedIds.has(String(p.id).trim())) {
          favList.push(p);
          addedIds.add(String(p.id).trim());
        }
      });
    }

    return favList;
  },
  
  filterProducts: (products, filters) => {
    if (!Array.isArray(products)) return [];
    if (!filters) return products;

    return products.filter(product => {
      // Filter by Category
      if (filters.categories && filters.categories.length > 0) {
        const prodCat = String(product.category || '').toLowerCase().trim();
        const matchesCategory = filters.categories.some(c => String(c || '').toLowerCase().trim() === prodCat);
        if (!matchesCategory) return false;
      }

      // Filter by Sub-Category
      if (filters.subcategories && filters.subcategories.length > 0) {
        const prodSub = String(product.subcategory || '').toLowerCase().trim();
        const prodFabric = String(product.fabric || '').toLowerCase().trim();
        const prodWeave = String(product.weave || '').toLowerCase().trim();
        const prodName = String(product.name || '').toLowerCase().trim();

        const matchesSubcat = filters.subcategories.some(s => {
          const target = String(s || '').toLowerCase().trim();
          return prodSub === target || prodFabric === target || prodWeave === target || prodName.includes(target);
        });
        if (!matchesSubcat) return false;
      }

      // Legacy fallback filters if used
      if (filters.fabric && filters.fabric.length > 0) {
        if (!filters.fabric.includes(product.fabric)) return false;
      }
      if (filters.weave && filters.weave.length > 0) {
        if (!filters.weave.includes(product.weave)) return false;
      }
      if (filters.color && filters.color.length > 0) {
        if (!filters.color.includes(product.color)) return false;
      }
      
      // Filter by Price Range
      if (filters.priceRange && filters.priceRange.length > 0) {
        let matchesPrice = false;
        filters.priceRange.forEach(range => {
          if (range === "under-2000" && product.price < 2000) matchesPrice = true;
          if (range === "2000-5000" && product.price >= 2000 && product.price <= 5000) matchesPrice = true;
          if (range === "above-5000" && product.price > 5000) matchesPrice = true;
        });
        if (!matchesPrice) return false;
      }
      
      // Filter by Search Query
      if (filters.searchQuery && filters.searchQuery.trim() !== "") {
        const query = filters.searchQuery.toLowerCase();
        const matchesName = (product.name||'').toLowerCase().includes(query);
        const matchesDesc = (product.description||'').toLowerCase().includes(query);
        const matchesCat = (product.category||'').toLowerCase().includes(query);
        const matchesSub = (product.subcategory||'').toLowerCase().includes(query);
        if (!matchesName && !matchesDesc && !matchesCat && !matchesSub) return false;
      }
      
      return true;
    });
  },
  
  sortProducts: (products, sortType) => {
    if (!Array.isArray(products)) return [];
    const list = [...products];
    switch (sortType) {
      case "price-low-high":
        return list.sort((a, b) => a.price - b.price);
      case "price-high-low":
        return list.sort((a, b) => b.price - a.price);
      case "discount":
        return list.sort((a, b) => (b.discount || 0) - (a.discount || 0));
      default:
        return list.sort((a, b) => a.price - b.price);
    }
  }
};

// Async initialization from PHP Backend & Database
async function initAppProducts() {
  try {
    const [prodRes, catRes] = await Promise.all([
      fetch('api/get_products.php?t=' + Date.now()),
      fetch('api/get_categories.php?t=' + Date.now())
    ]);

    if (prodRes.ok) {
      const dbProds = await prodRes.json();
      if (Array.isArray(dbProds)) {
        PRODUCTS = dbProds;
        try { localStorage.setItem('raga_admin_products_v2', JSON.stringify(dbProds)); } catch(e){}
      }
    }
    if (catRes.ok) {
      const dbCats = await catRes.json();
      if (Array.isArray(dbCats)) {
        APP_CATEGORIES = dbCats;
        try { localStorage.setItem('raga_admin_categories_v2', JSON.stringify(dbCats)); } catch(e){}
      }
    }
  } catch(e) {
    console.warn("Notice: Error fetching products/categories from API, using cached data:", e);
  } finally {
    window.RAGA_PRODUCTS_READY = true;
    
    // Dispatch events to document & window
    document.dispatchEvent(new CustomEvent("ragaProductsLoaded", { detail: { products: PRODUCTS, categories: APP_CATEGORIES } }));
    window.dispatchEvent(new CustomEvent("ragaProductsLoaded", { detail: { products: PRODUCTS, categories: APP_CATEGORIES } }));
    
    // Sync heart buttons
    syncAllHeartButtons();

    // If catalog callback is present, execute immediately
    if (typeof window.initCatalog === "function") {
      try { window.initCatalog(); } catch(e) { console.warn(e); }
    }
  }
}

initAppProducts();
