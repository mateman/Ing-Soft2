
function Confirm(title, msg, link) { /*change*/
        var $content =  "<div class='dialog-ovelay'>" +
                        "<div class='dialog'><header>" +
                         " <h3> " + title + " </h3> " +
                         "<i class='fa fa-close'></i>" +
                     "</header>" +
                     "<div class='dialog-msg'>" +
                         " <p> " + msg + " </p> " +
                     "</div>" +
                     "<footer>" +
                         "<div class='controls'>" +
                             " <button class='btn btn-success doAction'>" + 'Ok' + "</button> " +
                             " <button class='btn btn-danger cancelAction'>" + 'Cancelar' + "</button> " +
                         "</div>" +
                     "</footer>" +
                  "</div>" +
                "</div>";
         $('body').prepend($content);
      $('.doAction').click(function () {
       
      window.location=link;
      
        $(this).parents('.dialog-ovelay').fadeOut(500, function () {
          $(this).remove();
         
        });
      
      });
$('.cancelAction, .fa-close').click(function () {
        $(this).parents('.dialog-ovelay').fadeOut(500, function () {
          $(this).remove();
            ;
        });
      });
      
   }

function Alerta(title, msg) { /*change*/
    var $content =  "<div class='dialog-ovelay'>" +
        "<div class='dialog'><header>" +
        " <h3> " + title + " </h3> " +
        "<i class='fa fa-close'></i>" +
        "</header>" +
        "<div class='dialog-msg'>" +
        " <p> " + msg + " </p> " +
        "</div>" +
        "<footer>" +
        "<div class='controls'>" +
        " <button class='btn btn-success cancelAction'>" + 'Ok' + "</button> " +
        "</div>" +
        "</footer>" +
        "</div>" +
        "</div>";
    $('body').prepend($content);
    $('.cancelAction, .fa-close').click(function () {
        $(this).parents('.dialog-ovelay').fadeOut(500, function () {
            $(this).remove();
            ;
        });
    });

}
