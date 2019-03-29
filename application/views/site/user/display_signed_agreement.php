<?php $this->load->view('site/templates/header'); ?>


  <link rel="stylesheet" type="text/css" href="css/site/jquery.ad-gallery.css">
  <script type="text/javascript" src="js/site/jquery.ad-gallery.js"></script>
  <script type="text/javascript">
  $(function() {
    var galleries = $('.ad-gallery').adGallery();
	    galleries[0].slideshow.toggle();
  });
  </script>
  <style type="text/css">
  #gallery {
    padding: 30px;
    background: #e1eef5;
  }
  #descriptions {
    position: relative;
    height: 50px;
    background: #EEE;
    margin-top: 10px;
    width: 100%;
    padding: 10px;
    overflow: hidden;
  }
  #descriptions .ad-image-description {
      position: absolute;
  }
  #descriptions .ad-image-description .ad-description-title {
      display: block;
  }
  </style>
  
<div class="listing_content" style="margin-top:20px;">
	
   <?php $previewImg = @explode(',',$signDetails->row()->preview_images); ?>
	
  	<div id="gallery" class="ad-gallery">
    <h1 style=" margin-bottom:20px;">Signed Document</h1>
    
   
    
    <div class="clear"></div>
   
    
      <div class="ad-image-wrapper">
      </div>
      <div class="ad-controls">
      </div>
      <div class="ad-nav">
        <div class="ad-thumbs">
          <ul class="ad-thumb-list">
          
          	<?php foreach($previewImg as $previewImgs){ ?>
            <li>
              <a href="preview-images/<?php echo $previewImgs; ?>">
                <img src="preview-images/<?php echo $previewImgs; ?>" class="image0" width="100">
              </a>
            </li>
			<?php } ?>
          
          </ul>
        </div>
      </div>
    </div> 
  
</div>
<?php $this->load->view('site/templates/footer'); ?>