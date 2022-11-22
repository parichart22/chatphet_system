function ListName(){
  $body = $("body");
	$body.addClass("loading");
  var product_name = document.getElementById("product_name").value;
  $.get("Product/ajax_listproduct.php?product_name="+product_name, function(result) {
   			 $('#datalistOptions').html( result );
         $body.removeClass("loading");
   });
}

function AddProduct(){
  var product_name = document.getElementById("product_name").value;
  var comid = document.getElementById("comid").value;
  var company_name = document.getElementById("company_name").value;
  $.get("Product/db.php?product_name="+product_name+"&comid="+comid+"&company_name="+company_name, function(result) {
   if(result==1){
     $.get("Product/ajax_product.php", function(item) {
   			 $('#table_product').html( item );
   		});
    document.getElementById('product_name').value = '';
   }else{

   }
   });
}

function AddProductGroup(){
  var product_name = document.getElementById("product_name").value;
  var ref_shopee = document.getElementById("ref_shopee").value;
  $.get("Product/groupdb.php?product_name="+product_name+"&ref_shopee="+ref_shopee, function(result) {
   if(result==1){
     $.get("Product/ajax_productgroup.php", function(item) {
   			 $('#table_product').html( item );
   		});
    document.getElementById('product_name').value = '';
   }else{

   }
   });
}

function AddGroupDetail(pk){
  var pk_product = document.getElementById("pk_product").value;
  $.get("Product/addproductgroup.php?pk="+pk+"&pk_product="+pk_product, function(result) {
   if(result==1){
      $.get("Product/ajax_groupdetail.php?pk="+pk, function(item) {
           $('#table_stock').html( item );
           $body.removeClass("loading");
        });
    document.getElementById('pk_product').value = '';
   }else{

   }
   });
}

function EditProduct(pk){
  $body = $("body");
	$body.addClass("loading");
  var shopee_ref1 = document.getElementById("shopee_ref1"+pk).value;
  var shopee_ref2 = document.getElementById("shopee_ref2"+pk).value;
  var lazada_ref = document.getElementById("lazada_ref"+pk).value;
  var lz_productid = document.getElementById("lz_productid"+pk).value;
  var lz_skuid = document.getElementById("lz_skuid"+pk).value;
  var s_wb_product = document.getElementById("s_wb_product"+pk).value;
  var lnwshop_ref = document.getElementById("lnwshop_ref"+pk).value;
  var peak_ref = document.getElementById("peak_ref"+pk).value;
  var price = document.getElementById("price"+pk).value;
  var name = document.getElementById("product_name"+pk).value;
  $.get("Product/edit.php?product_name="+name+"&shopee_ref1="+shopee_ref1+"&shopee_ref2="+shopee_ref2+"&lazada_ref="+lazada_ref+"&lz_productid="+lz_productid+"&lz_skuid="+lz_skuid+"&s_wb_product="+s_wb_product+"&lnwshop_ref="+lnwshop_ref+"&peak_ref="+peak_ref+"&price="+price+"&pk="+pk, function(result) {
   if(result==1){
     /*$.get("Product/ajax_product.php", function(item) {
   			 $('#table_product').html( item );

   		});*/
       $body.removeClass("loading");
   }else{

   }
   });
}

function EditProductGroup(pk){
  $body = $("body");
	$body.addClass("loading");
  var ref_shopee_d = document.getElementById("ref_shopee_d"+pk).value;
  var price = document.getElementById("price"+pk).value;
  $.get("Product/editgroup.php?ref_shopee_d="+ref_shopee_d+"&price="+price+"&pk="+pk, function(result) {
   if(result==1){
     /*$.get("Product/ajax_product.php", function(item) {
   			 $('#table_product').html( item );

   		});*/
       $body.removeClass("loading");
   }else{

   }
   });
}


function EditGroup(pk){
  $body = $("body");
  $body.addClass("loading");
  var product_name = document.getElementById("product_name"+pk).value;
  var ref_shopee = document.getElementById("shopee_ref1"+pk).value;
  $.get("Product/ajax_productgroup_edit.php?product_name="+product_name+"&ref_shopee="+ref_shopee+"&pk="+pk, function(result) {
   if(result==1){

    $body.removeClass("loading");
   }else{

   }
   });
}

function TableProductBtn(){
  $body = $("body");
	$body.addClass("loading");
  var search = document.getElementById("search_txt").value;
  var boxno = document.getElementById("box_no").value;
  var mark_exp = document.getElementById("mark_exp").value;
  $.get("Product/ajax_product.php?search="+search+"&boxno="+boxno+"&mark_exp="+mark_exp, function(item) {
			 $('#table_product').html( item );
       $body.removeClass("loading");
		});
}

