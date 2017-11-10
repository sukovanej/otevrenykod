function render(element) {
    var value = element.val();

    if (value == 2) {
        $("#content_add_form_perex").parent().parent().fadeOut();
        $("#content_add_form_imageFileObject").parent().parent().fadeOut();
    } else if (value == 3) {
        $("#content_add_form_perex").parent().parent().fadeOut();
        $("#content_add_form_category").parent().parent().fadeOut();
        $("#content_add_form_title").parent().parent().fadeOut();
        $("#content_add_form_imageFileObject").parent().parent().fadeOut();
    } else {
        $("#content_add_form_perex").parent().parent().fadeIn();
        $("#content_add_form_category").parent().parent().fadeIn();
        $("#content_add_form_title").parent().parent().fadeIn();
        $("#content_add_form_imageFileObject").parent().parent().fadeIn();
    }
}