<?php

function bps_get_fields ()
{
	static $groups = array ();
	static $fields = array ();

	if (count ($groups))  return array ($groups, $fields);

	$field_list = apply_filters ('bps_fields_setup', array ());
	foreach ($field_list as $f)
	{
		$f = apply_filters ('bps_field_setup_data', $f);
		$groups[$f->group][] = array ('id' => $f->id, 'name' => $f->name);
		$fields[$f->id] = $f;
	}

	$request = bps_get_request ();
	bps_parse_request ($fields, $request);

	return array ($groups, $fields);
}

function bps_parse_request ($fields, $request)
{
	$j = 1;
	foreach ($request as $key => $value)
	{
		if ($value === '')  continue;

		$k = bps_match_key ($key, $fields);
		if ($k === false)  continue;

		$f = $fields[$k];
		$filter = substr ($key, strlen ($f->code));
		if (!bps_validate_filter ($filter, $f))  continue;

		switch ($filter)
		{
		case '':
			$f->filter = '';
			$f->value = $value;
			$f->values = (array)$f->value;
			$f->min = $f->max = '';
			break;
		case '_min':
			if (!is_numeric ($value))  break;
			$f->filter = 'range';
			$f->min = $value;
			if ($f->type == 'datebox')  $f->min = (int)$f->min;
			if ($f->type == 'birthdate')  $f->min = (int)$f->min;
			if (!isset ($f->max))  $f->max = '';
			$f->value = '';
			$f->values = array ();
			break;
		case '_max':
			if (!is_numeric ($value))  break;
			$f->filter = 'range';
			$f->max = $value;
			if ($f->type == 'datebox')  $f->max = (int)$f->max;
			if ($f->type == 'birthdate')  $f->max = (int)$f->max;
			if (!isset ($f->min))  $f->min = '';
			$f->value = '';
			$f->values = array ();
			break;
		case '_label':
			$f->label = stripslashes ($value);
			break;
		}

		if (!isset ($f->order))  $f->order = $j++;
	}

	return true;
}

function bps_match_key ($key, $fields)
{
	foreach ($fields as $k => $f)
		if ($key == $f->code || strpos ($key, $f->code. '_') === 0)  return $k;

	return false;
}

function bps_validate_filter ($filter, $f)
{
	if ($filter == '_min' || $filter == '_max')  $filter = 'range';
	if ($filter == '_label')  return true;

	if (!empty ($f->filters))  return in_array ($filter, $f->filters);

	$filters = bps_filtersXvalidation ($f);
	if (in_array ($filter, $filters))  return true;

	list ($x, $y, $range) = apply_filters ('bps_field_validation', array ('test', 'test', 'test'), $f);
	if ($range === true && $filter == 'range')  return true;
	if ($range === false && $filter == '')  return true;

	return false;
}

function bps_escaped_form_data ()
{
	list ($form, $location) = bps_template_args ();

	$meta = bps_meta ($form);
	list ($x, $fields) = bps_get_fields ();

	$F = new stdClass;
	$F->id = $form;
	$F->location = $location;
	$F->header = bps_wpml ($form, '-', 'header', $meta['header']);
	$F->toggle = ($meta['toggle'] == 'Enabled');
	$F->toggle_text = bps_wpml ($form, '-', 'toggle form', $meta['button']);
	if ($location == 'directory')
		$F->action = parse_url ($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	else
		$F->action = get_page_link (bps_wpml_id ($meta['action']));
	
	$F->method = $meta['method'];
	$F->fields = array ();

	foreach ($meta['field_name'] as $k => $id)
	{
		if (empty ($fields[$id]))  continue;

		$f = clone $fields[$id];
		if (isset ($meta['field_range'][$k]))  { $f->display = 'range'; $f->type = bps_displayXsearch_form ($f); }
		if (empty ($f->display))  $f->display = bps_displayXsearch_form ($f);

		$f->label = $f->name;
		$custom_label = bps_wpml ($form, $id, 'label', $meta['field_label'][$k]);
		if (!empty ($custom_label))  $f->label = $custom_label;

		$custom_desc = bps_wpml ($form, $id, 'comment', $meta['field_desc'][$k]);
		if ($custom_desc == '-')
			$f->description = '';
		else if (!empty ($custom_desc))
			$f->description = $custom_desc;

		if ($form != bps_active_form () || !isset ($f->filter))
		{
			$f->min = $f->max = $f->value = '';
			$f->values = array ();
		}

		$f = apply_filters ('bps_field_data_for_filters', $f);	// to be removed
		$f = apply_filters ('bps_field_data_for_search_form', $f);
		$F->fields[] = $f;

		if (!empty ($custom_label))
			$F->fields[] = bps_set_hidden_field ($f->code. '_label', $custom_label);
	}

	$F->fields[] = bps_set_hidden_field ('text_search', $meta['searchmode']);
//	$F->fields[] = bps_set_hidden_field ('bp_profile_search', $form);

	$F = apply_filters ('bps_search_form_data', $F);

	$F->toggle_text = esc_attr ($F->toggle_text);
	foreach ($F->fields as $f)
	{
		if (!is_array ($f->value))  $f->value = esc_attr (stripslashes ($f->value));
		if ($f->display == 'hidden')  continue;

		$f->label = esc_attr ($f->label);
		$f->description = esc_attr ($f->description);
		foreach ($f->values as $k => $value)  $f->values[$k] = esc_attr (stripslashes ($value));
		$options = array ();
		foreach ($f->options as $key => $label)  $options[esc_attr ($key)] = esc_attr ($label);
		$f->options = $options;
	}

	return $F;
}

function bps_escaped_filters_data ()
{
	$F = new stdClass;
	$F->action = parse_url ($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$F->fields = array ();

	list ($x, $fields) = bps_get_fields ();
	foreach ($fields as $field)
	{
		if (!isset ($field->filter))  continue;

		$f = clone $field;
		if ($f->filter == 'range')  $f->display = 'range';
		if (empty ($f->display))  $f->display = bps_displayXsearch_form ($f);

		if (empty ($f->label))  $f->label = $f->name;

		$f = apply_filters ('bps_field_data_for_filters', $f);
		$f = apply_filters ('bps_field_data_for_search_form', $f);	// to be removed
		$F->fields[] = $f;
	}

	$F = apply_filters ('bps_filters_data', $F);
	usort ($F->fields, 'bps_sort_fields');

	foreach ($F->fields as $f)
	{
		$f->label = esc_attr ($f->label);
		if (!is_array ($f->value))  $f->value = esc_attr (stripslashes ($f->value));
		foreach ($f->values as $k => $value)  $f->values[$k] = stripslashes ($value);

		foreach ($f->options as $key => $label)  $f->options[$key] = esc_attr ($label);
	}

	return $F;
}

function bps_set_hidden_field ($code, $value)
{
	$new = new stdClass;
	$new->display = 'hidden';
	$new->code = $code;
	$new->value = $value;

	return $new;
}

function bps_sort_fields ($a, $b)
{
	return ($a->order <= $b->order)? -1: 1;
}
