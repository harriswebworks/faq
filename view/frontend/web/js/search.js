define(['jquery'], function ($) {
    'use strict';
    function performSearch() {

        var searchTerm = $("#search-bar").val().toLowerCase();

        // Check if searchTerm is null or empty
        if (!searchTerm) {
            // Set everything to default
            $(".faq-item").show();
            $(".hww-faq-category-name").show();
            $('.hww-faq-answer').hide();
            $(".faq-item").removeClass("active");
            $("span").removeClass("highlight");

            return;
        }

        // Hide all FAQ items, answers, and corresponding category names
        $(".faq-item").hide();
        $(".hww-faq-category-name").hide();
        $('.hww-faq-answer').hide();

        // Iterate through each FAQ item and show if it matches the search term
        $(".faq-item").filter(function () {
            var questionText = $(this).find(".hww-faq-question").text().toLowerCase();
            var answerText = $(this).find(".hww-faq-answer").text().toLowerCase();

            // Check if the search term is present in the question or answer
            var isMatch = questionText.includes(searchTerm) || answerText.includes(searchTerm);

            // Show the corresponding category name and answer if there is a match
            if (isMatch) {
                var categoryId = $(this).closest(".hww-faq-category-section").attr("id").replace("category-", "");
                $("#category-" + categoryId + " .hww-faq-category-name").show();
                $(this).find(".hww-faq-answer").show();
                $(".faq-item").addClass("active")
            }
            return isMatch;
        }).show();

        // Highlight the keyword in the displayed FAQ items
        $(".faq-item:visible").each(function () {
            var questionText = $(this).find(".hww-faq-question").text();
            var answerText = $(this).find(".hww-faq-answer").text();

            // Highlight the keyword in the question and answer
            questionText = questionText.replace(new RegExp(searchTerm, "gi"), function (match) {
                return "<span class='highlight'>" + match + "</span>";
            });
            answerText = answerText.replace(new RegExp(searchTerm, "gi"), function (match) {
                return "<span class='highlight'>" + match + "</span>";
            });

            // Update the HTML with the highlighted text
            $(this).find(".hww-faq-question").html(questionText);
            $(this).find(".hww-faq-answer").html(answerText);
        });
    }

    $("#search-button").click(performSearch);

    // Keypress event for Enter key on search bar
    $("#search-bar").keypress(function (event) {
        if (event.which === 13) { // Enter key
            performSearch();
        }
    });
});
