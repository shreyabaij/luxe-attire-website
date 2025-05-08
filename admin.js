// JavaScript for Responsive Admin Dashboard

// Function to adjust the layout based on window size
function adjustLayout() {
    const menu = document.getElementById('menu');
    const interfaceSection = document.getElementById('interface');

    if (window.innerWidth < 768) {
        // For mobile view
        menu.style.width = '100%';
        interfaceSection.style.marginLeft = '0';
    } else {
        // For desktop view
        menu.style.width = '250px';
        interfaceSection.style.marginLeft = '250px';
    }
}

// Event listener for window resize
window.addEventListener('resize', adjustLayout);

// Initial call to set layout on page load
adjustLayout();