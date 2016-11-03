<?php

function bps_fields_box ($post)
{
	$bps_options = bps_meta ($post->ID);

	list ($groups, $fields) = bps_get_fields ();
	echo '<script>var bps_groups = ['. json_encode ($groups). '];</script>';
?>

	<div id="field_box" class="field_box">
<?php

	foreach ($bps_options['field_name'] as $k => $id)
	{
		if (empty ($fields[$id]))  continue;

		$field = $fields[$id];
		$label = esc_attr ($bps_options['field_label'][$k]);
		$default = esc_attr ($field->name);
		$showlabel = empty ($label)? "placeholder=\"$default\"": "value=\"$label\"";
		$desc = esc_attr ($bps_options['field_desc'][$k]);
		$default = esc_attr ($field->description);
		$showdesc = empty ($desc)? "placeholder=\"$default\"": "value=\"$desc\"";
?>

		<p id="field_div<?php echo $k; ?>" class="sortable">
			<span>&nbsp;&Xi; </span>
<?php
			_bps_field_select ("bps_options[field_name][$k]", "field_name$k", $id);
?>
			<input type="text" name="bps_options[field_label][<?php echo $k; ?>]" id="field_label<?php echo $k; ?>" <?php echo $showlabel; ?> style="width: 16%" />
			<input type="text" name="bps_options[field_desc][<?php echo $k; ?>]" id="field_desc<?php echo $k; ?>" <?php echo $showdesc; ?> style="width: 32%" />
			<label><input type="checkbox" name="bps_options[field_range][<?php echo $k; ?>]" id="field_range<?php echo $k; ?>" value="<?php echo $k; ?>"<?php if (isset ($bps_options['field_range'][$k])) echo ' checked="checked"'; ?> /><?php _e('Range', 'bp-profile-search'); ?> </label>
			<a href="javascript:hide('field_div<?php echo $k; ?>')" class="delete">[x]</a>
		</p>
<?php
	}
?>
		<input type="hidden" id="field_next" value="<?php echo count ($bps_options['field_name']); ?>" />
	</div>
	<p><a href="javascript:add_field()"><?php _e('Add Field', 'bp-profile-search'); ?></a></p>
<?php
}

function _bps_field_select ($name, $id, $value)
{
	list ($groups, $x) = bps_get_fields ();

	echo "<select name='$name' id='$id'>\n";
	foreach ($groups as $group => $fields)
	{
		$group = esc_attr ($group);
		echo "<optgroup label='$group'>\n";
		foreach ($fields as $field)
		{
			$selected = $field['id'] == $value? " selected='selected'": '';
			echo "<option value='$field[id]'$selected>$field[name]</option>\n";
		}
		echo "</optgroup>\n";
	}
	echo "</select>\n";

	return true;
}

function bps_attributes ($post)
{
	$options = bps_meta ($post->ID);
?>
	<p><strong><?php _e('Form Method', 'bp-profile-search'); ?></strong></p>
	<label class="screen-reader-text" for="method"><?php _e('Form Method', 'bp-profile-search'); ?></label>
	<select name="options[method]" id="method">
		<option value='POST' <?php selected ($options['method'], 'POST'); ?>><?php _e('POST', 'bp-profile-search'); ?></option>
		<option value='GET' <?php selected ($options['method'], 'GET'); ?>><?php _e('GET', 'bp-profile-search'); ?></option>
	</select>

	<p><strong><?php _e('Form Action (Results Directory)', 'bp-profile-search'); ?></strong></p>
	<label class="screen-reader-text" for="action"><?php _e('Form Action (Results Directory)', 'bp-profile-search'); ?></label>
	<select name="options[action]" id="action">
<?php
	$dirs = _bps_directories ();
	foreach ($dirs as $id => $title)
	{
?>
		<option value='<?php echo $id; ?>' <?php selected ($options['action'], $id); ?>><?php echo esc_attr ($title); ?></option>
<?php
	}
?>
	</select>

	<p><?php _e('Need help? Use the Help tab in the upper right of your screen.'); ?></p>
<?php
}

function _bps_directories ()
{
	$dirs = array ();

	if (function_exists ('bp_core_get_directory_page_ids'))
	{
		$bp_pages = bp_core_get_directory_page_ids ();
		$members = $bp_pages['members'];
		$dirs[$members] = get_the_title ($members);
	}

	if (!shortcode_exists ('bps_directory'))  return $dirs;

	$pages = get_pages ();
	foreach ($pages as $page)
		if (has_shortcode ($page->post_content, 'bps_directory'))  $dirs[$page->ID] = $page->post_title;

	return $dirs;
}