function TableProduct(even){
  if( even.keyCode == 13 ) {
  $body = $("body");
	$body.addClass("loading");
  var search = document.getElementById("search_txt").value;
  $.get("Product/ajax_product.php?search="+search, function(item) {
			 $('#table_product').html( item );
       $body.removeClass("loading");
		});
    }
}

function TableProductOrder(id){
  $body = $("body");
	$body.addClass("loading");
  var search = document.getElementById("search_txt").value;
  $.get("Order/ajax_product.php?search="+search+"&id="+id, function(item) {
			 $('#table_product').html( item );
       $body.removeClass("loading");
		});
}

function TableProductSort(type){
  $body = $("body");
	$body.addClass("loading");
  $.get("Product/ajax_product.php?type="+type, function(item) {
			 $('#table_product').html( item );
       $body.removeClass("loading");
		});
}

function AddStock(pk,type){
  $body = $("body");
	$body.addClass("loading");
  var amount = document.getElementById("amount").value;
  var month = document.getElementById("month").value;
  var year = document.getElementById("year").value;
  $.get("Product/stock_db.php?pk_product="+pk+"&amount="+amount+"&month="+month+"&year="+year+"&type="+type, function(result) {
   if(result==1){
     $.get("Product/ajax_liststock.php?pk="+pk, function(item) {
          $('#table_stock').html( item );
          $body.removeClass("loading");
       });
   }else{

   }
   });
}

function VoidStock(pk,type,year,month,no){
  $body = $("body");
	$body.addClass("loading");
  var amount = document.getElementById("amount"+no).value;
  $.get("Product/stock_db.php?pk_product="+pk+"&amount="+amount+"&month="+month+"&year="+year+"&type="+type, function(result) {
   if(result==1){
     $.get("Product/ajax_liststock.php?pk="+pk, function(item) {
          $('#table_stock').html( item );
          $body.removeClass("loading");
       });
   }else{

   }
   });
}

function AddBox(pk,type){
  $body = $("body");
	$body.addClass("loading");
  var box = document.getElementById("box").value;
  $.get("Product/box_db.php?pk_product="+pk+"&box="+box+"&type="+type, function(result) {
   if(result==1){
     $.get("Product/ajax_liststock.php?pk="+pk, function(item) {
          $('#table_stock').html( item );
       });
       $body.removeClass("loading");
   }else{

   }
   });
}

function AddOrder(){
  var id_ref = document.getElementById("id_ref").value;
  var ch = document.getElementById("ch").value;
  var customer_name = document.getElementById("customer_name").value;
  var datepicker = document.getElementById("datepicker").value;
  $.get("Order/db.php?id_ref="+id_ref+"&customer_name="+customer_name+"&datepicker="+datepicker+"&ch="+ch, function(result) {
   if(result==1){
        $.get("Order/ajax_order.php", function(item) {
            $('#table_order').html( item );
           $body.removeClass("loading");
         });
    document.getElementById('id_ref').value = '';
    document.getElementById('customer_name').value = '';
   }else{

   }
   });
}

function Additem(orderid,pk_product,box_no){
  $body = $("body");
	$body.addClass("loading");
  var item = document.getElementById("item"+pk_product).value;
  $.get("Order/add_item.php?orderid="+orderid+"&pk_product="+pk_product+"&item="+item+"&box_no="+box_no, function(result) {
   if(result==1){
     $.get("Order/ajax_order_detail.php?id="+orderid, function(item) {
   			 $('#table_order_detail').html( item );
        $body.removeClass("loading");
   		});

   }else{

   }
   });
}

function Delitem(orderid,pk_product){
  $body = $("body");
	$body.addClass("loading");
  $.get("Order/del_item.php?orderid="+orderid+"&pk_product="+pk_product, function(result) {
   if(result==1){
     $.get("Order/ajax_order_detail.php?id="+orderid, function(item) {
   			 $('#table_order_detail').html( item );
        $body.removeClass("loading");
   		});

   }else{

   }
   });
}

function PackStatus(orderid,status){
  $body = $("body");
	$body.addClass("loading");
  $.get("Order/ajax_staus.php?orderid="+orderid+"&status="+status, function(result) {
   if(result==1){
     $.get("Order/ajax_order.php", function(item) {
   			 $('#table_order').html( item );
        $body.removeClass("loading");
   		});

   }else{

   }
   });
}

