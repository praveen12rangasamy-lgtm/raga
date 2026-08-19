<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Portal — Raga Boutique</title>
  <link rel="icon" type="image/png" href="../images/raga_favicon.png">
  
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

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .font-serif {
      font-family: 'Playfair Display', serif;
    }
    /* Hide native browser password reveal eye icons to avoid double icon */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear {
      display: none !important;
    }
  </style>
</head>
<body class="bg-[#fbf9f6] min-h-screen flex items-center justify-center p-4 relative selection:bg-brand-gold selection:text-brand-burgundy">

  <!-- Main Login Card (Balanced, Comfortable & Elegant) -->
  <div class="w-full max-w-[385px] bg-white border border-brand-gold/30 shadow-2xl rounded-2xl overflow-hidden relative z-10 transition-all duration-300">
    
    <!-- Top Header Ribbon with Official Logo -->
    <div class="pt-6 pb-3.5 px-7 text-center border-b border-brand-gold/15 bg-gradient-to-b from-[#faf6f0]/80 to-white">
      
      <!-- Website Official Logo -->
      <a href="../index.php" class="inline-block mb-1.5">
        <img src="../images/raga_logo.png?v=3" alt="Raga Boutique Logo" class="h-12 w-auto mx-auto hover:opacity-90 transition duration-200">
      </a>

      <div class="flex items-center justify-center gap-2 mt-0.5">
        <span class="h-[1px] w-6 bg-brand-gold/45"></span>
        <p class="text-[10px] uppercase tracking-[0.25em] text-brand-burgundy font-bold">Admin Portal</p>
        <span class="h-[1px] w-6 bg-brand-gold/45"></span>
      </div>
    </div>
    
    <!-- Login Form Area -->
    <div class="px-7 py-5">
      <form id="adminLoginForm" onsubmit="handleLogin(event)" class="space-y-4">
        
        <!-- Error Notification Banner -->
        <div id="loginError" class="hidden p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-lg text-center font-medium flex items-center justify-center gap-1.5">
          <svg class="h-4 w-4 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span id="loginErrorText">Invalid username or password</span>
        </div>

        <!-- Username Field -->
        <div>
          <label class="block text-[11px] font-bold text-brand-charcoal uppercase tracking-wider mb-1.5">Username</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-brand-burgundy/60">
              <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <input type="text" id="username" value="admin" required placeholder="Enter username"
              class="w-full pl-9 pr-3.5 py-2.5 bg-[#faf6f0]/40 border border-gray-200 rounded-lg text-brand-charcoal placeholder-gray-400 text-sm focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy/15 transition-all duration-200">
          </div>
        </div>

        <!-- Password Field -->
        <div>
          <label class="block text-[11px] font-bold text-brand-charcoal uppercase tracking-wider mb-1.5">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-brand-burgundy/60">
              <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
              </svg>
            </div>
            <input type="password" id="password" required placeholder="••••••••"
              class="w-full pl-9 pr-10 py-2.5 bg-[#faf6f0]/40 border border-gray-200 rounded-lg text-brand-charcoal placeholder-gray-400 text-sm focus:outline-none focus:border-brand-burgundy focus:ring-1 focus:ring-brand-burgundy/15 transition-all duration-200">
            
            <!-- Eye Toggle Button -->
            <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-brand-burgundy transition-colors cursor-pointer" title="Toggle password visibility">
              <svg id="eye-icon" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-1.5">
          <button type="submit" id="loginBtn" 
            class="w-full py-3 px-5 rounded-lg text-white font-bold text-xs uppercase tracking-[0.2em] bg-brand-burgundy hover:bg-brand-burgundyLight shadow-md hover:shadow-lg transition-all duration-200 flex justify-center items-center gap-2 cursor-pointer">
            <span id="btnText">SECURE LOGIN</span>
            <svg id="btnSpinner" class="animate-spin h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
          </button>
        </div>

        <!-- Return to Store Link -->
        <div class="text-center pt-1.5">
          <a href="../index.php" class="text-xs text-gray-500 hover:text-brand-burgundy font-medium transition-colors inline-flex items-center gap-1">
            <span>←</span> Back to Raga Boutique
          </a>
        </div>

      </form>
    </div>
  </div>

  <script>
    // Check if already authenticated
    fetch('../api/check_auth.php')
      .then(res => res.json())
      .then(data => {
        if (data.authenticated) {
          window.location.href = '../admin.php';
        }
      })
      .catch(e => console.warn(e));

    function togglePasswordVisibility() {
      const passInput = document.getElementById('password');
      if (passInput.type === 'password') {
        passInput.type = 'text';
      } else {
        passInput.type = 'password';
      }
    }

    async function handleLogin(e) {
      e.preventDefault();
      
      const user = document.getElementById('username').value.trim();
      const pass = document.getElementById('password').value;
      const btnText = document.getElementById('btnText');
      const btnSpinner = document.getElementById('btnSpinner');
      const loginBtn = document.getElementById('loginBtn');
      const errorDiv = document.getElementById('loginError');
      const errorText = document.getElementById('loginErrorText');

      // Loading state
      btnText.classList.add('hidden');
      btnSpinner.classList.remove('hidden');
      loginBtn.disabled = true;
      errorDiv.classList.add('hidden');

      try {
        const response = await fetch('../api/login.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ username: user, password: pass })
        });
        
        const data = await response.json();
        
        if (data.success) {
          window.location.href = '../admin.php';
        } else {
          errorDiv.classList.remove('hidden');
          errorText.textContent = data.message || 'Invalid username or password';
        }
      } catch (err) {
        errorDiv.classList.remove('hidden');
        errorText.textContent = 'Server error. Please try again.';
      } finally {
        btnText.classList.remove('hidden');
        btnSpinner.classList.add('hidden');
        loginBtn.disabled = false;
      }
    }
  </script>
</body>
</html>
