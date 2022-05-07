<?php $this->load->view('inc/head'); ?>
<style type="text/css">
  .value-button {
  display: inline-block;
  border: 1px solid #ddd;
  margin: 0px;
  width: 40px;
  height: 40px;
  text-align: center;
  vertical-align: middle;
  padding: 6px 0;
  background: #eee;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.value-button:hover {
  cursor: pointer;
}

form #decrease {
  margin-right: -4px;
  border-radius: 8px 0 0 8px;
}

form #increase {
  margin-left: -4px;
  border-radius: 0 8px 8px 0;
}

form #input-wrap {
  margin: 0px;
  padding: 0px;
}

input#number {
  text-align: center;
  border: none;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  margin: 0px;
  width: 40px;
  height: 40px;
  padding-bottom: 7px;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
<!--- Breadcrumb --->
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="">Home</a></li>
            <li>Cart</li>
        </ul>
    </div>
</div>
<!--- /Breadcrumb --->

<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
       <!--  <div class="ps-section__header">
            <h1>Shopping Cart</h1>
        </div> -->
        <div class="ps-section__content">
            <div class="table-responsive">
                <table class="table ps-table--shopping-cart" border="1" bordercolor="#ddd">
                    <thead>
                    <tr>
                        <th>Product name</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>TOTAL</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
 <?php $i = 1; 
 foreach ($this->cart->contents() as $item){ 

  echo form_hidden($i.'[rowid]', $item['rowid']);
    ?>
                    <tr>
                        <td>
                            <div class="ps-product--cart">
                                <div class="ps-product__thumbnail"><a href="#"><img src="<?php  echo base_url() ; ?>/admin-assets/images/<?php echo $item['image']; ?>" alt=""></a></div>
                                <div class="ps-product__content"><a href="#"><?php echo $item['name']; ?></a>
                                  <p><strong>SKU:</strong> ZAT37<span class="sku-d"><?php echo substr($item['id'],5) ; ?></span></p>  
                                </div>
                            </div>
                        </td>
                        <td class="price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?><?php echo $this->frontend_m->convert($item['price']) ; ?></td>
                        <td>
                              <form  class="qty" action="javascript:void(0);">
                                              <?php echo form_hidden('rowid', $item['rowid']); ?>
                                   <input type="hidden" class="rowid" value="<?php echo $item['rowid']; ?>"> 
                                          <div class="quantity" style="text-align: center; padding: 10px 0">
                                           <button type="submit" class="value-button" id="decrease" onclick="decreaseValue()">-</button>


                                          <input name="qty" id="number" type="number" min="1"   step="1" value="<?php echo $item["qty"]; ?>" >


                                          <button type="submit" class="value-button" id="increase" onclick="increaseValue()">+</button>
                                        </div>
                              <!-- <strong><button class="btn-submit" type="submit"  style="    display: inline-block;
    background: #000;
    color: #fff;
    width: 74px;
    text-align: center;
    margin-top: 20px;
    font-size: 15px;
    padding: 5px 0px;">Update</button>  -->
       </form>
                        </td>
                        <td><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php echo $this->frontend_m->convert($item["subtotal"]); ?></td>
                        <td><a href="<?php echo base_url('cart/removeItem/'.$item["rowid"]); ?>"><i class="icon-cross"></i></a></td>
                    </tr>

                <?php } ?>
                    
                    </tbody>
                </table>
            </div>
            <div class="ps-section__cart-actions"><a class="ps-btn" href="<?php echo site_url('products'); ?>"><i class="icon-arrow-left"></i> Back to Shop</a></div>
            <div class="col-md-12 clearfix" >
             <div class="col-md-4 pull-right">
                    <div class="ps-block--shopping-total">
                        <div class="ps-block__header">
                            <p>Subtotal <span><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php echo $this->frontend_m->convert($this->cart->total()); ?></span></p>
                        </div>
                        
                    </div><a class="ps-btn ps-btn--fullwidth" href="<?php echo site_url('checkout'); ?>">Proceed to checkout</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $this->load->view('inc/footer'); ?>
 
<script type="text/javascript">
  function increaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
   value++;
   document.getElementById('number').value = value;
 }

function decreaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.getElementById('number').value = value;
}
</script>

<script>
/* Update item quantity */
$("form.qty").submit(function(e){
  e.preventDefault();
   $.ajax({
          url:"<?php  echo base_url(); ?>cart/updateItemQty",
          type:'post',
          data: $(this).serialize(),
           success:function(data){
               location.reload();
           }
         })
});
  
</script>
<script type="text/javascript">
   $("input[name='qty'").change(function(e){
       e.preventDefault();       
       $.ajax({
              url:"<?php  echo base_url(); ?>cart/updateItemQty",
              type:'post',
              data: {qty: $(this).val(), rowid:$('.rowid').val()},
               success:function(data){
                   location.reload();
                   
                   
               }
             })
    });
</script>
 
