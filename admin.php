<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel — Raga Boutique</title>
  <link rel="icon" type="image/png" href="images/raga_favicon.png">
  <meta name="robots" content="noindex, nofollow">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              burgundy: '#702152', burgundyLight: '#8b2968',
              gold: '#d4b270', goldDark: '#bfa061',
              cream: '#faf6f0', charcoal: '#2c2c2c',
            }
          },
          fontFamily: { serif: ['"Playfair Display"','serif'], sans: ['Inter','sans-serif'] }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;} body{font-family:'Inter',sans-serif;background:#faf6f0;margin:0;}
    h1,h2,h3,h4,.font-serif{font-family:'Playfair Display',serif;}

    /* ─ Sidebar ─ */
    .sidebar{background:linear-gradient(180deg,#702152 0%,#4a1539 100%);width:220px;min-height:100vh;position:fixed;top:0;left:0;display:flex;flex-direction:column;box-shadow:4px 0 24px rgba(0,0,0,.15);z-index:50;}
    .sidebar-logo{padding:20px 18px 16px;border-bottom:1px solid rgba(212,178,112,.15);}
    .sidebar-logo img{height:38px;object-fit:contain;}
    .admin-badge{font-size:9px;letter-spacing:.25em;text-transform:uppercase;color:rgba(212,178,112,.7);margin-top:5px;}
    .nav-label{padding:14px 18px 5px;font-size:9px;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.3);}
    .nav-item{display:flex;align-items:center;gap:10px;padding:11px 18px;color:rgba(255,255,255,.65);font-size:13px;font-weight:500;cursor:pointer;border-left:3px solid transparent;transition:all .2s;text-decoration:none;background:none;border-top:none;border-right:none;border-bottom:none;width:100%;text-align:left;}
    .nav-item:hover{color:#fff;background:rgba(255,255,255,.07);border-left-color:rgba(212,178,112,.4);}
    .nav-item.active{color:#fff;background:rgba(255,255,255,.12);border-left-color:#d4b270;}
    .nav-item svg{width:17px;height:17px;flex-shrink:0;}
    .nav-dropdown-wrapper{width:100%;}
    .nav-submenu{background:rgba(0,0,0,.15);border-left:2px solid rgba(212,178,112,.3);margin-left:18px;}
    .nav-subitem{display:flex;align-items:center;padding:7px 12px;color:rgba(255,255,255,.65);font-size:12px;font-weight:500;cursor:pointer;border-radius:6px;transition:all .2s;background:none;border:none;width:100%;text-align:left;}
    .nav-subitem:hover{color:#fff;background:rgba(255,255,255,.08);}
    .nav-subitem.active{color:#d4b270;font-weight:600;background:rgba(212,178,112,.15);}
    .logout-btn{margin:auto 14px 20px;padding:9px 14px;background:rgba(255,255,255,.07);border:1px solid rgba(212,178,112,.2);border-radius:8px;color:rgba(255,255,255,.55);font-size:12px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;cursor:pointer;display:flex;align-items:center;gap:8px;transition:all .2s;width:calc(100% - 28px);}
    .logout-btn:hover{background:rgba(239,68,68,.15);border-color:rgba(239,68,68,.3);color:#fca5a5;}

    /* ─ Main ─ */
    .main-content{margin-left:220px;min-height:100vh;}
    .topbar{background:#fff;border-bottom:1px solid rgba(112,33,82,.08);padding:14px 28px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:40;box-shadow:0 2px 8px rgba(112,33,82,.04);}

    /* ─ Stat Cards ─ */
    .stat-card{background:#fff;border-radius:10px;padding:18px 20px;border:1px solid rgba(212,178,112,.15);box-shadow:0 2px 10px rgba(112,33,82,.06);position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s;}
    .stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(112,33,82,.12);}
    .stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#702152,#d4b270);}
    .stat-icon{width:40px;height:40px;border-radius:9px;display:flex;align-items:center;justify-content:center;margin-bottom:10px;}

    /* ─ Category Boxes ─ */
    .cat-box{background:#fff;border-radius:14px;border:1px solid rgba(212,178,112,.18);box-shadow:0 3px 14px rgba(112,33,82,.07);cursor:pointer;overflow:hidden;transition:transform .2s,box-shadow .2s,border-color .2s;}
    .cat-box:hover{transform:translateY(-3px);box-shadow:0 10px 28px rgba(112,33,82,.14);border-color:rgba(112,33,82,.3);}
    .cat-box-header{padding:22px 20px 16px;border-bottom:1px solid rgba(212,178,112,.1);}
    .cat-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:12px;background:linear-gradient(135deg,rgba(112,33,82,.1),rgba(212,178,112,.12));}
    .cat-box-footer{padding:12px 20px;background:rgba(250,246,240,.6);display:flex;align-items:center;justify-content:space-between;}
    .cat-count-badge{font-size:11px;font-weight:600;color:#702152;background:rgba(112,33,82,.08);padding:3px 10px;border-radius:999px;border:1px solid rgba(112,33,82,.12);}

    /* ─ Sub-category Groups (Drill-down) ─ */
    .group-card{background:#fff;border-radius:12px;border:1px solid rgba(212,178,112,.15);box-shadow:0 2px 10px rgba(112,33,82,.05);margin-bottom:16px;overflow:hidden;}
    .group-header{padding:14px 18px;background:linear-gradient(135deg,rgba(112,33,82,.06),rgba(212,178,112,.04));border-bottom:1px solid rgba(212,178,112,.1);display:flex;align-items:center;justify-content:space-between;}
    .group-body{padding:16px 18px;}

    /* ─ Item chips ─ */
    .item-row{display:flex;align-items:center;justify-content:space-between;padding:8px 12px;border-radius:8px;border:1px solid rgba(212,178,112,.12);margin-bottom:8px;background:rgba(250,246,240,.5);transition:background .15s;}
    .item-row:hover{background:#fff;}
    .item-actions{display:flex;gap:6px;}
    .btn-edit{padding:3px 10px;font-size:10px;font-weight:600;border-radius:5px;background:rgba(212,178,112,.15);color:#bfa061;border:1px solid rgba(212,178,112,.3);cursor:pointer;transition:all .15s;}
    .btn-edit:hover{background:rgba(212,178,112,.3);}
    .btn-del{padding:3px 10px;font-size:10px;font-weight:600;border-radius:5px;background:rgba(239,68,68,.08);color:#ef4444;border:1px solid rgba(239,68,68,.2);cursor:pointer;transition:all .15s;}
    .btn-del:hover{background:rgba(239,68,68,.18);}
    .btn-icon-edit{width:28px;height:28px;display:flex;align-items:center;justify-content:center;border-radius:6px;background:rgba(212,178,112,.15);color:#bfa061;border:1px solid rgba(212,178,112,.3);cursor:pointer;transition:all .15s;}
    .btn-icon-edit:hover{background:rgba(212,178,112,.3);color:#702152;}
    .btn-icon-del{width:28px;height:28px;display:flex;align-items:center;justify-content:center;border-radius:6px;background:rgba(239,68,68,.1);color:#ef4444;border:1px solid rgba(239,68,68,.25);cursor:pointer;transition:all .15s;}
    .btn-icon-del:hover{background:rgba(239,68,68,.22);}

    /* ─ Add row ─ */
    .add-row{display:flex;gap:8px;margin-top:10px;}
    .add-input{flex:1;padding:8px 12px;border-radius:7px;border:1px solid rgba(212,178,112,.3);font-size:12px;outline:none;transition:border-color .2s;}
    .add-input:focus{border-color:#702152;box-shadow:0 0 0 2px rgba(112,33,82,.1);}
    .btn-add-item{padding:8px 18px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;background:#702152;color:#fff;border:none;border-radius:7px;cursor:pointer;white-space:nowrap;transition:background .2s;}
    .btn-add-item:hover{background:#8b2968;}

    /* ─ Dashed add button ─ */
    .btn-dashed{display:flex;align-items:center;gap:6px;padding:11px 18px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#702152;background:rgba(112,33,82,.05);border:1.5px dashed rgba(112,33,82,.25);border-radius:10px;cursor:pointer;transition:all .2s;width:100%;margin-top:4px;}
    .btn-dashed:hover{background:rgba(112,33,82,.1);border-color:#702152;}

    /* ─ Primary button ─ */
    .btn-primary{padding:9px 20px;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;background:#702152;color:#fff;border:none;border-radius:8px;cursor:pointer;transition:background .2s;display:inline-flex;align-items:center;gap:6px;}
    .btn-primary:hover{background:#8b2968;}

    /* ─ Secondary button ─ */
    .btn-secondary{padding:9px 20px;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;background:transparent;color:#702152;border:1.5px solid #702152;border-radius:8px;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
    .btn-secondary:hover{background:rgba(112,33,82,.06);}

    /* ─ Breadcrumb ─ */
    .breadcrumb{display:flex;align-items:center;gap:8px;font-size:13px;margin-bottom:24px;}
    .breadcrumb a{color:#702152;font-weight:600;cursor:pointer;text-decoration:none;}
    .breadcrumb a:hover{text-decoration:underline;}
    .breadcrumb-sep{color:#bfa061;}
    .breadcrumb-cur{color:#6b7280;font-weight:500;}

    /* ─ Table ─ */
    .admin-table{width:100%;border-collapse:collapse;}
    .admin-table th{background:#702152;color:#fff;padding:12px 14px;text-align:center;vertical-align:middle;font-size:11px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;white-space:nowrap;}
    .admin-table th:first-child{border-radius:8px 0 0 0;}.admin-table th:last-child{border-radius:0 8px 0 0;}
    .admin-table td{padding:12px 14px;font-size:12px;border-bottom:1px solid rgba(212,178,112,.08);color:#2c2c2c;text-align:center;vertical-align:middle;white-space:nowrap;}
    .admin-table tr:hover td{background:rgba(112,33,82,.02);}
    .admin-table tr:last-child td{border-bottom:none;}

    /* ─ Views ─ */
    .view{display:none;}.view.active{display:block;}

    /* ─ Modal ─ */
    .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center;z-index:200;opacity:0;pointer-events:none;transition:opacity .2s;}
    .modal-overlay.open{opacity:1;pointer-events:all;}
    .modal-box{background:#fff;border-radius:16px;padding:0;width:100%;max-width:480px;transform:translateY(24px);transition:transform .2s;box-shadow:0 24px 60px rgba(0,0,0,.2);overflow:hidden;}
    .modal-overlay.open .modal-box{transform:translateY(0);}
    .modal-header{background:linear-gradient(135deg,#702152,#8b2968);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;}
    .modal-body{padding:24px;}
    .modal-footer{padding:16px 24px;border-top:1px solid rgba(212,178,112,.12);display:flex;gap:10px;justify-content:flex-end;background:rgba(250,246,240,.5);}
    .form-label{display:block;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:rgba(112,33,82,.8);margin-bottom:6px;}
    .form-input{width:100%;padding:10px 14px;border:1px solid rgba(212,178,112,.3);border-radius:8px;font-size:13px;outline:none;transition:border-color .2s;background:#faf6f0;color:#2c2c2c;margin-bottom:14px;}
    .form-input:focus{border-color:#702152;box-shadow:0 0 0 2px rgba(112,33,82,.1);background:#fff;}
    .form-select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23702152'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;background-size:16px;padding-right:36px;}
    .btn-cancel{padding:9px 20px;font-size:11px;font-weight:600;border:1px solid #ddd;border-radius:8px;background:#fff;color:#6b7280;cursor:pointer;transition:all .2s;}
    .btn-cancel:hover{background:#f9fafb;}

    /* ─ Photo preview ─ */
    .photo-preview{width:100%;height:120px;border:2px dashed rgba(212,178,112,.4);border-radius:10px;display:flex;align-items:center;justify-content:center;background:rgba(250,246,240,.6);cursor:pointer;transition:all .2s;overflow:hidden;position:relative;margin-bottom:14px;}
    .photo-preview:hover{border-color:#702152;background:rgba(112,33,82,.04);}
    .photo-preview img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0;}
    .photo-placeholder{text-align:center;color:rgba(112,33,82,.5);}

    @keyframes fadeIn{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}
    .sidebar { transform: translateX(0); transition: transform 0.3s ease-in-out; }
    .sidebar.closed { transform: translateX(-100%); }
    .main-content { margin-left: 220px; transition: margin-left 0.3s ease-in-out; }
    .main-content.expanded { margin-left: 0; }
    .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 40; transition: opacity 0.3s; opacity: 0; }
    .sidebar-overlay.open { display: block; opacity: 1; }
    
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .sidebar.open { transform: translateX(0); }
      .main-content { margin-left: 0; }
      .topbar { padding: 14px 16px; }
    }
  </style>
  <script>
    fetch('api/check_auth.php')
      .then(res => res.json())
      .then(data => {
        if (!data.authenticated) {
          window.location.href = 'admin/index.php';
        }
      });
  </script>
</head>
<body>

<!-- ── Sidebar ── -->
<div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <img src="images/raga_logo_silver.png?v=2" alt="Raga"
      onerror="this.style.display='none';document.getElementById('sb-logo').style.display='block'">
    <div id="sb-logo" class="font-serif text-lg text-brand-gold font-bold" style="display:none;">Raga</div>
    <div class="admin-badge">Admin Panel</div>
  </div>
  <nav class="flex-1 py-3">
    <div class="nav-label">Main Menu</div>
    <button class="nav-item active" id="nav-dashboard" onclick="switchView('dashboard')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10-4a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/></svg>
      Dashboard
    </button>
    <button class="nav-item" id="nav-categories" onclick="switchView('categories')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
      Categories
    </button>
    <button class="nav-item" id="nav-products" onclick="switchView('products')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
      Products
    </button>
    <button class="nav-item" id="nav-orders" onclick="switchView('orders')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
      Orders
    </button>
    
    <!-- Transactions Dropdown Menu in Sidebar -->
    <div class="nav-dropdown-wrapper">
      <button class="nav-item flex justify-between items-center" id="nav-transactions-parent" onclick="toggleTransactionsDropdown(event)">
        <div class="flex items-center gap-2.5">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
          <span>Transactions</span>
        </div>
        <svg id="transactions-chevron" class="w-3.5 h-3.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div id="transactions-submenu" class="nav-submenu pl-6 pr-2 py-1 space-y-1 hidden">
        <button class="nav-subitem" id="nav-transactions" onclick="switchView('transactions')">
          <span class="w-1.5 h-1.5 rounded-full bg-brand-gold/60 inline-block mr-2"></span>
          <span>Transactions</span>
        </button>
        <button class="nav-subitem" id="nav-transaction-history" onclick="switchView('transaction-history')">
          <span class="w-1.5 h-1.5 rounded-full bg-brand-gold/60 inline-block mr-2"></span>
          <span>Transaction History</span>
        </button>
      </div>
    </div>

    <button class="nav-item" id="nav-messages" onclick="switchView('messages')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      Messages
    </button>
    <button class="nav-item" id="nav-settings" onclick="switchView('settings')">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      Settings
    </button>
  </nav>
  <button class="logout-btn" onclick="handleLogout()">
    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
    Logout
  </button>
</aside>

<!-- ── Main Content ── -->
<div class="main-content">
  <header class="topbar">
    <div class="flex items-center gap-3">
      <button class="menu-btn mr-2 text-brand-burgundy p-1 hover:bg-brand-gold/10 rounded-md transition-colors" onclick="toggleSidebar()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
      </button>
      <div>
        <h1 class="font-serif text-xl font-bold text-brand-burgundy" id="page-title">Dashboard</h1>
        <p class="text-xs text-gray-400 mt-0.5" id="page-subtitle">Raga Boutique Admin Panel</p>
      </div>
    </div>
    <div class="flex items-center gap-3">
      <div class="text-right hidden sm:block">
        <p class="text-xs font-semibold text-brand-burgundy" id="admin-name">admin</p>
        <p class="text-xs text-gray-400">Administrator</p>
      </div>
      <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm text-white" style="background:#702152;">A</div>
    </div>
  </header>

  <main class="p-6 sm:p-8">

    <!-- ═══ DASHBOARD ═══ -->
    <div id="view-dashboard" class="view active fade-in">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(112,33,82,.1)">
            <svg class="h-5 w-5 text-brand-burgundy" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
          </div>
          <div class="text-3xl font-bold text-brand-burgundy font-serif" id="stat-total">—</div>
          <div class="text-xs text-gray-400 font-medium mt-1 uppercase tracking-wider">Total Products</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(212,178,112,.12)">
            <svg class="h-5 w-5 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
          </div>
          <div class="text-3xl font-bold font-serif text-brand-gold" id="stat-dashboard-orders">—</div>
          <div class="text-xs text-gray-400 font-medium mt-1 uppercase tracking-wider">Total Orders</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(139,41,104,.08)">
            <svg class="h-5 w-5 text-brand-burgundyLight" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <div class="text-3xl font-bold font-serif text-brand-burgundyLight" id="stat-dashboard-revenue">—</div>
          <div class="text-xs text-gray-400 font-medium mt-1 uppercase tracking-wider">Total Revenue</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:rgba(44,44,44,.07)">
            <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
          </div>
          <div class="text-3xl font-bold font-serif text-gray-700" id="stat-categories">—</div>
          <div class="text-xs text-gray-400 font-medium mt-1 uppercase tracking-wider">Categories</div>
        </div>
      </div>

      <!-- Dashboard Products Table -->
      <div class="bg-white rounded-xl border overflow-hidden" style="border-color:rgba(212,178,112,.18);box-shadow:0 2px 12px rgba(112,33,82,.06);">
        <div class="px-6 py-4 border-b flex items-center justify-between" style="border-color:rgba(212,178,112,.12);">
          <h2 class="font-serif text-base font-bold text-brand-burgundy">All Products</h2>
          <span class="text-xs font-semibold px-3 py-1 rounded-full product-count-badge" style="background:rgba(212,178,112,.15);color:#bfa061;">—</span>
        </div>
        <div class="px-5 py-2.5 border-b flex gap-3 items-center" style="border-color:rgba(212,178,112,.08);background:rgba(250,246,240,.5);">
          <input type="search" id="dashboard-table-search" name="dashboard_product_search" autocomplete="off" placeholder="Search products…" oninput="filterTable()"
            class="border rounded-lg px-3 py-1.5 text-xs focus:outline-none flex-1" style="border-color:rgba(212,178,112,.3);">
          <select id="dashboard-table-cat-filter" onchange="filterTable()"
            class="border rounded-lg px-3 py-1.5 text-xs focus:outline-none" style="border-color:rgba(212,178,112,.3);">
            <option value="">All Categories</option>
          </select>
        </div>
        <div class="overflow-x-auto">
          <table class="admin-table">
            <thead><tr><th>#</th><th>Photo</th><th>Product Name</th><th>Category</th><th>Price</th><th>Offer</th><th>New Arrivals</th><th>Actions</th></tr></thead>
            <tbody id="dashboard-products-tbody"></tbody>
          </table>
        </div>
        <div id="dashboard-table-empty" class="hidden text-center py-10 text-gray-400 text-sm">No products found.</div>
      </div>

    </div>

    <!-- ═══ PRODUCTS ═══ -->
    <div id="view-products" class="view fade-in" style="display:none;">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <div class="hidden sm:block">
          <p class="text-sm text-gray-500">Manage all your products, prices, and stock across all categories.</p>
        </div>
        <div class="flex items-center gap-2.5 w-full sm:w-auto">
          <button class="btn-secondary flex-1 sm:flex-initial justify-center whitespace-nowrap text-xs py-2 px-3 sm:px-4" onclick="openModal('modal-add-subcategory')">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add Sub-Category</span>
          </button>
          <button class="btn-primary flex-1 sm:flex-initial justify-center whitespace-nowrap text-xs py-2 px-3 sm:px-4" onclick="createNewProductAndEdit()">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add Product</span>
          </button>
        </div>
      </div>

      <!-- Products Table -->
      <div class="bg-white rounded-xl border overflow-hidden" style="border-color:rgba(212,178,112,.18);box-shadow:0 2px 12px rgba(112,33,82,.06);">
        <div class="px-6 py-4 border-b flex items-center justify-between" style="border-color:rgba(212,178,112,.12);">
          <h2 class="font-serif text-base font-bold text-brand-burgundy">All Products</h2>
          <span class="text-xs font-semibold px-3 py-1 rounded-full product-count-badge" style="background:rgba(212,178,112,.15);color:#bfa061;">—</span>
        </div>
        <div class="px-5 py-2.5 border-b flex gap-3 items-center" style="border-color:rgba(212,178,112,.08);background:rgba(250,246,240,.5);">
          <input type="search" id="table-search" name="all_product_search" autocomplete="off" placeholder="Search products…" oninput="filterTable()"
            class="border rounded-lg px-3 py-1.5 text-xs focus:outline-none flex-1" style="border-color:rgba(212,178,112,.3);">
          <select id="table-cat-filter" onchange="filterTable()"
            class="border rounded-lg px-3 py-1.5 text-xs focus:outline-none" style="border-color:rgba(212,178,112,.3);">
            <option value="">All Categories</option>
          </select>
        </div>
        <div class="overflow-x-auto">
          <table class="admin-table">
            <thead><tr><th>#</th><th>Photo</th><th>Product Name</th><th>Category</th><th>Price</th><th>Offer</th><th>New Arrivals</th><th>Actions</th></tr></thead>
            <tbody id="products-tbody"></tbody>
          </table>
        </div>
        <div id="table-empty" class="hidden text-center py-10 text-gray-400 text-sm">No products found.</div>
      </div>
    </div>

    <!-- ═══ CATEGORIES — Grid View ═══ -->
    <div id="view-categories" class="view fade-in">
      <!-- Category Grid -->
      <div id="cat-grid-view">
        <div class="flex items-center justify-between gap-3 mb-6">
          <div>
            <p class="text-sm text-gray-500">Click a category to manage its sub-categories and products.</p>
          </div>
          <button class="btn-primary whitespace-nowrap flex-shrink-0" onclick="openAddCategoryModal()">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add Category</span>
          </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5" id="categories-grid"></div>
      </div>


    </div>

    <!-- ═══ ORDERS ═══ -->
    <div id="view-orders" class="view fade-in" style="display:none;">
      
      <!-- Stats Row -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        <div class="stat-card" style="border-top:3px solid #702152;">
          <div class="stat-icon" style="background:rgba(112,33,82,.08);">
            <svg class="h-5 w-5 text-brand-burgundy" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
          </div>
          <p class="stat-val text-brand-burgundy" id="stat-orders-total">0</p>
          <p class="stat-lbl">Total Orders</p>
        </div>
        <div class="stat-card" style="border-top:3px solid #bfa061;">
          <div class="stat-icon" style="background:rgba(212,178,112,.15);">
            <svg class="h-5 w-5 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <p class="stat-val text-brand-gold" id="stat-orders-pending">0</p>
          <p class="stat-lbl">Pending Confirmation</p>
        </div>
        <div class="stat-card" style="border-top:3px solid #2563eb;">
          <div class="stat-icon" style="background:rgba(37,99,235,.1);">
            <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
          </div>
          <p class="stat-val text-blue-600" id="stat-orders-shipped">0</p>
          <p class="stat-lbl">Shipped / In Transit</p>
        </div>
        <div class="stat-card" style="border-top:3px solid #059669;">
          <div class="stat-icon" style="background:rgba(5,150,105,.1);">
            <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <p class="stat-val text-green-600" id="stat-orders-revenue">₹0</p>
          <p class="stat-lbl">Total Revenue</p>
        </div>
      </div>

      <!-- Filters & Table -->
      <div class="bg-white rounded-xl border overflow-hidden" style="border-color:rgba(212,178,112,.18);box-shadow:0 2px 12px rgba(112,33,82,.06);">

        <!-- Controls Bar: Left Date Filter, Right Search Expandable -->
        <div class="px-5 py-3 border-b flex flex-wrap gap-3 items-center justify-between bg-white" style="border-color:rgba(212,178,112,.12);">
          
          <!-- Left: Date Filter -->
          <div class="flex items-center gap-2">
            <label for="orders-date-filter" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Filter by Date:</label>
            <input type="date" id="orders-date-filter" onchange="renderOrders()" class="border rounded-lg px-3 py-1.5 text-xs focus:outline-none text-gray-700 bg-white" style="border-color:rgba(212,178,112,.3);">
            <button type="button" onclick="document.getElementById('orders-date-filter').value=''; renderOrders();" class="text-xs text-gray-400 hover:text-brand-burgundy font-medium px-2 py-1.5 border rounded bg-white hover:bg-brand-cream/30" title="Clear Date Filter">Clear</button>
          </div>

          <!-- Right: Search Icon / Full Search Bar Expandable -->
          <div class="flex items-center gap-2 relative">
            <div id="orders-search-box" class="hidden transition-all duration-300 relative w-64 sm:w-80">
              <svg class="h-4 w-4 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              <input type="text" id="orders-search" oninput="renderOrders()" placeholder="Search Order ID, Customer, Phone, Item..." class="border rounded-lg pl-9 pr-8 py-1.5 text-xs focus:outline-none w-full shadow-xs" style="border-color:rgba(212,178,112,.4);">
              <button type="button" onclick="toggleOrdersSearchBar(false)" class="absolute right-2.5 top-1.5 text-gray-400 hover:text-gray-600 text-xs">✕</button>
            </div>
            <button id="orders-search-toggle-btn" type="button" onclick="toggleOrdersSearchBar(true)" class="p-2 border rounded-lg hover:bg-brand-cream/30 text-brand-burgundy transition shadow-xs" style="border-color:rgba(212,178,112,.3);" title="Search Orders">
              <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
          </div>

        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="admin-table">
            <thead>
              <tr>
                <th>S.no</th>
                <th>Order ID</th>
                <th>Date & Time</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="orders-tbody">
              
            </tbody>
          </table>
        </div>
        <div id="orders-table-empty" class="text-center py-12 text-gray-400 text-sm">No orders found matching the selected filter or search query.</div>
      </div>
    </div>

    <!-- ═══ TRANSACTIONS ═══ -->
    <div id="view-transactions" class="view fade-in" style="display:none;">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
        <div>
          <h2 class="text-xl font-bold text-brand-burgundy font-serif">Transactions</h2>
          <p class="text-xs text-gray-400 mt-0.5">Overview of all real-time transactions across payment states.</p>
        </div>
        <div>
          <button onclick="exportTransactionsExcel()" class="btn-primary flex items-center gap-2 text-xs py-2 px-4 shadow-sm hover:shadow transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <span>Download Excel</span>
          </button>
        </div>
      </div>

      <div class="bg-white rounded-xl border overflow-hidden" style="border-color:rgba(212,178,112,.18);box-shadow:0 2px 12px rgba(112,33,82,.06);">
        <!-- Filter Controls Bar -->
        <div class="p-4 border-b flex flex-wrap gap-3 items-center justify-between bg-white" style="border-color:rgba(212,178,112,.12); background:rgba(250,246,240,.4);">
          <!-- Filters Left -->
          <div class="flex flex-wrap items-center gap-3">
            <!-- Preset Period Filter -->
            <div class="flex items-center gap-1.5">
              <label for="trx-preset-filter" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Period:</label>
              <select id="trx-preset-filter" onchange="renderTransactions()" class="border rounded-lg px-3 py-1.5 text-xs font-medium focus:outline-none text-gray-700 bg-white" style="border-color:rgba(212,178,112,.3);">
                <option value="all">All</option>
                <option value="today">Today</option>
                <option value="last-week">Last Week</option>
                <option value="last-month">Last Month</option>
              </select>
            </div>

            <!-- Specific Date Filter -->
            <div class="flex items-center gap-1.5">
              <label for="trx-date-filter" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Date:</label>
              <input type="date" id="trx-date-filter" onchange="renderTransactions()" class="border rounded-lg px-2.5 py-1.5 text-xs focus:outline-none text-gray-700 bg-white" style="border-color:rgba(212,178,112,.3);">
              <button type="button" onclick="document.getElementById('trx-date-filter').value=''; renderTransactions();" class="text-xs text-gray-400 hover:text-brand-burgundy font-medium px-2 py-1 border rounded bg-white hover:bg-brand-cream/30" title="Clear Date">Clear</button>
            </div>
          </div>

          <!-- Search Right -->
          <div class="relative w-full sm:w-64">
            <svg class="h-4 w-4 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="trx-search" oninput="renderTransactions()" placeholder="Search TRX, Order, Customer…" class="border rounded-lg pl-9 pr-3 py-1.5 text-xs focus:outline-none w-full shadow-xs" style="border-color:rgba(212,178,112,.3);">
          </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="admin-table">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Transaction ID</th>
                <th>Order ID</th>
                <th>Date & Time</th>
                <th>Customer</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="transactions-tbody"></tbody>
          </table>
        </div>
        <div id="transactions-table-empty" class="text-center py-12 text-gray-400 text-sm hidden">No transactions found matching your filter.</div>
      </div>
    </div>

    <!-- ═══ TRANSACTION HISTORY (Revenue & Payment Analytics Graph) ═══ -->
    <div id="view-transaction-history" class="view fade-in" style="display:none;">
      <div class="mb-5">
        <h2 class="text-xl font-bold text-brand-burgundy font-serif">Revenue & Transaction Analytics</h2>
        <p class="text-xs text-gray-400 mt-0.5">Visual revenue trends, completed payment metrics, and date breakdown.</p>
      </div>

      <!-- ── Analytics KPI Summary Cards (Successful Payments Only) ── -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <!-- Total Completed Revenue -->
        <div class="stat-card">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-[10px] font-bold uppercase tracking-wider text-gray-500">Total Completed Revenue</p>
              <h3 id="trx-analytics-revenue" class="text-2xl font-bold font-serif text-brand-burgundy mt-1">₹ 0</h3>
              <p class="text-[11px] text-green-700 font-semibold flex items-center gap-1 mt-1.5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                <span>Success Status Only</span>
              </p>
            </div>
            <div class="stat-icon bg-emerald-50 text-emerald-600 border border-emerald-200">
              <span class="text-lg font-bold">₹</span>
            </div>
          </div>
        </div>

        <!-- Successful Orders Count -->
        <div class="stat-card">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-[10px] font-bold uppercase tracking-wider text-gray-500">Successful Orders</p>
              <h3 id="trx-analytics-count" class="text-2xl font-bold font-serif text-brand-charcoal mt-1">0</h3>
              <p class="text-[11px] text-gray-400 font-medium mt-1.5">Verified & Paid Transactions</p>
            </div>
            <div class="stat-icon bg-blue-50 text-blue-600 border border-blue-200">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
          </div>
        </div>

        <!-- Average Order Value (AOV) -->
        <div class="stat-card">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-[10px] font-bold uppercase tracking-wider text-gray-500">Avg. Transaction Value</p>
              <h3 id="trx-analytics-aov" class="text-2xl font-bold font-serif text-brand-gold mt-1">₹ 0</h3>
              <p class="text-[11px] text-gray-400 font-medium mt-1.5">Per Completed Order</p>
            </div>
            <div class="stat-icon bg-amber-50 text-amber-600 border border-amber-200">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
          </div>
        </div>
      </div>

      <!-- ── Analytics Chart Container ── -->
      <div class="bg-white rounded-xl border overflow-hidden" style="border-color:rgba(212,178,112,.18);box-shadow:0 2px 12px rgba(112,33,82,.06);">
        <!-- Filter Controls Bar with Month & Year in Single Picker -->
        <div class="p-4 border-b flex flex-wrap gap-3 items-center justify-between bg-white" style="border-color:rgba(212,178,112,.12); background:rgba(250,246,240,.4);">
          <!-- Filters Left -->
          <div class="flex flex-wrap items-center gap-3">
            <!-- Preset Period Filter -->
            <div class="flex items-center gap-1.5">
              <label for="trx-hist-preset-filter" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Period:</label>
              <select id="trx-hist-preset-filter" onchange="handleTrxHistPresetChange()" class="border rounded-lg px-2.5 py-1.5 text-xs font-medium focus:outline-none text-gray-700 bg-white shadow-xs" style="border-color:rgba(212,178,112,.3);">
                <option value="all">All Time</option>
                <option value="today">Today</option>
                <option value="last-week">This Week</option>
                <option value="this-month">This Month</option>
                <option value="last-month">Last Month</option>
                <option value="this-year">This Year</option>
              </select>
            </div>

            <!-- Year Dropdown -->
            <div class="flex items-center gap-1.5">
              <label for="trx-hist-year-select" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Year:</label>
              <select id="trx-hist-year-select" onchange="handleTrxHistYearMonthChange()" class="border rounded-lg px-2.5 py-1.5 text-xs font-medium focus:outline-none text-gray-700 bg-white shadow-xs" style="border-color:rgba(212,178,112,.3);">
                <option value="all">All Years</option>
                <option value="2026">2026</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
              </select>
            </div>

            <!-- Month Dropdown -->
            <div class="flex items-center gap-1.5">
              <label for="trx-hist-month-select" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Month:</label>
              <select id="trx-hist-month-select" onchange="handleTrxHistYearMonthChange()" class="border rounded-lg px-2.5 py-1.5 text-xs font-medium focus:outline-none text-gray-700 bg-white shadow-xs" style="border-color:rgba(212,178,112,.3);">
                <option value="all">All Months (Full Year)</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
            </div>

            <!-- Reset Button -->
            <button type="button" onclick="clearTrxHistFilters()" class="text-xs text-gray-500 hover:text-brand-burgundy font-medium px-2.5 py-1.5 border rounded-lg bg-white hover:bg-brand-cream/30 transition cursor-pointer shadow-xs" title="Reset All Filters">Reset</button>
          </div>

          <!-- Active Period Label Badge -->
          <div class="flex items-center gap-2">
            <span class="text-[11px] font-medium text-gray-400">Active View:</span>
            <span id="trx-chart-period-badge" class="px-3 py-1 rounded-full text-xs font-bold bg-brand-burgundy text-white tracking-wide shadow-xs">All Time Overview</span>
          </div>
        </div>

        <!-- Chart Section Header -->
        <div class="px-6 pt-5 pb-2 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
          <div>
            <h4 class="text-base font-bold text-brand-burgundy font-serif flex items-center gap-2">
              <svg class="w-4 h-4 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
              <span>Completed UPI Revenue Analytics Graph</span>
            </h4>
            <p class="text-xs text-gray-400 mt-0.5" id="trx-chart-subtitle">Showing successful payment timeline and earnings distribution.</p>
          </div>
          <div class="flex items-center gap-3">
            <div class="flex items-center gap-1.5 text-xs font-medium text-gray-600">
              <span class="w-3 h-3 rounded-full bg-brand-burgundy inline-block"></span>
              <span>Completed Revenue (₹)</span>
            </div>
          </div>
        </div>

        <!-- Chart Canvas Container -->
        <div class="p-4 sm:p-6 pt-2 relative" style="min-height:360px;">
          <div class="w-full h-[320px] sm:h-[360px] relative">
            <canvas id="trx-analytics-chart"></canvas>
          </div>
          <div id="trx-chart-empty" class="absolute inset-0 flex flex-col items-center justify-center bg-white/95 text-gray-400 text-sm hidden z-10">
            <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            <span class="font-medium text-gray-500">No successful transactions found for the selected filter.</span>
            <span class="text-xs text-gray-400 mt-1">Try choosing another month or clicking Reset.</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══ MESSAGES / INQUIRIES ═══ -->
    <div id="view-messages" class="view fade-in" style="display:none;">
      <!-- Search & Date Filter Container -->
      <div class="bg-white rounded-xl border overflow-hidden" style="border-color:rgba(212,178,112,.18);box-shadow:0 2px 12px rgba(112,33,82,.06);">
        <div class="p-4 border-b flex flex-col sm:flex-row gap-3 items-center justify-between" style="border-color:rgba(212,178,112,.12);background:rgba(250,246,240,.5);">
          <div class="relative flex-1 w-full sm:w-auto">
            <svg class="h-4 w-4 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="messages-search" oninput="renderMessages()" placeholder="Search messages by name, phone, email, topic, message..." class="border rounded-lg pl-9 pr-3 py-2 text-xs focus:outline-none w-full" style="border-color:rgba(212,178,112,.3);">
          </div>
          <div class="flex items-center gap-2 w-full sm:w-auto">
            <label for="messages-date-filter" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Filter by Date:</label>
            <input type="date" id="messages-date-filter" onchange="renderMessages()" class="border rounded-lg px-3 py-2 text-xs focus:outline-none text-gray-600 bg-white" style="border-color:rgba(212,178,112,.3);">
            <button onclick="document.getElementById('messages-date-filter').value=''; renderMessages();" class="text-xs text-gray-400 hover:text-brand-burgundy font-medium px-2 py-1 border rounded bg-white hover:bg-brand-cream/30" title="Clear Date">Clear</button>
          </div>
        </div>

        <!-- Messages Table -->
        <div class="overflow-x-auto">
          <table class="admin-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Sender / Contact</th>
                <th>Email</th>
                <th>Inquiry Topic</th>
                <th>Message Content</th>
                <th>Date & Time</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="messages-tbody"></tbody>
          </table>
        </div>
        <div id="messages-table-empty" class="text-center py-12 text-gray-400 text-sm hidden">
          <svg class="h-10 w-10 text-brand-gold/40 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          No contact messages found matching your criteria.
        </div>
      </div>
    </div>

    <!-- ═══ SETTINGS ═══ -->
    <div id="view-settings" class="view">
      <div class="grid grid-cols-1 max-w-xl gap-6">
      <div class="bg-white border border-brand-gold/15 shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-brand-gold/15 bg-brand-cream/30">
          <h2 class="text-lg font-bold text-brand-burgundy font-serif">Change Password</h2>
          <p class="text-xs text-gray-500 mt-1">Update your login password securely</p>
        </div>
        <div class="p-6 space-y-4">
          <div>
            <label class="form-label">Current Password</label>
            <input type="password" id="cp-current" class="form-input" placeholder="Enter current password">
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="form-label">New Password</label>
              <input type="password" id="cp-new" class="form-input" placeholder="New password">
            </div>
            <div>
              <label class="form-label">Confirm Password</label>
              <input type="password" id="cp-confirm" class="form-input" placeholder="Confirm new password">
            </div>
          </div>
          <div class="pt-4 text-right">
            <button class="btn-primary" onclick="handleChangePassword()">Save Changes</button>
          </div>
        </div>
      </div>
      </div>
    </div>

  </main>
</div>

<!-- ── MODAL: Add / Edit Category ── -->
<div class="modal-overlay" id="modal-add-category" onclick="if(event.target===this)closeModal('modal-add-category')">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="font-serif text-lg font-bold text-white" id="cat-modal-title">Add New Category</h3>
      <button onclick="closeModal('modal-add-category')" class="text-white/60 hover:text-white">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <label class="form-label">Category Name *</label>
      <input type="text" id="new-cat-name" class="form-input" placeholder="e.g. Lehengas, Silk Sarees, Festive Edit…">
      
      <!-- Category Photo Upload with Live Preview -->
      <label class="form-label">Category Photo *</label>
      <div class="photo-preview" id="cat-photo-preview-box" onclick="document.getElementById('cat-photo-file-input').click()">
        <img id="cat-photo-preview-img" src="" alt="" style="display:none; width:100%; height:100%; object-fit:cover;">
        <div class="photo-placeholder" id="cat-photo-placeholder" style="text-align:center;">
          <svg class="h-8 w-8 mx-auto mb-2 opacity-40 text-brand-burgundy" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          <p class="text-xs font-semibold text-brand-burgundy">Click to upload category photo</p>
          <p class="text-[10px] text-gray-400 mt-0.5">JPG, PNG, WEBP</p>
        </div>
      </div>
      <input type="file" id="cat-photo-file-input" accept="image/*" style="display:none;" onchange="handleCatPhotoUpload(event)">
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal('modal-add-category')">Cancel</button>
      <button class="btn-primary" id="cat-modal-submit-btn" onclick="confirmSaveCategory()">Create Category</button>
    </div>
  </div>
</div>

<!-- ── MODAL: Add Sub-Category ── -->
<div class="modal-overlay" id="modal-add-subcategory" onclick="if(event.target===this)closeModal('modal-add-subcategory')">
  <div class="modal-box">
    <div class="modal-header">
      <h3 class="font-serif text-lg font-bold text-white">Add Sub-Category</h3>
      <button onclick="closeModal('modal-add-subcategory')" class="text-white/60 hover:text-white">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <label class="form-label">Category *</label>
      <select id="new-subcat-category" class="form-input form-select">
        <option value="">Select category…</option>
      </select>
      <label class="form-label mt-4">Sub-Category Name *</label>
      <input type="text" id="new-subcat-name" class="form-input" placeholder="e.g. Silk, Banarasi…">
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal('modal-add-subcategory')">Cancel</button>
      <button class="btn-primary" onclick="confirmAddSubcategory()">Save</button>
    </div>
  </div>
</div>

<!-- ── MODAL: Add/Edit Product ── -->
<div class="modal-overlay" id="modal-product" onclick="if(event.target===this)closeModal('modal-product')">
  <div class="modal-box" style="max-width:520px;">
    <div class="modal-header">
      <h3 class="font-serif text-lg font-bold text-white" id="product-modal-title">Add Product</h3>
      <button onclick="closeModal('modal-product')" class="text-white/60 hover:text-white">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body" style="max-height:70vh;overflow-y:auto;">

      <!-- Photo Upload -->
      <label class="form-label">Product Photo</label>
      <div class="photo-preview" id="photo-preview-box" onclick="document.getElementById('photo-file-input').click()">
        <img id="photo-preview-img" src="" alt="" style="display:none;">
        <div class="photo-placeholder" id="photo-placeholder">
          <svg class="h-8 w-8 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          <p class="text-xs opacity-60">Click to upload photo</p>
        </div>
      </div>
      <input type="file" id="photo-file-input" accept="image/*" style="display:none;" onchange="handlePhotoUpload(event)">

      <label class="form-label">Category *</label>
      <select id="product-category" class="form-input form-select" onchange="updateSubcatDropdown()">
        <option value="">Select category…</option>
      </select>

      <label class="form-label">Sub-Category</label>
      <select id="product-subcategory" class="form-input form-select">
        <option value="">Select sub-category…</option>
      </select>

      <label class="form-label">Product Name *</label>
      <input type="text" id="product-name" class="form-input" placeholder="e.g. Royal Crimson Banarasi Silk Saree">

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="form-label">Fabric</label>
          <input type="text" id="product-fabric" class="form-input" placeholder="e.g. Silk">
        </div>
        <div>
          <label class="form-label">Weave</label>
          <input type="text" id="product-weave" class="form-input" placeholder="e.g. Banarasi">
        </div>
      </div>

      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="form-label">Sale Price (₹) *</label>
          <input type="number" id="product-price" class="form-input" placeholder="e.g. 8499" min="0">
        </div>
        <div>
          <label class="form-label">Original Price (₹)</label>
          <input type="number" id="product-original-price" class="form-input" placeholder="e.g. 12999" min="0">
        </div>
        <div>
          <label class="form-label">Discount (%)</label>
          <input type="number" id="product-discount" class="form-input" placeholder="e.g. 35">
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal('modal-product')">Cancel</button>
      <button class="btn-primary" onclick="confirmSaveProduct()">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        Save Product
      </button>
    </div>
  </div>
</div>

<!-- ── MODAL: Edit Item Name ── -->
<div class="modal-overlay" id="modal-edit-item" onclick="if(event.target===this)closeModal('modal-edit-item')">
  <div class="modal-box" style="max-width:380px;">
    <div class="modal-header">
      <h3 class="font-serif text-base font-bold text-white">Edit Item Name</h3>
      <button onclick="closeModal('modal-edit-item')" class="text-white/60 hover:text-white">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <label class="form-label">Item Name *</label>
      <input type="text" id="edit-item-value" class="form-input">
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal('modal-edit-item')">Cancel</button>
      <button class="btn-primary" onclick="confirmEditItem()">Save Changes</button>
    </div>
  </div>
</div>

<!-- ── MODAL: View Message Details ── -->
<div class="modal-overlay" id="modal-view-message" onclick="if(event.target===this)closeModal('modal-view-message')">
  <div class="modal-box" style="max-width:600px;">
    <div class="modal-header">
      <h3 class="font-serif text-lg font-bold text-white">Customer Inquiry Details</h3>
      <button onclick="closeModal('modal-view-message')" class="text-white/60 hover:text-white">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-body" style="max-height:75vh;overflow-y:auto;">
      <!-- Sender details block -->
      <div class="p-4 rounded-lg mb-4 border" style="background:rgba(250,246,240,0.6);border-color:rgba(212,178,112,0.25);">
        <div class="mb-3 pb-2 border-b border-brand-gold/15">
          <h4 class="font-serif text-base font-bold text-brand-burgundy" id="msg-detail-name">—</h4>
          <span class="text-[11px] text-gray-400" id="msg-detail-date">—</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
          <div>
            <span class="text-gray-400 block text-[10px] uppercase font-semibold">Phone</span>
            <span id="msg-detail-phone" class="font-medium text-brand-charcoal">—</span>
          </div>
          <div>
            <span class="text-gray-400 block text-[10px] uppercase font-semibold">Email</span>
            <span id="msg-detail-email" class="font-medium text-brand-charcoal">—</span>
          </div>
          <div class="sm:col-span-2">
            <span class="text-gray-400 block text-[10px] uppercase font-semibold">Inquiry Topic</span>
            <span id="msg-detail-subject" class="font-semibold text-brand-burgundy">—</span>
          </div>
        </div>
      </div>

      <!-- Message Content -->
      <label class="form-label">Full Message</label>
      <div class="p-4 rounded-lg bg-white border border-brand-gold/20 text-xs text-brand-charcoal leading-relaxed whitespace-pre-wrap font-sans shadow-inner" id="msg-detail-body" style="min-height:110px;">
        —
      </div>
    </div>
    <div class="modal-footer flex flex-wrap gap-2 justify-between items-center">
      <div class="flex gap-2">
        <a id="msg-whatsapp-btn" href="#" target="_blank" class="px-3 py-1.5 text-xs font-semibold rounded bg-green-600 hover:bg-green-700 text-white flex items-center gap-1.5 transition shadow-sm">
          <span>Reply on WhatsApp</span>
        </a>
        <a id="msg-email-btn" href="#" class="px-3 py-1.5 text-xs font-semibold rounded bg-brand-burgundy hover:bg-brand-burgundyLight text-white flex items-center gap-1.5 transition shadow-sm">
          <span>Reply via Email</span>
        </a>
      </div>
      <div>
        <button class="btn-cancel" onclick="closeModal('modal-view-message')">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- ── MODAL: View Full Order Details ── -->
<div class="modal-overlay" id="modal-view-order" onclick="if(event.target===this)closeModal('modal-view-order')">
  <div class="modal-box" style="max-width:680px; max-height:90vh; overflow-y:auto;">
    <div class="modal-header flex justify-between items-center bg-gradient-to-r from-brand-burgundy to-brand-burgundyLight text-white px-6 py-4">
      <div>
        <div class="flex items-center gap-2.5">
          <h3 class="font-serif text-lg font-bold text-white" id="order-detail-modal-id">Order Details</h3>
          <span id="order-detail-modal-badge" class="px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-brand-gold/40 text-white">Processing</span>
        </div>
        <p class="text-[11px] text-white/80 mt-0.5" id="order-detail-modal-date">Placed on —</p>
      </div>
      <button onclick="closeModal('modal-view-order')" class="text-white/70 hover:text-white p-1 rounded-md hover:bg-white/10 transition">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <div class="modal-body p-6 space-y-5 text-xs text-brand-charcoal">
      
      <!-- Customer & Delivery Info Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Customer Info Card -->
        <div class="bg-brand-cream/40 p-4 rounded-xl border border-brand-gold/20 space-y-2">
          <div class="flex items-center gap-2 text-brand-burgundy font-bold text-xs uppercase tracking-wider pb-1 border-b border-brand-gold/15">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span>Customer Details</span>
          </div>
          <div><span class="text-gray-400">Name:</span> <strong id="order-modal-cust-name" class="text-brand-charcoal font-semibold ml-1">—</strong></div>
          <div><span class="text-gray-400">Phone:</span> <a id="order-modal-cust-phone" href="#" class="text-brand-burgundy font-semibold hover:underline ml-1">—</a></div>
          <div><span class="text-gray-400">Email:</span> <a id="order-modal-cust-email" href="#" class="text-brand-burgundy font-semibold hover:underline ml-1">—</a></div>
        </div>

        <!-- Shipping Address Card -->
        <div class="bg-brand-cream/40 p-4 rounded-xl border border-brand-gold/20 space-y-2">
          <div class="flex items-center gap-2 text-brand-burgundy font-bold text-xs uppercase tracking-wider pb-1 border-b border-brand-gold/15">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span>Delivery Address</span>
          </div>
          <div><span class="text-gray-400">Address:</span> <span id="order-modal-cust-address" class="font-medium ml-1">—</span></div>
          <div><span class="text-gray-400">City / State:</span> <span id="order-modal-cust-city" class="font-medium ml-1">—</span></div>
          <div><span class="text-gray-400">Pincode:</span> <span id="order-modal-cust-pincode" class="font-semibold text-brand-burgundy ml-1">—</span></div>
        </div>
      </div>

      <!-- Items Ordered -->
      <div>
        <h4 class="font-serif text-xs font-bold text-brand-burgundy uppercase tracking-wider mb-2 flex items-center justify-between">
          <span>Items in Order (<span id="order-modal-items-count">0</span>)</span>
        </h4>
        <div class="border border-brand-gold/20 rounded-xl overflow-hidden bg-white">
          <div id="order-modal-items-list" class="divide-y divide-brand-gold/10">
            <!-- Items rendered dynamically -->
          </div>
        </div>
      </div>

      <!-- Financial Breakdown & Payment Mode -->
      <div class="bg-white p-4 rounded-xl border border-brand-gold/20 space-y-2">
        <div class="flex justify-between items-center text-xs">
          <span class="text-gray-500">Items Subtotal:</span>
          <span id="order-modal-subtotal" class="font-semibold text-brand-charcoal">₹ 0</span>
        </div>
        <div class="flex justify-between items-center text-xs">
          <span class="text-gray-500">Shipping Charges:</span>
          <span id="order-modal-shipping" class="font-semibold text-green-700">Free</span>
        </div>
        <div id="order-modal-discount-row" class="flex justify-between items-center text-xs text-brand-burgundy font-semibold">
          <span>Coupon Discount:</span>
          <span id="order-modal-discount">- ₹ 0</span>
        </div>
        <div class="flex justify-between items-center text-sm font-bold pt-2 border-t border-brand-gold/15">
          <span class="text-brand-burgundy font-serif">Grand Total:</span>
          <span id="order-modal-grandtotal" class="text-brand-burgundy text-base">₹ 0</span>
        </div>
      </div>

      <!-- Order Status Update Action (Shown only in Orders view) -->
      <div id="order-modal-status-box" class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 p-3.5 bg-brand-cream/30 border border-brand-gold/20 rounded-xl">
        <div class="flex items-center gap-2">
          <label for="order-modal-status-select" class="font-bold text-brand-burgundy text-xs uppercase tracking-wider">Change Status:</label>
          <select id="order-modal-status-select" class="border border-brand-gold/30 rounded px-3 py-1.5 text-xs font-semibold focus:outline-none focus:border-brand-burgundy bg-white">
            <option value="Processing">Processing</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Shipped">Shipped</option>
            <option value="Delivered">Delivered</option>
            <option value="Cancelled">Cancelled</option>
          </select>
        </div>
        <button id="order-modal-save-status-btn" onclick="saveOrderStatusFromModal()" class="btn-primary text-xs py-1.5 px-4 rounded">
          Save Status
        </button>
      </div>

    </div>

    <div class="modal-footer flex justify-end items-center p-4 border-t border-brand-gold/15 bg-brand-cream/20">
      <button class="btn-cancel" onclick="closeModal('modal-view-order')">Close</button>
    </div>
  </div>
</div>

<script src="js/products.js"></script>
<script>
  // ── Auth Guard ──
  // Auth handled by check_auth.php at the top
  document.getElementById('admin-name').textContent = 'admin';

  // ── Default Categories ──
  const DEFAULT_CATEGORIES = [
    { id: 'sarees', name: 'Sarees', icon: '🥻', desc: 'Premium handcrafted sarees from across India',
      groups: [
        { id: 'g-sarees-fabric', name: 'Fabric', items: ['Mulberry Silk','Organza','Linen','Cotton Mulmul','Tissue Silk'] },
        { id: 'g-sarees-weave', name: 'Weave Technique', items: ['Banarasi Zari','Kanjivaram Weave','Chanderi Border','Jamdani Inlay','Tussar Print'] },
        { id: 'g-sarees-color', name: 'Color', items: ['Crimson & Reds','Golden Shimmers','Pastel Blends','Sunlit Yellows','Emerald Greens','Indigo Blues','Ivory & Off-White'] },
        { id: 'g-sarees-price', name: 'Price Range', items: ['Under ₹2,000','₹2,000 – ₹5,000','Above ₹5,000'] }
      ]
    },
    { id: 'kurtas', name: 'Kurtas & Suits', icon: '👗', desc: 'Elegant kurta sets and suit collections',
      groups: [
        { id: 'g-kurtas-type', name: 'Kurta Type', items: ['Anarkali','A-Line','Straight Kurta','Short Kurti','Suit Sets'] },
        { id: 'g-kurtas-fabric', name: 'Fabric', items: ['Cotton','Silk Blend','Chanderi','Georgette','Khadi'] },
        { id: 'g-kurtas-color', name: 'Color', items: ['Red & Wine','Mustard Yellow','Mint & Sage','Indigo Blue','Pastel Pink','Olive Green'] },
        { id: 'g-kurtas-price', name: 'Price Range', items: ['Under ₹2,000','₹2,000 – ₹4,000','Above ₹4,000'] }
      ]
    },
    { id: 'dress-materials', name: 'Dress Materials', icon: '🧵', desc: 'Fine unstitched fabrics for custom styling',
      groups: [{ id: 'g-dm-fabric', name: 'Fabric', items: ['Cotton','Silk','Chanderi','Linen','Georgette'] }]
    },
    { id: 'blouses', name: 'Blouses', icon: '✂️', desc: 'Designer blouses to complement your sarees',
      groups: [{ id: 'g-bl-type', name: 'Type', items: ['Silk Blouses','Brocade','Velvet','Cotton','Embroidered'] }]
    },
    { id: 'short-kurtis', name: 'Short Kurtis & Tops', icon: '👚', desc: 'Trendy short kurtis and fusion tops',
      groups: [{ id: 'g-sk-style', name: 'Style', items: ['Khadi','Cotton Printed','Block Print','Embroidered','Tie-Dye'] }]
    },
    { id: 'new-arrivals', name: 'New Arrivals', icon: '✨', desc: 'Latest additions to our collection',
      groups: [{ id: 'g-na-season', name: 'Season', items: ['Summer 2025','Wedding Season','Festive Edit','Casual Wear'] }]
    },
    { id: 'sale', name: 'Sale', icon: '🏷️', desc: 'Exclusive discounts on premium pieces',
      groups: [{ id: 'g-sale-disc', name: 'Discount', items: ['Up to 30% off','Up to 37% off','Clearance','Limited Time Deals'] }]
    },
    { id: 'gifting', name: 'Gifting', icon: '🎁', desc: 'Curated gifting sets for every occasion',
      groups: [{ id: 'g-gift-type', name: 'Gift Type', items: ['Wedding Gifts','Festival Hampers','Custom Packaging','Gift Cards'] }]
    },
    { id: 'collections', name: 'Collections', icon: '🌸', desc: 'Thematic collections across seasons',
      groups: [{ id: 'g-col-name', name: 'Collection Name', items: ['Summer Solstice','Banarasi Jaal','Shimmering Tissue','Heritage Weaves','Yazhagam'] }]
    },
  ];

  // ── State ──
  let categories = loadCategories();
  let adminProducts = loadAdminProducts();
  let adminOrders = [];
  let currentCategoryId = null;
  let editingProductId = null;
  let editItemTarget = null; // { catId, groupId, itemIdx }
  let photoDataUrl = null;

  function loadCategories() {
    const s = localStorage.getItem('raga_admin_categories_v2');
    if (s) { try { return JSON.parse(s); } catch(e){} }
    return JSON.parse(JSON.stringify(DEFAULT_CATEGORIES));
  }
  function saveCategories() { 
    try {
      localStorage.setItem('raga_admin_categories_v2', JSON.stringify(categories));
    } catch(e) {
      console.warn('localStorage quota warning on saveCategories:', e);
    }
  }

  function loadAdminProducts() {
    const s = localStorage.getItem('raga_admin_products_v2');
    if (s) { try { return JSON.parse(s); } catch(e){} }
    if (typeof PRODUCTS !== 'undefined') {
      return JSON.parse(JSON.stringify(PRODUCTS));
    }
    return [];
  }
  function saveAdminProducts() { 
    try {
      localStorage.setItem('raga_admin_products_v2', JSON.stringify(adminProducts));
    } catch(e) {
      console.warn('localStorage quota warning on saveAdminProducts:', e);
    }
  }

  function compressImage(file, maxDimension, quality, callback) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const img = new Image();
      img.onload = function() {
        let width = img.width;
        let height = img.height;
        if (width > height) {
          if (width > maxDimension) {
            height = Math.round((height * maxDimension) / width);
            width = maxDimension;
          }
        } else {
          if (height > maxDimension) {
            width = Math.round((width * maxDimension) / height);
            height = maxDimension;
          }
        }
        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0, width, height);
        const dataUrl = canvas.toDataURL('image/jpeg', quality);
        callback(dataUrl);
      };
      img.onerror = function() {
        callback(e.target.result);
      };
      img.src = e.target.result;
    };
    reader.onerror = function() {
      console.error('File reading error');
    };
    reader.readAsDataURL(file);
  }

  // ── Helpers ──
  function esc(str) {
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }
  function uid() { return Date.now().toString(36) + Math.random().toString(36).slice(2,5); }
  function getCat(id) { return categories.find(c => c.id === id); }

  // ── Modal ──
  function openModal(id) { document.getElementById(id).classList.add('open'); }
  function closeModal(id) { document.getElementById(id).classList.remove('open'); }

  // ── View Switching ──
  function switchView(view) {
    if (window.location.hash !== '#' + view) {
      window.history.replaceState(null, null, '#' + view);
    }
    document.querySelectorAll('.view').forEach(v => { v.classList.remove('active'); v.style.display = 'none'; });
    document.querySelectorAll('.nav-item, .nav-subitem').forEach(n => n.classList.remove('active'));
    
    const viewEl = document.getElementById('view-' + view);
    if (viewEl) {
      viewEl.classList.add('active');
      viewEl.style.display = '';
    }
    const navEl = document.getElementById('nav-' + view);
    if (navEl) {
      navEl.classList.add('active');
    }

    // Auto expand Transactions dropdown if viewing transactions or transaction-history
    const submenu = document.getElementById('transactions-submenu');
    const chevron = document.getElementById('transactions-chevron');
    if (view === 'transactions' || view === 'transaction-history') {
      if (submenu) submenu.classList.remove('hidden');
      if (chevron) chevron.style.transform = 'rotate(180deg)';
      document.getElementById('nav-transactions-parent')?.classList.add('active');
    } else {
      document.getElementById('nav-transactions-parent')?.classList.remove('active');
    }
    
    const titles = { 
      dashboard: ['Dashboard', 'Raga Boutique Admin Panel'], 
      products: ['Products', 'Manage your product catalog'],
      categories: ['Categories', 'Manage your product categories'],
      orders: ['Orders Management', 'Track, filter, update statuses, and view customer order details.'],
      transactions: ['Transactions', 'Overview of all real-time transactions across payment states.'],
      'transaction-history': ['Transaction History', 'Archive of verified and successful payments with downloadable CSV reports.'],
      messages: ['Messages & Inquiries', 'View and track all customer contact messages submitted on the website.'],
      settings: ['Settings', 'Manage boutique configurations.']
    };
    document.getElementById('page-title').textContent = titles[view] ? titles[view][0] : 'Dashboard';
    document.getElementById('page-subtitle').textContent = titles[view] ? titles[view][1] : '';
    
    const search1 = document.getElementById('table-search');
    const search2 = document.getElementById('dashboard-table-search');
    if (search1) search1.value = '';
    if (search2) search2.value = '';

    if (view === 'categories') renderCategoryGrid();
    if (view === 'products' || view === 'dashboard') {
      renderTable(adminProducts);
      updateStats();
    }
    if (view === 'orders') renderOrders();
    if (view === 'transactions') renderTransactions();
    if (view === 'transaction-history') {
      renderTransactionHistory();
      setTimeout(renderTransactionHistory, 50);
    }
    if (view === 'messages') renderMessages();
  }

  function toggleTransactionsDropdown(e) {
    if (e) e.preventDefault();
    const submenu = document.getElementById('transactions-submenu');
    const chevron = document.getElementById('transactions-chevron');
    if (!submenu) return;
    const isHidden = submenu.classList.contains('hidden');
    if (isHidden) {
      submenu.classList.remove('hidden');
      if (chevron) chevron.style.transform = 'rotate(180deg)';
    } else {
      submenu.classList.add('hidden');
      if (chevron) chevron.style.transform = 'rotate(0deg)';
    }
  }

  function createNewProductAndEdit() {
    editingProductId = null;
    photoDataUrl = null;
    document.getElementById('product-modal-title').textContent = 'Add Product';
    document.getElementById('product-category').value = '';
    updateSubcatDropdown();
    document.getElementById('product-subcategory').value = '';
    document.getElementById('product-name').value = '';
    document.getElementById('product-fabric').value = '';
    document.getElementById('product-weave').value = '';
    document.getElementById('product-price').value = '';
    document.getElementById('product-original-price').value = '';
    document.getElementById('product-discount').value = '';
    document.getElementById('photo-preview-img').style.display = 'none';
    document.getElementById('photo-placeholder').style.display = '';
    
    openModal('modal-product');
  }
  function handleLogout() {
    sessionStorage.removeItem('raga_admin_auth');
    sessionStorage.removeItem('raga_admin_user');
    window.location.href = 'index.php';
  }

  // ═══════════════════════════════════════
  // ── CATEGORY GRID & MANAGEMENT ──
  // ═══════════════════════════════════════
  let editingCategoryId = null;
  let catPhotoDataUrl = null;

  function renderCategoryGrid() {
    const grid = document.getElementById('categories-grid');
    if (!grid) return;
    grid.innerHTML = categories.map(cat => {
      const prodCount = adminProducts.filter(p => String(p.category).trim() === String(cat.id).trim()).length;
      const catImage = cat.image || 'images/img-saree-red.jpg';
      return `
        <div class="cat-box fade-in" style="position: relative; padding: 16px; display: flex; flex-direction: column; justify-content: space-between;">
          <!-- Top-Right Action Buttons: Icon-Only Edit and Delete -->
          <div style="position: absolute; top: 12px; right: 12px; display: flex; gap: 6px; z-index: 20;">
            <button type="button" class="btn-icon-edit" onclick="openEditCategory('${cat.id}', event)" title="Edit Category">
              <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            </button>
            <button type="button" class="btn-icon-del" onclick="deleteCategory('${cat.id}', event)" title="Delete Category">
              <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>

          <!-- Category Info Clickable Area -->
          <div onclick="drillIntoCategory('${cat.id}')" style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
            <img src="${catImage}" alt="${esc(cat.name)}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(212,178,112,0.3); flex-shrink: 0; background: #2d0921;">
            <div style="flex: 1; min-width: 0; padding-right: 68px;">
              <h3 class="font-serif text-base font-bold text-brand-burgundy truncate hover:text-brand-burgundy/80 transition-colors" title="${esc(cat.name)}">${esc(cat.name)}</h3>
              <span class="text-xs text-gray-400 flex items-center gap-1 mt-0.5">
                <svg class="h-3.5 w-3.5 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4"/></svg>
                ${prodCount} product${prodCount !== 1 ? 's' : ''}
              </span>
            </div>
          </div>

          <!-- Bottom Drill-In Link -->
          <div onclick="drillIntoCategory('${cat.id}')" style="margin-top: 14px; pt: 8px; border-top: 1px solid rgba(212,178,112,0.12); display: flex; align-items: center; justify-content: space-between; cursor: pointer;">
            <span class="text-[11px] font-semibold text-brand-gold hover:underline">Manage Products</span>
            <span class="text-xs text-brand-gold">→</span>
          </div>
        </div>
      `;
    }).join('');

    // Update category filter dropdown
    const sel = document.getElementById('table-cat-filter');
    if (sel) {
      sel.innerHTML = '<option value="">All Categories</option>' +
        categories.map(c => `<option value="${c.id}">${esc(c.name)}</option>`).join('');
    }
    const sel2 = document.getElementById('product-category');
    if (sel2) {
      sel2.innerHTML = '<option value="">Select category…</option>' +
        categories.map(c => `<option value="${c.id}">${esc(c.name)}</option>`).join('');
    }
  }

  function openAddCategoryModal() {
    editingCategoryId = null;
    catPhotoDataUrl = null;
    document.getElementById('cat-modal-title').textContent = 'Add New Category';
    document.getElementById('cat-modal-submit-btn').textContent = 'Create Category';
    document.getElementById('new-cat-name').value = '';
    document.getElementById('cat-photo-file-input').value = '';
    document.getElementById('cat-photo-preview-img').src = '';
    document.getElementById('cat-photo-preview-img').style.display = 'none';
    document.getElementById('cat-photo-placeholder').style.display = '';
    openModal('modal-add-category');
  }

  function openEditCategory(catId, event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    const cat = getCat(catId) || categories.find(c => String(c.id).trim() === String(catId).trim());
    if (!cat) return;
    editingCategoryId = cat.id;
    catPhotoDataUrl = cat.image || '';
    document.getElementById('cat-modal-title').textContent = 'Edit Category';
    document.getElementById('cat-modal-submit-btn').textContent = 'Save Changes';
    document.getElementById('new-cat-name').value = cat.name;
    document.getElementById('cat-photo-file-input').value = '';
    
    if (catPhotoDataUrl) {
      document.getElementById('cat-photo-preview-img').src = catPhotoDataUrl;
      document.getElementById('cat-photo-preview-img').style.display = '';
      document.getElementById('cat-photo-placeholder').style.display = 'none';
    } else {
      document.getElementById('cat-photo-preview-img').src = '';
      document.getElementById('cat-photo-preview-img').style.display = 'none';
      document.getElementById('cat-photo-placeholder').style.display = '';
    }
    openModal('modal-add-category');
  }

  function handleCatPhotoUpload(e) {
    const file = e.target.files[0];
    if (!file) return;
    compressImage(file, 800, 0.82, function(dataUrl) {
      catPhotoDataUrl = dataUrl;
      const preview = document.getElementById('cat-photo-preview-img');
      const placeholder = document.getElementById('cat-photo-placeholder');
      if (preview) {
        preview.src = catPhotoDataUrl;
        preview.style.display = 'block';
      }
      if (placeholder) {
        placeholder.style.display = 'none';
      }
    });
  }

  // ─ Save Category (Add / Edit) ─
  async function confirmSaveCategory() {
    const name = document.getElementById('new-cat-name').value.trim();
    if (!name) {
      alert('Please enter a category name.');
      document.getElementById('new-cat-name').focus();
      return;
    }

    let image = catPhotoDataUrl || '';
    if (!image) {
      if (editingCategoryId) {
        const existing = getCat(editingCategoryId);
        image = existing && existing.image ? existing.image : 'images/img-saree-red.jpg';
      } else {
        image = 'images/img-saree-red.jpg';
      }
    }

    if (editingCategoryId) {
      // Update existing category
      const existing = getCat(editingCategoryId);
      if (existing) {
        existing.name = name;
        existing.image = image;
      }

      const payload = {
        id: editingCategoryId,
        name: name,
        image: image,
        icon: existing ? (existing.icon || '✨') : '✨',
        groups: existing ? (existing.groups || []) : []
      };

      saveCategories();

      try {
        await fetch('api/save_category.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });
      } catch (e) {
        console.warn('Could not update category on server API:', e);
      }
    } else {
      // Add new category at the very first
      const id = name.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '') + '-' + uid();
      const newCat = { id, name, image, icon: '✨', groups: [] };

      categories.unshift(newCat);
      saveCategories();

      try {
        await fetch('api/save_category.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(newCat)
        });
      } catch (e) {
        console.warn('Could not save category on server API:', e);
      }
    }

    renderCategoryGrid();
    closeModal('modal-add-category');
    populateCategoryDropdowns();
    updateStats();
  }

  async function deleteCategory(catId, event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    if (!confirm('Are you sure you want to delete this category? All sub-categories and products in this category will also be permanently deleted.')) return;
    
    const cleanId = String(catId).trim();

    // 1. Remove category and its subcategories from memory
    categories = categories.filter(c => String(c.id).trim().toLowerCase() !== cleanId.toLowerCase());
    
    // 2. Remove all products belonging to this category from memory
    adminProducts = adminProducts.filter(p => String(p.category).trim().toLowerCase() !== cleanId.toLowerCase());
    
    // 3. Save to localStorage immediately
    saveCategories();
    saveAdminProducts();
    
    // 4. Re-render UI immediately
    renderCategoryGrid();
    renderTable(adminProducts);
    populateCategoryDropdowns();
    updateStats();

    // 5. Call server API to delete from MySQL database
    try {
      await fetch('api/delete_category.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: cleanId })
      });
    } catch (e) {
      console.warn('Could not delete category on server API:', e);
    }
  }

  // ═══════════════════════════════════════
  // ── CATEGORY CLICK ──
  // ═══════════════════════════════════════
  function drillIntoCategory(catId) {
    switchView('products');
    const prodFilter = document.getElementById('table-cat-filter');
    if (prodFilter) {
      prodFilter.value = catId;
      filterTable();
    }
  }

  // ═══════════════════════════════════════
  // ── PRODUCT CRUD ──
  // ═══════════════════════════════════════

  function updateSubcatDropdown() {
    const catId = document.getElementById('product-category').value;
    const sel = document.getElementById('product-subcategory');
    if (!sel) return;
    if (!catId) {
      sel.innerHTML = '<option value="">Select sub-category…</option>';
      return;
    }
    const cat = getCat(catId);
    if (!cat) return;
    
    if (!cat.groups) cat.groups = [];
    
    let html = '<option value="">Select sub-category…</option>';
    cat.groups.forEach(g => {
      html += `<option value="${esc(g)}">${esc(g)}</option>`;
    });
    sel.innerHTML = html;
  }

  async function confirmAddSubcategory() {
    const catId = document.getElementById('new-subcat-category').value;
    const subName = document.getElementById('new-subcat-name').value.trim();
    if (!catId || !subName) {
      alert('Please select a category and enter a sub-category name.');
      return;
    }
    const cat = getCat(catId);
    if (!cat) return;
    if (!cat.groups) cat.groups = [];
    if (!cat.groups.includes(subName)) {
      cat.groups.unshift(subName);
      saveCategories();

      try {
        await fetch('api/save_category.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            id: cat.id,
            name: cat.name,
            image: cat.image || '',
            icon: cat.icon || '✨',
            groups: cat.groups
          })
        });
      } catch (e) {
        console.warn('Could not save subcategory to server API:', e);
      }
    }
    closeModal('modal-add-subcategory');
    document.getElementById('new-subcat-category').value = '';
    document.getElementById('new-subcat-name').value = '';
    updateSubcatDropdown();
  }

  function openEditProduct(id) {
    const p = adminProducts.find(x => x.id === id);
    if (!p) return;
    editingProductId = id;
    photoDataUrl = p.image || p.photo || null;
    document.getElementById('product-modal-title').textContent = 'Edit Product';
    document.getElementById('product-category').value = p.category || '';
    updateSubcatDropdown();
    document.getElementById('product-subcategory').value = p.subcategory || '';
    document.getElementById('product-name').value = p.name || '';
    document.getElementById('product-fabric').value = p.fabric || '';
    document.getElementById('product-weave').value = p.weave || '';
    document.getElementById('product-price').value = p.price || '';
    document.getElementById('product-original-price').value = p.originalPrice || '';
    document.getElementById('product-discount').value = p.discount || (p.offer ? parseInt(p.offer) : '') || '';
    if (photoDataUrl) {
      document.getElementById('photo-preview-img').src = photoDataUrl;
      document.getElementById('photo-preview-img').style.display = '';
      document.getElementById('photo-placeholder').style.display = 'none';
    } else {
      document.getElementById('photo-preview-img').style.display = 'none';
      document.getElementById('photo-placeholder').style.display = '';
    }
    openModal('modal-product');
  }

  function handlePhotoUpload(e) {
    const file = e.target.files[0];
    if (!file) return;
    compressImage(file, 900, 0.82, function(dataUrl) {
      photoDataUrl = dataUrl;
      const preview = document.getElementById('photo-preview-img');
      const placeholder = document.getElementById('photo-placeholder');
      if (preview) {
        preview.src = photoDataUrl;
        preview.style.display = 'block';
      }
      if (placeholder) {
        placeholder.style.display = 'none';
      }
    });
  }

  async function confirmSaveProduct() {
    const nameEl = document.getElementById('product-name');
    const catEl = document.getElementById('product-category');
    const subcatEl = document.getElementById('product-subcategory');
    const priceEl = document.getElementById('product-price');
    const origPriceEl = document.getElementById('product-original-price');
    const discountEl = document.getElementById('product-discount');
    const fabricEl = document.getElementById('product-fabric');
    const weaveEl = document.getElementById('product-weave');

    const name = nameEl ? nameEl.value.trim() : '';
    const category = catEl ? catEl.value.trim() : '';
    const subcategory = subcatEl ? subcatEl.value.trim() : '';
    const price = priceEl ? priceEl.value.trim() : '';

    if (!name || !category || !price) {
      alert('Please fill in Category, Product Name, and Price.');
      return;
    }

    const priceNum = Number(price) || 0;
    const origPriceNum = origPriceEl && origPriceEl.value ? Number(origPriceEl.value) : priceNum;
    const discountNum = discountEl && discountEl.value ? Number(discountEl.value) : 0;
    const fabricVal = fabricEl && fabricEl.value.trim() ? fabricEl.value.trim() : 'Handloom';
    const weaveVal = weaveEl && weaveEl.value.trim() ? weaveEl.value.trim() : 'Traditional Weave';

    const product = {
      id: editingProductId || uid(),
      name,
      category,
      subcategory,
      price: priceNum,
      originalPrice: origPriceNum,
      discount: discountNum,
      image: photoDataUrl || 'images/img-saree-red.jpg',
      hover_image: photoDataUrl || 'images/img-saree-red.jpg',
      fabric: fabricVal,
      weave: weaveVal,
      color: '',
      rating: 5,
      reviews: 0,
      description: "A beautiful handcrafted piece from Raga Boutique.",
      highlights: ["Premium Quality", "Authentic Handloom"]
    };

    // 1. Update in-memory array immediately
    if (editingProductId) {
      const idx = adminProducts.findIndex(x => String(x.id).trim() === String(editingProductId).trim());
      if (idx > -1) {
        adminProducts[idx] = product;
      } else {
        adminProducts.unshift(product);
      }
    } else {
      adminProducts.unshift(product);
    }

    // 2. Persist to localStorage safely and re-render UI
    saveAdminProducts();
    closeModal('modal-product');
    updateStats();
    filterTable();
    renderCategoryGrid();

    // 3. Save to server MySQL database
    try {
      const response = await fetch('api/save_product.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(product)
      });
      const data = await response.json();
      if (!data.success) {
        console.warn('Backend product save notice:', data.message);
      }
    } catch(e) {
      console.warn('Network issue while saving product to server:', e);
    }
  }

  async function deleteProduct(id, event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    if (!confirm('Are you sure you want to delete this product?')) return;

    // Immediately remove from local memory and UI
    adminProducts = adminProducts.filter(p => String(p.id).trim() !== String(id).trim());
    saveAdminProducts();
    updateStats();
    filterTable();
    renderCategoryGrid();

    try {
      const response = await fetch('api/delete_product.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      });
      const data = await response.json();
      if (!data.success) {
        console.warn('Backend delete product warning:', data.message);
      }
    } catch(e) {
      console.warn('Network issue on delete product:', e);
    }
  }

  // ─ Tables ─
  function filterTable() {
    const activeView = document.querySelector('.view.active')?.id || 'view-products';
    const prefix = activeView === 'view-dashboard' ? 'dashboard-' : '';
    
    const searchEl = document.getElementById(prefix + 'table-search');
    const catEl = document.getElementById(prefix + 'table-cat-filter');
    if (!searchEl || !catEl) return;
    
    const q = searchEl.value.toLowerCase();
    const cat = catEl.value;
    let list = adminProducts;
    if (cat) list = list.filter(p => String(p.category).toLowerCase() === String(cat).toLowerCase());
    if (q) list = list.filter(p => p.name.toLowerCase().includes(q) || (p.subcategory||'').toLowerCase().includes(q));
    
    renderTableForPrefix(list, prefix);
  }

  function renderTable(products) {
    renderTableForPrefix(products, '');
    renderTableForPrefix(products, 'dashboard-');
  }

  function renderTableForPrefix(products, prefix) {
    const tbody = document.getElementById(prefix + 'products-tbody');
    const empty = document.getElementById(prefix + 'table-empty');
    if (!tbody || !empty) return;
    if (!products || products.length === 0) { tbody.innerHTML = ''; empty.classList.remove('hidden'); return; }
    empty.classList.add('hidden');
    tbody.innerHTML = products.map((p, i) => {
      const catName = (getCat(p.category) || {}).name || p.category;
      const isLiked = p.is_liked === true || (typeof isProductLiked === 'function' && isProductLiked(p.id));
      return `<tr>
        <td class="text-gray-400 font-mono text-xs">${i+1}</td>
        <td>${(p.image || p.photo) ? `<img src="${p.image || p.photo}" class="h-10 w-10 object-cover rounded-lg border border-brand-gold/20">` : '<div class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-300 text-xs">—</div>'}</td>
        <td><div class="font-medium text-sm" style="max-width:200px;">${esc(p.name)}</div><div class="text-xs text-gray-400">${esc(p.subcategory||'')}</div></td>
        <td><span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold" style="background:rgba(112,33,82,.1);color:#702152;">${esc(catName)}</span></td>
        <td>
          <div class="font-semibold text-brand-burgundy">₹${Number(p.price).toLocaleString('en-IN')}</div>
          ${p.originalPrice ? `<div class="text-xs text-gray-400 line-through">₹${Number(p.originalPrice).toLocaleString('en-IN')}</div>` : ''}
        </td>
        <td>${p.discount ? `<span class="text-xs font-bold text-green-700">${esc(p.discount)}% OFF</span>` : (p.offer ? `<span class="text-xs font-bold text-green-700">${esc(p.offer)}</span>` : '—')}</td>
        <td class="text-center">
          <button type="button" 
            onclick="toggleAdminProductLike('${p.id}', event)" 
            class="p-1.5 rounded-full hover:bg-brand-burgundy/10 transition duration-200 inline-flex items-center justify-center"
            title="${isLiked ? 'Featured in New Arrivals (Click to remove)' : 'Click to feature in New Arrivals'}">
            <svg class="w-5 h-5 transition-all duration-200 ${isLiked ? 'text-[#e11d48] scale-110' : 'text-gray-300 hover:text-brand-burgundy'}" 
              fill="${isLiked ? '#e11d48' : 'none'}" 
              stroke="${isLiked ? '#e11d48' : 'currentColor'}" 
              stroke-width="2" 
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
          </button>
        </td>
        <td><div class="flex gap-2"><button type="button" class="btn-edit" onclick="openEditProduct('${p.id}', event)">Edit</button><button type="button" class="btn-del" onclick="deleteProduct('${p.id}', event)">Delete</button></div></td>
      </tr>`;
    }).join('');
  }

  async function toggleAdminProductLike(id, event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    const cleanId = String(id).trim();
    const prod = adminProducts.find(p => String(p.id).trim() === cleanId);
    if (!prod) return;

    // Toggle local product state
    const newLiked = !prod.is_liked;
    prod.is_liked = newLiked;

    // Sync with localStorage liked array
    let likedList = [];
    try {
      likedList = JSON.parse(localStorage.getItem('raga_liked_products') || '[]');
    } catch(e){}
    if (newLiked) {
      if (!likedList.includes(cleanId)) likedList.push(cleanId);
    } else {
      likedList = likedList.filter(x => x !== cleanId);
    }

    try {
      localStorage.setItem('raga_liked_products', JSON.stringify(likedList));
      localStorage.setItem('raga_admin_products_v2', JSON.stringify(adminProducts));
    } catch(e) {}

    // Re-render table rows immediately
    filterTable();

    // Persist to MySQL database via API
    try {
      await fetch('api/toggle_like.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: cleanId, is_liked: newLiked })
      });
    } catch(e) {
      console.warn('Could not save like state to server:', e);
    }
  }

  async function handleChangePassword() {
    const current = document.getElementById('cp-current').value;
    const newPass = document.getElementById('cp-new').value;
    const confirmPass = document.getElementById('cp-confirm').value;

    if (!current) {
      alert('Please enter your current password.');
      document.getElementById('cp-current').focus();
      return;
    }
    if (!newPass) {
      alert('Please enter a new password.');
      document.getElementById('cp-new').focus();
      return;
    }
    if (newPass !== confirmPass) {
      alert('New password and confirm password do not match!');
      document.getElementById('cp-confirm').focus();
      return;
    }
    if (newPass.length < 4) {
      alert('New password must be at least 4 characters long.');
      return;
    }

    try {
      const response = await fetch('api/change_password.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          current_password: current,
          new_password: newPass
        })
      });

      const data = await response.json();

      if (data.success) {
        localStorage.setItem('raga_admin_password', newPass);
        alert(data.message || 'Password updated successfully! Please login with your new password.');
        window.location.href = 'admin/index.php';
      } else {
        alert(data.message || 'Failed to update password. Please check your current password.');
      }
    } catch (e) {
      console.error('Error updating password:', e);
      alert('Server error while updating password. Please try again.');
    }
  }

  async function deleteOrder(id) {
    if (!confirm('Are you sure you want to delete order ' + id + '?')) return;
    try {
      const response = await fetch('api/delete_order.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      });
      const data = await response.json();
      if (data.success) {
        adminOrders = adminOrders.filter(o => o.id !== id);
        renderOrders();
      } else {
        alert('Failed to delete order: ' + data.message);
      }
    } catch(e) {
      alert('Error deleting order');
    }
  }

  function toggleOrdersSearchBar(open) {
    const box = document.getElementById('orders-search-box');
    const btn = document.getElementById('orders-search-toggle-btn');
    const input = document.getElementById('orders-search');
    if (!box || !btn) return;
    
    if (open) {
      box.classList.remove('hidden');
      btn.classList.add('hidden');
      if (input) {
        input.focus();
      }
    } else {
      box.classList.add('hidden');
      btn.classList.remove('hidden');
      if (input) {
        input.value = '';
        renderOrders();
      }
    }
  }

  // ── ORDERS & TRANSACTIONS LOGIC ──
  let currentViewingOrder = null;

  function renderOrders() {
    const tbody = document.getElementById('orders-tbody');
    const empty = document.getElementById('orders-table-empty');
    if (!tbody || !empty) return;
    
    let orders = [...adminOrders];
    if (orders.length === 0) {
      try {
        orders = JSON.parse(localStorage.getItem('raga_orders') || '[]');
      } catch(e){}
    }
    
    const totalOrders = orders.length;
    let revenue = 0;
    let counts = { pending: 0, confirmed: 0, packed: 0, shipped: 0, delivered: 0, cancelled: 0, returned: 0 };

    orders.forEach(o => {
      const status = (o.status || '').toLowerCase();
      if (status !== 'cancelled') {
        revenue += Number(o.amount) || 0;
      }
      if (status === 'processing' || status === 'pending') counts.pending++;
      else if (counts[status] !== undefined) counts[status]++;
    });

    const elTotal = document.getElementById('stat-orders-total');
    const elPending = document.getElementById('stat-orders-pending');
    const elShipped = document.getElementById('stat-orders-shipped');
    const elRevenue = document.getElementById('stat-orders-revenue');
    
    if (elTotal) elTotal.textContent = totalOrders;
    if (elPending) elPending.textContent = counts.pending;
    if (elShipped) elShipped.textContent = counts.shipped;
    if (elRevenue) elRevenue.textContent = '₹' + revenue.toLocaleString('en-IN');

    const searchEl = document.getElementById('orders-search');
    if (searchEl && searchEl.value.trim()) {
       const q = searchEl.value.trim().toLowerCase();
       orders = orders.filter(o => 
         (o.id && o.id.toLowerCase().includes(q)) || 
         (o.customer && o.customer.toLowerCase().includes(q)) || 
         (o.email && o.email.toLowerCase().includes(q)) ||
         (o.phone && o.phone.toLowerCase().includes(q)) ||
         (o.product_name && o.product_name.toLowerCase().includes(q)) ||
         (o.status && o.status.toLowerCase().includes(q))
       );
    }

    const dateEl = document.getElementById('orders-date-filter');
    if (dateEl && dateEl.value) {
       orders = orders.filter(o => {
         if (!o.date) return false;
         const d = new Date(o.date);
         if (isNaN(d.getTime())) return false;
         const yyyy = d.getFullYear();
         const mm = String(d.getMonth() + 1).padStart(2, '0');
         const dd = String(d.getDate()).padStart(2, '0');
         return `${yyyy}-${mm}-${dd}` === dateEl.value;
       });
    }

    // Sort newest first
    orders.sort((a, b) => new Date(b.date).getTime() - new Date(a.date).getTime());

    if (orders.length === 0) {
      tbody.innerHTML = '';
      empty.classList.remove('hidden');
      return;
    }
    
    empty.classList.add('hidden');
    tbody.innerHTML = orders.map((o, index) => {
      const displayId = String(o.id).startsWith('Raga-') ? o.id : (o.id.startsWith('#RAGA-') ? `Raga-${o.id.replace('#RAGA-', '').padStart(3, '0')}` : o.id);
      const statusLower = (o.status || '').toLowerCase();
      let statusBadgeClass = 'bg-brand-gold/20 text-brand-charcoal';
      if (statusLower === 'delivered') statusBadgeClass = 'bg-green-100 text-green-800';
      else if (statusLower === 'shipped') statusBadgeClass = 'bg-blue-100 text-blue-800';
      else if (statusLower === 'cancelled') statusBadgeClass = 'bg-red-100 text-red-800';
      else if (statusLower === 'confirmed') statusBadgeClass = 'bg-purple-100 text-purple-800';

      return `
        <tr class="border-b border-brand-gold/10 last:border-0 hover:bg-brand-cream/10 transition-colors">
          <td class="p-4 font-mono text-xs text-brand-burgundy font-semibold text-center whitespace-nowrap">${index + 1}</td>
          <td class="p-4 font-mono text-xs text-brand-burgundy font-bold cursor-pointer hover:underline text-center whitespace-nowrap" onclick="viewOrderDetails('${o.id}', 'orders')" title="Click to view details">${displayId}</td>
          <td class="p-4 text-xs text-gray-500 text-center whitespace-nowrap">${new Date(o.date).toLocaleString([], { year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</td>
          <td class="p-4 font-medium text-sm text-brand-charcoal text-center whitespace-nowrap">${esc(o.customer)}</td>
          <td class="p-4 text-xs text-gray-600 text-center whitespace-nowrap">${o.items || 1} item(s)</td>
          <td class="p-4 font-bold text-brand-burgundy text-center whitespace-nowrap">₹${Number(o.amount).toLocaleString('en-IN')}</td>
          <td class="p-4 text-center whitespace-nowrap"><span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] uppercase tracking-widest font-bold ${statusBadgeClass}">${esc(o.status || 'Processing')}</span></td>
          <td class="p-4 text-center whitespace-nowrap">
            <div class="flex items-center justify-center gap-2">
              <button class="px-3 py-1.5 bg-brand-burgundy hover:bg-brand-burgundyLight text-white text-xs font-semibold rounded-md shadow-xs flex items-center gap-1.5 transition cursor-pointer" onclick="viewOrderDetails('${o.id}', 'orders')">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span>View</span>
              </button>
              <button class="p-1 text-red-500 hover:text-red-700 hover:bg-red-50 rounded transition cursor-pointer" title="Delete Order" onclick="deleteOrder('${o.id}')">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
              </button>
            </div>
          </td>
        </tr>
      `;
    }).join('');
  }

  // ── Helper to filter records by Date, Month, Year, and Preset ──
  function filterRecordsByDateAndPreset(records, dateVal, presetVal, searchVal, monthVal = '', yearVal = '') {
    let list = [...records];

    const now = new Date();
    const startOfToday = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    
    if (presetVal === 'today') {
      list = list.filter(r => {
        if (!r.date && !r.created_at) return false;
        const d = new Date(r.date || r.created_at);
        return d >= startOfToday;
      });
    } else if (presetVal === 'last-week') {
      const sevenDaysAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
      list = list.filter(r => {
        if (!r.date && !r.created_at) return false;
        const d = new Date(r.date || r.created_at);
        return d >= sevenDaysAgo;
      });
    } else if (presetVal === 'this-month') {
      list = list.filter(r => {
        if (!r.date && !r.created_at) return false;
        const d = new Date(r.date || r.created_at);
        return d.getFullYear() === now.getFullYear() && d.getMonth() === now.getMonth();
      });
    } else if (presetVal === 'last-month') {
      const prevMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
      list = list.filter(r => {
        if (!r.date && !r.created_at) return false;
        const d = new Date(r.date || r.created_at);
        return d.getFullYear() === prevMonth.getFullYear() && d.getMonth() === prevMonth.getMonth();
      });
    } else if (presetVal === 'this-year') {
      list = list.filter(r => {
        if (!r.date && !r.created_at) return false;
        const d = new Date(r.date || r.created_at);
        return d.getFullYear() === now.getFullYear();
      });
    }

    // Filter by Year if specified
    if (yearVal && yearVal !== 'all') {
      list = list.filter(r => {
        if (!r.date && !r.created_at) return false;
        const d = new Date(r.date || r.created_at);
        if (isNaN(d.getTime())) return false;
        return String(d.getFullYear()) === String(yearVal);
      });
    }

    // Filter by Month if specified (e.g. '01', '08', etc. or 'YYYY-MM')
    if (monthVal && monthVal !== 'all') {
      list = list.filter(r => {
        if (!r.date && !r.created_at) return false;
        const d = new Date(r.date || r.created_at);
        if (isNaN(d.getTime())) return false;
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        if (monthVal.includes('-')) {
          const [yyyy, m] = monthVal.split('-');
          return d.getFullYear() === parseInt(yyyy, 10) && mm === m;
        }
        return mm === monthVal;
      });
    }

    if (dateVal) {
      list = list.filter(r => {
        if (!r.date && !r.created_at) return false;
        const d = new Date(r.date || r.created_at);
        if (isNaN(d.getTime())) return false;
        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}` === dateVal;
      });
    }

    if (searchVal) {
      const q = searchVal.toLowerCase().trim();
      list = list.filter(r => {
        const numPart = String(r.id || '').replace(/^#?RAGA-?/i, '');
        const trxId = `TRX-${numPart.padStart(3, '0')}`.toLowerCase();
        const orderId = String(r.id || '').toLowerCase();
        const cust = String(r.customer || r.customer_name || '').toLowerCase();
        const phone = String(r.phone || '').toLowerCase();
        const email = String(r.email || '').toLowerCase();
        const amount = String(r.amount || '');
        return trxId.includes(q) || orderId.includes(q) || cust.includes(q) || phone.includes(q) || email.includes(q) || amount.includes(q);
      });
    }

    return list;
  }

  let trxAnalyticsChartInstance = null;

  // ── Handlers for Transaction History Filter Controls ──
  function handleTrxHistPresetChange() {
    const preset = document.getElementById('trx-hist-preset-filter')?.value || 'all';
    const now = new Date();
    const curYear = String(now.getFullYear());
    const curMonth = String(now.getMonth() + 1).padStart(2, '0');

    if (preset === 'this-year') {
      if (document.getElementById('trx-hist-year-select')) document.getElementById('trx-hist-year-select').value = curYear;
      if (document.getElementById('trx-hist-month-select')) document.getElementById('trx-hist-month-select').value = 'all';
    } else if (preset === 'this-month') {
      if (document.getElementById('trx-hist-year-select')) document.getElementById('trx-hist-year-select').value = curYear;
      if (document.getElementById('trx-hist-month-select')) document.getElementById('trx-hist-month-select').value = curMonth;
    } else if (preset === 'last-month') {
      const prevDate = new Date(now.getFullYear(), now.getMonth() - 1, 1);
      if (document.getElementById('trx-hist-year-select')) document.getElementById('trx-hist-year-select').value = String(prevDate.getFullYear());
      if (document.getElementById('trx-hist-month-select')) document.getElementById('trx-hist-month-select').value = String(prevDate.getMonth() + 1).padStart(2, '0');
    } else {
      if (document.getElementById('trx-hist-year-select')) document.getElementById('trx-hist-year-select').value = 'all';
      if (document.getElementById('trx-hist-month-select')) document.getElementById('trx-hist-month-select').value = 'all';
    }

    renderTransactionHistory();
  }

  function handleTrxHistYearMonthChange() {
    if (document.getElementById('trx-hist-preset-filter')) document.getElementById('trx-hist-preset-filter').value = 'all';
    renderTransactionHistory();
  }

  function clearTrxHistFilters() {
    if (document.getElementById('trx-hist-preset-filter')) document.getElementById('trx-hist-preset-filter').value = 'all';
    if (document.getElementById('trx-hist-year-select')) document.getElementById('trx-hist-year-select').value = 'all';
    if (document.getElementById('trx-hist-month-select')) document.getElementById('trx-hist-month-select').value = 'all';
    renderTransactionHistory();
  }

  // ── Render All Transactions (Tracks Real Payment Status for UPI Gateway) ──
  function renderTransactions() {
    const tbody = document.getElementById('transactions-tbody');
    const empty = document.getElementById('transactions-table-empty');
    if (!tbody || !empty) return;
    
    let orders = (Array.isArray(adminOrders) && adminOrders.length > 0)
      ? adminOrders
      : JSON.parse(localStorage.getItem('raga_orders') || '[]');
    
    const dateVal = document.getElementById('trx-date-filter')?.value || '';
    const presetVal = document.getElementById('trx-preset-filter')?.value || 'all';
    const searchVal = document.getElementById('trx-search')?.value || '';

    const filtered = filterRecordsByDateAndPreset(orders, dateVal, presetVal, searchVal);

    if (filtered.length === 0) {
      tbody.innerHTML = '';
      empty.classList.remove('hidden');
      return;
    }
    
    empty.classList.add('hidden');
    tbody.innerHTML = filtered.map((o, idx) => {
      const numPart = String(o.id || '').replace(/^#?RAGA-?/i, '');
      const trxId = `TRX-${numPart.padStart(3, '0')}`;
      const orderDisplayId = String(o.id).startsWith('Raga-') ? o.id : `Raga-${numPart.padStart(3, '0')}`;
      
      const paySt = (o.payment_status || (o.status === 'Cancelled' ? 'Refunded' : 'Success')).toLowerCase();
      let statusDisplay = 'Success';
      let statusClass = 'bg-green-100 text-green-800';
      if (paySt === 'cancelled' || paySt === 'refunded') {
        statusDisplay = 'Refunded';
        statusClass = 'bg-red-100 text-red-800';
      } else if (paySt === 'failed') {
        statusDisplay = 'Failed';
        statusClass = 'bg-red-100 text-red-800';
      } else if (paySt === 'pending') {
        statusDisplay = 'Pending';
        statusClass = 'bg-yellow-100 text-yellow-800';
      }

      const phoneStr = (o.phone && String(o.phone).trim()) ? String(o.phone).trim() : '—';
      const emailStr = (o.email && String(o.email).trim()) ? String(o.email).trim() : '—';

      return `
        <tr class="border-b border-brand-gold/10 last:border-0 hover:bg-brand-cream/10 transition-colors">
          <td class="p-4 font-mono text-xs text-brand-burgundy font-semibold text-center whitespace-nowrap">${idx + 1}</td>
          <td class="p-4 font-mono text-xs text-brand-burgundy font-bold text-center whitespace-nowrap">${trxId}</td>
          <td class="p-4 font-mono text-xs text-brand-burgundy font-bold cursor-pointer hover:underline text-center whitespace-nowrap" onclick="viewOrderDetails('${o.id}', 'transactions')" title="Click to view details">${orderDisplayId}</td>
          <td class="p-4 text-xs text-gray-500 text-center whitespace-nowrap">${new Date(o.date).toLocaleString([], { year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</td>
          <td class="p-4 font-medium text-sm text-brand-charcoal text-center whitespace-nowrap">${esc(o.customer)}</td>
          <td class="p-4 text-xs text-gray-600 font-mono text-center whitespace-nowrap">${phoneStr !== '—' ? `<a href="tel:${phoneStr.replace(/[^0-9]/g, '')}" class="text-brand-burgundy font-semibold hover:underline">${esc(phoneStr)}</a>` : '<span class="text-gray-400 font-normal">—</span>'}</td>
          <td class="p-4 text-xs text-gray-600 text-center whitespace-nowrap">${emailStr !== '—' ? `<a href="mailto:${emailStr}" class="text-brand-burgundy font-semibold hover:underline">${esc(emailStr)}</a>` : '<span class="text-gray-400 font-normal">—</span>'}</td>
          <td class="p-4 font-bold text-brand-burgundy text-center whitespace-nowrap">₹${Number(o.amount).toLocaleString('en-IN')}</td>
          <td class="p-4 text-center whitespace-nowrap"><span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] uppercase tracking-widest font-bold ${statusClass}">${statusDisplay}</span></td>
        </tr>
      `;
    }).join('');
  }

  let trxHistYearsPopulated = false;
  function populateTrxHistYearDropdown() {
    const yearSelect = document.getElementById('trx-hist-year-select');
    if (!yearSelect || trxHistYearsPopulated) return;
    
    let orders = (Array.isArray(adminOrders) && adminOrders.length > 0)
      ? adminOrders
      : JSON.parse(localStorage.getItem('raga_orders') || '[]');
    
    const curYear = new Date().getFullYear();
    const yearSet = new Set([curYear, curYear - 1, curYear - 2, 2026, 2025, 2024]);
    
    orders.forEach(o => {
      if (o.date || o.created_at) {
        const d = new Date(o.date || o.created_at);
        if (!isNaN(d.getFullYear())) yearSet.add(d.getFullYear());
      }
    });

    const currentSelected = yearSelect.value || 'all';
    const sortedYears = Array.from(yearSet).sort((a, b) => b - a);

    let html = '<option value="all">All Years</option>';
    sortedYears.forEach(y => {
      html += `<option value="${y}" ${String(currentSelected) === String(y) ? 'selected' : ''}>${y}</option>`;
    });
    
    yearSelect.innerHTML = html;
    trxHistYearsPopulated = true;
  }

  // ── Render Transaction History (Dynamic Revenue Analytics Graph — Success Only) ──
  function renderTransactionHistory() {
    populateTrxHistYearDropdown();
    let orders = (Array.isArray(adminOrders) && adminOrders.length > 0)
      ? adminOrders
      : JSON.parse(localStorage.getItem('raga_orders') || '[]');
    
    // Filter ONLY paid and verified successful transactions
    orders = orders.filter(o => {
      const paySt = (o.payment_status || (o.status === 'Cancelled' ? 'Refunded' : 'Success')).toLowerCase();
      return paySt === 'success';
    });

    const yearVal = document.getElementById('trx-hist-year-select')?.value || 'all';
    const monthVal = document.getElementById('trx-hist-month-select')?.value || 'all';
    const presetVal = document.getElementById('trx-hist-preset-filter')?.value || 'all';

    const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    const shortMonthNames = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

    const filtered = filterRecordsByDateAndPreset(orders, '', presetVal, '', monthVal, yearVal);

    // Calculate Analytics KPIs (Success only)
    const totalSuccessRevenue = filtered.reduce((sum, o) => sum + (Number(o.amount) || 0), 0);
    const totalSuccessCount = filtered.length;
    const avgOrderVal = totalSuccessCount > 0 ? (totalSuccessRevenue / totalSuccessCount) : 0;

    const revEl = document.getElementById('trx-analytics-revenue');
    if (revEl) revEl.textContent = '₹ ' + Number(totalSuccessRevenue).toLocaleString('en-IN');

    const countEl = document.getElementById('trx-analytics-count');
    if (countEl) countEl.textContent = totalSuccessCount;

    const aovEl = document.getElementById('trx-analytics-aov');
    if (aovEl) aovEl.textContent = '₹ ' + Math.round(avgOrderVal).toLocaleString('en-IN');

    // Update active period badge & subtitle
    const badge = document.getElementById('trx-chart-period-badge');
    const subtitle = document.getElementById('trx-chart-subtitle');
    let viewTitle = 'All Time Overview';
    let viewSubtitle = 'Completed revenue distribution across all transactions.';

    if (yearVal !== 'all' && monthVal !== 'all') {
      const mIdx = parseInt(monthVal, 10) - 1;
      viewTitle = `${monthNames[mIdx]} ${yearVal}`;
      viewSubtitle = `Daily revenue breakdown for ${monthNames[mIdx]} ${yearVal}.`;
    } else if (yearVal !== 'all' && monthVal === 'all') {
      viewTitle = `Year ${yearVal} (All 12 Months)`;
      viewSubtitle = `Monthly completed revenue breakdown for Year ${yearVal}.`;
    } else if (yearVal === 'all' && monthVal !== 'all') {
      const mIdx = parseInt(monthVal, 10) - 1;
      viewTitle = `Month: ${monthNames[mIdx]} (All Years)`;
      viewSubtitle = `Completed revenue for ${monthNames[mIdx]} across all recorded years.`;
    } else if (presetVal === 'today') {
      viewTitle = "Today's Revenue";
      viewSubtitle = "Hourly completed revenue distribution for today.";
    } else if (presetVal === 'last-week') {
      viewTitle = 'This Week';
      viewSubtitle = "Completed revenue over the last 7 days.";
    } else if (presetVal === 'this-month') {
      const now = new Date();
      viewTitle = `${monthNames[now.getMonth()]} ${now.getFullYear()}`;
      viewSubtitle = `Daily completed revenue breakdown for ${viewTitle}.`;
    } else if (presetVal === 'last-month') {
      const prev = new Date(new Date().getFullYear(), new Date().getMonth() - 1, 1);
      viewTitle = `${monthNames[prev.getMonth()]} ${prev.getFullYear()}`;
      viewSubtitle = `Daily completed revenue breakdown for ${viewTitle}.`;
    } else if (presetVal === 'this-year') {
      viewTitle = `Year ${new Date().getFullYear()} (All 12 Months)`;
      viewSubtitle = `Monthly completed revenue breakdown for Year ${new Date().getFullYear()}.`;
    }

    if (badge) badge.textContent = viewTitle;
    if (subtitle) subtitle.textContent = viewSubtitle;

    const canvas = document.getElementById('trx-analytics-chart');
    const emptyEl = document.getElementById('trx-chart-empty');
    if (!canvas) return;

    if (filtered.length === 0) {
      if (emptyEl) emptyEl.classList.remove('hidden');
      if (trxAnalyticsChartInstance) {
        trxAnalyticsChartInstance.destroy();
        trxAnalyticsChartInstance = null;
      }
      return;
    }

    if (emptyEl) emptyEl.classList.add('hidden');

    // Build chart labels & data dynamically
    let labels = [];
    let revenueData = [];

    // Case 1: Filter by Today
    if (presetVal === 'today') {
      const hourSlots = ['6 AM', '8 AM', '10 AM', '12 PM', '2 PM', '4 PM', '6 PM', '8 PM', '10 PM'];
      labels = hourSlots;
      const hourlyRev = {};
      hourSlots.forEach(h => hourlyRev[h] = 0);

      filtered.forEach(o => {
        const d = new Date(o.date || o.created_at);
        const h = d.getHours();
        let slot = '12 PM';
        if (h < 7) slot = '6 AM';
        else if (h < 9) slot = '8 AM';
        else if (h < 11) slot = '10 AM';
        else if (h < 13) slot = '12 PM';
        else if (h < 15) slot = '2 PM';
        else if (h < 17) slot = '4 PM';
        else if (h < 19) slot = '6 PM';
        else if (h < 21) slot = '8 PM';
        else slot = '10 PM';
        hourlyRev[slot] = (hourlyRev[slot] || 0) + (Number(o.amount) || 0);
      });
      revenueData = hourSlots.map(h => hourlyRev[h]);

    }
    // Case 2: Specific Year selected with All Months (Annual view Jan-Dec)
    else if (yearVal !== 'all' && monthVal === 'all') {
      labels = shortMonthNames;
      const monthTotals = Array(12).fill(0);
      filtered.forEach(o => {
        const d = new Date(o.date || o.created_at);
        const m = d.getMonth();
        if (m >= 0 && m < 12) {
          monthTotals[m] += (Number(o.amount) || 0);
        }
      });
      revenueData = monthTotals;

    }
    // Case 3: Specific Month selected (Daily breakdown in that month)
    else if (monthVal !== 'all') {
      const dayMap = {};
      filtered.forEach(o => {
        const d = new Date(o.date || o.created_at);
        const dayNum = d.getDate();
        const label = `${dayNum} ${d.toLocaleString('default', { month: 'short' })}`;
        dayMap[label] = (dayMap[label] || 0) + (Number(o.amount) || 0);
      });

      const sortedKeys = Object.keys(dayMap);
      labels = sortedKeys;
      revenueData = sortedKeys.map(k => dayMap[k]);

    }
    // Case 4: Preset 'this-year'
    else if (presetVal === 'this-year') {
      labels = shortMonthNames;
      const monthTotals = Array(12).fill(0);
      filtered.forEach(o => {
        const d = new Date(o.date || o.created_at);
        const m = d.getMonth();
        if (m >= 0 && m < 12) {
          monthTotals[m] += (Number(o.amount) || 0);
        }
      });
      revenueData = monthTotals;

    }
    // Case 5: All Time or custom date ranges
    else {
      const groupMap = {};
      const sortedOrders = [...filtered].sort((a,b) => new Date(a.date || a.created_at) - new Date(b.date || b.created_at));
      
      sortedOrders.forEach(o => {
        const d = new Date(o.date || o.created_at);
        const key = `${d.toLocaleString('default', { month: 'short' })} ${d.getDate()}, ${d.getFullYear()}`;
        groupMap[key] = (groupMap[key] || 0) + (Number(o.amount) || 0);
      });
      labels = Object.keys(groupMap);
      revenueData = Object.values(groupMap);
    }

    if (trxAnalyticsChartInstance) {
      trxAnalyticsChartInstance.destroy();
    }

    const ctx = canvas.getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 320);
    gradient.addColorStop(0, 'rgba(112, 33, 82, 0.85)');
    gradient.addColorStop(1, 'rgba(212, 178, 112, 0.25)');

    trxAnalyticsChartInstance = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Completed Revenue (₹)',
          data: revenueData,
          backgroundColor: gradient,
          borderColor: '#702152',
          borderWidth: 1.5,
          borderRadius: 6,
          borderSkipped: false,
          maxBarThickness: 52,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 600,
          easing: 'easeOutQuart'
        },
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: '#2c2c2c',
            titleFont: { family: 'Inter', size: 12, weight: 'bold' },
            bodyFont: { family: 'Inter', size: 13, weight: '600' },
            padding: 12,
            cornerRadius: 8,
            callbacks: {
              label: function(context) {
                const val = context.parsed.y || 0;
                return ` Completed Revenue: ₹${Number(val).toLocaleString('en-IN')}`;
              }
            }
          }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: {
              font: { family: 'Inter', size: 11, weight: '500' },
              color: '#6b7280'
            }
          },
          y: {
            grid: {
              color: 'rgba(212, 178, 112, 0.15)',
              drawBorder: false
            },
            ticks: {
              font: { family: 'Inter', size: 11, weight: '500' },
              color: '#6b7280',
              callback: function(value) {
                if (value >= 100000) return '₹' + (value / 100000).toFixed(1) + 'L';
                if (value >= 1000) return '₹' + (value / 1000).toFixed(0) + 'k';
                return '₹' + value;
              }
            }
          }
        }
      }
    });
  }

  // ── Download Excel Export for All Transactions ──
  function exportTransactionsExcel() {
    let orders = (Array.isArray(adminOrders) && adminOrders.length > 0)
      ? adminOrders
      : JSON.parse(localStorage.getItem('raga_orders') || '[]');

    const dateVal = document.getElementById('trx-date-filter')?.value || '';
    const presetVal = document.getElementById('trx-preset-filter')?.value || 'all';
    const searchVal = document.getElementById('trx-search')?.value || '';

    const filtered = filterRecordsByDateAndPreset(orders, dateVal, presetVal, searchVal);

    if (filtered.length === 0) {
      alert('No transaction records found matching your selected filter to download.');
      return;
    }

    // Calculate sum of SUCCESS status only
    const totalSuccessAmount = filtered
      .filter(o => (o.payment_status || (o.status === 'Cancelled' ? 'Refunded' : 'Success')).toLowerCase() === 'success')
      .reduce((sum, o) => sum + (Number(o.amount) || 0), 0);

    const headers = ['S.No', 'Transaction ID', 'Order ID', 'Date & Time', 'Customer Name', 'Phone Number', 'Email Address', 'Amount (INR)', 'Payment Status'];
    const rows = filtered.map((o, idx) => {
      const numPart = String(o.id || '').replace(/^#?RAGA-?/i, '');
      const trxId = `TRX-${numPart.padStart(3, '0')}`;
      const orderId = String(o.id).startsWith('Raga-') ? o.id : `Raga-${numPart.padStart(3, '0')}`;
      const dateStr = o.date ? new Date(o.date).toLocaleString('en-IN') : '—';
      const cust = `"${String(o.customer || '').replace(/"/g, '""')}"`;
      const phone = `"${String(o.phone || '—').replace(/"/g, '""')}"`;
      const email = `"${String(o.email || '—').replace(/"/g, '""')}"`;
      const amount = Number(o.amount || 0).toFixed(2);
      const paySt = o.payment_status || (o.status === 'Cancelled' ? 'Refunded' : 'Success');

      return [idx + 1, trxId, orderId, `"${dateStr}"`, cust, phone, email, amount, paySt].join(',');
    });

    // Append final summary total row at the very bottom
    rows.push(['', '', '', '', '', '', 'Total Amount', Number(totalSuccessAmount).toFixed(2), '']);

    const csvString = '\uFEFF' + [headers.join(','), ...rows].join('\r\n');
    const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    const todayStr = new Date().toISOString().split('T')[0];
    link.href = url;
    link.download = `raga_transactions_${todayStr}.csv`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
  }

  // ── Download CSV Export for Transaction History (Only Successful) ──
  function exportTransactionsCSV() {
    let orders = (Array.isArray(adminOrders) && adminOrders.length > 0)
      ? adminOrders
      : JSON.parse(localStorage.getItem('raga_orders') || '[]');

    // Only successful transactions for History
    orders = orders.filter(o => {
      const paySt = (o.payment_status || (o.status === 'Cancelled' ? 'Refunded' : 'Success')).toLowerCase();
      return paySt === 'success';
    });

    const dateVal = document.getElementById('trx-hist-date-filter')?.value || '';
    const presetVal = document.getElementById('trx-hist-preset-filter')?.value || 'all';
    const yearVal = document.getElementById('trx-hist-year-select')?.value || 'all';
    const monthVal = document.getElementById('trx-hist-month-select')?.value || 'all';

    const filtered = filterRecordsByDateAndPreset(orders, dateVal, presetVal, '', monthVal, yearVal);

    if (filtered.length === 0) {
      alert('No successful transaction history records found matching your selected filter to download.');
      return;
    }

    const totalSuccessAmount = filtered.reduce((sum, o) => sum + (Number(o.amount) || 0), 0);

    const headers = ['S.No', 'Transaction ID', 'Order ID', 'Date & Time', 'Customer Name', 'Phone Number', 'Email Address', 'Amount (INR)', 'Payment Status'];
    const rows = filtered.map((o, idx) => {
      const numPart = String(o.id || '').replace(/^#?RAGA-?/i, '');
      const trxId = `TRX-${numPart.padStart(3, '0')}`;
      const orderId = String(o.id).startsWith('Raga-') ? o.id : `Raga-${numPart.padStart(3, '0')}`;
      const dateStr = o.date ? new Date(o.date).toLocaleString('en-IN') : '—';
      const cust = `"${String(o.customer || '').replace(/"/g, '""')}"`;
      const phone = `"${String(o.phone || '—').replace(/"/g, '""')}"`;
      const email = `"${String(o.email || '—').replace(/"/g, '""')}"`;
      const amount = Number(o.amount || 0).toFixed(2);
      const status = 'Success';

      return [idx + 1, trxId, orderId, `"${dateStr}"`, cust, phone, email, amount, status].join(',');
    });

    // Append final summary total row at the very bottom
    rows.push(['', '', '', '', '', '', 'Total Amount', Number(totalSuccessAmount).toFixed(2), '']);

    const csvString = '\uFEFF' + [headers.join(','), ...rows].join('\r\n');
    const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    const todayStr = new Date().toISOString().split('T')[0];
    link.href = url;
    link.download = `raga_transaction_history_${todayStr}.csv`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
  }

  // ── Find order by any ID format ──
  function findOrderById(id) {
    if (!id) return null;
    const targetStr = String(id).trim().toLowerCase();
    const cleanTarget = targetStr.replace(/^#?raga-?/i, '');

    let allOrders = [];
    if (Array.isArray(adminOrders)) allOrders.push(...adminOrders);
    try {
      const local = JSON.parse(localStorage.getItem('raga_orders') || '[]');
      if (Array.isArray(local)) allOrders.push(...local);
    } catch(e){}

    return allOrders.find(o => {
      if (!o) return false;
      const oId = String(o.id || '').trim().toLowerCase();
      if (oId === targetStr) return true;
      const cleanOId = oId.replace(/^#?raga-?/i, '');
      return cleanOId === cleanTarget;
    }) || null;
  }

  // ── View Order / Transaction Details Modal Handler ──
  function viewOrderDetails(id, viewMode = 'orders') {
    try {
      let order = findOrderById(id);
      if (!order) {
        console.warn('Record details not found for ID: ' + id);
        return;
      }

      currentViewingOrder = order;

      const numPart = String(order.id || '').replace(/^#?RAGA-?/i, '');
      const displayId = String(order.id).startsWith('Raga-') ? order.id : `Raga-${numPart.padStart(3, '0')}`;
      const trxId = `TRX-${numPart.padStart(3, '0')}`;
      
      const modalIdEl = document.getElementById('order-detail-modal-id');
      const badge = document.getElementById('order-detail-modal-badge');
      const statusBox = document.getElementById('order-modal-status-box');

      if (viewMode === 'transactions' || viewMode === 'transaction-history') {
        // HIDE Order Fulfillment Status Dropdown on Transactions (Tracked via UPI Gateway)
        if (modalIdEl) modalIdEl.textContent = `Transaction ${trxId} (${displayId})`;
        if (statusBox) statusBox.style.display = 'none';

        const paySt = (order.payment_status || (order.status === 'Cancelled' ? 'Refunded' : 'Success')).toLowerCase();
        if (badge) {
          if (paySt === 'success') {
            badge.textContent = 'Payment: Success';
            badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-green-500 text-white';
          } else if (paySt === 'pending') {
            badge.textContent = 'Payment: Pending';
            badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-yellow-500 text-white';
          } else if (paySt === 'failed') {
            badge.textContent = 'Payment: Failed';
            badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-red-500 text-white';
          } else {
            badge.textContent = 'Payment: ' + (order.payment_status || 'Success');
            badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-blue-500 text-white';
          }
        }
      } else {
        // Orders view: Show order lifecycle updater
        if (modalIdEl) modalIdEl.textContent = `Order ${displayId}`;
        if (statusBox) statusBox.style.display = '';

        if (badge) {
          const st = (order.status || 'Processing').toLowerCase();
          badge.textContent = order.status || 'Processing';
          if (st === 'delivered') badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-green-500 text-white';
          else if (st === 'shipped') badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-blue-500 text-white';
          else if (st === 'cancelled') badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-red-500 text-white';
          else badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-brand-gold/50 text-white';
        }
      }

      const dateEl = document.getElementById('order-detail-modal-date');
      if (dateEl) {
        dateEl.textContent = order.date 
          ? `Placed on ${new Date(order.date).toLocaleString('en-IN', { dateStyle: 'medium', timeStyle: 'short' })}` 
          : 'Placed recently';
      }

      const nameEl = document.getElementById('order-modal-cust-name');
      if (nameEl) nameEl.textContent = (order.customer && order.customer.trim()) ? order.customer.trim() : '—';
      
      const phoneEl = document.getElementById('order-modal-cust-phone');
      if (phoneEl) {
        if (order.phone && String(order.phone).trim()) {
          const ph = String(order.phone).trim();
          phoneEl.textContent = ph;
          phoneEl.href = `tel:${ph.replace(/[^0-9]/g, '')}`;
          phoneEl.className = 'text-brand-burgundy font-semibold hover:underline ml-1';
        } else {
          phoneEl.textContent = 'Not provided';
          phoneEl.removeAttribute('href');
          phoneEl.className = 'text-gray-400 font-normal ml-1';
        }
      }

      const emailEl = document.getElementById('order-modal-cust-email');
      if (emailEl) {
        if (order.email && String(order.email).trim()) {
          const em = String(order.email).trim();
          emailEl.textContent = em;
          emailEl.href = `mailto:${em}`;
          emailEl.className = 'text-brand-burgundy font-semibold hover:underline ml-1';
        } else {
          emailEl.textContent = 'Not provided';
          emailEl.removeAttribute('href');
          emailEl.className = 'text-gray-400 font-normal ml-1';
        }
      }

      const addrEl = document.getElementById('order-modal-cust-address');
      if (addrEl) {
        addrEl.textContent = (order.address && String(order.address).trim()) ? String(order.address).trim() : 'Not provided';
        addrEl.className = (order.address && String(order.address).trim()) ? 'font-medium ml-1 text-brand-charcoal' : 'font-normal ml-1 text-gray-400';
      }

      const cityEl = document.getElementById('order-modal-cust-city');
      if (cityEl) {
        cityEl.textContent = (order.city && String(order.city).trim()) ? String(order.city).trim() : 'Not provided';
        cityEl.className = (order.city && String(order.city).trim()) ? 'font-medium ml-1 text-brand-charcoal' : 'font-normal ml-1 text-gray-400';
      }

      const pinEl = document.getElementById('order-modal-cust-pincode');
      if (pinEl) {
        pinEl.textContent = (order.pincode && String(order.pincode).trim()) ? String(order.pincode).trim() : 'Not provided';
        pinEl.className = (order.pincode && String(order.pincode).trim()) ? 'font-semibold ml-1 text-brand-burgundy' : 'font-normal ml-1 text-gray-400';
      }

      const amountVal = Number(order.amount) || 0;
      const subtotalVal = (Number(order.subtotal) > 0) ? Number(order.subtotal) : amountVal;
      const discountVal = Number(order.discount) || 0;
      const shippingVal = (Number(order.shipping) > 0) ? Number(order.shipping) : (subtotalVal >= 1999 ? 0 : 150);

      const subtotalEl = document.getElementById('order-modal-subtotal');
      if (subtotalEl) subtotalEl.textContent = `₹ ${subtotalVal.toLocaleString('en-IN')}`;

      const shipEl = document.getElementById('order-modal-shipping');
      if (shipEl) shipEl.textContent = shippingVal === 0 ? 'Free Shipping' : `₹ ${shippingVal.toLocaleString('en-IN')}`;
      
      const discRow = document.getElementById('order-modal-discount-row');
      if (discRow) {
        if (discountVal > 0) {
          discRow.classList.remove('hidden');
          const discEl = document.getElementById('order-modal-discount');
          if (discEl) discEl.textContent = `- ₹ ${discountVal.toLocaleString('en-IN')}`;
        } else {
          discRow.classList.add('hidden');
        }
      }

      const grandEl = document.getElementById('order-modal-grandtotal');
      if (grandEl) grandEl.textContent = `₹ ${amountVal.toLocaleString('en-IN')}`;
      
      const payMethodDisplay = order.payment === 'upi' ? 'UPI Payment (Instant UPI)' : (order.payment === 'cod' ? 'Cash on Delivery (COD)' : (order.payment === 'card' ? 'Credit / Debit Card' : (order.payment || 'UPI Payment')));
      const payEl = document.getElementById('order-modal-payment');
      if (payEl) payEl.textContent = payMethodDisplay;

      // Extract items safely
      let items = order.items_detail;
      if (typeof items === 'string') {
        try { items = JSON.parse(items); } catch(e) { items = []; }
      }
      if (!Array.isArray(items) || items.length === 0) {
        let pIds = order.product_ids;
        if (typeof pIds === 'string') {
          try { pIds = JSON.parse(pIds); } catch(e) { pIds = []; }
        }
        const pName = (order.product_name && order.product_name.trim()) ? order.product_name : 'Handcrafted Traditional Silk Saree';
        const pImg = 'images/img-saree-red.jpg';
        items = [{
          id: (Array.isArray(pIds) && pIds[0]) ? pIds[0] : 'item-1',
          name: pName,
          price: subtotalVal / (order.items || 1),
          quantity: order.items || 1,
          image: pImg,
          fabric: 'Pure Silk Blend',
          weave: 'Authentic Handloom'
        }];
      }

      const countEl = document.getElementById('order-modal-items-count');
      if (countEl) countEl.textContent = items.length;

      const itemsContainer = document.getElementById('order-modal-items-list');
      if (itemsContainer) {
        itemsContainer.innerHTML = items.map(item => `
          <div class="p-3 flex items-center gap-3.5 bg-white hover:bg-brand-cream/10 transition">
            <div class="w-14 h-16 rounded-lg overflow-hidden border border-brand-gold/20 flex-shrink-0 bg-brand-cream/20">
              <img src="${item.image || 'images/img-saree-red.jpg'}" alt="${esc(item.name || 'Garment')}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
              <h5 class="font-bold text-xs text-brand-charcoal truncate">${esc(item.name || 'Handloom Garment')}</h5>
              <p class="text-[10px] text-brand-gold font-semibold uppercase tracking-wider mt-0.5">${esc(item.fabric || 'Silk')} | ${esc(item.weave || 'Handloom')}</p>
              <div class="text-[11px] text-gray-500 mt-1">
                <span>Qty: <strong class="text-brand-charcoal">${item.quantity || 1}</strong></span>
                <span class="mx-2 text-gray-300">•</span>
                <span>Price: <strong class="text-brand-charcoal">₹ ${Number(item.price || 0).toLocaleString('en-IN')}</strong></span>
              </div>
            </div>
            <div class="text-right flex-shrink-0">
              <span class="font-bold text-sm text-brand-burgundy">₹ ${(Number(item.price || 0) * Number(item.quantity || 1)).toLocaleString('en-IN')}</span>
            </div>
          </div>
        `).join('');
      }

      const statusSelect = document.getElementById('order-modal-status-select');
      if (statusSelect) {
        statusSelect.value = order.status || 'Processing';
      }

      openModal('modal-view-order');
    } catch(err) {
      console.error('Error opening order details modal:', err);
      alert('Error opening order details: ' + err.message);
    }
  }

  async function saveOrderStatusFromModal() {
    if (!currentViewingOrder) return;
    const statusSelect = document.getElementById('order-modal-status-select');
    if (!statusSelect) return;
    const newStatus = statusSelect.value;

    const btn = document.getElementById('order-modal-save-status-btn');
    if (btn) btn.textContent = 'Saving…';

    try {
      const res = await fetch('api/update_order_status.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: currentViewingOrder.id, status: newStatus })
      });
      const data = await res.json();
      if (data.success) {
        currentViewingOrder.status = newStatus;
        const oInList = adminOrders.find(o => o.id === currentViewingOrder.id);
        if (oInList) oInList.status = newStatus;
        
        try {
          let local = JSON.parse(localStorage.getItem('raga_orders') || '[]');
          const idx = local.findIndex(o => o.id === currentViewingOrder.id);
          if (idx >= 0) {
            local[idx].status = newStatus;
            localStorage.setItem('raga_orders', JSON.stringify(local));
          }
        } catch(e){}

        renderOrders();
        renderTransactions();
        renderTransactionHistory();
        updateStats();

        const badge = document.getElementById('order-detail-modal-badge');
        if (badge) {
          badge.textContent = newStatus;
          const st = newStatus.toLowerCase();
          if (st === 'delivered') badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-green-500 text-white';
          else if (st === 'shipped') badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-blue-500 text-white';
          else if (st === 'cancelled') badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-red-500 text-white';
          else badge.className = 'px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider bg-brand-gold/50 text-white';
        }

        if (btn) {
          btn.textContent = 'Saved! ✓';
          btn.classList.add('bg-green-600');
          setTimeout(() => {
            if (btn) {
              btn.textContent = 'Save Status';
              btn.classList.remove('bg-green-600');
            }
          }, 1500);
        }
      } else {
        console.error('Failed to update status:', data.message);
      }
    } catch(e) {
      console.error('Error updating order status:', e);
    } finally {
      if (btn && btn.textContent !== 'Saved! ✓') btn.textContent = 'Save Status';
    }
  }

  function printOrderInvoice() {
    if (!currentViewingOrder) return;
    window.print();
  }

  async function deleteOrder(id) {
    if (!id) return;

    try {
      const res = await fetch('api/delete_order.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      });
      const data = await res.json();
      if (data.success) {
        adminOrders = adminOrders.filter(o => String(o.id) !== String(id));
        try {
          let local = JSON.parse(localStorage.getItem('raga_orders') || '[]');
          local = local.filter(o => String(o.id) !== String(id));
          localStorage.setItem('raga_orders', JSON.stringify(local));
        } catch(e){}

        renderOrders();
        renderTransactions();
        renderTransactionHistory();
        updateStats();

        if (currentViewingOrder && String(currentViewingOrder.id) === String(id)) {
          closeModal('modal-view-order');
        }
      } else {
        console.error('Failed to delete order:', data.message);
      }
    } catch(err) {
      console.error('Error deleting order:', err);
    }
  }

  function updateStats() {
    const totalProdEl = document.getElementById('stat-total');
    if (totalProdEl) totalProdEl.textContent = adminProducts.length;

    // Calculate orders and revenue
    let ordersList = [];
    if (Array.isArray(adminOrders) && adminOrders.length > 0) {
      ordersList = adminOrders;
    } else {
      try {
        ordersList = JSON.parse(localStorage.getItem('raga_orders') || '[]');
      } catch(e) {}
    }

    const totalOrders = ordersList.length;
    const totalRevenue = ordersList
      .filter(o => {
        const paySt = (o.payment_status || (o.status === 'Cancelled' ? 'Refunded' : 'Success')).toLowerCase();
        return paySt === 'success';
      })
      .reduce((sum, o) => sum + (Number(o.amount) || 0), 0);

    const ordersEl = document.getElementById('stat-dashboard-orders');
    if (ordersEl) ordersEl.textContent = totalOrders;

    const revEl = document.getElementById('stat-dashboard-revenue');
    if (revEl) revEl.textContent = '₹' + Number(totalRevenue).toLocaleString('en-IN');

    const catEl = document.getElementById('stat-categories');
    if (catEl) catEl.textContent = categories.length;

    document.querySelectorAll('.product-count-badge').forEach(el => el.textContent = adminProducts.length + ' products');
  }

  function populateCategoryDropdowns() {
    const filterOptions = '<option value="">All Categories</option>' + 
      categories.map(c => `<option value="${c.id}">${esc(c.name)}</option>`).join('');
    
    const dashFilter = document.getElementById('dashboard-table-cat-filter');
    const prodFilter = document.getElementById('table-cat-filter');
    if (dashFilter) dashFilter.innerHTML = filterOptions;
    if (prodFilter) prodFilter.innerHTML = filterOptions;

    const modalSelect = document.getElementById('product-category');
    const newSubcatSel = document.getElementById('new-subcat-category');
    if (modalSelect) {
      modalSelect.innerHTML = '<option value="">Select category…</option>' + 
        categories.map(c => `<option value="${c.id}">${esc(c.name)}</option>`).join('');
    }
    if (newSubcatSel) {
      newSubcatSel.innerHTML = '<option value="">Select category…</option>' + 
        categories.map(c => `<option value="${c.id}">${esc(c.name)}</option>`).join('');
    }
  }

  async function handleLogout() {
    try {
      await fetch('api/logout.php');
    } catch(e) {}
    window.location.href = 'index.php';
  }

  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const main = document.querySelector('.main-content');
    const overlay = document.getElementById('sidebar-overlay');
    
    if (window.innerWidth <= 768) {
      sidebar.classList.toggle('open');
      overlay.classList.toggle('open');
    } else {
      sidebar.classList.toggle('closed');
      main.classList.toggle('expanded');
    }
  }

  // ═══════════════════════════════════════
  // ── MESSAGES / INQUIRIES MANAGEMENT ──
  // ═══════════════════════════════════════
  let adminMessages = [];
  let currentViewingMsgId = null;

  async function loadMessages() {
    try {
      const res = await fetch('api/get_messages.php');
      if (res.ok) {
        const dbMsgs = await res.json();
        if (Array.isArray(dbMsgs)) {
          adminMessages = dbMsgs;
          try { localStorage.setItem('raga_messages', JSON.stringify(dbMsgs)); } catch(e){}
        }
      }
    } catch(e) {
      console.warn('Could not fetch messages from server API, using local cache:', e);
      try {
        adminMessages = JSON.parse(localStorage.getItem('raga_messages') || '[]');
      } catch(ign){}
    }
  }

  function renderMessages() {
    const tbody = document.getElementById('messages-tbody');
    const empty = document.getElementById('messages-table-empty');
    if (!tbody || !empty) return;

    let filtered = [...adminMessages];

    const searchVal = (document.getElementById('messages-search')?.value || '').toLowerCase().trim();
    const dateVal = document.getElementById('messages-date-filter')?.value || '';

    if (searchVal) {
      filtered = filtered.filter(m => 
        (m.name && m.name.toLowerCase().includes(searchVal)) ||
        (m.phone && m.phone.toLowerCase().includes(searchVal)) ||
        (m.email && m.email.toLowerCase().includes(searchVal)) ||
        (m.subject && m.subject.toLowerCase().includes(searchVal)) ||
        (m.message && m.message.toLowerCase().includes(searchVal))
      );
    }

    if (dateVal) {
      filtered = filtered.filter(m => {
        if (!m.created_at) return false;
        const d = new Date(m.created_at);
        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}` === dateVal;
      });
    }

    if (filtered.length === 0) {
      tbody.innerHTML = '';
      empty.classList.remove('hidden');
      return;
    }

    empty.classList.add('hidden');

    tbody.innerHTML = filtered.map((m, index) => {
      const snippet = m.message ? (m.message.length > 55 ? m.message.substring(0, 55) + '…' : m.message) : '—';
      
      return `
        <tr class="border-b border-brand-gold/10 last:border-0 hover:bg-brand-cream/15 transition-colors">
          <td class="p-4 font-mono text-xs text-brand-burgundy font-semibold">${index + 1}</td>
          <td class="p-4">
            <div class="font-bold text-sm text-brand-burgundy">${esc(m.name)}</div>
            ${m.phone ? `<a href="tel:${esc(m.phone)}" class="text-xs text-gray-500 hover:text-brand-gold">${esc(m.phone)}</a>` : '<span class="text-xs text-gray-400">No phone</span>'}
          </td>
          <td class="p-4 text-xs text-gray-600">
            ${m.email ? `<a href="mailto:${esc(m.email)}" class="hover:text-brand-burgundy hover:underline">${esc(m.email)}</a>` : '<span class="text-gray-400">—</span>'}
          </td>
          <td class="p-4 text-xs font-semibold text-brand-charcoal">${esc(m.subject || 'General Inquiry')}</td>
          <td class="p-4 text-xs text-gray-600 max-w-xs truncate cursor-pointer hover:text-brand-burgundy" onclick="viewMessageDetails(${m.id})" title="${esc(m.message)}">
            ${esc(snippet)}
          </td>
          <td class="p-4 text-xs text-gray-500 whitespace-nowrap">${m.created_at ? new Date(m.created_at).toLocaleString([], { dateStyle: 'short', timeStyle: 'short' }) : '—'}</td>
          <td class="p-4">
            <div class="flex items-center gap-3">
              <button class="text-brand-burgundy text-xs hover:underline font-bold" onclick="viewMessageDetails(${m.id})">View</button>
              <button class="text-red-500 text-xs hover:underline font-semibold" onclick="deleteMessage(${m.id}, event)">Delete</button>
            </div>
          </td>
        </tr>
      `;
    }).join('');
  }

  function viewMessageDetails(id) {
    const msg = adminMessages.find(m => String(m.id) === String(id));
    if (!msg) return;

    currentViewingMsgId = msg.id;

    document.getElementById('msg-detail-name').textContent = msg.name || '—';
    document.getElementById('msg-detail-date').textContent = msg.created_at ? new Date(msg.created_at).toLocaleString() : '—';
    document.getElementById('msg-detail-phone').textContent = msg.phone || 'Not provided';
    document.getElementById('msg-detail-email').textContent = msg.email || 'Not provided';
    document.getElementById('msg-detail-subject').textContent = msg.subject || 'General Inquiry';
    document.getElementById('msg-detail-body').textContent = msg.message || '—';

    // Action links
    const cleanPhone = (msg.phone || '').replace(/[^0-9]/g, '');
    const waBtn = document.getElementById('msg-whatsapp-btn');
    if (waBtn) {
      if (cleanPhone) {
        waBtn.href = `https://wa.me/${cleanPhone}?text=${encodeURIComponent('Hello ' + (msg.name || '') + ', greetings from Raga Boutique regarding your inquiry on ' + (msg.subject || 'our collection') + '.')}`;
        waBtn.style.display = 'inline-flex';
      } else {
        waBtn.style.display = 'none';
      }
    }

    const emailBtn = document.getElementById('msg-email-btn');
    if (emailBtn) {
      if (msg.email) {
        emailBtn.href = `mailto:${msg.email}?subject=${encodeURIComponent('Re: ' + (msg.subject || 'Inquiry at Raga Boutique'))}&body=${encodeURIComponent('Dear ' + (msg.name || '') + ',\n\nThank you for reaching out to Raga Boutique.\n\n')}`;
        emailBtn.style.display = 'inline-flex';
      } else {
        emailBtn.style.display = 'none';
      }
    }

    openModal('modal-view-message');
  }

  async function deleteMessage(id, event) {
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    if (!confirm('Are you sure you want to delete this message?')) return;

    adminMessages = adminMessages.filter(m => String(m.id) !== String(id));
    try {
      localStorage.setItem('raga_messages', JSON.stringify(adminMessages));
    } catch(e){}

    renderMessages();
    if (currentViewingMsgId === id) {
      closeModal('modal-view-message');
    }

    try {
      await fetch('api/delete_message.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      });
    } catch(e) {
      console.warn('Could not delete message on server:', e);
    }
  }

  // ── Init ──
  async function initAdminApp() {
    try {
      const cRes = await fetch('api/get_categories.php');
      if (cRes.ok) {
        categories = await cRes.json();
        saveCategories();
      }
    } catch(e) { console.error('Failed to load categories', e); }

    try {
      const pRes = await fetch('api/get_products.php');
      if (pRes.ok) adminProducts = await pRes.json();
    } catch(e) { console.error('Failed to load products', e); }
    
    try {
      const oRes = await fetch('api/get_orders.php');
      if (oRes.ok) adminOrders = await oRes.json();
    } catch(e) { console.error('Failed to load orders', e); }

    await loadMessages();
    
    populateCategoryDropdowns();
    updateStats();
    renderTable(adminProducts);
    renderCategoryGrid();
    renderOrders();
    renderTransactions();
    renderTransactionHistory();
    renderMessages();
    
    const initialView = window.location.hash ? window.location.hash.substring(1) : 'dashboard';
    switchView(initialView);
  }
  
  initAdminApp();
</script>
</body>
</html>
