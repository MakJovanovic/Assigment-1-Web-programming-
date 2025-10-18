
    const modal = document.getElementById('modal');
    const modalImg = document.getElementById('modal-img');
    const captionText = document.getElementById('caption');
    const closeModal = document.getElementsByClassName('close')[0];

    document.querySelectorAll('.thumbnail').forEach(function(thumbnail) {
        thumbnail.addEventListener('click', function() {
            modal.style.display = 'block';
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        });
    });

    closeModal.onclick = function() {
        modal.style.display = 'none';
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    document.querySelectorAll('.view-more').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            alert('More details about ' + this.dataset.product + ' will be available soon!');
        });
    });

    document.querySelectorAll('.toggle-description').forEach(function(button) {
        button.addEventListener('click', function() {
            const description = this.nextElementSibling;
            if (description.style.display === 'none' || description.style.display === '') {
                description.style.display = 'block';
            } else {
                description.style.display = 'none';
            }
        });
    });