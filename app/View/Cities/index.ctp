<?php
if (count($cities)) {
    ?>
    <div class="marco form">
        <h1><?php echo __('Most popular cities') ?></h1>

            <table cellpadding="0" cellspacing="0" class="tQuestion">
                <tr>
                    <th><?php echo __('Country')?></th>
                    <th><?php echo __('Name')?></th>
                    <th><?php echo __('Admin name')?></th>
                    <th><?php echo __('Populaton')?></th>
                    <th><?php echo __('Questions')?></th>
                </tr>
                <?php foreach ($cities as $city):?>
                <tr>
                    <td><?php echo h($city['City']['country_name']); ?></td>
                    <td><?php echo $this->Html->link(h($city['City']['name']),'/cities/' . $city['City']['name']); ?></td>
                    <td><?php echo h($city['City']['admin_name']); ?></td>
                    <td><?php echo h($city['City']['population']); ?></td>
                    <td><?php echo h($city[0]['num']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

    </div>

    <?php
}
?>