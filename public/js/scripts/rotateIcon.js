const icons = document.querySelectorAll('.rotate-icon');

icons.forEach(function(icon) {
    icon.addEventListener('click', function() {
        icons.forEach(function(otherIcon) {
            if (otherIcon !== icon)
                otherIcon.style.transform = 'none';
        });
        if (icon.style.transform === 'rotate(180deg)') {
            icon.style.transform = 'none';
            removeParam('order');
        } else {
            icon.style.transform = 'rotate(180deg)';
            addParam('order', 'desc');
        }
    });
});

function addParam(name, value) {
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.set(name, value);
    const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?" + searchParams.toString();
    window.history.pushState({path: newUrl}, '', newUrl);
}

function removeParam(name) {
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.delete(name);
    const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?" + searchParams.toString();
    window.history.pushState({path: newUrl}, '', newUrl);
}