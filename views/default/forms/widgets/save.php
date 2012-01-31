<?php 
/**
 * Elgg widget edit settings
 *
 * @uses $vars['widget']
 * @uses $vars['show_access']
 */

$widget = $vars['widget'];
$show_access = elgg_extract('show_access', $vars, true);
$widget_context = $widget->context;

$edit_view = "widgets/$widget->handler/edit";
$custom_form_section = elgg_view($edit_view, array('entity' => $widget));

$access = '';
if ($show_access) {
	$access = elgg_echo('access') . ': ' . elgg_view('input/access', array(
		'name' => 'params[access_id]',
		'value' => $widget->access_id,
	));
}

$yesno_options = array(
		"yes" => elgg_echo("option:yes"),
		"no" => elgg_echo("option:no")
);

$noyes_options = array_reverse($yesno_options, true);

$advanced = "<a rel='toggle' href='#widget-manager-widget-edit-advanced-" . $widget->getGUID() . "'>" . elgg_echo("widget_manager:widgets:edit:advanced") . "</a>";
$advanced .= "<div class='hidden' id='widget-manager-widget-edit-advanced-" . $widget->getGUID() . "'>";
$advanced .= "<fieldset>";

$advanced .= "<div>" . elgg_echo('widget_manager:widgets:edit:custom_title') . ": " . elgg_view('input/text', array('name' => 'params[widget_manager_custom_title]', 'value' => $widget->widget_manager_custom_title)) . "</div>";

if($widget_context == "index" || $widget_context == "groups" || elgg_in_context("default_widgets")){
	$advanced .= "<div>" . elgg_echo('widget_manager:widgets:edit:custom_url') . ": " . elgg_view('input/text', array('name' => 'params[widget_manager_custom_url]', 'value' => $widget->widget_manager_custom_url)) . "</div>";
}

if($widget_context == "index"){
	$advanced .= "<div>" . elgg_echo('widget_manager:widgets:edit:hide_header') . ": " . elgg_view('input/dropdown', array('name' => 'params[widget_manager_hide_header]', 'value' => $widget->widget_manager_hide_header, 'options_values' =>$noyes_options)) . "</div>";
	$advanced .= "<div>" . elgg_echo('widget_manager:widgets:edit:disable_widget_content_style') . ": " . elgg_view('input/dropdown', array('name' => 'params[widget_manager_disable_widget_content_style]', 'value' => $widget->widget_manager_disable_widget_content_style, 'options_values' => $noyes_options)) . "</div>";
	$advanced .= "<div>" . elgg_echo('widget_manager:widgets:edit:custom_class') . ": " . elgg_view('input/text', array('name' => 'params[widget_manager_custom_class]', 'value' => $widget->widget_manager_custom_class)) . "</div>";
}

$advanced .= "</fieldset>";
$advanced .= "</div>";

$hidden = elgg_view('input/hidden', array('name' => 'guid', 'value' => $widget->guid));
$submit = elgg_view('input/submit', array('value' => elgg_echo('save')));

$body = <<<___END
	$custom_form_section
	<div>
		$access
	</div>
	<div>
		$advanced
	</div>
	<div class="elgg-foot">
		$hidden
		$submit
	</div>
___END;

echo $body;