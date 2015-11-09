$('#form').on('submit', function () {
    var $this = $(this),
        contents = $this.serialize();
    // Post the results from the form.
    $.ajax({
        url: '',
        dataType: 'text',
        type: 'post',
        data: contents,
        success: function (data) {
        // On successfull ajax request wright out the 'div#contents' 
        // container with 'data' response.
            $('#contents').html(data);

        },
        // Throw error if ajax request fails.
        error: function (xhr, ajaxOptions, thrownError) {

            alert(thrownError);
        }
    });
    // Disable the form submitting.
    return false;
});
