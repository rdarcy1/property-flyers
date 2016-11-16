$(function () {

    /**
     * Show delete button when hovering over image
     */

    var fadeTime = 500;

    // Hide delete buttons by default
    $('.delete-thumbnail').hide();

    $('.gallery__image').hover(
        function () {
            $(this).children('.delete-thumbnail').stop(true, true).fadeIn(fadeTime);
        }, function () {
            $(this).children('.delete-thumbnail').stop(true, true).fadeOut(fadeTime);
        }
    );

});

//# sourceMappingURL=scripts.js.map
