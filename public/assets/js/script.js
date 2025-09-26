$(function(){
    "use strict"

    let offCanvasElement, offCanvasEl;
    $(document).on("click", ".modalDrawer", function(){   
        var el = $(this).data("identifier"); 
        offCanvasElement = document.querySelector('#'+el);
        offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
        offCanvasEl.show();
    })
})