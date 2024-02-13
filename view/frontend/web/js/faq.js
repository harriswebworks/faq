define(['jquery'], function ($) {
    'use strict';
    // Hide all answers initially
    $('.hww-faq-answer').hide();

    // Show the selected category section on category link click
    $('.category-link').on('click', function (event) {
        event.preventDefault();

        $(".faq-item").show();
        $(".faq-item").removeClass("active")
        $(".hww-faq-category-name").show();
        $('.hww-faq-answer').hide();
        $("span").removeClass("highlight");

        var categoryId = $(this).data('category-id');

        if (categoryId === 'show-all') {
            // Show all category sections
            $('.category-section').show();
        } else {
            // Hide all other category sections
            $('.category-section').hide();

            // Show the selected category section
            $('#category-' + categoryId).show();
        }
    });

    // Toggle answer visibility on question click
    $(".faq-item").on("click", function () {
        $(this).find(".hww-faq-answer").slideToggle(500);
        $(this).toggleClass("active");

    });
});
