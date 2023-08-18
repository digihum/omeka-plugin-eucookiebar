<p>This plugin uses the <a href="https://orestbida.com/demo-projects/cookieconsent/"  target="_blank">Cookie Consent</a> library. 
The configuration options below are a subset of availalble options to customse the appearance of the modals. 
To have complete customisation of the cookie consent, create your own init file and place it at 
'<?php echo Theme::getCurrentThemeName('public') ?>/javascripts/cookieconsent-init.js'.</p>


<?php

// Configuration form

$fields = array(
	array(
		'label' => 'Title',
		'description' => 'The message displayed in the cookie bar.',
		'name' => 'cookie_title',
		'required' => true,
		'group' => 'main'
	),
	array(
		'label' => 'Description',
		'description' => 'A description to be displayed below the title. Required.',
		'name' => 'cookie_description',
		'required' => true,
		'group' => 'main'
	),
	array(
		'label' => 'More information',
		'description' => 'A sentence for more information (can contain html). Required.',
		'name' => 'cookie_more_information',
		'required' => true,
		'group' => 'main'
	),
	array(
		'label' => 'Google Analytics Identifier',
		'description' => 'An identifier for Google Analytics (not the script itself)',
		'name' => 'cookie_analytics',
		'required' => true,
		'group' => 'analytics'
	),
	array(
		'label' => 'Consent Layout',
		'description' => 'The layout of the consent modal. Can be "block", "classic", "edgeless", "wire" or "cloud".',
		'name' => 'cookie_consent_layout',
		'options' => ['block', 'classic', 'edgeless', 'wire', 'cloud'],
		'required' => false,
		'group' => 'consent'
	),
	array(
		'label' => 'Consent Position',
		'description' => 'The position of the consent modal. Can be "top", "bottom", "bottom-left" or "bottom-right".',
		'name' => 'cookie_consent_position',
		'options' => ['top', 'bottom', 'bottom-left', 'bottom-right'],
		'required' => false,
		'group' => 'consent'
	),
	array(
		'label' => 'Consent Transition',
		'description' => 'The transition of the consent modal. Can be "fade" or "slide".',
		'name' => 'cookie_consent_transition',
		'options' => ['fade', 'slide'],
		'required' => false,
		'group' => 'consent'
	),
	array(
		'label' => 'Consent Swap Buttons',
		'description' => 'Swap the buttons on the consent modal. Can be "true" or "false".',
		'name' => 'cookie_consent_swap_buttons',
		'options' => ['true', 'false'],
		'required' => false,
		'group' => 'consent'
	),
	array(
		'label' => 'Settings Title',
		'description' => 'The title for the settings modal. Can be blank.',
		'name' => 'cookie_settings_title',
		'required' => false,
		'group' => 'settings'
	),
	array(
		'label' => 'Settings Layout',
		'description' => 'The layout of the settings modal. Can be "block" or "bar".',
		'name' => 'cookie_settings_layout',
		'options' => ['block', 'bar'],
		'required' => false,
		'group' => 'settings'
	),
	array(
		'label' => 'Settings Position',
		'description' => 'The position of the settings modal. Can be "left" or "right".',
		'name' => 'cookie_settings_position',
		'options' => ['left', 'right'],
		'required' => false,
		'group' => 'settings'
	),
	array(
		'label' => 'Settings Transition',
		'description' => 'The transition of the settings modal. Can be "fade" or "slide".',
		'name' => 'cookie_settings_transition',
		'options' => ['fade', 'slide'],
		'required' => false,
		'group' => 'settings'
	)

);


foreach ($fields as $key => $row): ?>

<?php 
/* TODO: use checkboxes and toggles https://omeka.readthedocs.io/en/latest/Tutorials/bestPracticesPlugins.html#building-forms-in-admin */

// puts a horizontal rule between groups
if (isset($row['group']) && $row['group'] !== $fields[$key-1]['group']): ?>

	<h2><?php echo ucfirst($row['group']); ?> options</h2>
	<hr/>
<?php endif; ?>
<div class="field">
	<div id="<?php echo $row['name']; ?>-label" class="two columns alpha">
		<label for="<?php echo $row['name']; ?>" class="<?php if ($row['required'] === true){ echo "required"; } ?>"><?php echo $row['label']; ?></label>
	</div>
	<?php if (isset($row['options'])): ?>
		<div class="inputs five columns omega">
			<ul>
			<?php foreach ($row['options'] as $option): ?>
			
			<label for="<?php echo $row['name']; ?>" class="two columns alpha"><?php echo ucfirst($option)?></label>
				<input class="two columns omega" type="radio" name="<?php echo $row['name']; ?>" id="<?php echo $row['name']; ?>" value="<?php echo $option; ?>" <?php if (option($row['name']) === $option){ echo "checked"; } ?> />
			<br>
			<?php endforeach; ?>
			</ul>
			<?php else: ?>
		<div class="inputs five columns omega">
			<p class="explanation"><?php echo $row['description']; ?></p>
			<input type="<?php echo (isset($row['password']) && $row['password'] === true) ? 'password' : 'text'; ?>" name="<?php echo $row['name']; ?>" id="<?php echo $row['name']; ?>" value="<?php echo option($row['name']); ?>" />
		</div>
	<?php endif; ?>
</div>



<?php endforeach; ?>
