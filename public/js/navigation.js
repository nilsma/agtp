function toggleNavigation(element) {
    var otherMenu;
    var toggleDuration = 200;

    if(element.id == 'responsive-nav-unauthed') {
        otherMenu = document.getElementById('responsive-nav-authed');
    } else {
        otherMenu = document.getElementById('responsive-nav-unauthed');
    }

    if(otherMenu && jQuery(otherMenu).css('display') !== 'none') {
        setElementVisibility(otherMenu, 'hidden', function() {
            jQuery(element).toggle(toggleDuration);
            jQuery(otherMenu).toggle(toggleDuration);
            setElementVisibility(otherMenu, 'visible', function() {
                //do nothing
            });
        });
    } else {
        jQuery(element).toggle(toggleDuration);
    }

}

function setElementVisibility(element, visibility, callback) {
    jQuery(element).css('visibility', visibility);
    callback();
}

function loadListeners() {
    var button;
    if(button = document.getElementById('visitor-menu-btn')) {
        button.addEventListener('click', function () {
            toggleNavigation(document.getElementById('responsive-nav-unauthed'));
        }, false);
    }

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