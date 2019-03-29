
 
 	<script src="<?php echo base_url(); ?>js/calculator/custom_jscalc.js"></script>   

<a id="openPopUp" class="calculateBtn" href="javascript:;"></a>
 <div class="calculatorPopUp" id="calculatorTab">
        <script type="text/javascript">
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '\$1' + ',' + '\$2');
	}
	return x1 + x2;
}
 
function stripCommas(nStr)
{
  return nStr.replace(',', '') *1;
}
 
function compute_pvalue(form)
{
// Calculate total gross income
  var gross = 0;
  gross = stripCommas(form.rent.value) * 12;
  form.gross.value =  addCommas(gross);
 
 
  var other = stripCommas(form.other.value) * 1;
  var total_gross = gross + other;
   form.total_gross.value =  addCommas(total_gross);
   
   
		vc = total_gross * form.vc_pct.value/100;
		mv = total_gross * form.maintes.value/100;
		mf = total_gross * form.mang_fee.value/100;
		form.vc_act.value = addCommas(vc);
		form.maint.value = addCommas(mv); 
		form.mgt.value = addCommas(mf); 
	

 
  var noi = total_gross - vc
                  - stripCommas(form.impr.value)
                  - stripCommas(form.maint.value)
                  - stripCommas(form.util.value)
                  - stripCommas(form.tax.value)
                  - stripCommas(form.ins.value)
                  - stripCommas(form.mgt.value);
  form.noi.value = addCommas(noi);
 
  var cap_rate = form.cap_rate.value   * 1;
  var cur_value = stripCommas(form.cur_value.value) * 1;
 
  if (cur_value != 0) 
   {
    cap_rate = (noi * 100)/cur_value;
    form.cap_rate.value = cap_rate.toFixed(2);
   }
 
  if (cap_rate == 0)
      {cap_rate = 7.5;
       form.cap_rate.value = cap_rate;
      }
 
    
    cur_value = (noi * 100)/cap_rate;
    form.cur_value.value = addCommas(cur_value.toFixed(0));
	var capvalue = 0.00;
	if(noi){

		if(form.vcp_per.value>0){
			capvalue =  noi/(form.vcp_per.value/100);
		}else{
			capvalue =  '';
		}
     }
	 else{
	 		capvalue=0;
	 }
		form.vcp.value=addCommas(capvalue.toFixed(0));
}

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/calculator/simplecalendar.js" ></script>
        
        	<!--calculatorPopUpTop starts here-->
            <span class="calculatorPopUpTop"></span>
            <!--calculatorPopUpTop ends here-->
        
            <!--calculatorPopUpMain starts here-->
            <div class="calculatorPopUpMain datatable">
            
            	<a href="javascript:;" id="popUpClose"></a>
                
                <h2>Calculate Your Own Estimated Return</h2>
               <div class="outLink"><a href="http://www.realtytrac.com/content/news-and-opinion/single-family-rentals-top-20-markets-7670" target="_blank" >Nationwide Cap Rate Averages</a></div>
               
              <form name="frm" id="frm">  
                <!--popupFormEnclose starts here-->
                <div class="popupFormEnclose width100">
                
                    <!--popupFormBox starts here-->
                    <div class="popupFormBox width100">
                     <label>Monthly Rent</label> <input type="text" name="rent" size="10" value="" />
					  <div class="ccrighttxt">Enter the total monthly rent you receive</div>
             </div>
                    <!--popupFormBox ends here-->
                    
                    <!--popupFormBox starts here-->
                    <div class="popupFormBox width100">
                    	
                        <label>Gross Annual Income</label>
                      <input type="text" disabled="disabled" name="gross" size="10" class="disabled" />
                        <div class="ccrighttxt">Calculated as monthly rent * 12</div>
                        
                    </div>
                    <!--popupFormBox ends here-->
                    
                    <!--popupFormBox starts here-->
                    <div class="popupFormBox width100">
                    	
                        <label>Other Income</label>
                       <input type="text" name="other" size="10" />
                        <div class="ccrighttxt">Enter the annual amount of any other income (e.g. Laundry)</div>
                        
                    </div>
                    <!--popupFormBox ends here-->
                    
                    <!--popupFormBox starts here-->
                    <div class="popupFormBox width100">
                    	
                        <label>Total Gross</label>
                        <input type="text" disabled="disabled" class="disabled"  name="total_gross" size="10" />
                       <div class="ccrighttxt">Calculated as the annual rent plus other income.</div>
                        
                    </div>
                    <!--popupFormBox ends here-->
                    
                    <!--popupFormBox starts here-->
                    <div class="popupFormBox width100">
                    	
                        <label>Vacancy <input  type="text"name="vc_pct" size="2" class="vc_pct" value="0" /> %</label>
                       <input type="text" disabled="disabled" class="disabled"  name="vc_act" size="10" />
                        <div class="ccrighttxt">Estimate a value for expected vacancies (5% is typical)</div>
                        
                    </div>
                    <!--popupFormBox ends here-->
                    
                                    <!--popupFormBox starts here-->
               
                    <!--popupFormBox ends here-->
                      <input name="impr" type="hidden" size="10" value="0" />
                                    <!--popupFormBox starts here-->
  <!--                  <div class="popupFormBox width100">
                    	
                        <label>Amortized Costs </label>-->
                   
                       <!-- <h5>Estimate an annual amortized value for repairs and capital improvements (e.g. a $10,000 roof amortized over 10 years = $1,000)</h5>
                        
                    </div>-->
                    <!--popupFormBox ends here-->
                    
                             <div class="popupFormBox width100">
                    	
                        <label>Maintenance <input  type="text"name="maintes" size="2" class="vc_pct" value="0" /> % </label>
                    <input name="maint" size="10" value="" type="text" />
                        <div class="ccrighttxt">Estimate an annual amortized value for repairs and capital improvements (e.g. a $10,000 roof amortized over 10 years = $1,000)</div>
                        
                    </div>
                    
                    
                          <div class="popupFormBox width100">
                    	
                        <label>Utilities </label>
                   <input name="util" size="10" value=""  type="text" />
                        <div class="ccrighttxt">Enter the amount spent on utilities this year.</div>
                        
                    </div>
                    
                    
                    <div class="popupFormBox width100">
                    	
                        <label>Property Taxes </label>
                  <input name="tax" size="10" value="" type="text" />
                        <div class="ccrighttxt">Enter the annual property tax amount for the building.</div>
                        
                    </div>
                    
                      <div class="popupFormBox width100">
                    	
                        <label>Insurance </label>
                             <input name="ins" size="10" value="0" type="text" />
          
                        <div class="ccrighttxt">Enter the annual property insurance premium.</div>
                        
                    </div>
                    
                     <div class="popupFormBox width100">
                    	
                        <label>Management Fees  <input  type="text"name="mang_fee" size="2" class="vc_pct" value="0" /> % </label>
                     <input name="mgt" size="10" type="text" />
                        <div class="ccrighttxt">Net Operating Income</div>
                        
                    </div>
                    
                                       
                    
                    
                <div class="popupFormBox width100">
                <label>Net Operating Income</label>
                
                <input disabled="disabled" name="noi" class="disabled"  size="10"   type="text" />
                
                <div class="ccrighttxt">Calculated as the annual gross income minus expenses</div> 
                </div>
                    
                    
			      <div class="popupFormBox width100">
					 <label>Sale Price</label>
					<input name="cur_value" id="cur_value" size="10"  type="text" value="<?php echo $price; ?>"  />
					<div class="ccrighttxt">Enter the current market value <u>and leave the CAP Rate blank</u> to calculate the CAP Rate</div>
                    </div>
                    
                    
			      <div class="popupFormBox width100">
					 <label>CAP Rate</label>
					<input name="cap_rate" size="10"  type="text" class="result"   />        
					<div class="ccrighttxt">Enter a CAP Rate <u>and leave the sale Price blank</u> to calulate the property value</div>
                    </div>
                    
                     <div>
			      <div class="popupFormBox  floatLeft" style="width:30%;">
			
					<input name="Button" onclick="compute_pvalue(this.form)" type="button" value="Calculate" />
					</div>
                    <div class="popupFormBox  floatLeft" style="width:70%; margin-top:15px;">
                    	
                        <label>Value at <input  type="text"name="vcp_per" size="2" class="vc_pct" value="0" /> % Cap </label> <input name="vcp" size="10" type="text" />
                                               
                    </div>
                    </div>
                    
                
                </div>
                <!--popupFormEnclose ends here-->
                </form>
                
            </div>
            <!--calculatorPopUpMain ends here-->
            
            <!--calculatorPopUpBotttom starts here-->
            <span class="calculatorPopUpBotttom"></span>
            <!--calculatorPopUpBotttom ends here-->
        
        </div>