function SearchOrder(status){
  $body = $("body");
	$body.addClass("loading");
  var search = document.getElementById("search_txt").value;
  $.get("Order/ajax_order.php?search="+search+"&status="+status, function(item) {
			 $('#table_order').html( item );
       $body.removeClass("loading");
		});
}

function SearchOrderAccount(){
  $body = $("body");
	$body.addClass("loading");
  var search = document.getElementById("search_txt").value;
  $.get("Order/ajax_order_account.php?search="+search, function(item) {
			 $('#table_order').html( item );
       $body.removeClass("loading");
		});
}

function AddListStock(pk_product){
  $body = $("body");
	$body.addClass("loading");
  var qty = document.getElementById("qty"+pk_product).value;
  $.get("Order/ajax_addtoliststock.php?qty="+qty+"&pk_product="+pk_product, function(item) {
			 $('#table_order').html( item );
       $body.removeClass("loading");
		});
}

function MarkExp(pk_product,type){
  $body = $("body");
	$body.addClass("loading");
  $.get("Product/ajax_markexp.php?type="+type+"&pk_product="+pk_product, function(result) {
    if(result==1){
      $.get("Product/ajax_report_exp.php", function(item) {
           $('#table_product_exp').html( item );
         $body.removeClass("loading");
        });

    }else{

    }
		});
}

function ReportHotitem(company){
  var datestart = document.getElementById("datestart").value;
  var dateend = document.getElementById("dateend").value;
  $body = $("body");
  $body.addClass("loading");
  $.get("Product/ajax_hotitem.php?company="+company+"&datestart="+datestart+"&dateend="+dateend, function(item) {
           $('#table_hotitem').html( item );
         $body.removeClass("loading");
       });
}

function ReportHotitemAll(){
  var datestart = document.getElementById("datestart").value;
  var dateend = document.getElementById("dateend").value;
  $body = $("body");
  $body.addClass("loading");
  $.get("Product/ajax_hotitemall.php?datestart="+datestart+"&dateend="+dateend, function(item) {
           $('#table_hotitem').html( item );
         $body.removeClass("loading");
       });
}

function ReportnoSale(){
  var datestart = document.getElementById("datestart").value;
  var dateend = document.getElementById("dateend").value;
  $body = $("body");
  $body.addClass("loading");
  $.get("Product/ajax_nosale.php?datestart="+datestart+"&dateend="+dateend, function(item) {
           $('#table_nosale').html( item );
         $body.removeClass("loading");
       });
}

function ReportImportSale(){
  var datestart = document.getElementById("datestart").value;
  var dateend = document.getElementById("dateend").value;
  $body = $("body");
  $body.addClass("loading");
  $.get("Product/ajax_importsale.php?datestart="+datestart+"&dateend="+dateend, function(item) {
           $('#table_importsale').html( item );
         $body.removeClass("loading");
       });
}

function CalShopee(){
  var price = document.getElementById("price").value;
  var shipping = document.getElementById("shipping").value;
  $body = $("body");
  $body.addClass("loading");
  $.get("Report/ajax_calshopee.php?price="+price+"&shipping="+shipping, function(item) {
           $('#form_cal').html( item );
         $body.removeClass("loading");
       });
}

function CalLazada(){
  var price = document.getElementById("price").value;
  var shipping = document.getElementById("shipping").value;
  $body = $("body");
  $body.addClass("loading");
  $.get("Report/ajax_callazada.php?price="+price+"&shipping="+shipping, function(item) {
           $('#form_cal').html( item );
         $body.removeClass("loading");
       });
}

function AddCategory(){
  var category = document.getElementById("category").value;
  $body = $("body");
  $body.addClass("loading");
  $.get("Product/category_db.php?category="+category, function(result) {
   if(result==1){
        $.get("Product/ajax_category.php", function(item) {
            $('#table_category').html( item );
           $body.removeClass("loading");
         });
    document.getElementById('category').value = '';
   }else{

   }
   });
}

function EditCategory(pk){
  var category = document.getElementById("category"+pk).value;
  var rank = document.getElementById("rank"+pk).value;
  $body = $("body");
  $body.addClass("loading");
  $.get("Product/editcategory.php?category="+category+"&rank="+rank+"&pk="+pk, function(result) {
   if(result==1){
        $.get("Product/ajax_category.php", function(item) {
            $('#table_category').html( item );
           $body.removeClass("loading");
         });

   }else{

   }
   });
}
