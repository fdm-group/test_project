jQuery(function($){
  $('.salesforce-contact-form').each(function(){

  var $form = $(this).children('form');
  var $thanks = $(this).children('.scf-thank-you');

  // 'Name' field is a honeypot - hide it from humans
  $form.find('[name=Name]').prop('required',false).parent().hide();

  $form.on('submit', function(e){

    var dataArr = $form.serializeArray();
    var dataObj = {};
    for (var i=0; i<dataArr.length; i++) {
      dataObj[dataArr[i].name] = dataArr[i].value;
    }

    // honeypot
    if (dataObj.Name) {return false;}
    delete dataObj.Name;

    $.ajax({
      type: "POST",
      dataType: "json",
      contentType: "application/json; charset=UTF-8",
      data: JSON.stringify(dataObj),
      processData: false,
     url: "https://applications.fdmgroup.com/services/apexrest/EnquiryService"
    }).done(function(){
      $form.fadeOut(400, function(){
        $thanks.fadeIn(400);
      });

    }).fail(function(jqXHR, textStatus, errorThrown){
      alert('Sorry, we are experiencing some technical issues - your message was not submitted.');
      console.log(jqXHR, textStatus, errorThrown);
    });

    return false;

  });

});

});
