<div class="cities index">
	<h2><?php echo __('Cities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('country_name'); ?></th>
			<th><?php echo $this->Paginator->sort('lat'); ?></th>
			<th><?php echo $this->Paginator->sort('lng'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('admin_name'); ?></th>
			<th><?php echo $this->Paginator->sort('population'); ?></th>
	</tr>
	<?php
	foreach ($cities as $city): ?>
	<tr>
		<td><?php echo h($city['City']['country_name']); ?>&nbsp;</td>
		<td><?php echo h($city['City']['lat']); ?>&nbsp;</td>
		<td><?php echo h($city['City']['lng']); ?>&nbsp;</td>
		<td><?php echo h($city['City']['name']); ?>&nbsp;</td>
		<td><?php echo h($city['City']['admin_name']); ?>&nbsp;</td>
		<td><?php echo h($city['City']['population']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New City'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Mayors'), array('controller' => 'mayors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mayor'), array('controller' => 'mayors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
