<?php

add_action ('bp_before_directory_members_tabs', 'bps_add_form');
function bps_add_form ()
{
	global $post;

	$page = $post->ID;
	if ($page == 0)
	{
		$bp_pages = bp_core_get_directory_page_ids ();
		$page = $bp_pages['members'];
	}

	$page = bps_wpml_id ($page, 'default');
	$len = strlen ((string)$page);

	$args = array (
		'post_type' => 'bps_form',
		'orderby' => 'ID',
		'order' => 'ASC',
		'nopaging' => true,
		'meta_query' => array (
			array (
				'key' => 'bps_options',
				'value' => 's:9:"directory";s:3:"Yes";',
				'compare' => 'LIKE',
			),
			array (
				'key' => 'bps_options',
				'value' => "s:6:\"action\";s:$len:\"$page\";",
				'compare' => 'LIKE',
			),
		)
	);

	$args = apply_filters ('bps_form_order', $args);
	$posts = get_posts ($args);

	foreach ($posts as $post)
	{
		$meta = bps_meta ($post->ID);
		$template = $meta['template'];
		bps_display_form ($post->ID, $template, 'directory');
	}
}

add_action ('bps_display_form', 'bps_display_form', 10, 3);
function bps_display_form ($form, $template='', $location='')
{
	if (!function_exists ('bp_has_profile'))
	{
		printf ('<p class="bps_error">'. __('%s: The BuddyPress Extended Profiles component is not active.', 'bp-profile-search'). '</p>',
			'<strong>BP Profile Search '. BPS_VERSION. '</strong>');
		return false;
	}

	$meta = bps_meta ($form);
	if (empty ($meta['field_name']))
	{
		printf ('<p class="bps_error">'. __('%s: Form %d was not found, or has no fields.', 'bp-profile-search'). '</p>',
			'<strong>BP Profile Search '. BPS_VERSION. '</strong>', $form);
		return false;
	}

	if (empty ($template))  $template = bps_default_template ();
	bps_set_template_args ($form, $location);
	bps_call_template ($template);

	return true;
}

add_action ('bp_before_directory_members_content', 'bps_display_filters');
function bps_display_filters ()
{
	$form = bps_active_form ();
	if ($form === false)  return false;

	bps_set_template_args ($form, 'filters');
	bps_call_template ('members/bps-filters');

	return true;
}

add_shortcode ('bps_display', 'bps_show_form');
function bps_show_form ($attr, $content)
{
	ob_start ();

	if (isset ($attr['form']))
	{
		$template = isset ($attr['template'])? $attr['template']: '';
		bps_display_form ($attr['form'], $template, 'shortcode');
	}	

	return ob_get_clean ();
}

add_shortcode ('bps_directory', 'bps_show_directory');
function bps_show_directory ($attr, $content)
{
	ob_start ();

	if (!function_exists ('bp_has_profile'))
	{
		printf ('<p class="bps_error">'. __('%s: The BuddyPress Extended Profiles component is not active.', 'bp-profile-search'). '</p>',
			'<strong>BP Profile Search '. BPS_VERSION. '</strong>');
	}
	else
	{
		$template = isset ($attr['template'])? $attr['template']: 'members/index';

		$found = bp_get_template_part ($template);
		if (!$found)  printf ('<p class="bps_error">'. __('%s: The directory template "%s" was not found.', 'bp-profile-search'). '</p>',
			'<strong>BP Profile Search '. BPS_VERSION. '</strong>', $template);
	}

	return ob_get_clean ();
}

function bps_set_template_args ()
{
	$GLOBALS['bps_template_args'] = func_get_args ();
}

function bps_template_args ()
{
	return $GLOBALS['bps_template_args'];
}

function bps_call_template ($template)
{
	$version = BPS_VERSION;
	$args = implode (', ', bps_template_args ());

	echo "\n<!-- BP Profile Search $version $template ($args) -->\n";
	$found = bp_get_template_part ($template);
	if (!$found)  printf ('<p class="bps_error">'. __('%s: Template "%s" not found.', 'bp-profile-search'). '</p>',
		"<strong>BP Profile Search $version</strong>", $template);
	echo "\n<!-- BP Profile Search $version $template ($args) - end -->\n";

	return true;
}

function bps_set_wpml ($form, $code, $key, $value)
{
	if (!class_exists ('BPML_XProfile'))  return false;
	if (empty ($value))  return false;

	icl_register_string ('Profile Search', "form $form $code $key", $value);
}

function bps_wpml ($form, $id, $key, $value)
{
	if (!class_exists ('BPML_XProfile'))  return $value;
	if (empty ($value))  return $value;

	switch ($key)
	{
	case 'name':
		return icl_t ('Buddypress Multilingual', "profile field $id name", $value);
	case 'label':
		return icl_t ('Profile Search', "form $form field_$id label", $value);
	case 'description':
		return icl_t ('Buddypress Multilingual', "profile field $id description", $value);
	case 'comment':
		return icl_t ('Profile Search', "form $form field_$id comment", $value);
	case 'option':
		$option = bpml_sanitize_string_name ($value, 30);
		return icl_t ('Buddypress Multilingual', "profile field $id - option '$option' name", $value);
	case 'header':
		return icl_t ('Profile Search', "form $form - header", $value);
	case 'toggle form':
		return icl_t ('Profile Search', "form $form - toggle form", $value);
	}
}

function bps_wpml_id ($id, $lang='current')
{
	if (class_exists ('BPML_XProfile'))
	{
		global $sitepress;

		if ($lang == 'current')  $id = icl_object_id ($id, 'page', true);
		if ($lang == 'default')  $id = icl_object_id ($id, 'page', true, $sitepress->get_default_language ());
	}

	return $id;
}
