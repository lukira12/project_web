document.addEventListener('DOMContentLoaded', () => {
  // Mengatur dropdown untuk profil admin
  const dropdownTrigger = document.querySelector('.user-profile');
  const dropdownContent = document.querySelector('.dropdown-content');

  dropdownTrigger.addEventListener('click', (event) => {
    event.stopPropagation(); // Mencegah klik di luar area dropdown menutup dropdown
    dropdownContent.classList.toggle('show');
  });

  // Menutup dropdown jika klik di luar area dropdown
  window.addEventListener('click', (e) => {
    if (!dropdownTrigger.contains(e.target)) {
      dropdownContent.classList.remove('show');
    }
  });

  // Mengatur sidebar toggle
  const toggleBtn = document.querySelector('.toggle-btn');
  const sidebar = document.querySelector('.sidebar');
  const body = document.body;

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed'); // Toggle sidebar
    // Jika sidebar menyusut, sesuaikan margin konten
    if (sidebar.classList.contains('collapsed')) {
      body.style.marginLeft = '80px';
    } else {
      body.style.marginLeft = '250px';
    }
  });

  // Mencegah klik di luar sidebar atau tombol hamburger untuk menutup sidebar
  window.addEventListener('click', (e) => {
    if (!toggleBtn.contains(e.target)) {
      return; // Hanya biarkan tombol hamburger yang mengubah status sidebar
    }
  });
});
