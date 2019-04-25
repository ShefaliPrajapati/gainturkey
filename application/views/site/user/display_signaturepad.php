<?php $this->load->view('site/templates/new_header');
ob_start();
session_start(); ?>
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<link href="css/site/my-account.css" type="text/css" rel="stylesheet" media="all" />

<?php //unlink('Signature/1_signature.png');?>
<!-- singature pad start -->

<style>

@font-face { font-family: 'Arty'; src: url('./signature-from-text/Arty.ttf') format('truetype'); }
@font-face { font-family: 'Crazy'; src: url('./signature-from-text/Crazy.ttf') format('truetype'); }
@font-face { font-family: 'Heart'; src: url('./signature-from-text/Heart.ttf') format('truetype'); }
@font-face { font-family: 'Journal'; src: url('./signature-from-text/Journal.ttf') format('truetype'); }
@font-face { font-family: 'Mayqueen'; src: url('./signature-from-text/Mayqueen.ttf') format('truetype'); }
@font-face { font-family: 'Monsieur'; src: url('./signature-from-text/Monsieur.ttf') format('truetype'); }
@font-face { font-family: 'MrsSaint'; src: url('./signature-from-text/MrsSaint.ttf') format('truetype'); }
@font-face { font-family: 'Notera'; src: url('./signature-from-text/Notera.ttf') format('truetype'); }
@font-face { font-family: 'PWSignatures'; src: url('./signature-from-text/PWSignatures.ttf') format('truetype'); }
@font-face { font-family: 'PWSignaturetwo'; src: url('./signature-from-text/PWSignaturetwo.ttf') format('truetype'); }
@font-face { font-family: 'Signerica'; src: url('./signature-from-text/Signerica.ttf') format('truetype'); }
@font-face { font-family: 'Smile'; src: url('./signature-from-text/Smile.ttf') format('truetype'); }
@font-face { font-family: 'Tamoro'; src: url('./signature-from-text/Tamoro.ttf') format('truetype'); }


</style>

   <link href="<?php echo base_url(); ?>sign/assets/jquery.signaturepad.css" rel="stylesheet">
  
  
  <!--[if lt IE 9]><script src="../assets/flashcanvas.js"></script><![endif]-->
 <script>
$(document).ready(function(){

  $("#test").click(function(){
  		$('#loadingImg').show();	
	  $('#ErrDivSign').html('');
	/*var data = { inputtext: document.getElementById('output').value,};*/	

	var intNameVal = document.getElementById('initial_name').value;	
	
	if(intNameVal==''){
		$('#ErrDivSign').html('<font color="#FF0000">Please Enter Your Initial.</font>');
		$('#loadingImg').hide();
		return false;
	}
	
	
	var txtboxval = document.getElementById('name').value;
	//var txtboxval = '';
    var font = document.getElementById('font').value;

	if(txtboxval=="") { 
		var outputval = document.getElementById('output').value;
		if(outputval==''){
			$('#ErrDivSign').html('<font color="#FF0000">Please Enter Signature Name.</font>');
			$('#loadingImg').hide();
			return false;
		}else{
			var data = {
				inputtext: document.getElementById('output').value,
				signname:document.getElementById('signID').value,
			};
  			var url_link ="<?php echo base_url(); ?>signature-from-json/index.php";
		}	
		
	}else if(font == ''){
		$('#ErrDivSign').html('<font color="#FF0000">Please Select Signature Type.</font>');
		$('#loadingImg').hide();
		return false;
	}else { 
		var data = {
			 inputtext: document.getElementById('name').value,
			 font: document.getElementById('font').value,
			 signname:document.getElementById('signID').value,
	
		};
		//alert("inputy"+txtboxval+font);
		 var url_link ="<?php echo base_url(); ?>signature-from-text/index.php";
	 }
  
  	 var inti_link ="<?php echo base_url(); ?>site/user/intialsave";
  	 var stid = <?php echo $this->uri->segment(2); ?>;
  //alert(url_link);
    $.ajax({
	type:"POST",
	//url:"http://192.168.1.253/sivaprakash/ReturnOnRentals/signature-from-json/index.php",
	url:url_link,
	data: data,	
	success:function(result){
      if(result=="success") {
		var intialname = $('#initial_name').val();
			$.ajax({
				type:"POST",
				url:inti_link,
				data: {'intiailName':intialname,'stid':stid},	
				success:function(resulta){
					//alert(resulta);		
					if(resulta =='success'){
					//alert("Sucessfully created your signature");
					window.location.href = "<?php echo base_url().'viewagreement/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/';?>";
					$('#loadingImg').hide();
					}
				}
			});
		//location.reload();
	  //window.setTimeout('location.reload()', 3000); 
	  }
	  
	 
	  //alert(result);
	 //$("#div1").html(result);
	 
    }});
  });
});
</script>


 <script src="<?php echo base_url(); ?>sign/jquery.signaturepad.js"></script>
 
  <script>
    $(document).ready(function() {
      $('.sigPad').signaturePad();
    });
  </script>

  <script src="<?php echo base_url(); ?>sign/assets/json2.min.js"></script> 
  
  
  <script>
  function Onload() {
  document.getElementById('imgsign').style.display='none';
  }
  
  function hideTypeit(val) {
	  //alert("you click draw it");
	  if(val=="draw") {
		  document.getElementById('name').value="";
		  document.getElementById('name').style.display='none';
		  document.getElementById('font').style.display='none';
		  document.getElementById('loading').style.display='none';
		  $('#signCloseVal').hide();
	  }
	  else {
		  document.getElementById('name').style.display='block';
		  document.getElementById('font').style.display='block';
		  $('#signCloseVal').show();
	  }
  
  }
  
  
  </script>
