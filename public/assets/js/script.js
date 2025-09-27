$(function(){
    "use strict"

    let offCanvasElement, offCanvasEl;
    $(document).on("click", ".modalDrawer", function(){   
        var el = $(this).data("identifier"); 
        offCanvasElement = document.querySelector('#'+el);
        offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
        offCanvasEl.show();
    });

    $(document).on("click", ".modalDrawerEdit", function(){
        let id = $(this).data('id');
        let model = $(this).data('model');
        var el = $(this).data("identifier");
        $.ajax({
            type: 'GET',
            url: '/ajax/edit',
            data: {'id': id, 'model': model},
            dataType: "json",
            success: function (res) {
                if(model === 'branch'){
                    const name = document.querySelector('.editName');
                    name.value = res.data.name;
                    const code = document.querySelector('.editCode');
                    code.value = res.data.code;
                    const mobile = document.querySelector('.editMobile');
                    mobile.value = res.data.mobile;
                    const contact = document.querySelector('.editContact');
                    contact.value = res.data.contact ?? null;
                    const address = document.querySelector('.editAddress');
                    address.value = res.data.address;
                }                 
                offCanvasElement = document.querySelector('#'+el);
                offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }            
        });  
    })
})