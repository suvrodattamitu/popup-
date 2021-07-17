(function($) {
    let settings = $('#fizzy-popup-modal-light').data('settings');
    let html_element;
    console.log(settings);

    if(settings) {
        //show on page load
        if (settings.trigger_type === 'page_load') {
            setTimeout(showFizzyPopups, settings.display_time);
        }

        //show on click
        else if (settings.trigger_type === 'on_click') {
            html_element = settings.html_element;
            if(html_element) {
                html_element = (html_element[0] === '#') ? html_element : '#'+html_element;
                $(html_element).on('click',function(){
                    showFizzyPopups();
                });
            }
        }
    }

    //show timer after 3 seconds
    function showFizzyPopups() {
        //var modal = document.getElementById("fizzy-popup-modal-light");
       // modal.style.display = "block";
       $("#fizzy-popup-modal-light").removeAttr("style");
       $('#fizzy-popup-modal-light').css({'display' : 'block'});
    }

    //close popup on outside click
    document.getElementById('fizzy-popup-modal-light').onclick = function(event){
        let modal = document.getElementById("fizzy-popup-modal-light");
        if (event.target == modal) {
            //modal.remove();
           // modal.style.display = "none";
           $(html_element).find("#fizzy-popup-modal-light").removeAttr("style");
           $(html_element).find('#fizzy-popup-modal-light').css({'display' : 'none'});
        }
    }

    //close popup on button click
    let button = document.getElementById('close_fizzy_popup');
    if( button ) {
        button.onclick = function(){
            //var modal = document.getElementById("fizzy-popup-modal-light");
            //console.log('clicked', modal)
            //$('#fizzy-popup-modal-light').toggleClass("show_popup hide_popup");
           //modal.style.display = "none";
           $(html_element+" #fizzy-popup-modal-light").removeAttr("style");
           $(html_element+" #fizzy-popup-modal-light").css({'display' : 'none'});
           //console.log(modal.style)
        };
    }
})(jQuery);