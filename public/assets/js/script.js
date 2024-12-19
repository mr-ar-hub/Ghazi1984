// Open navbar
function toggleMobileNavbar() {
    var navbar = document.getElementById("mobileNavbar");
    if (navbar.style.display === "block") {
        navbar.style.display = "none";
    } else {
        navbar.style.display = "block";
    }
}

// Close navbar
function closeMobileNavbar() {
    var navbar = document.getElementById("mobileNavbar");
    navbar.style.display = "none";
}

// Manage tabs
function openTab(event, tabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    event.currentTarget.className += " active";
}

//Menu tab open by default
document.getElementById("defaultOpen").click();

// mouse dropdown
document.querySelector('.search-toggle').addEventListener('mouseenter', function () {
    var searchBox = this.querySelector('.search-box');
    searchBox.style.display = 'flex';
});

document.querySelector('.search-toggle').addEventListener('mouseleave', function () {
    var searchBox = this.querySelector('.search-box');
    searchBox.style.display = 'none';
});

// account sidebar
document.getElementById('account-sidebar-btn').addEventListener('click', function () {
    var sidebar = document.getElementById('account-sidebar');
    sidebar.classList.toggle('open');
});

document.getElementById('account-sidebar-close').addEventListener('click', function () {
    var sidebar = document.getElementById('account-sidebar');
    sidebar.classList.remove('open');
});

// Back to top
window.onscroll = function () { 
    scrollFunction();
    addStickyClass()
};

function scrollFunction() {
    const backToTopBtn = document.getElementById("backToTopBtn");
    const windowHeight = window.innerHeight;
    const scrollPosition = window.scrollY;

    if (scrollPosition > windowHeight / 2) {
        backToTopBtn.style.display = "block";
    } else {
        backToTopBtn.style.display = "none";
    }
}

document.getElementById("backToTopBtn").addEventListener("click", function () {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});

function addStickyClass() {
    var desktopHeader = document.querySelector(".main-desktop-header");
    var mobileHeader = document.querySelector(".main-mobile-header");

    if (window.scrollY > 40) {
        desktopHeader.classList.add("sticky");
    } else {
        desktopHeader.classList.remove("sticky");
    }

    if (window.scrollY > 30) {
        mobileHeader.classList.add("sticky");
    } else {
        mobileHeader.classList.remove("sticky");
    }
}