<?php

add_action ('widgets_init', 'bps_widget_init');
function bps_widget_init ()
{
	register_widget ('bps_widget');
}

class bps_widget extends WP_Widget
{
	function __construct ()
	{
		$widget_ops = array ('description' => __('A Profile Search form.', 'bp-profile-search'));
		parent::__construct ('bps_widget', __('Profile Search', 'bp-profile-search'), $widget_ops);
	}

	function widget ($args, $instance)
	{
		extract ($args);
		$title = apply_filters ('widget_title', $instance['title']);
		$form = $instance['form'];
		$template = isset ($instance['template'])? $instance['template']: '';

		echo $before_widget;
		if ($title)
			echo $before_title. $title. $after_title;
		bps_display_form ($form, $template, 'widget');
		echo $after_widget;
	}

	function update ($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['form'] = $new_instance['form'];
		$instance['template'] = $new_instance['template'];
		return $instance;
	}

	function form ($instance)
	{
		$title = isset ($instance['title'])? $instance['title']: '';
		$form = isset ($instance['form'])? $instance['form']: '';
		$template = isset ($instance['template'])? $instance['template']: '';
?>
	<p>
		<label for="<?php echo $this->get_field_id ('title'); ?>"><?php _e('Title:', 'bp-profile-search'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id ('title'); ?>" name="<?php echo $this->get_field_name ('title'); ?>" type="text" value="<?php echo esc_attr ($title); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id ('form'); ?>"><?php _e('Form:', 'bp-profile-search'); ?></label>
<?php
		$posts = get_posts (array ('post_type' => 'bps_form', 'orderby' => 'ID', 'order' => 'ASC', 'nopaging' => true));
		if (count ($posts))
		{
			echo "<select class='widefat' id='{$this->get_field_id ('form')}' name='{$this->get_field_name ('form')}'>";
			foreach ($posts as $post)
			{
				$id = $post->ID;
				$name = !empty ($post->post_title)? $post->post_title: __('(no title)');
				echo "<option value='$id'";
				if ($id == $form)  echo " selected='selected'";
				echo ">$name &nbsp;</option>\n";
			}
			echo "</select>";
		}
		else
		{
			echo '<br/>';
			_e('You have not created any form yet.', 'bp-profile-search');
		}
?>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id ('template'); ?>"><?php _e('Template:', 'bp-profile-search'); ?></label>
<?php
		$templates = bps_templates ();
		echo "<select class='widefat' id='{$this->get_field_id ('template')}' name='{$this->get_field_name ('template')}'>";
		foreach ($templates as $option)
		{
			echo "<option value='$option'";
			if ($option == $template)  echo " selected='selected'";
			echo ">$option &nbsp;</option>\n";
		}
		echo "</select>";
?>
	</p>
<?php
	}
}
