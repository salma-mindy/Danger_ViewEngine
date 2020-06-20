$(document).ready(function() {
    // Delete 
    $('.delete').click(function() {
        var el = this;

        // Delete id
        var deleteid = $(this).data('id');

        // Confirm box
        bootbox.confirm("Vous êtes sur le point de supprimer cet opérateur, voulez-vous continuer? ", function(result) {

            if (result) {
                // AJAX Request
                $.ajax({
                    url: '../admin/delete-op.php',
                    type: 'POST',
                    data: { id: deleteid },
                    success: function(response) {
                        if (response == 1) {
                            $(el).closest('tr').css('background', 'tomato');
                            $(el).closest('tr').fadeOut(800, function() {
                                $(this).remove();
                            });
                        } else {
                            bootbox.alert('Opérateur non supprimer.');
                        }

                    }
                });
            }

        }).css('color', '#000');

    });
});