$(document).ready(function(){
    $(".button-collapse").sideNav(); //mobile menu open action
    $('.slider').slider();
    $('.collapsible').collapsible();
    $('#submitMainInputFormToShort,#resetMainInputFormToShort').click(function(event){
        return false;
    });

});

function showResaultFromShortnerFile() {
    $.ajax({
        type: 'POST',
        url: 'shortner.php',
        data: $('#shortnerForm').serialize(),
        success: function (response) {
            if(response == "Invalid URL"){
                $('#ShowShortLink').html("لینک وارد شده اشتباه است: لینک صحیح با ://http یا ://https شروع می شود");
                $('#ShowShortLink').addClass('black-text');
            }else{
                $('#ShowShortLink').removeClass('black-text');
                $('#ShowShortLink').html(response);
                $('#ShowShortLink').attr('href',response);
            }
        }
    });
}

function resetMainInput() {
    $('#mainInputGetLongLink').val("");
}
