<?php

add_action ('wp', 'bps_set_cookie');
function bps_set_cookie ()
{
	if (isset ($_REQUEST['bp_profile_search']))
		setcookie ('bps_request', serialize ($_REQUEST), 0, COOKIEPATH);
	else if (isset ($_COOKIE['bps_request']))
		setcookie ('bps_request', '', 0, COOKIEPATH);
}

function bps_get_request ()
{
	$request = array ();
	if (isset ($_REQUEST['bp_profile_search']))
		$request = $_REQUEST;
	else if (isset ($_COOKIE['bps_request']) && defined ('DOING_AJAX'))
		$request = unserialize (stripslashes ($_COOKIE['bps_request']));

	return apply_filters ('bps_request', $request);
}

function bps_active_form ()
{
	$request = bps_get_request ();
	return isset ($request['bp_profile_search'])? $request['bp_profile_search']: false;
}

function bps_text_search ()
{
	$request = bps_get_request ();
	if (!isset ($request['text_search']))  return 'contains';

	$text_search = $request['text_search'];
	if ($text_search == 'EQUAL')  return '';
	if ($text_search == 'ISLIKE')  return 'like';
	return 'contains';
}

add_action ('bp_ajax_querystring', 'bps_filter_members', 99, 2);
function bps_filter_members ($qs, $object)
{
	if ($object != 'members')  return $qs;
	if (bps_active_form () === false)  return $qs;

	$results = bps_search ();
	if ($results['validated'])
	{
		$args = wp_parse_args ($qs);
		$users = $results['users'];

		if (isset ($args['include']))
		{
			$included = explode (',', $args['include']);
			$users = array_intersect ($users, $included);
			if (count ($users) == 0)  $users = array (0);
		}

		$users = apply_filters ('bps_filter_members', $users);
		$args['include'] = implode (',', $users);
		$qs = build_query ($args);
	}

	return $qs;
}

function bps_search ()
{
	$results = array ('users' => array (0), 'validated' => true);

	list ($x, $fields) = bps_get_fields ();
	foreach ($fields as $f)
	{
		if (!isset ($f->filter))  continue;

		do_action ('bps_before_search', $f);
		if (is_callable ($f->search))
			$found = call_user_func ($f->search, $f);
		else
			$found = apply_filters ('bps_field_query', array (), $f, $f->code, $f->value);

		do_action ('bps_after_search', $f, $found);
		$users = isset ($users)? array_intersect ($users, $found): $found;
		if (count ($users) == 0)  return $results;
	}

	if (isset ($users))
		$results['users'] = $users;
	else
		$results['validated'] = false;

	return $results;
}

function bps_esc_like ($text)
{
    return addcslashes ($text, '_%\\');
}