<!-- signature pad end -->


<script type="text/javascript">

function displayfunction(id,id2){


if(document.getElementById(id).style.display=="none")
{
document.getElementById(id).style.display="block";
document.getElementById(id2).style.display="none";
return true;
}
if(document.getElementById(id).style.display=="block")
{
document.getElementById(id).style.display="none";
document.getElementById(id2).style.display="block";
return true;
}

}
</script>
<script>
$(function() {
$( "#draggablecalci" ).draggable();
});
</script>

<style>
#draggablecalci { padding: 0.5em; }
</style>


	<script src="<?php echo base_url(); ?>js/calculator/custom_jscalc.js"></script>   

<!--<a id="openPopUp" class="calculateBtn" href="javascript:void(0);"></a>-->
<div class="calculatorPopUp container">
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
    return nStr.replace(',', '') * 1;
}

function compute_pvalue(form)
{
// Calculate total gross income
    var gross = 0;
    gross = stripCommas(form.rent.value) * 12;
    form.gross.value = addCommas(gross);


    var other = stripCommas(form.other.value) * 1;
    var total_gross = gross + other;
    form.total_gross.value = addCommas(total_gross);


    /*	vc = total_gross * form.vc_pct.value/100;
        mv = total_gross * form.maintes.value/100;
        mf = total_gross * form.mang_fee.value/100;
        form.vc_act.value = addCommas(vc);
        form.maint.value = addCommas(mv);
        form.mgt.value = addCommas(mf);
    */


    if (form.vc_pct.value == 0) {
        vc = (form.vc_act.value * 100) / total_gross;
        form.vc_pct.value = vc;
    } else {
        vc = total_gross * form.vc_pct.value / 100;
        form.vc_act.value = addCommas(vc);
    }
    if (form.maintes.value == 0) {
        mv = (form.maint.value * 100) / total_gross;
        form.maintes.value = mv;
    } else {
        mv = total_gross * form.maintes.value / 100;
        form.maint.value = addCommas(mv);
    }
    if (form.mang_fee.value == 0) {
        mf = (form.mgt.value * 100) / total_gross;
        form.mang_fee.value = mf;
    } else {
        mf = total_gross * form.mang_fee.value / 100;
        form.mgt.value = addCommas(mf);
    }


    var noi = total_gross - vc
        - stripCommas(form.impr.value)
        - stripCommas(form.maint.value)
        - stripCommas(form.util.value)
        - stripCommas(form.tax.value)
        - stripCommas(form.ins.value)
        - stripCommas(form.mgt.value);
    form.noi.value = addCommas(noi);

    var cap_rate = form.cap_rate.value * 1;
    var cur_value = stripCommas(form.cur_value.value) * 1;

    if (cur_value != 0) {
        cap_rate = (noi * 100) / cur_value;
        form.cap_rate.value = cap_rate.toFixed(2);
    }

    if (cap_rate == 0) {
        cap_rate = 7.5;
        form.cap_rate.value = cap_rate;
    }


    cur_value = (noi * 100) / cap_rate;
    form.cur_value.value = addCommas(cur_value.toFixed(0));
    var capvalue = 0.00;
    if (noi) {

        if (form.vcp_per.value > 0) {
            capvalue = noi / (form.vcp_per.value / 100);
        } else {
            capvalue = '';
        }
    } else {
        capvalue = 0;
    }
    form.vcp.value = addCommas(capvalue.toFixed(0));
}

