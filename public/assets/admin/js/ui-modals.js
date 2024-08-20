document.addEventListener('DOMContentLoaded', (event) => {
    var modal = document.getElementById("myModal");
    var modalImage = document.getElementById("modalImage");
    var closeModalButton = document.getElementById("closeModal");
    var span = document.getElementsByClassName("close")[0];

    document.querySelectorAll('.btn-primary').forEach(button => {
        button.onclick = function() {
            var imageUrl = this.getAttribute('data-image-url');
            modalImage.src = imageUrl;
            modal.style.display = "block";
        }
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    closeModalButton.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
