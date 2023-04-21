const elements = document.querySelectorAll('.postElement');

elements.forEach(function(element) {
    let params = JSON.parse(element.getAttribute('data-post-params'));
    let isAsc = true;
    element.addEventListener('click', function() {
        params.order = isAsc ? 'DESC' : 'ASC';
        const url = element.getAttribute('data-post-url');
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(params)
        };
        console.log(params)
        fetch(url, options)
            .then(response => {
                if (response.ok) {
                    console.log('POST wysłany pomyślnie');
                } else {
                    console.error('Wysyłanie POST zakończone błędem');
                }
            })
            .catch(error => console.error(error));
        isAsc = !isAsc;
    });
});