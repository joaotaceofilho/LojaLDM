document.addEventListener('DOMContentLoaded', function () {
    var mainImage = document.querySelector('#product-main-image');

    document.querySelectorAll('.product-thumbnail').forEach(function (thumbnail) {
        thumbnail.addEventListener('click', function () {
            if (!mainImage) {
                return;
            }

            mainImage.src = thumbnail.dataset.image;
            document.querySelectorAll('.product-thumbnail').forEach(function (item) {
                item.classList.remove('active');
            });
            thumbnail.classList.add('active');
        });
    });
});