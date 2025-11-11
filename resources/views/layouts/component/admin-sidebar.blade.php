<aside id="sidebar"
  class="sidebar sidebar-expanded bg-gradient-to-b from-green-800 to-green-900 text-white h-screen fixed lg:relative z-40 lg:z-auto transition-all duration-300 shadow-2xl">

  <div class="p-4 border-b border-green-700/50 backdrop-blur-sm">
    <div class="flex items-center space-x-3 group">
      <div class="relative">
        <img src="{{ asset('images/logo.png') }}" alt="Logo"
          class="h-10 w-10 mx-1 rounded-full ring-2 ring-green-600 group-hover:ring-green-400 transition-all duration-300">
        <div
          class="absolute inset-0 rounded-full bg-green-400 opacity-0 group-hover:opacity-20 blur-md transition-all duration-300">
        </div>
      </div>
      <div class="flex flex-col leading-tight sidebar-text">
        <h1 class="text-white font-bold text-sm tracking-tight whitespace-nowrap">
          PPDB MISBAHUNNUR
        </h1>
        <h2 class="text-green-100 font-semibold text-xs uppercase whitespace-nowrap">
          Cimahi
        </h2>
      </div>
    </div>
  </div>

  <nav
    class="mt-6 overflow-y-auto h-[calc(100vh-200px)] scrollbar-thin scrollbar-thumb-green-700 scrollbar-track-transparent">
    <ul class="space-y-2 px-3">
      <li>
        <a href="{{ route('admin.registrations.registrant') }}"
          class="group flex items-center space-x-3 px-5 py-2.5 rounded-lg text-sm font-medium transition-all duration-300 transform hover:translate-x-1
                          {{ request()->routeIs('admin.registrations.registrant') ? 'bg-green-700 text-white shadow-lg' : 'text-green-100 hover:bg-green-700/70 hover:text-white' }}">
          <i class="fa-solid fa-users w-5 text-center transition-transform duration-300 group-hover:scale-110"></i>
          <span class="sidebar-text">Pendaftaran</span>
          <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300 sidebar-text">
            <i class="fa-solid fa-chevron-right text-xs"></i>
          </span>
        </a>
      </li>

      <li>
        <a href="{{ route('admin.students.mts') }}"
          class="group flex items-center space-x-3 px-5 py-2.5 rounded-lg text-sm font-medium transition-all duration-300 transform hover:translate-x-1
                          {{ request()->routeIs('admin.students.mts') ? 'bg-green-700 text-white shadow-lg' : 'text-green-100 hover:bg-green-700/70 hover:text-white' }}">
          <i
            class="fa-solid fa-graduation-cap w-5 text-center transition-transform duration-300 group-hover:scale-110"></i>
          <span class="sidebar-text">Siswa MTS</span>
          <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300 sidebar-text">
            <i class="fa-solid fa-chevron-right text-xs"></i>
          </span>
        </a>
      </li>

      <li>
        <a href="{{ route('admin.students.ma') }}"
          class="group flex items-center space-x-3 px-5 py-2.5 rounded-lg text-sm font-medium transition-all duration-300 transform hover:translate-x-1
                          {{ request()->routeIs('admin.students.ma') ? 'bg-green-700 text-white shadow-lg' : 'text-green-100 hover:bg-green-700/70 hover:text-white' }}">
          <i
            class="fa-solid fa-user-graduate w-5 text-center transition-transform duration-300 group-hover:scale-110"></i>
          <span class="sidebar-text">Siswa MA</span>
          <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300 sidebar-text">
            <i class="fa-solid fa-chevron-right text-xs"></i>
          </span>
        </a>
      </li>

      <li class="py-2">
        <div class="border-t border-green-700/50"></div>
      </li>

      <li>
        <a href="#"
          class="group flex items-center space-x-3 px-5 py-2.5 rounded-lg text-sm font-medium text-green-100 hover:bg-green-700/70 hover:text-white transition-all duration-300 transform hover:translate-x-1">
          <i class="fa-solid fa-chart-bar w-5 text-center transition-transform duration-300 group-hover:scale-110"></i>
          <span class="sidebar-text">Nilai</span>
          <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300 sidebar-text">
            <i class="fa-solid fa-chevron-right text-xs"></i>
          </span>
        </a>
      </li>

      <li>
        <a href="#"
          class="group flex items-center space-x-3 px-5 py-2.5 rounded-lg text-sm font-medium text-green-100 hover:bg-green-700/70 hover:text-white transition-all duration-300 transform hover:translate-x-1">
          <i
            class="fa-solid fa-credit-card w-5 text-center transition-transform duration-300 group-hover:scale-110"></i>
          <span class="sidebar-text">Pembayaran</span>
          <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300 sidebar-text">
            <i class="fa-solid fa-chevron-right text-xs"></i>
          </span>
        </a>
      </li>

      <li>
        <a href="#"
          class="group flex items-center space-x-3 px-5 py-2.5 rounded-lg text-sm font-medium text-green-100 hover:bg-green-700/70 hover:text-white transition-all duration-300 transform hover:translate-x-1">
          <i class="fa-solid fa-tag w-5 text-center transition-transform duration-300 group-hover:scale-110"></i>
          <span class="sidebar-text">Harga</span>
          <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300 sidebar-text">
            <i class="fa-solid fa-chevron-right text-xs"></i>
          </span>
        </a>
      </li>

      <li>
        <a href="#"
          class="group flex items-center space-x-3 px-5 py-2.5 rounded-lg text-sm font-medium text-green-100 hover:bg-green-700/70 hover:text-white transition-all duration-300 transform hover:translate-x-1">
          <i
            class="fa-solid fa-heart-pulse w-5 text-center transition-transform duration-300 group-hover:scale-110"></i>
          <span class="sidebar-text">Riwayat Kesehatan</span>
          <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300 sidebar-text">
            <i class="fa-solid fa-chevron-right text-xs"></i>
          </span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="absolute bottom-4 left-4 right-4 hidden lg:block">
    <button onclick="toggleDesktopSidebar()"
      class="group w-full flex items-center justify-center space-x-2 px-3 py-2.5 rounded-lg text-sm font-medium text-green-100 hover:bg-green-700 hover:text-white transition-all duration-300 border border-green-700/50 hover:border-green-600">
      <i class="fa-solid fa-chevron-left collapse-icon transition-transform duration-300 group-hover:scale-110"></i>
      <span class="sidebar-text">Sembunyikan</span>
    </button>
  </div>
