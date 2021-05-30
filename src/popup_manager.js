(function() {
    //show timer after 3 seconds
    function showNinjaPopups() {
        var modal = document.getElementById("ninja-popup-modal-light");
        modal.style.display = "block";
    }
    setTimeout(showNinjaPopups, 3000);

    //close popup on outside click
    document.getElementById('ninja-popup-modal-light').onclick = function(event){
        let modal = document.getElementById("ninja-popup-modal-light");
        if (event.target == modal) {
            modal.remove();
        }
    }

    //close popup on button click
    document.getElementById('close_ninja_popup').onclick = function(){
        var modal = document.getElementById("ninja-popup-modal-light");
        modal.remove();
    };
})();