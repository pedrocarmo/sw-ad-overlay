     </pre>
<div class="wrap"><form action="options.php" method="post" name="options">
<h2>Settings</h2>
<?php wp_nonce_field('update-options');?>
<table class="form-table" width="100%" cellpadding="10">
<tbody>

<tr>
	<th>
		<label for="sw_overlay_active">Active</label>
	</th>
	<td scope="row" align="left">
		<input id="sw_overlay_active" name="sw_overlay_active" <?php echo $active;?> type="checkbox" value="true" />
	</td>
</tr>

<tr>
    <th>
        <label for="sw_overlay_show_always">Show Overlay Always</label>
    </th>
    <td scope="row" align="left">
        <input id="sw_overlay_show_always" name="sw_overlay_show_always" <?php echo $showAlways;?> type="checkbox" value="true" />

        <p class="description">Turn this setting on if you want the overlay to keep on popping up, regardless of how long since the user closed it.</p>
    </td>
</tr>

<tr>
    <th>
        <label for="sw_overlay_repeat_duration">Repeat Timeout</label>
    </th>
    <td scope="row" align="left">
        <input 
            id="sw_overlay_repeat_duration"
            class="regular-text"
             name="sw_overlay_repeat_duration" type="text" value="<?php echo $repeatDuration;?>" />
		<p class="description">If the above is disabled, this will define (in minutes) how long until the popup is shown again.</p>
    </td>
</tr>

<tr>
	<th>
		<label for="sw_overlay_link">Overlay Link</label>
	</th>
	<td scope="row" align="left">
		<input
			id="sw_overlay_link"
			class="regular-text"
			name="sw_overlay_link" type="text" value="<?php echo esc_html($link);?>" />
	</td>
</tr>

<tr>
	<th>
		<label for="sw_overlay_image">Overlay Image URL</label>
	</th>
	<td scope="row" align="left">
		<input
			id="sw_overlay_image"
			class="regular-text"
			name="sw_overlay_image" type="text" value="<?php echo esc_html($image);?>" />
	</td>
</tr>


<tr>
    <th>
        <label for="sw_overlay_close_text">Close Link Text</label>
    </th>
    <td scope="row" align="left">
        <input id="sw_overlay_close_text" name="sw_overlay_close_text"
            class="regular-text"
            type="text" value="<?php echo esc_html($closeText);?>" />
    </td>
</tr>

</tbody>
</table>
 <input type="hidden" name="action" value="update" />
 <input type="hidden" name="page_options" value="sw_overlay_close_text,sw_overlay_show_always,
 													sw_overlay_image,sw_overlay_link,sw_overlay_active,sw_overlay_repeat_duration" />
 <input type="submit" name="Submit" value="Update" /></form></div>
<pre>