</script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/calculator/simplecalendar.js"></script>
    <div class="row">
        <div class="col-lg-12">
            <div id="TabbedPanels1" class="TabbedPanels mt-5">
                <div class="TabbedPanelsContentGroup">
                    <div class="TabbedPanelsContent ">
                        <div class="tab_box">
                            <div>
                                <div class="personal_detail" id="details_parent" style="margin-top: 45px !important;">
                                    <div class="personal_title">
                                        <span>Your Signature</span>

                                    </div>

                                </div>
                                <div class="personal_detail" id="details">
                                    <p style="margin:10px; font-size:14px;">Please create your initials and signature
                                        below. Once you create them, you will have a chance to review the document and
                                        input your initials and signature in designated spots. </p>
                                    <form method="post" action="demo.php" class="sigPad">
                                        <input type="hidden" id="signID" name="signID" value="<?php echo $userId; ?>"/>
                                        <input type="hidden" id="signID" name="signID" value="<?php echo $userId; ?>"/>

                                        <div id="signature">

                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="40%">Your Initial :</td>
                                                    <td width="60%"><input type="text" name="initial_name"
                                                                           id="initial_name" class="form-control"/></td>
                                                </tr>
                                                <tr>
                                                    <td>Initial Type</td>
                                                    <td><select name="initial_font" id="initial_font"
                                                                class="form-control">
                                                            <option value=""> Select Initial Type</option>
                                                            <!--<option value="Arty" style="font-family:Arty; font-size:20px;">Initial 1</option>-->
                                                            <option value="Crazy"
                                                                    style="font-family:Crazy; font-size:20px;">Initial 1
                                                            </option>
                                                            <option value="Heart"
                                                                    style="font-family:Heart; font-size:20px;">Initial 2
                                                            </option>
                                                            <option value="Journal"
                                                                    style="font-family:Journal; font-size:20px;">Initial
                                                                3
                                                            </option>
                                                            <!--<option value="Mayqueen" style="font-family:Mayqueen; font-size:20px;">Initial 5</option>-->
                                                            <option value="Monsieur"
                                                                    style="font-family:Monsieur; font-size:20px;">
                                                                Initial 4
                                                            </option>
                                                            <option value="MrsSaint"
                                                                    style="font-family:MrsSaint; font-size:20px;">
                                                                Initial 5
                                                            </option>
                                                            <option value="Notera"
                                                                    style="font-family:Notera; font-size:20px;">Initial
                                                                6
                                                            </option>
                                                            <!--<option value="PWSignatures" style="font-family:PWSignatures; font-size:20px;">Initial 9</option>-->
                                                            <option value="PWSignaturetwo"
                                                                    style="font-family:PWSignaturetwo; font-size:20px;">
                                                                Initial 7
                                                            </option>
                                                            <option value="Signerica"
                                                                    style="font-family:Signerica; font-size:20px;">
                                                                Initial 8
                                                            </option>
                                                            <option value="Smile"
                                                                    style="font-family:Smile; font-size:20px;">Initial 9
                                                            </option>
                                                            <option value="Tamoro"
                                                                    style="font-family:Tamoro; font-size:20px;">Initial
                                                                10
                                                            </option>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <div id="loadingInitial"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <span id="ErrDivSign"></span>
                                            <div id="signCloseVal">
                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td width="40%">Signature Name</td>
                                                        <td width="60%"><input type="text" name="name" id="name"
                                                                               class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Signature Type</td>
                                                        <td><select name="font" id="font" class="form-control">
                                                                <option value=""> Select Signature Type</option>
                                                                <option value="Arty"
                                                                        style="font-family:Arty; font-size:20px;">
                                                                    Signatue 1
                                                                </option>
                                                                <option value="Crazy"
                                                                        style="font-family:Crazy; font-size:20px;">
                                                                    Signatue 2
                                                                </option>
                                                                <option value="Heart"
                                                                        style="font-family:Heart; font-size:20px;">
                                                                    Signatue 3
                                                                </option>
                                                                <option value="Journal"
                                                                        style="font-family:Journal; font-size:20px;">
                                                                    Signatue 4
                                                                </option>
                                                                <option value="Mayqueen"
                                                                        style="font-family:Mayqueen; font-size:20px;">
                                                                    Signatue 5
                                                                </option>
                                                                <option value="Monsieur"
                                                                        style="font-family:Monsieur; font-size:20px;">
                                                                    Signatue 6
                                                                </option>
                                                                <option value="MrsSaint"
                                                                        style="font-family:MrsSaint; font-size:20px;">
                                                                    Signatue 7
                                                                </option>
                                                                <option value="Notera"
                                                                        style="font-family:Notera; font-size:20px;">
                                                                    Signatue 8
                                                                </option>
                                                                <option value="PWSignatures"
                                                                        style="font-family:PWSignatures; font-size:20px;">
                                                                    Signatue 9
                                                                </option>
                                                                <option value="PWSignaturetwo"
                                                                        style="font-family:PWSignaturetwo; font-size:20px;">
                                                                    Signatue 10
                                                                </option>
                                                                <option value="Signerica"
                                                                        style="font-family:Signerica; font-size:20px;">
                                                                    Signatue 11
                                                                </option>
                                                                <option value="Smile"
                                                                        style="font-family:Smile; font-size:20px;">
                                                                    Signatue 12
                                                                </option>
                                                                <option value="Tamoro"
                                                                        style="font-family:Tamoro; font-size:20px;">
                                                                    Signatue 13
                                                                </option>
                                                            </select></td>
                                                    </tr>
                                                </table>


                                            </div>
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td width="40%">Your Signature</td>
                                                    <td width="60%">
                                                        <div id="loading"></div>

                                                        <div class="sig sigWrapper" id="drawpad">

                                                            <!--<div class="typed"></div>-->
                                                            <div class="typed" id="demotest"></div>

                                                            <canvas class="pad" width="250" height="50"
                                                                    style="color:#000 !important;"></canvas>

                                                            <input type="hidden" name="output" id="output"
                                                                   class="output">

                                                            <!-- <p class="typeItDesc">your signature</p>-->

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Signature Option</td>
                                                    <td><p class="drawItDesc">Draw your signature</p>
                                                        <ul class="sigNav">
                                                            <li class="typeIt"><a href="#type-it" class="current"
                                                                                  onClick="hideTypeit('type');">Type
                                                                    It</a></li>
                                                            <li class="drawIt"><a href="#draw-it"
                                                                                  onClick="hideTypeit('draw');">Draw
                                                                    It</a></li>
                                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-add" id="test">Click
                                                            to review document
                                                        </button>
                                                        <span id="loadingImg" style="display:none;"><img
                                                                    src="images/ajax-loader/ajax-loader(1).gif"</span>
                                                    </td>
                                                </tr>


                                                </td>

                                                </tr>


                                            </table>

                                            <input type="hidden" id="txt"/>
                                        </div>


                                    </form>


                                </div>
                            </div>
                            <div>

                                <div>


                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>


                </div>

                <div class="clear"></div>
                <!--end of tab panels-->
            </div>
        </div>
    </div>
