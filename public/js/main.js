function toggleNavigation(element) {
    jQuery(element).toggle(200);
}

function loadListeners() {
    var button;
    if(button = document.getElementById('member-menu-btn')) {
        button.addEventListener('click', function () {
            toggleNavigation(document.getElementById('responsive-nav-authed'));
        }, false);
    }
}

function init() {
    loadListeners();
}

window.onload = function() {
    init();
};