</aside>

<div id="sidebar-overlay"
  class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden transition-opacity duration-300"
  onclick="toggleSidebar()"></div>

<style>
  .sidebar-expanded {
    width: 256px;
  }

  .sidebar-collapsed {
    width: 80px;
  }

  .sidebar-collapsed .sidebar-text {
    opacity: 0;
    width: 0;
    overflow: hidden;
  }

  .sidebar-collapsed .collapse-icon {
    transform: rotate(180deg);
  }

  @media (max-width: 1023px) {
    .sidebar {
      transform: translateX(-100%);
    }

    .sidebar-mobile-open {
      transform: translateX(0);
    }
  }

  .content-expanded {
    margin-left: 256px;
  }

  .content-collapsed {
    margin-left: 80px;
  }

  @media (max-width: 1023px) {

    .content-expanded,
    .content-collapsed {
      margin-left: 0;
    }
  }

  .scrollbar-thin::-webkit-scrollbar {
    width: 6px;
  }

  .scrollbar-thin::-webkit-scrollbar-track {
    background: transparent;
  }

  .scrollbar-thin::-webkit-scrollbar-thumb {
    background: #166534;
    border-radius: 3px;
  }

  .scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #15803d;
  }

  /* Hover Effects */
  .group:hover .fa-chevron-right {
    animation: bounce-right 0.6s ease-in-out;
  }

  @keyframes bounce-right {

    0%,
    100% {
      transform: translateX(0);
    }

    50% {
      transform: translateX(4px);
    }
  }
</style>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    sidebar.classList.toggle('sidebar-mobile-open');
    overlay.classList.toggle('hidden');

    if (sidebar.classList.contains('sidebar-mobile-open')) {
      overlay.style.opacity = '0';
      setTimeout(() => {
        overlay.style.opacity = '1';
      }, 10);
    } else {
      overlay.style.opacity = '0';
    }
  }

  function toggleDesktopSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const collapseIcon = document.querySelector('.collapse-icon');

    sidebar.classList.toggle('sidebar-expanded');
    sidebar.classList.toggle('sidebar-collapsed');

    if (content) {
      content.classList.toggle('content-expanded');
      content.classList.toggle('content-collapsed');
    }

    collapseIcon.style.transform = sidebar.classList.contains('sidebar-collapsed') ?
      'rotate(180deg)' :
      'rotate(0deg)';

    const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
    localStorage.setItem('sidebarCollapsed', isCollapsed);
  }

  document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

    if (isCollapsed) {
      sidebar.classList.remove('sidebar-expanded');
      sidebar.classList.add('sidebar-collapsed');
      if (content) {
        content.classList.remove('content-expanded');
        content.classList.add('content-collapsed');
      }
    } else {
      sidebar.classList.add('sidebar-expanded');
      if (content) {
        content.classList.add('content-expanded');
      }
    }

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  });

  document.querySelectorAll('#sidebar a').forEach(link => {
    link.addEventListener('click', function() {
      if (window.innerWidth < 1024) {
        toggleSidebar();
      }
    });
  });

  let resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebar-overlay');

      if (window.innerWidth >= 1024) {
        sidebar.classList.remove('sidebar-mobile-open');
        overlay.classList.add('hidden');
      }
    }, 250);
  });
</script>
