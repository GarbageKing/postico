<div class="postico-container">
	<h1>Postico</h1>
	<br>

	<form id="postico_form" type="POST" action="options.php">
		<?php settings_fields( 'postico-settings-group' ); ?>
		<?php do_settings_sections( 'postico-settings-group' ); ?>
		<h3>Icon to show:</h3>				
		<?php foreach($d_icons as $icon){
			$is_checked = '';
			if($chosen_icon == $icon) {
				$is_checked = 'checked';
			}
			echo '<label style="border: 1px solid #000; padding: 4px"><input name="icons_radio" type="radio" value="'.esc_attr($icon).'" '.$is_checked.' ><span class="dashicons-before wp-menu-image '.$icon.'"></span></label> ';
		} ?>			
		<label><input name="icons_radio" type="radio" value="none" <?php if($chosen_icon == "none") {echo 'checked';} ?>>None</label>	

		<h3>Placement:</h3>				
		<label>Before title <input name="placement_radio" type="radio" value="0" <?php if($chosen_place == 0){echo 'checked';}?>></label>
		<label>After title <input name="placement_radio" type="radio" value="1" <?php if($chosen_place == 1){echo 'checked';}?>></label>
		<br>
		<button>Apply</button>
	</form>

	<h3>Posts:</h3>
	<table id="posts_table" class="display" style="width:100%; text-align:center;">
		<thead>
	        <tr>
	        	<th>Title</th>
	            <th>Status</th>
	            <th>Type</th>
	            <th>Use Icon</th>					                        
	        </tr>
	    </thead>
	    <tbody>
	    	<?php foreach($relevant_posts as $post){ ?>
	        <tr>
	        	<td><?= $post->post_title ?></td>
	        	<td><?= $post->post_status ?></td>
	        	<td><?= $post->post_type ?></td>
	        	<td><input type="checkbox" class="use-icon" data-id="<?= $post->ID ?>" <?php if(get_post_meta($post->ID, 'use_icon', true) == 1){echo 'checked';} ?>></td>					        	
	        </tr>
	    	<?php } ?>
	    </tbody>
	</table>
</div>
