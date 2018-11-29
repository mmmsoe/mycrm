$('#products').change(function() {
    var make = $('option:selected', this).data('make');
    var model = $('option:selected', this).data('model');

    $('#make').html( make );
    $('#model').html( model );
});

$('#customers').change(function() {
    var email = $('option:selected', this).data('email');
    var phone = $('option:selected', this).data('phone');

    $('#email').html( email );
    $('#phone').html( phone );
});
