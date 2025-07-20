document.addEventListener('DOMContentLoaded', function() {
    // Wait for Livewire to be ready
    document.addEventListener('livewire:navigated', initializeSidebar);
    initializeSidebar();
    
    function initializeSidebar() {
        const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
        const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
        const sidebar = document.getElementById('sidebarMenu');
        const backdrop = document.getElementById('sidebarBackdrop');

        if (!sidebarToggleBtn || !sidebar || !backdrop) return;

        function showSidebar() {
            sidebar.classList.add('show');
            backdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function hideSidebar() {
            sidebar.classList.remove('show');
            backdrop.classList.remove('show');
            document.body.style.overflow = '';
        }

        // Remove existing listeners to prevent duplicates
        const newToggleBtn = sidebarToggleBtn.cloneNode(true);
        sidebarToggleBtn.parentNode.replaceChild(newToggleBtn, sidebarToggleBtn);
        
        if (sidebarCloseBtn) {
            const newCloseBtn = sidebarCloseBtn.cloneNode(true);
            sidebarCloseBtn.parentNode.replaceChild(newCloseBtn, sidebarCloseBtn);
        }

        // Add event listeners
        newToggleBtn.addEventListener('click', showSidebar);
        
        if (document.getElementById('sidebarCloseBtn')) {
            document.getElementById('sidebarCloseBtn').addEventListener('click', hideSidebar);
        }

        backdrop.addEventListener('click', hideSidebar);

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                hideSidebar();
            }
        });

        // Close sidebar when clicking on nav links on mobile
        const navLinks = sidebar.querySelectorAll('a.nav-link:not(.accordion-button)');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    setTimeout(hideSidebar, 100); // Small delay for Livewire navigation
                }
            });
        });
    }
});