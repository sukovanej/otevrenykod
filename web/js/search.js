$(document).ready(function () {
    $.post("/ajax/search", function (data) {
        var $input = $(".search-box");

        $input.typeahead({
            source: data
        });
    });
});