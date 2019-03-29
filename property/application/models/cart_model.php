<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to Cart Page
 * @author Teamtweaks
 *
 */
class Cart_model extends My_Model
{
	
	public function add_cart($dataArr=''){
			$this->db->insert(PRODUCT,$dataArr);
	}

	public function edit_cart($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(PRODUCT,$dataArr);
	}
	
	
	public function view_cart($condition=''){
			return $this->db->get_where(PRODUCT,$condition);
			
	}
	
	
	public function mani_cart_view($userid=''){
	
		$MainShipCost = 0;
		$MainTaxCost = 0; $cartQty = 0;

	
		$shipVal = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userid));				
		
		if($shipVal -> num_rows >0 ){
		
			$shipValID = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userid, 'primary' => 'Yes'));				
			$dataArr = array('shipping_id' => $shipValID->row()->id);
			$condition = array('user_id' => $userid); 											
			$this->cart_model->update_details(FANCYYBOX_TEMP,$dataArr,$condition);
			$ShipCostVal = $this->cart_model->get_all_details(COUNTRY_LIST,array( 'country_code' => $shipValID->row()->country));
			
			$MainShipCost = $ShipCostVal->row()->shipping_cost;
			$MainTaxCost = $ShipCostVal->row()->shipping_tax;
			$dataArr2 = array('shipping_cost' => $MainShipCost, 'tax' => $MainTaxCost);
			$this->cart_model->update_details(SHOPPING_CART,$dataArr2,$condition); 
		}
		
		$GiftValue = ''; $CartValue = ''; $SubscribValue = '';	

		$giftSet = $this->cart_model->get_all_details(GIFTCARDS_SETTINGS,array( 'id' => '1'));
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));

		$SubcribRes = $this->minicart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));	
		
		$this->db->select('a.*,b.seourl,b.image,b.id as prdid,c.attr_name');
		$this->db->from(SHOPPING_CART.' as a');
		$this->db->join(PRODUCT.' as b' , 'b.id = a.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = a.attribute_values','left');		
		$this->db->where('a.user_id = '.$userid);
		$cartVal = $this->db->get();
		
		$this->db->select_sum('discountAmount');
		$this->db->from(SHOPPING_CART);
		$this->db->where('user_id = '.$userid);
		$query = $this->db->get();
		
		$disAmt = $query->row()->discountAmount;

		
		//$resultCart = $cartVal->result_array();
		/****************************** Gift Card Displays **************************************/
		
		if($giftRes -> num_rows() > 0 ){ 
			
			$GiftValue.= '<div id="GiftCartTable" style="display:block;">
			<form method="post" name="giftSubmit" id="giftSubmit" class="continue_payment" enctype="multipart/form-data" action="checkout/gift">
				<div class="cart-payment-wrap cart-note"><span class="cart-payment-top"><b></b></span><div class="table-cart-wrap"><table class="table-cart">
				<thead><tr><th width="51%" colspan="2" class="product">Product</th><th width="18%">Price</th><th width="15%">Quantity</th><th width="21%">Total</th></tr></thead></table>';	
			$giftAmt = 0; $g=0;
			
			foreach ($giftRes->result() as $giftRow){
				$GiftValue.= '<div id="giftId_'.$g.'" style="display:block;"><table class="table-cart"><tbody><tr class="first">
					<td rowspan="2" class="thumnail"><img src="'.GIFTPATH.$giftSet->row()->image.'" alt="'.$giftSet->row()->title.'"><a href="javascript:delete_gift('.$giftRow->id.','.$g.')" class="remove_gift_card" cid="66577">Remove</a></td>
					<td class="title"><a href=""><b>'.$giftSet->row()->title.'</b></a><br></td>
					<td class="price">'.$this->data['currencySymbol'].number_format($giftRow->price_value,2,'.','').'</td>
					<td class="price">1</td>
					<td class="total">'.$this->data['currencySymbol'].number_format($giftRow->price_value,2,'.','').'</td>
				</tr>
                <tr>
            		<td class="optional" colspan="4"><div class="relative"><span></span>
						<ul class="optional-list">
							<li><span class="option-tit">Recipient name:</span><span class="option-txt">'.$giftRow->recipient_name.'</span></li>
							<li><span class="option-tit">Recipient e-mail:</span><span class="option-txt">'.$giftRow->recipient_mail.'</span></li>
    	                    <li><span class="option-tit">Message:</span><span class="option-txt">'.$giftRow->description.'</span></li>
						</ul>
						</div>
					</td>
				</tr></tbody></table></div>';
				$giftAmt = $giftAmt + $giftRow->price_value;
				$g++;
			}

		$GiftValue.= '</div>
			<input name="gift_cards_amount" id-"gift_cards_amount" value="'.number_format($giftAmt,2,'.','').'" type="hidden">
			<input name="checkout_type" id-"checkout_type" value="giftpurchase" type="hidden">
			<div class="cart-payment" id="giftcard-cart-payment"><input type="hidden"><span class="bg-cart-payment"></span>
		    <dl class="cart-payment-order">
			   	<dt>Order</dt><dd><ul>
				<li class="first"><span class="order-payment-type">Item total</span><span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="item_total">'.number_format($giftAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span></li>
				<li class="total"><span class="order-payment-type"><b>Total</b></span><span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="total_item">'.number_format($giftAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span></li>
				</ul>
		      	</dd>
			</dl>
		    <button type="submit" class="btn" id="button-submit-giftcard">Continue to Payment</button>
		  	</div></div></form></div>';
		}
		
		/****************************** Subscribe Card Displays **************************************/
		if($SubcribRes -> num_rows() > 0 ){ 
			
			$SubscribValue.= '<div id="SubscribeCartTable" style="display:block;">
			<form method="post" name="SubscribeSubmit" id="SubscribeSubmit" class="continue_payment" enctype="multipart/form-data" action="site/cart/Subscribecheckout">
				<div class="cart-payment-wrap cart-note"><span class="cart-payment-top"><b></b></span><div class="table-cart-wrap"><table class="table-cart">
			<thead><tr><th width="51%" colspan="2" class="product">Product</th><th width="18%">Price</th><th width="15%">Quantity</th><th width="21%">Total</th></tr></thead></table>
				';	
			$SubscribAmt = 0; $subcribSAmt = 0; $subcribTAmt = 0; $SubgrantAmt = 0; $s=0;
			
			foreach ($SubcribRes->result() as $SubcribRow){
				$SubscribValue.= '<div id="SubscribId_'.$s.'" style="display:block;"><table class="table-cart"><tbody><tr class="first">
					<td rowspan="2" class="thumnail"><img src="'.FANCYBOXPATH.$SubcribRow->image.'" alt="'.$SubcribRow->name.'"><a href="javascript:delete_subscribe('.$SubcribRow->id.','.$s.')" class="remove_gift_card" cid="66577">Remove</a></td>
					<td class="title"><a href=""><b>'.$SubcribRow->name.'</b></a><br></td>
					<td class="price">'.$this->data['currencySymbol'].number_format($SubcribRow->price,2,'.','').'</td>
					<td class="price">1</td>
					<td class="total">'.$this->data['currencySymbol'].number_format($SubcribRow->price,2,'.','').'</td>
				</tr>
				</tbody></table></div>';
				$SubscribAmt = $SubscribAmt + $SubcribRow->price;
				$s++;
			}
			
				$subcribSAmt = $MainShipCost;
				$subcribTAmt = ($SubscribAmt * 0.01 * $MainTaxCost);
				$SubgrantAmt = $SubscribAmt + $subcribSAmt + $subcribTAmt ;
		

		$SubscribValue.= '</div>
			 <div class="cart-payment" id="merchant-cart-payment">
		    <input type="hidden">
		    <span class="bg-cart-payment"></span>
		    <dl class="cart-payment-ship">
		      <dt>Ship to</dt>
		      <dd>
			<select id="address-cart" class="select-round select-shipping-addr" onchange="SubscribeChangeAddress(this.value);">
				  <option value="" id="address-select">Choose Your Shipping Address</option>
			';
			
			foreach ($shipVal->result() as $Shiprow){
			if($Shiprow->primary == 'Yes'){ $optionsValues = 'selected="selected"'; 
			$ChooseVal = $Shiprow->full_name.'<br>'.$Shiprow->address1.'<br>'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'<br>'.$Shiprow->country.'<br>'.$Shiprow->phone; $ship_id =$Shiprow->id;  }else{ $optionsValues ='';}
			$SubscribValue.='<option '.$optionsValues.' value="'.$Shiprow->id.'" l1="'.$Shiprow->full_name.'" l2="'.$Shiprow->address1.'" l3="'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'" l4="'.$Shiprow->country.'" l5="'.$Shiprow->phone.'">'.$Shiprow->full_name.'</option>';
			}  
			  

		$SubscribValue.='</select>
			<input type="hidden" name="SubShip_address_val" id="SubShip_address_val" value="'.$ship_id.'" />
			
			<p class="default_addr"><span id="SubChg_Add_Val">'.$ChooseVal.'</span></p>
			<span style="color:#FF0000;" id="Ship_Sub_err"></span>
			<a href="javascript:void(0);" class="delete_addr" onclick="shipping_cart_address_delete();">Delete this address</a>
			
			<a href="javascript:void(0);" class="add_addr add_" onclick="shipping_address_cart();">Add new shipping address</a>

		      </dd>
			</dl>

			   <dl class="cart-payment-order">
		      <dt>Order</dt>
		      <dd>
			<ul>
			  <li class="first">
			    <span class="order-payment-type">Item total</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartAmt">'.number_format($SubscribAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">Shipping</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartSAmt">'.number_format($subcribSAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">Tax (<span id="SubTamt">'.$MainTaxCost.'</span>%) of '.$this->data['currencySymbol'].$SubscribAmt.'</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartTAmt">'.number_format($subcribTAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li></ul>';
			 
			 $SubscribValue.='
			  <ul>
			 <li class="total">
			    <span class="order-payment-type"><b>Total</b></span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartGAmt">'.number_format($SubgrantAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			</ul>
		      </dd>
	              
		    </dl>
			
		    <input name="user_id" value="'.$userid.'" type="hidden">
			<input name="subcrib_amount" id="subcrib_amount" value="'.number_format($SubscribAmt,2,'.','').'" type="hidden">
			<input name="subcrib_ship_amount" id="subcrib_ship_amount" value="'.number_format($subcribSAmt,2,'.','').'" type="hidden">
			<input name="subcrib_tax_amount" id="subcrib_tax_amount" value="'.number_format($subcribTAmt,2,'.','').'" type="hidden">
			<input name="subcrib_total_amount" id="subcrib_total_amount" value="'.number_format($SubgrantAmt,2,'.','').'" type="hidden">
		    <input type="submit" class="btn" name="SubscribePayment" id="button-submit-merchant" value="Continue to Payment" />
		    
		  </div>
		</div>
	</form></div>';
		}

		
		/****************************** Cart Displays **************************************/
		
		if($cartVal -> num_rows() > 0 ){
			$CartValue.='<div id="CartTable" style="display:block;"><p class="cart-list-from">Order from <b>'.$this->config->item('email_title').' Merchant</b></p>
				<form method="post" name="cartSubmit" id="cartSubmit" class="continue_payment" enctype="multipart/form-data" action="site/cart/cartcheckout">
				<div class="cart-payment-wrap cart-note"><span class="cart-payment-top"><b></b></span><div class="table-cart-wrap"><table class="table-cart">
		<thead><tr><th width="61%" colspan="2" class="product">Product</th><th width="12%">Price</th><th width="14%">Quantity</th><th width="21%">Total</th></tr></thead></table>
       ';
		$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0; 
		$s=0;
		foreach ($cartVal->result() as $CartRow){
			//echo '<pre>';print_r($CartRow);
			$curdate = date('Y-m-d');
			$newImg = @explode(',',$CartRow->image);
			if($newImg[0]!=''){
				$newImgpath = PRODUCTPATH.$newImg[0];			
			}else{
				$newImgpath = PRODUCTPATH.'dummyProductImage.jpg';
			}
			
		$CartValue.='<div id="cartdivId_'.$s.'"> <table class="table-cart"><tbody><tr class="first">
			<td rowspan="2" class="thumnail"><a href="things/'.$CartRow->prdid.'/'.$CartRow->seourl.'"><img src="'.$newImgpath.'" alt="'.$CartRow->product_name.'"></a><a href="javascript:void(0);" onclick="javascript:delete_cart('.$CartRow->id.','.$s.')" class="remove_item">Remove</a></td>
			<td class="title"><a href="things/'.$CartRow->prdid.'/'.$CartRow->seourl.'"><b>'.$CartRow->product_name.'</b></a>';
			if($CartRow->attr_name!=''){
			$CartValue.='<br>'.$CartRow->attr_name.'';
			}
			$CartValue.='<br><small>'.$this->data['currencySymbol'].$CartRow->orgprice.' retail price</small> </td>
			<td class="price">'.$this->data['currencySymbol'].$CartRow->price.'</td>
			<td class="quantity"><select name="quantity'.$s.'" id="quantity'.$s.'" class="select-round" style="width:60px;" data-mqty="'.$CartRow->mqty.'" onchange="javascript:update_cart('.$CartRow->id.','.$s.')">';
				for($p=1;$p<=$CartRow->mqty;$p++){
					if($CartRow->quantity == $p){ $SelVal='selected="selected"'; }else{ $SelVal='';}
					$CartValue.='<option '.$SelVal.' value="'.$p.'"  >'.$p.'</option>';
				}
			$CartValue.='</select>
			</td>
			<td class="total">'.$this->data['currencySymbol'].'<span id="IndTotalVal'.$s.'">'.$CartRow->indtotal.'</span></td>
		</tr>
		<tr>
         	<td class="optional" colspan="4"><div class="relative"><span></span>
			<ul class="optional-list"><li><span class="option-tit">Shipping:</span><span class="option-txt">';
			if($CartRow->ship_immediate == 'true'){
				$CartValue.='Immediate';
			}else{
				$CartValue.=date('d/m', strtotime($curdate)).' - '.date('d/m', strtotime($curdate. ' + 10 day'));
			}	
			
			$CartValue.='</span></li></ul>
			<div class="show_detail">
				<span class="tooltip shipping" style="display:none"><i class="ic-truck"></i><small>Ships within 1-3 business days<b></b></small></span>
				<span class="tooltip delivery" style="display:none"><i class="ic-delivery"></i><small>Order before 11 AM and get it today!<br>Available in New York, NY<b></b></small></span>
			</div>
			</div>
			</td>
		</tr></tbody></table></div>';
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost + $CartRow->price + ($CartRow->price * 0.01 * $CartRow->product_tax_cost))  * $CartRow->quantity);
				$cartShippingAmt = $cartShippingAmt + ($CartRow->product_shipping_cost * $CartRow->quantity);
				$cartTaxAmt = $cartTaxAmt + ($CartRow->product_tax_cost * $CartRow->quantity);
				$cartQty = $cartQty + $CartRow->quantity;
				$s++;
			}
			$cartSAmt = $MainShipCost;
			$cartTAmt = ($cartAmt * 0.01 * $MainTaxCost);
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;
			
		$CartValue.='<dl class="note">
		      <dt>Note to '.$this->config->item('email_title').' Merchant <small>Optional</small></dt>
		      <dd><textarea class="note-to-seller" name="note" data-id="cart-note-1192557-616001" placeholder="You can leave a personalized note here"></textarea></dd>
		    </dl>

		  </div>
		  <div class="cart-payment" id="merchant-cart-payment">
		    <input type="hidden">
		    <span class="bg-cart-payment"></span>
		    <dl class="cart-payment-ship">
		      <dt>Ship to</dt>
		      <dd>
			<select id="address-cart" class="select-round select-shipping-addr" onchange="CartChangeAddress(this.value);">
				  <option value="" id="address-select">Choose Your Shipping Address</option>
			';
			
			foreach ($shipVal->result() as $Shiprow){
			if($Shiprow->primary == 'Yes'){ $optionsValues = 'selected="selected"'; $ChooseVal = $Shiprow->full_name.'<br>'.$Shiprow->address1.'<br>'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'<br>'.$Shiprow->country.'<br>'.$Shiprow->phone; $ship_id =$Shiprow->id;  }else{ $optionsValues ='';}
			$CartValue.='<option '.$optionsValues.' value="'.$Shiprow->id.'" l1="'.$Shiprow->full_name.'" l2="'.$Shiprow->address1.'" l3="'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'" l4="'.$Shiprow->country.'" l5="'.$Shiprow->phone.'">'.$Shiprow->full_name.'</option>';
			}  
			  

		$CartValue.='</select>
			<input type="hidden" name="Ship_address_val" id="Ship_address_val" value="'.$ship_id.'" />
			
			<p class="default_addr"><span id="Chg_Add_Val">'.$ChooseVal.'</span></p>
			<span style="color:#FF0000;" id="Ship_err"></span>
			<a href="javascript:void(0);" class="delete_addr" onclick="shipping_cart_address_delete();">Delete this address</a>
			
			<a href="javascript:void(0);" class="add_addr add_" onclick="shipping_address_cart();">Add new shipping address</a>

		      </dd>
			</dl>

			<dl class="ship-speed" style="display:none;border-bottom:1px solid #D4D6DF;">
			    <dt>Shipping Speed</dt>
			    <dd>
				    <input id="speed2-val1" name="shipping_speed" value="0" type="radio"> <label for="speed2-val1">Standard</label><br>
					<input id="speed2-val3" name="shipping_speed" value="3" type="radio"> <label for="speed2-val3">Same-day Delivery</label>
				</dd>
			</dl>
			<dl class="cart-gift" style="border-bottom: 1px solid #D4D6DF;">
			  <dt>Gift</dt>
			  <dd><label>
				<input id="is_gift" name="is_gift" data-id="cart-gift-1192557-616001" value="1" type="checkbox">
				<span>This order is a gift</span>
			  </label></dd>
			</dl>
			<dl class="cart-coupon">
				<dt>Coupon Codes</dt>
                <dd><input id="is_coupon" name="is_coupon" class="text coupon-code" placeholder="Have a coupon code?" data-sid="616001" type="text">
				<input type="button" class="btn-blue-apply apply-coupon" onclick="javascript:checkCode();" value="Apply" style="cursor:pointer;" /></dd>
				<dd><span id="CouponErr" style="color:#FF0000;"></span></dd>
                
			</dl>
		    
		    <dl class="cart-payment-order">
		      <dt>Order</dt>
		      <dd>
			<ul>
			  <li class="first">
			    <span class="order-payment-type">Item total</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="CartAmt">'.number_format($cartAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">Shipping</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="CartSAmt">'.number_format($cartSAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">Tax (<span id="carTamt">'.$MainTaxCost.'</span>%) of '.$this->data['currencySymbol'].'<span id="CartAmtDup">'.$cartAmt.'</span></span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="CartTAmt">'.number_format($cartTAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li></ul>';
			  if($disAmt >0){
			  $grantAmt = $grantAmt - $disAmt;
			  $CartValue.='<ul><li>
			    <span class="order-payment-type">Discount</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="disAmtVal">'.number_format($disAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li><ul>';
			  }
			 $CartValue.='<div id="disAmtValDiv" style="display:none;"><ul>
			 <li>
			    <span class="order-payment-type">Discount</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="disAmtVal">'.number_format($disAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  </ul></div>
			  <ul>
			 <li class="total">
			    <span class="order-payment-type"><b>Total</b></span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="CartGAmt">'.number_format($grantAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			</ul>
		      </dd>
	              
		    </dl>
			
		    <input name="user_id" value="'.$userid.'" type="hidden">
			<input name="cart_amount" id="cart_amount" value="'.number_format($cartAmt,2,'.','').'" type="hidden">
			<input name="cart_ship_amount" id="cart_ship_amount" value="'.number_format($cartSAmt,2,'.','').'" type="hidden">
			<input name="cart_tax_amount" id="cart_tax_amount" value="'.number_format($cartTAmt,2,'.','').'" type="hidden">
			<input name="cart_tax_Value" id="cart_tax_Value" value="'.number_format($MainTaxCost,2,'.','').'" type="hidden">
			<input name="cart_total_amount" id="cart_total_amount" value="'.number_format($grantAmt,2,'.','').'" type="hidden">
			<input name="discount_Amt" id="discount_Amt" value="'.number_format($disAmt,2,'.','').'" type="hidden">
			
			<input name="CouponCode" id="CouponCode" value="" type="hidden">
			<input name="Coupon_id" id="Coupon_id" value="0" type="hidden">
			<input name="couponType" id="couponType" value="" type="hidden">												
		    <input type="submit" class="btn" name="cartPayment" id="button-submit-merchant" value="Continue to Payment" />
		    
		  </div>
		</div>
	</form></div>';
		}
		
		$countVal = $giftRes -> num_rows() + $cartQty + $SubcribRes -> num_rows();
		
		
		
		if($countVal >0 ){
			$CartDisp = '<h2><span id="Shop_id_count">'.$countVal.'</span> items in shopping cart</h2>'.$GiftValue.$SubscribValue.$CartValue.'<div id="EmptyCart" style="border-bottom: none; display:none;" class="empty-alert" >
					<p style="text-align:center;"><img src="images/site/shopping_empty.jpg" alt="Shopping Cart Empty"></p>
					<p style="text-align:center;"><b>Your Shopping Cart is Empty</b></p>
					<p style="text-align:center;">Don`t miss out on awesome sales right here on '.ucwords($this->config->item('email_title')).'. Let`s fill that cart, shall we?</p>
				</div>';
		}else{
		
		$CartDisp = '<h2>Shopping Cart</h2>
					<div style="border-bottom: none;" class="empty-alert" >
					<p style="text-align:center;"><img src="images/site/shopping_empty.jpg" alt="Shopping Cart Empty"></p>
					<p style="text-align:center;"><b>Your Shopping Cart is Empty</b></p>
					<p style="text-align:center;">Don`t miss out on awesome sales right here on '.ucwords($this->config->item('email_title')).'. Let`s fill that cart, shall we?</p>
				</div>';
		}
		
		return $CartDisp;

	}
	
	
	
	public function mani_gift_total($userid=''){
		
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$giftAmt = 0;
		if($giftRes -> num_rows() > 0 ){ 
			
			foreach ($giftRes->result() as $giftRow){
				$giftAmt = $giftAmt + $giftRow->price_value;
			}

		}
		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$countVal = $giftRes -> num_rows() + $SubcribRes -> num_rows() + $cartVal -> num_rows() ;
		
		return number_format($giftAmt,2,'.','').'|'.$countVal;

	}
	
	public function mani_subcribe_total($userid=''){
		
		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$SubcribAmt = 0; $SubcribSAmt = 0; $SubcribTAmt = 0; $SubcribTotalAmt = 0;
		if($SubcribRes -> num_rows() > 0 ){ 
			
			foreach ($SubcribRes->result() as $SubscribRow){
				$SubcribAmt = $SubcribAmt + $SubscribRow->price;
			}
			$SubcribSAmt = $SubcribRes->row()->shipping_cost;
			$SubcribTAmt = $SubcribRes->row()->tax;
			$SubcribTotalAmt = $SubcribAmt + $SubcribSAmt + $SubcribTAmt ;

		}
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$countVal = $SubcribRes -> num_rows() + $giftRes -> num_rows() + $cartVal -> num_rows() ;
		
		return number_format($SubcribAmt,2,'.','').'|'.number_format($SubcribSAmt,2,'.','').'|'.number_format($SubcribTAmt,2,'.','').'|'.number_format($SubcribTotalAmt,2,'.','').'|'.$countVal;

	}
	public function mani_cart_total($userid=''){
		
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0; $cartMiniMainCount = 0;

		if($cartVal -> num_rows() > 0 ){ 
			foreach ($cartVal->result() as $CartRow){
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost +  ($CartRow->product_tax_cost * 0.01 * $CartRow->price ) + $CartRow->price)  * $CartRow->quantity);
				
				$cartMiniMainCount = $cartMiniMainCount + $CartRow->quantity;
				
			}
			$cartSAmt = $cartVal->row()->shipping_cost;
			$cartTAmt = $cartAmt * 0.01 * $cartVal->row()->tax;
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;
			
		}
		
		$countVal = $giftRes -> num_rows() + $SubcribRes -> num_rows() + $cartMiniMainCount;
		
		$this->db->select_sum('discountAmount');
		$query = $this->db->get(SHOPPING_CART);
		
		if($query->row()->discountAmount !=''){
			$grantAmt = $grantAmt - $query->row()->discountAmount;
		}
		
		return number_format($cartAmt,2,'.','').'|'.number_format($cartSAmt,2,'.','').'|'.number_format($cartTAmt,2,'.','').'|'.number_format($grantAmt,2,'.','').'|'.$countVal.'|'.number_format($query->row()->discountAmount,2,'.','');

	}
	
	
	
	public function mani_cart_coupon_sucess($userid=''){
		
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0;

		if($cartVal -> num_rows() > 0 ){ 
			$k=0;
			foreach ($cartVal->result() as $CartRow){
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost +  ($CartRow->product_tax_cost * 0.01 * $CartRow->price ) + $CartRow->price)  * $CartRow->quantity);
				$newCartInd[] = $CartRow->indtotal;
				$k = $k + 1;
			}
			$cartSAmt = $cartVal->row()->shipping_cost;
			$cartTAmt = $cartAmt * 0.01 * $cartVal->row()->tax;
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;
			
		}
		
		$this->db->select_sum('discountAmount');
		$query = $this->db->get(SHOPPING_CART);
		$newAmtsValues = @implode('|',$newCartInd);
		
		if($query->row()->discountAmount !=''){
			$grantAmt = $grantAmt - $query->row()->discountAmount;
		}
		
		return number_format($cartAmt,2,'.','').'|'.number_format($cartSAmt,2,'.','').'|'.number_format($cartTAmt,2,'.','').'|'.number_format($grantAmt,2,'.','').'|'.number_format($query->row()->discountAmount,2,'.','').'|'.$k.'|'.$newAmtsValues;

	}
	
	
	
	
	public function view_cart_details($condition = ''){
		$select_qry = "select p.*,u.full_name,u.user_name,u.thumbnail from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id ".$condition;
		$cartList = $this->ExecuteQuery($select_qry);
		return $cartList;
			
	}
	
	public function view_atrribute_details(){
		$select_qry = "select * from ".ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
	
	public function Check_Code_Val($Code = '',$amount = '',$shipamount = '', $userid = ''){
	
		$code = $Code;
		$amount = $amount;
		$amountOrg = $amount;
		$ship_amount = $shipamount;

		$CoupRes = $this->cart_model->get_all_details(COUPONCARDS,array( 'code' => $code, 'card_status' => 'not used'));
		$GiftRes = $this->cart_model->get_all_details(GIFTCARDS,array( 'code' => $code));		
		$ShopArr = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$excludeArr = array('code','amount','shipamount');

		
		if($CoupRes->num_rows > 0){

			$PayVal = $this->cart_model->get_all_details(PAYMENT,array( 'user_id' => $userid, 'coupon_id' => $CoupRes->row()->id));
			
			if($PayVal->num_rows == 0){
			
				if($ShopArr->row()->couponID == 0){

				if($CoupRes->row()->quantity > $CoupRes->row()->purchase_count){

					$today = getdate();
					$tomorrow = mktime(0,0,0,date("m"),date("d"),date("Y"));
					$currDate = date("Y-d-m", $tomorrow);
					$couponExpDate = $CoupRes->row()->dateto; 

					$curVal = (strtotime($couponExpDate) < time());
					if($curVal != '') {
						echo '5';
						exit();
					} 

						
					if($CoupRes->row()->coupon_type == "shipping") {
						$totalamt = number_format($amount - $ship_amount,2,'.','');
						$discount ='0';
						
						$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Free Shipping',
											'is_coupon_used' => 'Yes',
											'shipping_cost' => 0,
											'total' => $totalamt);
						$condition =array('user_id' => $userid);
						$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
						echo 'Success|'.$CoupRes->row()->id.'|Shipping';
						exit();

			
					} elseif($CoupRes->row()->coupon_type == "category") {
							$newAmt = $amount;
						$catAry = @explode(',',$CoupRes->row()->category_id);
						foreach($ShopArr->result() as $shopRow){
							$shopCatArr = '';

							$shopCatArr = @explode(',',$shopRow->cate_id);
							
							$combArr = array_merge($catAry, $shopCatArr);
							$combArr1 = array_unique($combArr);
							if(count($combArr) != count($combArr1)){
							
								if($CoupRes->row()->price_type == 2){
									$percentage = $CoupRes->row()->price_value;
									$amountOrg = $shopRow->indtotal;									
									$discount = ($percentage * 0.01) * $amountOrg; 
									$IndAmt = number_format($amountOrg-$discount,2,'.','');
									$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
									$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Category',
											'is_coupon_used' => 'Yes',
											'indtotal' => $IndAmt);
									$condition =array('id' => $shopRow->id);
									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									
									$dataArr1 = array('total' => $TotalAmt);
									$condition1 =array('user_id' => $userid);
									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1); 

									
								}elseif($CoupRes->row()->price_type == 1){
								
									$discount = $CoupRes->row()->price_value;
									$amountOrg = $shopRow->indtotal;
									if($amountOrg > $discount){									
										$amountOrg = number_format($amountOrg-$discount,2,'.','');
										$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
										$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Category',
											'is_coupon_used' => 'Yes',
											'indtotal' => $amountOrg);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
										$dataArr1 = array('total' => $TotalAmt);
										$condition1 =array('user_id' => $userid);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1); 										
									}else{
										echo '7';
										exit();
									}								
								}
							}
						}
						echo 'Success|'.$CoupRes->row()->id.'|Category';
						exit();
			
					} elseif($CoupRes->row()->coupon_type== "product") {
						$PrdArr = @explode(',',$CoupRes->row()->product_id);
						$newAmt = $amount;
						foreach($ShopArr->result() as $shopRow){

							$shopPrd = $shopRow->product_id;
							
							if(in_array($shopPrd,$PrdArr)==1){
							
								if($CoupRes->row()->price_type == 2){
									
									$percentage = $CoupRes->row()->price_value;
									$amountOrg = $shopRow->indtotal;									
									$discount = ($percentage * 0.01) * $amountOrg; 
									$IndAmt = number_format($amountOrg - $discount,2,'.',''); 
									$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
									$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Product',
											'is_coupon_used' => 'Yes',
											'indtotal' => $IndAmt);
									$condition =array('id' => $shopRow->id);
									
									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									$dataArr1 = array('total' => $TotalAmt);
									$condition1 =array('user_id' => $userid);
									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1); 	

								}elseif($CoupRes->row()->price_type == 1){
								
									$discount = $CoupRes->row()->price_value;
									$amountOrg = $shopRow->indtotal;
									if($amountOrg > $discount){									
										$newDisAmt = number_format($amountOrg - $discount,2,'.','');
										$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
										$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Product',
											'is_coupon_used' => 'Yes',
											'indtotal' => $newDisAmt);
										
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
										$dataArr1 = array('total' => $TotalAmt);
										$condition1 =array('user_id' => $userid);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1); 	
		
									}else{
										echo '7';
										exit();
									}								
								}
							}
						}
						echo 'Success|'.$CoupRes->row()->id.'|Product';
						exit();

					}else{

						if($CoupRes->row()->price_type == 2){
								
									$percentage = $CoupRes->row()->price_value;
									$discount = ($percentage * 0.01) * $amount; 
									$totalAmt = number_format($amount-$discount,2,'.',''); 
									
									$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $totalAmt);
									$condition =array('user_id' => $userid);

									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									
									foreach($ShopArr->result() as $shopRow){
							
										$amountOrg = $shopRow->indtotal;									
										$discount = ($percentage * 0.01) * $amountOrg; 
										$IndAmt = number_format($amountOrg - $discount,2,'.',''); 
	
										$dataArr = array('indtotal' => $IndAmt);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									}
									
									echo 'Success|'.$CoupRes->row()->id;
									exit();
								
								}elseif($CoupRes->row()->price_type == 1){
								
									$discount = $CoupRes->row()->price_value;
									if($amount > $discount){									
										$amountOrg = number_format($amount-$discount,2,'.','');
										$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $amountOrg);
										$condition =array('user_id' => $userid);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
										$newDisAmt = ($discount / $ShopArr->num_rows);
									foreach($ShopArr->result() as $shopRow){
										$amountOrg = $shopRow->indtotal;									
										$IndAmt = number_format($amountOrg - $newDisAmt,2,'.',''); 
										$dataArr = array('indtotal' => $IndAmt);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
									}

										
										echo 'Success|'.$CoupRes->row()->id;
										exit();

									}else{
										echo '7';
										exit();
									}								
								}
								
					}
				} else {
					echo '6';
					exit();
				}
				}else{
					echo '2';
					exit();
				}
	
			
			}else{
				echo '2';
				exit();
			}
		
		
		}elseif($GiftRes->num_rows > 0){ 
		
			$curGiftVal = (strtotime($GiftRes->row()->expiry_date) < time());
			if($curGiftVal != '') {
					echo '8';
					exit();
			} 
			
			if($GiftRes->row()->price_value > $GiftRes->row()->used_amount){
				
				$NewGiftAmt = $GiftRes->row()->price_value - $GiftRes->row()->used_amount;
				if($amount > $NewGiftAmt){
					$amountOrg = $amountOrg - $NewGiftAmt;
					
						$dataArr = array('discountAmount' => $NewGiftAmt, 
											'couponID' => $GiftRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Gift',
											'is_coupon_used' => 'Yes',
											'total' => $totalamt);
						$condition =array('user_id' => $userid);
						$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition); 
						
						
						$newDisAmt = ($NewGiftAmt / $ShopArr->num_rows);
						foreach($ShopArr->result() as $shopRow){
								$amountOrg = $shopRow->indtotal;									
								$IndAmt = number_format($amountOrg - $newDisAmt,2,'.',''); 
								$dataArr = array('indtotal' => $IndAmt);
								$condition =array('id' => $shopRow->id);
								$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition); 
						}
					
				}else{
					$dataArr = array('discountAmount' => $amountOrg, 
											'couponID' => $GiftRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Gift',
											'is_coupon_used' => 'Yes',
											'total' => '0');
						$condition =array('user_id' => $userid);
						$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition); 
						
						foreach($ShopArr->result() as $shopRow){
								$amountOrg = $shopRow->indtotal;									
								$IndAmt = number_format($amountOrg - $newDisAmt,2,'.',''); 
								$dataArr = array('indtotal' => '0');
								$condition =array('id' => $shopRow->id);
								$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition); 
						}
				}
				
				echo 'Success|'.$GiftRes->row()->id.'|Gift';
				exit();
			
			}else{
					echo '2';
					exit();
			}
		
		}else{
			echo '1';
			exit();
		}

	}
	
	
	public function addPaymentCart($userid = ''){
	
	
		$this->db->select('a.*,b.city,b.state,b.country,b.postal_code');
		$this->db->from(SHOPPING_CART.' as a');
		$this->db->join(SHIPPING_ADDRESS.' as b' , 'a.user_id = b.user_id and a.user_id = "'.$userid.'" and b.id="'.$this->input->post('Ship_address_val').'"');
		$AddPayt = $this->db->get();
		
		
		if($this->session->userdata('randomNo') != '') {
			$delete = 'delete from '.PAYMENT.' where dealCodeNumber = "'.$this->session->userdata('randomNo').'" and user_id = "'.$userid.'" ';
			$this->ExecuteQuery($delete, 'delete');
			$dealCodeNumber = $this->session->userdata('randomNo');
		} else {
			$dealCodeNumber = mt_rand();
		}
		
		$insertIds = array();
		foreach ($AddPayt->result() as $result) {
					
					if($this->input->post('is_gift')==''){
						$ordergift = 0;
					}else{
						$ordergift = 1;
					}
					
				$sumTotal = number_format((($result->price + $result->product_shipping_cost + ($result->product_tax_cost * 0.01 * $result->price)) * $result->quantity ),2,'.','');
					
						$insert = ' insert into '.PAYMENT.' set 
								product_id = "'.$result->product_id.'",
								sell_id = "'.$result->sell_id.'",								
								price = "'.$result->price.'",
								quantity = "'.$result->quantity.'",
								indtotal = "'.$result->indtotal.'",
								shippingcountry = "'.$result->country.'",
								shippingid = "'.$this->input->post('Ship_address_val').'",
								shippingstate = "'.$result->state.'",
								shippingcity = "'.$result->city.'",
								shippingcost = "'.$this->input->post('cart_ship_amount').'",
								tax = "'.$this->input->post('cart_tax_amount').'",
								product_shipping_cost = "'.$result->product_shipping_cost.'",
								product_tax_cost = "'.$result->product_tax_cost.'",																												
								coupon_id  = "'.$result->couponID.'",
								discountAmount = "'.$this->input->post('discount_Amt').'",
								couponCode  = "'.$result->couponCode.'",
								coupontype = "'.$result->coupontype.'",
								sumtotal = "'.$sumTotal.'",
								user_id = "'.$result->user_id.'",
								created = now(),
								dealCodeNumber = "'.$dealCodeNumber.'",
								status = "Pending",
								payment_type = "",
								attribute_values = "'.$result->attribute_values.'",
								shipping_status = "Pending",
								total  = "'.$this->input->post('cart_total_amount').'", 
								note = "'.$this->input->post('note').'", 
								order_gift = "'.$ordergift.'", 
								inserttime = "'.time().'"';
									
						$insertIds[] = $this->cart_model->ExecuteQuery($insert, 'insert');
		}
					
						$paymtdata = array(
								'randomNo' => $dealCodeNumber,
								'randomIds' => $insertIds,
							);
						$this->session->set_userdata($paymtdata);
						
						return $insertIds;	
	}
	
	
	public function addPaymentSubscribe($userid = ''){

		if($this->session->userdata('InvoiceNo') != '') {
			$InvoiceNo = $this->session->userdata('InvoiceNo');
		} else {
			$InvoiceNo = mt_rand();
		}
		
		$paymtdata = array(	'InvoiceNo' => $InvoiceNo);
		$this->session->set_userdata($paymtdata);
		
		$dataArr = array('invoice_no' => $InvoiceNo,
						'shipping_id' => $this->input->post('SubShip_address_val'),
						'shipping_cost' => $this->input->post('subcrib_ship_amount'),
						'tax' => $this->input->post('subcrib_tax_amount'),
						'total' => $this->input->post('subcrib_total_amount'),																		
							);
		$condition =array('user_id' => $userid);
		$this->cart_model->update_details(FANCYYBOX_TEMP,$dataArr,$condition); 
		
		
		return;
		
	}
	
	
}

?>