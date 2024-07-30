document.addEventListener('DOMContentLoaded', function() {
    fetch('gallery.php')
        .then(response => response.json())
        .then(photos => {
            const gallery = document.getElementById('gallery');
            if (photos.error) {
                console.error('Error:', photos.error);
                return;
            }
            photos.forEach(photo => {
                const img = document.createElement('img');

                img.style.maxWidth = "40%";
                img.style.maxHeight = "70%";
                const html =
                    '<div class="bloc"> ' +
                    ''
                img.src = `photos/${photo}`;
                img.alt = photo;
                const bloc = document.createElement("div");
                bloc.classList.add('bloc');
                bloc.appendChild(img);
                gallery.appendChild(bloc);


            });
        })
        .catch(error => console.error('Error fetching photos:', error));
});
