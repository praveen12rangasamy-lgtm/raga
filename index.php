<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Raga Boutique — Woven in Heritage, Worn in Grace</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="images/raga_favicon.png">
  <!-- SEO Meta Tags -->
  <meta name="description"
    content="Discover premium handcrafted Indian sarees, Kurtas, and traditional ethnic wear at Raga Boutique. Backed by the legacy of authentic weaves and premium handlooms.">

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

<body class="bg-brand-cream text-brand-charcoal min-h-screen flex flex-col selection:bg-brand-gold selection:text-brand-burgundy">

  <!-- Global Dynamic Header -->
  <header id="global-header" class="w-full bg-white z-40"></header>

  <!-- Main Content -->
  <main class="flex-grow">

    <!-- Hero Banner Slider -->
    <section class="relative bg-brand-charcoal overflow-hidden h-[400px] sm:h-[500px] lg:h-[600px] group">
      <div id="hero-slider" class="relative w-full h-full">

        <!-- Slide 1 -->
        <div class="hero-slide absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out">
          <img src="images/yazhagam_hero_yellow.png" alt="Royal Yellow Banarasi Silk"
            class="w-full h-full object-cover object-center scale-100 transition-transform duration-[8000ms]">
          <div class="absolute inset-0 bg-gradient-to-r from-brand-burgundy/60 via-transparent to-brand-charcoal/20">
          </div>
          <div class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
              <div class="max-w-lg text-white space-y-4">
                <span class="text-xs uppercase tracking-[0.3em] text-brand-gold font-semibold block fade-in">The
                  Banarasi Jaal Edit</span>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight fade-in">Golden Aura</h1>
                <p class="text-sm sm:text-base text-white/90 font-light max-w-sm fade-in">Indulge in royal handwoven
                  silks adorned with dual-tone shimmers and gold borders, hand-loomed by master artisans.</p>
                <div class="pt-4 fade-in">
                  <a href="#collections"
                    class="inline-block bg-brand-gold hover:bg-brand-goldDark text-brand-burgundy text-xs uppercase tracking-widest font-bold py-3.5 px-8 border-b-2 border-brand-burgundy transition-all duration-300">
                    Explore Collection
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
          <img src="images/yazhagam_hero_peach.png" alt="Pastel Peach Tissue Silk"
            class="w-full h-full object-cover object-center scale-100 transition-transform duration-[8000ms]">
          <div class="absolute inset-0 bg-gradient-to-r from-brand-burgundy/50 via-transparent to-brand-charcoal/30">
          </div>
          <div class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
              <div class="max-w-lg text-white space-y-4">
                <span class="text-xs uppercase tracking-[0.3em] text-brand-gold font-semibold block">Summer Solstice
                  2026</span>
                <h2 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">Shimmering Tissue</h2>
                <p class="text-sm sm:text-base text-white/90 font-light max-w-sm">Celebrate elegance with soft peach
                  tissue silk sarees, detailed with delicate scalloped borders.</p>
                <div class="pt-4">
                  <a href="sarees.php?fabric=Silk"
                    class="inline-block bg-brand-gold hover:bg-brand-goldDark text-brand-burgundy text-xs uppercase tracking-widest font-bold py-3.5 px-8 border-b-2 border-brand-burgundy transition-all duration-300">
                    Discover Tissue Silk
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slider Controls -->
      <button onclick="prevSlide()"
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white text-white hover:text-brand-burgundy p-2.5 transition duration-300 rounded-full border border-white/30 hidden group-hover:block"
        aria-label="Previous Slide">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button onclick="nextSlide()"
        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white text-white hover:text-brand-burgundy p-2.5 transition duration-300 rounded-full border border-white/30 hidden group-hover:block"
        aria-label="Next Slide">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>

      <!-- Slideshow Dots (Circle SVGs) -->
      <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-2.5 z-30">
        <button onclick="setSlide(0)"
          class="hero-dot text-brand-gold transition-all duration-300 transform hover:scale-110 active:scale-95"
          aria-label="Slide 1">
          <svg class="h-3 w-3 fill-current" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
          </svg>
        </button>
        <button onclick="setSlide(1)"
          class="hero-dot text-white/50 transition-all duration-300 transform hover:scale-110 active:scale-95"
          aria-label="Slide 2">
          <svg class="h-3 w-3 fill-current" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
          </svg>
        </button>
      </div>
    </section>

    <!-- ── NEW ARRIVALS PRODUCT CAROUSEL SECTION ── -->
    <section id="new-arrivals" class="bg-white border-b border-brand-gold/15 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="flex items-end justify-between mb-8 sm:mb-10">
          <div>
            <span class="text-[10px] sm:text-xs uppercase tracking-[0.25em] text-brand-gold font-bold mb-1 block">Newly Unveiled Weaves</span>
            <h2 class="font-serif text-2xl sm:text-4xl font-bold text-brand-burgundy">New Arrivals</h2>
          </div>
          <a href="sarees.php"
            class="text-xs sm:text-sm font-semibold text-brand-burgundy hover:text-brand-gold flex items-center whitespace-nowrap transition duration-200 ml-2">
            <span>View All Products</span>
            <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4 ml-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </a>
        </div>

        <!-- Product Cards Grid/Carousel Container -->
        <div class="relative overflow-x-auto no-scrollbar pb-6 flex space-x-4 sm:space-x-6 snap-x snap-mandatory" id="new-arrivals-carousel">
          <!-- Populated Dynamically via products.js -->
        </div>

      </div>
    </section>

    <!-- Shop The Look Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="text-center mb-10">
        <span class="text-xs uppercase tracking-[0.25em] text-brand-gold font-bold mb-1.5 block">Visual Drapes</span>
        <h2 class="font-serif text-3xl font-bold text-brand-burgundy uppercase tracking-wider">Shop The Look</h2>
        <div class="h-0.5 w-16 bg-brand-gold mx-auto mt-4"></div>
      </div>

      <!-- Grid of 4 vertical cards (Unique Looks) -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">

        <!-- Card 1 (saree-01) -->
        <div
          class="relative group cursor-pointer overflow-hidden border border-brand-gold/15 shadow-sm rounded-lg stl-card"
          onclick="openShopTheLook('saree-01', 'videos/look-2.mp4')" onmouseenter="playHoverVideo(this)"
          onmouseleave="pauseHoverVideo(this)">
          <div class="aspect-[2/3] overflow-hidden bg-brand-cream/10 relative">
            <img src="images/img-saree-red.jpg" alt="Shop the Look 1"
              class="w-full h-full object-cover zoom-image absolute inset-0 group-hover:opacity-0 transition-opacity duration-300">
            <video src="videos/look-2.mp4"
              class="w-full h-full object-cover absolute inset-0 opacity-0 group-hover:opacity-100 stl-video-zoom transition-opacity duration-300"
              loop muted playsinline preload="metadata"></video>
            <div
              class="absolute inset-0 flex items-center justify-center bg-black/10 group-hover:bg-black/25 transition duration-300 z-10">
              <div
                class="bg-white/95 text-brand-burgundy p-3 rounded-full shadow-lg transform group-hover:scale-110 transition duration-300 stl-play-btn">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>
              </div>
            </div>
            <div class="absolute bottom-3 left-3 bg-white p-0.5 rounded-full border border-brand-gold/25 shadow z-10">
              <img src="images/img-saree-red.jpg" alt="thumb" class="h-10 w-10 rounded-full object-cover">
            </div>
          </div>
        </div>

        <!-- Card 2 (saree-02) -->
        <div
          class="relative group cursor-pointer overflow-hidden border border-brand-gold/15 shadow-sm rounded-lg stl-card"
          onclick="openShopTheLook('saree-02', 'videos/look-3.mp4')" onmouseenter="playHoverVideo(this)"
          onmouseleave="pauseHoverVideo(this)">
          <div class="aspect-[2/3] overflow-hidden bg-brand-cream/10 relative">
            <img src="images/img-saree-gold.jpg" alt="Shop the Look 2"
              class="w-full h-full object-cover zoom-image absolute inset-0 group-hover:opacity-0 transition-opacity duration-300">
            <video src="videos/look-3.mp4"
              class="w-full h-full object-cover absolute inset-0 opacity-0 group-hover:opacity-100 stl-video-zoom transition-opacity duration-300"
              loop muted playsinline preload="metadata"></video>
            <div
              class="absolute inset-0 flex items-center justify-center bg-black/10 group-hover:bg-black/25 transition duration-300 z-10">
              <div
                class="bg-white/95 text-brand-burgundy p-3 rounded-full shadow-lg transform group-hover:scale-110 transition duration-300 stl-play-btn">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>
              </div>
            </div>
            <div class="absolute bottom-3 left-3 bg-white p-0.5 rounded-full border border-brand-gold/25 shadow z-10">
              <img src="images/img-saree-gold.jpg" alt="thumb" class="h-10 w-10 rounded-full object-cover">
            </div>
          </div>
        </div>

        <!-- Card 3 (saree-03) -->
        <div
          class="relative group cursor-pointer overflow-hidden border border-brand-gold/15 shadow-sm rounded-lg stl-card"
          onclick="openShopTheLook('saree-03', 'videos/look-4.mp4')" onmouseenter="playHoverVideo(this)"
          onmouseleave="pauseHoverVideo(this)">
          <div class="aspect-[2/3] overflow-hidden bg-brand-cream/10 relative">
            <img src="images/img-saree-organza.jpg" alt="Shop the Look 3"
              class="w-full h-full object-cover zoom-image absolute inset-0 group-hover:opacity-0 transition-opacity duration-300">
            <video src="videos/look-4.mp4"
              class="w-full h-full object-cover absolute inset-0 opacity-0 group-hover:opacity-100 stl-video-zoom transition-opacity duration-300"
              loop muted playsinline preload="metadata"></video>
            <div
              class="absolute inset-0 flex items-center justify-center bg-black/10 group-hover:bg-black/25 transition duration-300 z-10">
              <div
                class="bg-white/95 text-brand-burgundy p-3 rounded-full shadow-lg transform group-hover:scale-110 transition duration-300 stl-play-btn">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>
              </div>
            </div>
            <div class="absolute bottom-3 left-3 bg-white p-0.5 rounded-full border border-brand-gold/25 shadow z-10">
              <img src="images/img-saree-organza.jpg" alt="thumb" class="h-10 w-10 rounded-full object-cover">
            </div>
          </div>
        </div>

        <!-- Card 4 (saree-05) -->
        <div
          class="relative group cursor-pointer overflow-hidden border border-brand-gold/15 shadow-sm rounded-lg stl-card"
          onclick="openShopTheLook('saree-05', 'videos/look-5.mp4')" onmouseenter="playHoverVideo(this)"
          onmouseleave="pauseHoverVideo(this)">
          <div class="aspect-[2/3] overflow-hidden bg-brand-cream/10 relative">
            <img src="images/img-saree-tussar.jpg" alt="Shop the Look 4"
              class="w-full h-full object-cover zoom-image absolute inset-0 group-hover:opacity-0 transition-opacity duration-300">
            <video src="videos/look-5.mp4"
              class="w-full h-full object-cover absolute inset-0 opacity-0 group-hover:opacity-100 stl-video-zoom transition-opacity duration-300"
              loop muted playsinline preload="metadata"></video>
            <div
              class="absolute inset-0 flex items-center justify-center bg-black/10 group-hover:bg-black/25 transition duration-300 z-10">
              <div
                class="bg-white/95 text-brand-burgundy p-3 rounded-full shadow-lg transform group-hover:scale-110 transition duration-300 stl-play-btn">
                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>
              </div>
            </div>
            <div class="absolute bottom-3 left-3 bg-white p-0.5 rounded-full border border-brand-gold/25 shadow z-10">
              <img src="images/img-saree-tussar.jpg" alt="thumb" class="h-10 w-10 rounded-full object-cover">
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- ── ABOUT US / HERITAGE SECTION ── -->
    <section id="about" class="relative py-20 bg-brand-cream border-t border-b border-brand-gold/20 overflow-hidden">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Side Heading -->
        <div class="mb-10">
          <span class="text-xs uppercase tracking-[0.25em] text-brand-gold font-bold mb-1.5 block">Our Story & Heritage</span>
          <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-burgundy">About Us</h2>
        </div>

        <!-- Header Banner with Rich Purple Gradient -->
        <div class="bg-gradient-to-r from-[#4a1236] via-brand-burgundy to-[#3b0e2b] text-white p-8 sm:p-12 rounded-xl shadow-2xl mb-16 border border-brand-gold/30 relative overflow-hidden">
          <div class="relative z-10 max-w-3xl">
            <span class="text-xs uppercase tracking-[0.3em] text-brand-gold font-bold mb-2 block">Our Heritage & Craftsmanship</span>
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight mb-4">Woven in Heritage,<br>Worn in Grace.</h2>
            <div class="h-0.5 w-20 bg-brand-gold mb-6"></div>
            <p class="text-sm sm:text-base text-white/90 font-light leading-relaxed">
              At Raga Boutique, we celebrate the eternal elegance of Indian handlooms. Each drape tells a story of centuries-old craftsmanship, brought to life for the modern connoisseur.
            </p>
          </div>
          <!-- Decorative stamp watermark -->
          <div class="absolute -bottom-8 -right-8 w-52 h-52 opacity-10 text-brand-gold border-8 border-current rounded-full flex items-center justify-center font-serif text-4xl font-bold pointer-events-none select-none">
            RAGA
          </div>
        </div>

        <!-- Story & Pillars Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
          <div class="relative group">
            <div class="absolute -inset-3 bg-brand-burgundy/10 rounded-xl transform rotate-1 transition duration-500 group-hover:rotate-0"></div>
            <div class="relative h-[420px] sm:h-[500px] rounded-lg overflow-hidden border border-brand-gold/20 shadow-md">
              <img src="images/img-saree-tussar.jpg" alt="Weaving Loom Artistry" class="w-full h-full object-cover">
              <div class="absolute bottom-6 left-6 right-6 bg-brand-burgundy/95 backdrop-blur-sm text-white p-5 border-l-4 border-brand-gold shadow-lg rounded-sm">
                <span class="text-brand-gold text-[10px] uppercase tracking-widest font-bold block mb-1">Authenticity Guaranteed</span>
                <p class="text-xs text-white/90 leading-relaxed font-light">Every silk saree in our boutique is Silk Mark Certified for 100% pure Mulberry silk.</p>
              </div>
            </div>
          </div>

          <div class="space-y-6">
            <span class="text-xs uppercase tracking-[0.25em] text-brand-gold font-bold block">Preserving Ancient Looms</span>
            <h3 class="font-serif text-3xl sm:text-4xl font-bold text-brand-burgundy leading-tight">A Legacy of Threads & Master Artisans</h3>
            <p class="text-sm text-brand-charcoal/80 leading-relaxed">
              Founded with a passion for preserving the rich textile heritage of India, Raga Boutique travels across the country to bring you the finest, most authentic weaves. From the royal looms of Kanchipuram to the delicate artistry of Banaras, we curate collections that honor traditional weavers while appealing to contemporary aesthetics.
            </p>
            <p class="text-sm text-brand-charcoal/80 leading-relaxed">
              We believe that a saree is not just a garment; it is an heirloom. It represents patience, artistry, and the soul of the artisan who spent weeks meticulously bringing a vision to life.
            </p>

            <!-- Key Stats -->
            <div class="grid grid-cols-3 gap-4 border-t border-brand-gold/20 pt-6">
              <div class="bg-white p-4 rounded-lg border border-brand-gold/20 text-center shadow-sm">
                <h4 class="font-serif text-2xl font-bold text-brand-burgundy">100%</h4>
                <p class="text-[10px] uppercase tracking-wider text-brand-charcoal/70 font-semibold mt-1">Authentic Handloom</p>
              </div>
              <div class="bg-white p-4 rounded-lg border border-brand-gold/20 text-center shadow-sm">
                <h4 class="font-serif text-2xl font-bold text-brand-burgundy">50+</h4>
                <p class="text-[10px] uppercase tracking-wider text-brand-charcoal/70 font-semibold mt-1">Weaving Clusters</p>
              </div>
              <div class="bg-white p-4 rounded-lg border border-brand-gold/20 text-center shadow-sm">
                <h4 class="font-serif text-2xl font-bold text-brand-burgundy">1,200+</h4>
                <p class="text-[10px] uppercase tracking-wider text-brand-charcoal/70 font-semibold mt-1">Master Artisans</p>
              </div>
            </div>
          </div>
        </div>

        <!-- The 3 Raga Promises -->
        <div class="mt-8 text-center">
          <span class="text-xs uppercase tracking-[0.25em] text-brand-gold font-bold mb-2 block">Our Commitment To You</span>
          <h3 class="font-serif text-2xl sm:text-3xl font-bold text-brand-burgundy mb-10">The Raga Promise</h3>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <div class="bg-white p-8 rounded-lg border border-brand-gold/20 shadow-sm hover:shadow-md transition duration-300">
              <div class="w-12 h-12 rounded-full bg-brand-burgundy/10 text-brand-burgundy flex items-center justify-center mb-5">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
              </div>
              <h4 class="font-serif text-lg font-bold text-brand-burgundy mb-2">Silk Mark Certified</h4>
              <p class="text-xs text-brand-charcoal/80 leading-relaxed">Every silk saree comes with a Silk Mark certification, guaranteeing 100% pure silk and genuine weaving quality.</p>
            </div>

            <div class="bg-white p-8 rounded-lg border border-brand-gold/20 shadow-sm hover:shadow-md transition duration-300">
              <div class="w-12 h-12 rounded-full bg-brand-burgundy/10 text-brand-burgundy flex items-center justify-center mb-5">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
              </div>
              <h4 class="font-serif text-lg font-bold text-brand-burgundy mb-2">Empowering Artisans</h4>
              <p class="text-xs text-brand-charcoal/80 leading-relaxed">We work directly with weaving clusters across India, cutting out middlemen to ensure fair wages and sustainable livelihoods.</p>
            </div>

            <div class="bg-white p-8 rounded-lg border border-brand-gold/20 shadow-sm hover:shadow-md transition duration-300">
              <div class="w-12 h-12 rounded-full bg-brand-burgundy/10 text-brand-burgundy flex items-center justify-center mb-5">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
              </div>
              <h4 class="font-serif text-lg font-bold text-brand-burgundy mb-2">Handpicked Elegance</h4>
              <p class="text-xs text-brand-charcoal/80 leading-relaxed">Every piece in our boutique is personally selected for its exceptional drape, authentic color palette, and artisanal beauty.</p>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Customer Favourites Section (Below The Raga Promise) -->
    <section id="customer-favourites" class="bg-white border-t border-b border-brand-gold/10 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <span class="text-xs uppercase tracking-[0.25em] text-brand-gold font-bold mb-2.5 block">Most Liked Drapes</span>
          <h2 class="font-serif text-3xl font-bold text-brand-burgundy">Customer Favourites</h2>
          <div class="h-0.5 w-16 bg-brand-gold mx-auto mt-4"></div>
        </div>

        <div class="flex sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 overflow-x-auto sm:overflow-x-visible no-scrollbar pb-4 sm:pb-0 snap-x snap-mandatory sm:snap-none" id="favorites-grid">
          <!-- Populated Dynamically via orders -->
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-brand-cream/20 py-16 border-t border-b border-brand-gold/10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">

        <!-- Large Quotation Icon -->
        <div class="text-[#702152]/25 font-serif text-8xl leading-[0.1] select-none mb-4">“</div>
        <span class="text-xs uppercase tracking-[0.25em] text-brand-gold font-bold mb-2 block">TESTIMONIALS</span>
        <h2 class="font-serif text-3xl font-bold text-brand-charcoal mb-8">Speaking from their hearts</h2>

        <!-- Grid layout for reviews -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left mb-10">

          <!-- Testimonial 1 -->
          <div class="bg-white border border-brand-gold/10 p-6 shadow-sm flex flex-col justify-between rounded-lg">
            <div class="space-y-3">
              <div class="flex items-center text-brand-gold space-x-0.5">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
              </div>
              <p class="text-xs text-brand-charcoal/80 italic leading-relaxed">
                "Surbhi and Sneha (customer care representatives) helped me a lot to get that particular saree. Really
                appreciate their excellent work and support!"
              </p>
            </div>
            <div
              class="flex justify-between items-center pt-4 border-t border-gray-100 mt-4 text-[10px] text-gray-500 font-semibold">
              <span>Ankita</span>
              <span>12/09/25</span>
            </div>
          </div>

          <!-- Testimonial 2 -->
          <div class="bg-white border border-brand-gold/10 p-6 shadow-sm flex flex-col justify-between rounded-lg">
            <div class="space-y-3">
              <div class="flex items-center text-brand-gold space-x-0.5">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
              </div>
              <p class="text-xs text-brand-charcoal/80 italic leading-relaxed">
                "A Raga Boutique product! The name says it all. Par excellence as always. The quality of cotton and
                authentic weaves are incomparable."
              </p>
            </div>
            <div
              class="flex justify-between items-center pt-4 border-t border-gray-100 mt-4 text-[10px] text-gray-500 font-semibold">
              <span>Asha K.</span>
              <span>26/06/26</span>
            </div>
          </div>

          <!-- Testimonial 3 -->
          <div class="bg-white border border-brand-gold/10 p-6 shadow-sm flex flex-col justify-between rounded-lg">
            <div class="space-y-3">
              <div class="flex items-center text-brand-gold space-x-0.5">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
              </div>
              <p class="text-xs text-brand-charcoal/80 italic leading-relaxed">
                "Excellent collection, conveniently arranged by crafts and weaves. Weavers did an amazing job. The
                delivery was fast and packing was solid."
              </p>
            </div>
            <div
              class="flex justify-between items-center pt-4 border-t border-gray-100 mt-4 text-[10px] text-gray-500 font-semibold">
              <span>Madras S.</span>
              <span>02/05/25</span>
            </div>
          </div>

        </div>

        <a href="#collections"
          class="inline-block bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs uppercase tracking-widest font-bold py-3.5 px-8 rounded-full border-b border-brand-gold transition duration-300">
          Explore All Weaves
        </a>
      </div>
    </section>

    <!-- SEO / Info Accordion Block -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 border-t border-brand-gold/10">
      <div class="border border-brand-gold/20 bg-white rounded-lg overflow-hidden">

        <!-- Accordion Header -->
        <button onclick="toggleAccordion('seo-content')"
          class="w-full flex items-center justify-between p-6 text-left focus:outline-none bg-brand-cream/30">
          <h3 class="font-serif text-lg font-bold text-brand-burgundy uppercase tracking-wider">Raga Boutique: Woven in
            Heritage, Worn in Grace</h3>
          <span id="accordion-icon" class="text-brand-gold text-xl font-bold transition-transform duration-300">+</span>
        </button>

        <!-- Accordion Body -->
        <div id="seo-content" class="p-6 border-t border-brand-gold/20 hidden bg-brand-cream/10">
          <p class="text-xs text-brand-charcoal/80 leading-relaxed mb-4">
            Founded with a vision to sustain India's priceless handloom traditions, Raga Boutique stands at the
            intersection of classical weaving heritage and contemporary luxury. Our collections are ethically sourced
            directly from master artisans across Banaras, Kanchipuram, Chanderi, and Bengal.
          </p>
          <p class="text-xs text-brand-charcoal/80 leading-relaxed mb-4">
            From the auspicious zari of Kanjivaram silks to the ethereal feather-weight feel of Bengal Jamdani and
            hand-block printed Chanderis, every saree is Silk Mark certified and crafted to be an heirloom passed down
            through generations.
          </p>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 border-t border-brand-gold/15 text-center">
            <div>
              <div class="font-serif text-xl font-bold text-brand-burgundy">100%</div>
              <div class="text-[10px] text-gray-500 uppercase tracking-wider">Pure Silk</div>
            </div>
            <div>
              <div class="font-serif text-xl font-bold text-brand-burgundy">500+</div>
              <div class="text-[10px] text-gray-500 uppercase tracking-wider">Weavers Empowered</div>
            </div>
            <div>
              <div class="font-serif text-xl font-bold text-brand-burgundy">10,000+</div>
              <div class="text-[10px] text-gray-500 uppercase tracking-wider">Drapes Delivered</div>
            </div>
            <div>
              <div class="font-serif text-xl font-bold text-brand-burgundy">4.9 ★</div>
              <div class="text-[10px] text-gray-500 uppercase tracking-wider">Customer Rating</div>
            </div>
          </div>
        </div>

      </div>
    </section>

  </main>

  <!-- Dynamic Footer Component -->
  <div id="global-footer"></div>

  <!-- Javascript Modules -->
  <script src="js/products.js"></script>
  <script src="js/components.js"></script>
  <script src="js/main.js"></script>

  <!-- Page specific slideshow and data-rendering script -->
  <script>
    // 1. Image Slider Logic
    let currentSlideIndex = 0;
    const slides = document.getElementsByClassName("hero-slide");
    const dots = document.getElementsByClassName("hero-dot");

    function showSlide(index) {
      if (slides.length === 0) return;
      if (index >= slides.length) currentSlideIndex = 0;
      else if (index < 0) currentSlideIndex = slides.length - 1;
      else currentSlideIndex = index;

      for (let i = 0; i < slides.length; i++) {
        slides[i].classList.add("opacity-0");
        slides[i].classList.remove("opacity-100");
        if (dots[i]) {
          dots[i].classList.remove("text-brand-gold");
          dots[i].classList.add("text-white/50");
        }
      }

      slides[currentSlideIndex].classList.remove("opacity-0");
      slides[currentSlideIndex].classList.add("opacity-100");
      if (dots[currentSlideIndex]) {
        dots[currentSlideIndex].classList.add("text-brand-gold");
        dots[currentSlideIndex].classList.remove("text-white/50");
      }
    }

    function nextSlide() {
      showSlide(currentSlideIndex + 1);
    }

    function prevSlide() {
      showSlide(currentSlideIndex - 1);
    }

    function setSlide(index) {
      showSlide(index);
    }

    // Auto slideshow transition
    setInterval(nextSlide, 7000);

    // 2. SEO Accordion Toggler
    function toggleAccordion(id) {
      const content = document.getElementById(id);
      const icon = document.getElementById("accordion-icon");
      if (!content) return;

      if (content.classList.contains("hidden")) {
        content.classList.remove("hidden");
        icon.textContent = "-";
      } else {
        content.classList.add("hidden");
        icon.textContent = "+";
      }
    }

    // Homepage Product Fetching & Rendering Script
    function initHomepageProducts() {
      renderNewArrivals();
      renderCustomerFavourites();
    }

    document.addEventListener("DOMContentLoaded", initHomepageProducts);
    document.addEventListener("ragaProductsLoaded", initHomepageProducts);
    window.addEventListener("ragaProductsLoaded", initHomepageProducts);
    document.addEventListener("ragaLikesUpdated", renderNewArrivals);
    window.addEventListener("ragaLikesUpdated", renderNewArrivals);

    if (typeof ProductsDB !== "undefined" && ProductsDB.getAll().length > 0) {
      initHomepageProducts();
    }

    function renderNewArrivals() {
      const carousel = document.getElementById("new-arrivals-carousel");
      if (!carousel || typeof ProductsDB === "undefined") return;

      const prods = ProductsDB.getLikedProducts();

      if (prods && prods.length > 0) {
        let html = "";
        prods.forEach(product => {
          html += createProductCardHTML(product);
        });
        carousel.innerHTML = html;
      }
      
      if (typeof syncAllHeartButtons === "function") syncAllHeartButtons();
    }

    async function renderCustomerFavourites() {
      const grid = document.getElementById("favorites-grid");
      if (!grid || typeof ProductsDB === "undefined") return;

      let orders = [];
      try {
        const oRes = await fetch('api/get_orders.php');
        if (oRes.ok) {
          orders = await oRes.json();
          try { localStorage.setItem('raga_orders', JSON.stringify(orders)); } catch(e){}
        }
      } catch(e) {}

      if (orders.length === 0) {
        try {
          orders = JSON.parse(localStorage.getItem('raga_orders') || '[]');
        } catch(e){}
      }

      const favourites = ProductsDB.getCustomerFavourites(orders);

      if (favourites && favourites.length > 0) {
        let html = "";
        favourites.forEach(product => {
          html += createProductCardHTML(product, true);
        });
        grid.innerHTML = html;
      }
    }

    // Product Card Template Generator
    function createProductCardHTML(product, isGrid = false) {
      const discountPercentage = product.discount > 0
        ? `<span class="bg-green-700 text-white text-[9px] font-bold px-1.5 py-0.5 absolute top-2 left-2 z-10 uppercase tracking-widest">${product.discount}% OFF</span>`
        : "";

      const cardClass = isGrid 
        ? "w-[82vw] max-w-[300px] sm:w-full flex-shrink-0 sm:flex-shrink snap-start bg-white border border-brand-gold/15 group relative flex flex-col justify-between rounded shadow-sm hover:shadow-md transition duration-300 overflow-hidden"
        : "w-[82vw] max-w-[300px] sm:w-72 flex-shrink-0 snap-start bg-white border border-brand-gold/15 group relative flex flex-col justify-between rounded shadow-sm hover:shadow-md transition duration-300 overflow-hidden";

      return `
        <div class="${cardClass}">
          <div class="relative h-80 overflow-hidden bg-brand-cream/10">
            ${discountPercentage}

            <!-- Product Images -->
            <div class="h-full w-full">
              <img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover zoom-image absolute inset-0">
            </div>
          </div>

          <!-- Description / Price Block -->
          <div class="p-2.5 sm:p-4 bg-white flex-grow flex flex-col justify-between">
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

    // Safe video hover playback for Shop The Look
    function playHoverVideo(card) {
      const vid = card.querySelector('video');
      if (vid) {
        const p = vid.play();
        if (p && typeof p.catch === 'function') {
          p.catch(() => {});
        }
      }
    }

    function pauseHoverVideo(card) {
      const vid = card.querySelector('video');
      if (vid) {
        vid.pause();
        vid.currentTime = 0;
      }
    }
  </script>
</body>

</html>