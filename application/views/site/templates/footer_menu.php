 <footer id="footer"> <a href="<?php echo $this->config->item('twitter_link');?>" target="_blank" class="follow-twitter"><i class="ic-follow-twitter"></i><?php if($this->lang->line('footer_follow_on') != '') { echo stripslashes($this->lang->line('footer_follow_on')); } else echo "Follow on "; ?>  Twitter</a>
        <hr>
        <?php 
         if (count($cmsPages)>0){
        ?>
        <ul class="footer-nav">
        <?php 
        foreach ($cmsPages as $cmsRow){
            if ($cmsRow['category'] == 'Main'){
        ?>
          <li><a href="pages/<?php echo $cmsRow['seourl'];?>"><?php echo $cmsRow['page_name'];?></a></li>
        <?php 
            }
        }
        ?>  
        </ul>
        <?php 
         }
        ?>
        <!-- / footer-nav -->
      </footer>
      <!-- / footer -->