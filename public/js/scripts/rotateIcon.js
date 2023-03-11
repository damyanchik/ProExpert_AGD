const icons = document.querySelectorAll('.rotate-icon');

icons.forEach(function(icon) {
    icon.addEventListener('click', function() {
        icons.forEach(function(otherIcon) {
            if (otherIcon !== icon) {
                otherIcon.style.transform = 'none';
            }
        });
        icon.style.transform = 'rotate(180deg)';
    });
});