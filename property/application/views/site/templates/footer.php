
       
<footer>
     <div class="fotter_full">
     	<div class="fotter_content">
        	<ul class="terms">
            <li><a href="javascript:void(0);"><?php echo $this->config->item('footer_content'); ?></a></li>
				<?php 
		         if (count($cmsPages)>0){
		        ?>
		        <?php 
		        foreach ($cmsPages as $cmsRow){
		            if ($cmsRow['category'] == 'Main' && $cmsRow['status'] == 'Publish' && $cmsRow['hidden_page'] == 'No' && $cmsRow['site'] == 'main'){
		        ?>
		          <li><a href="pages/<?php echo $cmsRow['seourl'];?>"><?php echo $cmsRow['page_name'];?></a></li>
		        <?php 
		            }
		        }
		        ?>  
		        <?php 
		         }
		        ?>
                <li><a href="<?php echo base_url(contact);?>">Contact Us </a></li>
            </ul>
        	<p>All properties advertised via Return on Rentals website are sold 'as is', without expressed or implied warranty. You may purchase a home warranty from a 3rd party. Any property you purchase is a transaction between you and the seller of that property and every property will differ in condition and financial performance. We strongly suggest that you conduct any due-dilligence needed before finalizing the transaction. Return on Rentals and it's related entities does not offer any guarantee regarding the specific performance of a property including it's return on investment or cap rate. As all real estate transactions pose some risk, we suggest you contact your on accounting, legal or other professional advisor regarding any questions you have including the suitability of a specific transaction.</p>
        
        </div>
     <div class="clear"></div>
      
	  <div id="reservatiosnIDLists"></div>
      
       <div id="soldIDLists"></div>
     
     
     
     
     
     </div>
     
    
         
     
     
     
     </footer>
     
     
     <?php if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code'));}?>

<!--////////filter jquery/////////-->
 

<script>
function GetHTTPObject()  {
	// This is for FireFox
	if(window.XMLHttpRequest) {
		try {
			objHTTP = new XMLHttpRequest();
		} catch(e) {
			objHTTP = false;
		}
		// branch for IE/Windows ActiveX version
	}
	else if(window.ActiveXObject) {
		try {
			objHTTP = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			try {
				objHTTP = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e) {
				objHTTP = false;
			}
		}
	}
	return objHTTP;
}
    
        function SearchByCat(cat_id,subcat_id) {
		
         // alert("sss");
		  //$("#container").hide();
		  $("#fulldiv_container").html('<a class="c-loader" href="javascript:void(0);" title="Loading" >Loading...</a>').show();
		  $(".selected").removeClass('selected');
		  var sPath = window.location.pathname;
			var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);	
			var url = baseURL+'site/product/Get_All_Property_List_page/'+cat_id+'/'+subcat_id;
			//alert(url);
			var req = GetHTTPObject();
			req.open('GET',url,false);
			req.send(null);
			if(req.readyState == 4 && req.status == 200)  {
				var responseText = req.responseText;
				//alert(responseText);
				$("#fulldiv_container").html(responseText).show();
				$("#active_"+cat_id).addClass('selected');
				 //$("#active_"+cat_id).className = "selected";
				
				//$container.isotope( 'insert', $( responseText ) );
			}
			}
			
			
			
			function SearchByFeatureCat(cat_id,subcat_id) {
		
         // alert("sss");
		  //$("#container").hide();
		  $("#container").html('<a class="c-loader" href="javascript:void(0);" title="Loading" >Loading...</a>').show();
		  $(".selected").removeClass('selected');
		  var sPath = window.location.pathname;
			var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);	
			var url = baseURL+'site/product/Get_All_Property_Feature_List_page/'+cat_id+'/'+subcat_id;
			//alert(url);
			var req = GetHTTPObject();
			req.open('GET',url,false);
			req.send(null);
			if(req.readyState == 4 && req.status == 200)  {
				var responseText = req.responseText;
				//alert(responseText);
				$("#container").html(responseText).show();
				$("#active_"+cat_id).addClass('selected');
				 //$("#active_"+cat_id).className = "selected";
				
				//$container.isotope( 'insert', $( responseText ) );
			}
			}
			
			
			
		function SoldSearchByCat(cat_id,subcat_id) {
		
         // alert("sss");
		  //$("#container").hide();
		  $("#fulldiv_container").html('<a class="c-loader" href="javascript:void(0);" title="Loading" >Loading...</a>').show();
		  $(".selected").removeClass('selected');
		  var sPath = window.location.pathname;
			var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);	
			var url = baseURL+'site/product/display_all_sold_proptery/'+cat_id+'/'+subcat_id;
			//alert(url);
			var req = GetHTTPObject();
			req.open('GET',url,false);
			req.send(null);
			if(req.readyState == 4 && req.status == 200)  {
				var responseText = req.responseText;
				//alert(responseText);
				$("#fulldiv_container").html(responseText).show();
				$("#active_"+cat_id).addClass('selected');
				 //$("#active_"+cat_id).className = "selected";
				
				//$container.isotope( 'insert', $( responseText ) );
			}
			}
			/*$.ajax({
			type:'post',
			url:baseURL+'site/product/Get_All_Property_List',
			data:{'uid':'1'},
			dataType:'html',
			success:function(data){
				 $container.isotope( 'appended', $( $container.html(data) ) ); 
				 //$container.html(data); 
			}
		});*/
       
     
  </script> 
  <script id="godaddy-security-s" src="https://cdn.sucuri.net/badge/badge.js" data-s="205" data-i="8d7b9eaf239072b5bbdc5a8a16c72148180d0eb2d3" data-p="r" data-c="d" data-t="g"></script>
  
  
  
  
  

  
  
  
  
  
  
</body>
</html>
