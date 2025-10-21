$(function(){
    "use strict"

    $(".datatables-basic").dataTable();

    select2 = $('.select2');
    if (select2.length) {
        select2.each(function() {
            var $this = $(this);
            /*$this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            });*/
            $this.select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            });
        });
    }

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
                    const btype = document.querySelector('.bType');
                    btype.value = res.data.type;
                    $(".bType").select2();
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
    });

    $(document).on("click", ".addNewDirector", function(){
        $(".addNewDirectorSpan").text($(this).data("pname"));
        $("#pid").val($(this).data("pid"));
    });

    $(document).on("click", ".btnPurchaseRow", function(){
        $.ajax({
            type: 'GET',
            url: '/ajax/hsn',
            dataType: "json",
            success: function (res) {
                let rand = Math.random() * 100;
                var xdata = $.map(res.data, function (obj) {
                    obj.text = obj.name || obj.id;
                    return obj;
                });
                $(".tblPurchase").append(`<tr><td><select name='hsns[]' id='hsn_${rand}' class='selHsn select2 form-select'></select></td><td><select name='products[]' id='product_${rand}' class='select2 form-select selPdct'><option value=''>Select</option></select></td><td><input type='number' name='qty[]' class='form-control text-end qty' min='1' max='' step='1' placeholder='0'></td><td><input type='date' name='expiry_date[]' class='form-control'></td><td><input type='text' name='batch_number[]' class='form-control' placeholder='Batch'></td><td><input type='number' name='purchase_price[]' class='form-control text-end pprice' min='1' max='' step='' placeholder='0.00'></td><td><input type='number' name='selling_price[]' class='form-control text-end sprice' min='1' max='' step='' placeholder='0.00'></td><td><input type='number' name='total[]' class='form-control text-end total' min='1' max='' step='' placeholder='0.00' readonly></td><td class='text-center'><i class='fa fa-trash text-danger remRow'></i></td></tr>`);
                $('.selHsn:last').html("<option value=''>Select</option>").select2({
                    data: xdata,
                });  
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }            
        });      
    });

    $(document).on("click", ".remRow", function(){
        $(this).parent().parent().remove();
        calculatePurchaseTotal();
    });

    $(document).on("change", ".selHsn", function(){
        let dis = $(this);
        let hsn = dis.val();
        $.ajax({
            type: 'GET',
            url: '/ajax/products',
            dataType: "json",
            data: {'hsn': hsn},
            success: function (res) {                
                var xdata = $.map(res.data, function (obj) {
                    obj.text = obj.name || obj.id;
                    return obj;
                });
                dis.parent().parent().find(".selPdct").html("<option value=''>Select</option>").select2({
                    data: xdata,
                }).append(new Option("Not Applicable", "0")); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }            
        });        
    });

    $(document).on("change", ".qty, .pprice", function(){
        calculatePurchaseTotal();
    })
});

function calculatePurchaseTotal(){
    let sum = 0;
    $(".tblPurchase tr").each(function(){
        let tot= 0;
        let qty = parseInt($(this).find(".qty").val() ?? 0);
        let price = parseFloat($(this).find(".pprice").val() ?? 0);
        tot = parseInt(qty)*parseFloat(price);
        sum += tot;
        $(this).find(".total").val(tot.toFixed(2));
    })
    $(".sum").text(sum.toFixed(2))
}