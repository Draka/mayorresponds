<div class="cities view">
<h2><?php  echo __('City'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($city['City']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($city['City']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($city['City']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country Name'); ?></dt>
		<dd>
			<?php echo h($city['City']['country_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country Code'); ?></dt>
		<dd>
			<?php echo h($city['City']['country_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lat'); ?></dt>
		<dd>
			<?php echo h($city['City']['lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lng'); ?></dt>
		<dd>
			<?php echo h($city['City']['lng']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($city['City']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fcode'); ?></dt>
		<dd>
			<?php echo h($city['City']['fcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Geoname Id'); ?></dt>
		<dd>
			<?php echo h($city['City']['geoname_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin Name'); ?></dt>
		<dd>
			<?php echo h($city['City']['admin_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Population'); ?></dt>
		<dd>
			<?php echo h($city['City']['population']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit City'), array('action' => 'edit', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete City'), array('action' => 'delete', $city['City']['id']), null, __('Are you sure you want to delete # %s?', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mayors'), array('controller' => 'mayors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mayor'), array('controller' => 'mayors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Mayors'); ?></h3>
	<?php if (!empty($city['Mayor'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Vote Plus'); ?></th>
		<th><?php echo __('Vote Minus'); ?></th>
		<th><?php echo __('Vote Abuse'); ?></th>
		<th><?php echo __('Trusted'); ?></th>
		<th><?php echo __('Confirm'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($city['Mayor'] as $mayor): ?>
		<tr>
			<td><?php echo $mayor['id']; ?></td>
			<td><?php echo $mayor['created']; ?></td>
			<td><?php echo $mayor['modified']; ?></td>
			<td><?php echo $mayor['name']; ?></td>
			<td><?php echo $mayor['city_id']; ?></td>
			<td><?php echo $mayor['user_id']; ?></td>
			<td><?php echo $mayor['vote_plus']; ?></td>
			<td><?php echo $mayor['vote_minus']; ?></td>
			<td><?php echo $mayor['vote_abuse']; ?></td>
			<td><?php echo $mayor['trusted']; ?></td>
			<td><?php echo $mayor['confirm']; ?></td>
			<td><?php echo $mayor['start']; ?></td>
			<td><?php echo $mayor['end']; ?></td>
			<td><?php echo $mayor['active']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'mayors', 'action' => 'view', $mayor['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'mayors', 'action' => 'edit', $mayor['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'mayors', 'action' => 'delete', $mayor['id']), null, __('Are you sure you want to delete # %s?', $mayor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mayor'), array('controller' => 'mayors', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Questions'); ?></h3>
	<?php if (!empty($city['Question'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifield'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('Questions'); ?></th>
		<th><?php echo __('Vote Plus'); ?></th>
		<th><?php echo __('Vote Minus'); ?></th>
		<th><?php echo __('Vote Abuse'); ?></th>
		<th><?php echo __('Trusted'); ?></th>
		<th><?php echo __('Confirm'); ?></th>
		<th><?php echo __('Actived'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($city['Question'] as $question): ?>
		<tr>
			<td><?php echo $question['id']; ?></td>
			<td><?php echo $question['created']; ?></td>
			<td><?php echo $question['modifield']; ?></td>
			<td><?php echo $question['user_id']; ?></td>
			<td><?php echo $question['city_id']; ?></td>
			<td><?php echo $question['questions']; ?></td>
			<td><?php echo $question['vote_plus']; ?></td>
			<td><?php echo $question['vote_minus']; ?></td>
			<td><?php echo $question['vote_abuse']; ?></td>
			<td><?php echo $question['trusted']; ?></td>
			<td><?php echo $question['confirm']; ?></td>
			<td><?php echo $question['actived']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'questions', 'action' => 'view', $question['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'questions', 'action' => 'edit', $question['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questions', 'action' => 'delete', $question['id']), null, __('Are you sure you want to delete # %s?', $question['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
