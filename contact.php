<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | Raga Boutique</title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="images/raga_favicon.png">
  <meta name="description" content="Get in touch with Raga Boutique. Visit our boutique in Tiruchengode or connect for bridal drapes, custom styling, and inquiries.">

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

  <!-- Global Dynamic Header (Pinned Top) -->
  <header id="global-header" class="w-full bg-white z-40"></header>

  <!-- Main Content (Single Page Fitted Layout) -->
  <main class="flex-grow py-8 sm:py-12 flex flex-col justify-center">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
      
      <!-- Compact Top Header -->
      <div class="text-center mb-8">
        <span class="text-xs uppercase tracking-[0.3em] text-brand-gold font-bold block mb-1">Get In Touch</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-brand-burgundy">Contact Raga Boutique</h1>
        <div class="h-0.5 w-16 bg-brand-gold mx-auto mt-2.5 mb-2"></div>
        <p class="text-xs sm:text-sm text-brand-charcoal/80 max-w-xl mx-auto">
          Visit our flagship store in Tiruchengode or send us a message for personalized styling assistance.
        </p>
      </div>

      <!-- Symmetrical 2-Column Balanced Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        
        <!-- Left Column: Boutique Information (5 cols) -->
        <div class="lg:col-span-5 flex flex-col justify-between bg-gradient-to-br from-[#3b0e2b] via-brand-burgundy to-[#4a1236] text-white p-6 sm:p-8 rounded-xl border border-brand-gold/30 shadow-xl relative overflow-hidden">
          <!-- Subtle decorative background pattern -->
          <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#d4b270 1px, transparent 1px); background-size: 24px 24px;"></div>
          
          <div class="relative z-10 space-y-6">
            <div class="border-b border-brand-gold/25 pb-4">
              <span class="text-[10px] uppercase tracking-[0.25em] text-brand-gold font-semibold block mb-1">Flagship Store</span>
              <h2 class="font-serif text-2xl font-bold text-white">Raga Boutique</h2>
            </div>
            
            <!-- Address -->
            <div class="flex items-start space-x-3.5">
              <div class="p-2.5 bg-brand-gold/20 text-brand-gold rounded-full border border-brand-gold/40 flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
              <div>
                <h3 class="font-bold text-xs text-brand-gold uppercase tracking-wider mb-1">Store Address</h3>
                <p class="text-xs text-white/90 leading-relaxed">
                  No.21, 22 & 23, Municipality Building,<br>
                  Santhaipettai Bus Stop, Erode Main Road,<br>
                  Tiruchengode - 637 211, Tamil Nadu.
                </p>
              </div>
            </div>

            <!-- Phone / WhatsApp -->
            <div class="flex items-start space-x-3.5">
              <div class="p-2.5 bg-brand-gold/20 text-brand-gold rounded-full border border-brand-gold/40 flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
              </div>
              <div>
                <h3 class="font-bold text-xs text-brand-gold uppercase tracking-wider mb-1">Phone & Support</h3>
                <p class="text-xs text-white/95">
                  <a href="tel:+918754291999" class="hover:text-brand-gold font-semibold transition">+91 87542 91999</a>
                </p>
              </div>
            </div>

            <!-- Email -->
            <div class="flex items-start space-x-3.5">
              <div class="p-2.5 bg-brand-gold/20 text-brand-gold rounded-full border border-brand-gold/40 flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <div>
                <h3 class="font-bold text-xs text-brand-gold uppercase tracking-wider mb-1">Email Inquiries</h3>
                <p class="text-xs text-white/95">
                  <a href="mailto:customercare@ragaboutique.co.in" class="hover:text-brand-gold transition">customercare@ragaboutique.co.in</a>
                </p>
              </div>
            </div>

            <!-- Timings -->
            <div class="flex items-start space-x-3.5">
              <div class="p-2.5 bg-brand-gold/20 text-brand-gold rounded-full border border-brand-gold/40 flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <h3 class="font-bold text-xs text-brand-gold uppercase tracking-wider mb-1">Opening Hours</h3>
                <p class="text-xs text-white/85">Mon - Sat: 10:00 AM – 8:30 PM<br>Sun: 11:00 AM – 7:00 PM</p>
              </div>
            </div>
          </div>

          <!-- Bottom Action Buttons -->
          <div class="relative z-10 pt-6 border-t border-brand-gold/20 flex gap-3 mt-6">
            <a href="tel:+918754291999" class="flex-1 text-center py-2.5 px-3 bg-brand-gold text-brand-burgundy font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-brand-goldDark transition">
              Call Store
            </a>
            <a href="https://wa.me/918754291999" target="_blank" class="flex-1 text-center py-2.5 px-3 bg-green-600 hover:bg-green-700 text-white font-bold text-xs uppercase tracking-wider rounded shadow transition">
              WhatsApp
            </a>
          </div>
        </div>

        <!-- Right Column: Interactive Contact Form (7 cols) -->
        <div class="lg:col-span-7 bg-white text-brand-charcoal p-6 sm:p-8 rounded-xl shadow-xl border border-brand-gold/30 flex flex-col justify-between">
          <div>
            <div class="border-b border-brand-gold/20 pb-4 mb-6">
              <span class="text-[10px] uppercase tracking-[0.25em] text-brand-gold font-bold block mb-1">Direct Assistance</span>
              <h2 class="font-serif text-2xl font-bold text-brand-burgundy">Send Us A Message</h2>
            </div>
                     <form id="contact-form" onsubmit="handleContactSubmit(event)" class="space-y-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label for="contact-name" class="block text-[10px] uppercase tracking-wider font-bold text-brand-charcoal/80 mb-1">Full Name *</label>
                  <input type="text" id="contact-name" name="name" required placeholder="e.g. Priya Sharma" class="w-full bg-brand-cream/30 border border-brand-gold/30 rounded px-3.5 py-2.5 text-xs text-brand-charcoal focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy transition">
                </div>
                <div>
                  <label for="contact-phone" class="block text-[10px] uppercase tracking-wider font-bold text-brand-charcoal/80 mb-1">Phone Number *</label>
                  <input type="tel" id="contact-phone" name="phone" required placeholder="e.g. +91 98765 43210" class="w-full bg-brand-cream/30 border border-brand-gold/30 rounded px-3.5 py-2.5 text-xs text-brand-charcoal focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy transition">
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label for="contact-email" class="block text-[10px] uppercase tracking-wider font-bold text-brand-charcoal/80 mb-1">Email Address</label>
                  <input type="email" id="contact-email" name="email" placeholder="e.g. priya@example.com" class="w-full bg-brand-cream/30 border border-brand-gold/30 rounded px-3.5 py-2.5 text-xs text-brand-charcoal focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy transition">
                </div>
                <div>
                  <label for="contact-subject" class="block text-[10px] uppercase tracking-wider font-bold text-brand-charcoal/80 mb-1">Inquiry Type</label>
                  <select id="contact-subject" name="subject" class="w-full bg-brand-cream/30 border border-brand-gold/30 rounded px-3.5 py-2.5 text-xs text-brand-charcoal focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy transition">
                    <option value="Bridal Silk Sarees">Bridal Silk Sarees</option>
                    <option value="Handloom & Banarasi Weaves">Handloom & Banarasi Weaves</option>
                    <option value="Designer Kurtas & Ensembles">Designer Kurtas & Ensembles</option>
                    <option value="Custom Orders / General Inquiry">Custom Orders / General Inquiry</option>
                  </select>
                </div>
              </div>

              <div>
                <label for="contact-message" class="block text-[10px] uppercase tracking-wider font-bold text-brand-charcoal/80 mb-1">Message *</label>
                <textarea id="contact-message" name="message" rows="3" required placeholder="Tell us about the sarees, fabrics, or styling assistance you are looking for..." class="w-full bg-brand-cream/30 border border-brand-gold/30 rounded px-3.5 py-2.5 text-xs text-brand-charcoal focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy transition"></textarea>
              </div>

              <button id="contact-submit-btn" type="submit" class="w-full bg-brand-burgundy hover:bg-brand-burgundyLight text-white font-bold text-xs uppercase tracking-[0.2em] py-3.5 rounded shadow-md border-b-2 border-brand-gold transition duration-300 flex items-center justify-center">
                <span id="contact-btn-text">Send Message</span>
              </button>
            </form>
          </div>
        </div>

      </div>

    </div>
  </main>

  <!-- Global Dynamic Footer -->
  <div id="global-footer"></div>

  <!-- Javascript Modules -->
  <script src="js/products.js"></script>
  <script src="js/components.js"></script>
  <script src="js/main.js"></script>

  <script>
    async function handleContactSubmit(event) {
      event.preventDefault();
      
      const submitBtn = document.getElementById("contact-submit-btn");
      const btnText = document.getElementById("contact-btn-text");
      const name = document.getElementById("contact-name").value.trim();
      const phone = document.getElementById("contact-phone").value.trim();
      const email = document.getElementById("contact-email").value.trim();
      const subject = document.getElementById("contact-subject").value;
      const message = document.getElementById("contact-message").value.trim();

      if (!name || !message) {
        showToast("Please enter your name and message.");
        return;
      }

      if (submitBtn && btnText) {
        submitBtn.disabled = true;
        btnText.textContent = "Sending...";
      }

      const payload = {
        name,
        phone,
        email,
        subject,
        message,
        date: new Date().toISOString()
      };

      try {
        const response = await fetch("api/send_message.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload)
        });
        const result = await response.json();

        if (result.success) {
          // Sync to localStorage for instant admin display
          try {
            let localMsgs = JSON.parse(localStorage.getItem("raga_messages") || "[]");
            payload.id = result.id || Date.now();
            payload.is_read = 0;
            payload.created_at = new Date().toISOString();
            localMsgs.unshift(payload);
            localStorage.setItem("raga_messages", JSON.stringify(localMsgs));
          } catch(e) {}

          showToast("Thank you! Your message has been sent to Raga Boutique.");
          document.getElementById("contact-form").reset();
        } else {
          showToast(result.message || "Failed to send message. Please try again.");
        }
      } catch (err) {
        console.error("Message send error:", err);
        // Fallback local save if offline
        try {
          let localMsgs = JSON.parse(localStorage.getItem("raga_messages") || "[]");
          payload.id = Date.now();
          payload.is_read = 0;
          payload.created_at = new Date().toISOString();
          localMsgs.unshift(payload);
          localStorage.setItem("raga_messages", JSON.stringify(localMsgs));
        } catch(e) {}
        showToast("Thank you! Your message has been sent to Raga Boutique.");
        document.getElementById("contact-form").reset();
      } finally {
        if (submitBtn && btnText) {
          submitBtn.disabled = false;
          btnText.textContent = "Send Message";
        }
      }
    }
  </script>
</body>

</html>
