<div class="cities form">
<?php echo $this->Form->create('City'); ?>
	<fieldset>
		<legend><?php echo __('Add City'); ?></legend>
	<?php
		echo $this->Form->input('country_name');
		echo $this->Form->input('country_code');
		echo $this->Form->input('lat');
		echo $this->Form->input('lng');
		echo $this->Form->input('name');
		echo $this->Form->input('fcode');
		echo $this->Form->input('geoname_id');
		echo $this->Form->input('admin_name');
		echo $this->Form->input('population');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Mayors'), array('controller' => 'mayors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mayor'), array('controller' => 'mayors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
