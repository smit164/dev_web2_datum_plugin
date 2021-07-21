<li class="datum_user_profile"> 
  	<div class="half">
    	<label for="profile2" class="profile-dropdown">
      		<input type="checkbox" id="profile2">
      		<span><?php echo getDMUserFirstName(); ?> <?php echo getDMUserLastName(); ?></span>
            <?php
            $fileURL = ( getDMUserProfileImage() != null ) ? getDMUserProfileImage() : 'https://datumdocstorage.blob.core.windows.net/datumfilecontainer/placeholders/agent-placeholder.png';
            ?>
      		<img src="<?php echo $fileURL; ?>">
      		<label for="profile2"><i class="mdi mdi-menu"></i></label>
      		<ul>
                <li><a href="javascript:void(0);" id="open_register" data-popup="register_html" class="datum_signup_popup_popup datum_model_open"><i class="mdi mdi-email-outline"></i>Update Profile</a></li>
                <li><a href="<?php echo dm_get_page_link('datum_my_listing_page_id'); ?>"><i class="mdi mdi-account"></i>My Listing</a></li>
                <li><a href="<?php echo dm_get_page_link('datum_my_favorite_listing_page_id'); ?>"><i class="mdi mdi-account"></i>My Favourite</a></li>
                <li><a href="#" id="datum_logout"><i class="mdi mdi-logout"></i>Logout</a></li>
     	 	</ul>
    	</label>
  	</div>
</li>