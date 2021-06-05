(function() {
    //show timer after 3 seconds
    function showFizzyPopups() {
        var modal = document.getElementById("fizzy-popup-modal-light");
        modal.style.display = "block";
    }
    setTimeout(showFizzyPopups, 3000);

    //close popup on outside click
    document.getElementById('fizzy-popup-modal-light').onclick = function(event){
        let modal = document.getElementById("fizzy-popup-modal-light");
        if (event.target == modal) {
            modal.remove();
        }
    }

    //close popup on button click
    let button = document.getElementById('close_fizzy_popup');
    if( button ) {
        button.onclick = function(){
            var modal = document.getElementById("fizzy-popup-modal-light");
            modal.remove();
        };
    }
})();