function bps_directory ($post)
{
	$options = bps_meta ($post->ID);
?>
	<p><strong><?php _e('Add to Directory', 'bp-profile-search'); ?></strong></p>
	<label class="screen-reader-text" for="directory"><?php _e('Add to Directory', 'bp-profile-search'); ?></label>
	<select name="options[directory]" id="directory">
		<option value='Yes' <?php selected ($options['directory'], 'Yes'); ?>><?php _e('Yes', 'bp-profile-search'); ?></option>
		<option value='No' <?php selected ($options['directory'], 'No'); ?>><?php _e('No', 'bp-profile-search'); ?></option>
	</select>

	<p><strong><?php _e('Form Template', 'bp-profile-search'); ?></strong></p>
	<select name="options[template]" id="template">
<?php
	$templates =  bps_templates ();
	foreach ($templates as $template)
	{
?>
		<option value='<?php echo $template; ?>' <?php selected ($options['template'], $template); ?>><?php echo $template; ?></option>
<?php
	}
?>
	</select>

	<p><strong><?php _e('Form Header', 'bp-profile-search'); ?></strong></p>
	<label class="screen-reader-text" for="header"><?php _e('Form Header', 'bp-profile-search'); ?></label>
	<textarea name="options[header]" id="header" class="large-text code" rows="4"><?php echo $options['header']; ?></textarea>

	<p><strong><?php _e('Toggle Form', 'bp-profile-search'); ?></strong></p>
	<label class="screen-reader-text" for="toggle"><?php _e('Toggle Form', 'bp-profile-search'); ?></label>
	<select name="options[toggle]" id="toggle">
		<option value='Enabled' <?php selected ($options['toggle'], 'Enabled'); ?>><?php _e('Enabled', 'bp-profile-search'); ?></option>
		<option value='Disabled' <?php selected ($options['toggle'], 'Disabled'); ?>><?php _e('Disabled', 'bp-profile-search'); ?></option>
	</select>

	<p><strong><?php _e('Toggle Form Button', 'bp-profile-search'); ?></strong></p>
	<label class="screen-reader-text" for="button"><?php _e('Toggle Form Button', 'bp-profile-search'); ?></label>
	<input type="text" name="options[button]" id="button" value="<?php echo esc_attr ($options['button']); ?>" />
<?php
}

function bps_searchmode ($post)
{
	$options = bps_meta ($post->ID);
?>
	<select name="options[searchmode]" id="searchmode">
		<option value='LIKE' <?php selected ($options['searchmode'], 'LIKE'); ?>><?php _e('contains', 'bp-profile-search'); ?></option>
		<option value='EQUAL' <?php selected ($options['searchmode'], 'EQUAL'); ?>><?php _e('is', 'bp-profile-search'); ?></option>
		<option value='ISLIKE' <?php selected ($options['searchmode'], 'ISLIKE'); ?>><?php _e('is like', 'bp-profile-search'); ?></option>
	</select>
<?php
}

function bps_update_meta ($form)
{
	if (empty ($_POST['options']) && empty ($_POST['bps_options']))  return false;

	$meta = array ();
	$meta['field_name'] = array ();
	$meta['field_code'] = array ();
	$meta['field_label'] = array ();
	$meta['field_desc'] = array ();
	$meta['field_range'] = array ();

	list ($x, $fields) = bps_get_fields ();

	$j = 0;
	$posted = isset ($_POST['bps_options'])? $_POST['bps_options']: array ();
	if (isset ($posted['field_name']))  foreach ($posted['field_name'] as $k => $id)
	{
		if (empty ($fields[$id]))  continue;

		$f = $fields[$id];

		$meta['field_name'][$j] = $id;
		$meta['field_code'][$j] = $f->code;
		$meta['field_label'][$j] = stripslashes ($posted['field_label'][$k]);
		$meta['field_desc'][$j] = stripslashes ($posted['field_desc'][$k]);

		$range = isset ($posted['field_range'][$k]);
		$filter = $range? 'range': '';
		if (bps_validate_filter ($filter, $f))
			$meta['field_range'][$j] = $range;
		else
			$meta['field_range'][$j] = !$range;

		if ($meta['field_range'][$j] == false)  $meta['field_range'][$j] = null;

		bps_set_wpml ($form, $f->code, 'label', $meta['field_label'][$j]);
		bps_set_wpml ($form, $f->code, 'comment', $meta['field_desc'][$j]);
		$j = $j + 1;
	}

	foreach (array ('directory', 'template', 'header', 'toggle', 'button', 'method', 'action', 'searchmode') as $key)
		$meta[$key] = stripslashes ($_POST['options'][$key]);

	bps_set_wpml ($form, '-', 'header', $meta['header']);
	bps_set_wpml ($form, '-', 'toggle form', $meta['button']);

	update_post_meta ($form, 'bps_options', $meta);
	return true;
}