</div>

     <script>
$('#font').on('change', function() {
  //alert( this.value );
  
  $("#ErrDivSign").html("");
  $("#loading").html("");
  $('#demotest').css('font-family', $(this).val()); 
  
//$('#loading').html('<img src="http://preloaders.net/preloaders/287/Filling%20broken%20ring.gif"> loading...');
  
 var curName = document.getElementById('name').value;
    var fontname = document.getElementById('font').value;
 
  var data = {
	 inputtext: document.getElementById('name').value,
	 font: document.getElementById('font').value,
	 signname:document.getElementById('signID').value,
	
	};
	//alert("inputy"+txtboxval+font);
	 var url_link ="<?php echo base_url(); ?>signature-from-text/index.php";
	 var intialname = $('#initial_name').val();
	// alert(url_link);
   $.ajax({
	type:"POST",
	url:url_link,
	data: data,	
	success:function(result){
		//alert(result);
			$("#loading").html("");
			$("#loading").html('<span style="font-family:'+fontname+'; font-size:24px;">'+curName+"</span>");
			
		}
    });

});


$('#initial_font').on('change', function() {
  
  $("#ErrDivSign").html("");
  $("#loadingInitial").html("");
  $('#initial_test').css('font-family', $(this).val()); 
  
  
 var curName = document.getElementById('initial_name').value;
    var fontname = document.getElementById('initial_font').value;
 
  var data = {
	 inputtext: document.getElementById('initial_name').value,
	 font: document.getElementById('initial_font').value,
	 signname:document.getElementById('signID').value,
	
	};
	//alert("inputy"+txtboxval+font);
	 var url_link ="<?php echo base_url(); ?>signature-from-text/index_initial.php";
	 var intialname = $('#initial_name').val();
	// alert(url_link);
   $.ajax({
	type:"POST",
	//url:"http://192.168.1.253/sivaprakash/ReturnOnRentals/signature-from-json/index.php",
	url:url_link,
	data: data,	
	success:function(result){
	//$("#
			$("#loadingInitial").html("");
			$("#loadingInitial").html('<span style="font-family:'+fontname+'; font-size:24px;">'+curName+"</span>");
			//$("#loading").html("<img id='asdfa' src='<?php echo base_url()."Signature/".$userId."_signature.png"; ?>' />");
			
			//$("#loading").html("<img id='asdfa' src='<?php echo base_url(); ?>Signature/1_signature.png' />");
			//$("#asdfa").removeAttr("src").attr("src", "/myimg.jpg
			//alert(<?php echo base_url() ?>+"Signature/1_signature.png");
		}
    });
  
})


</script>
<?php $this->load->view('site/templates/new_footer'); ?>
