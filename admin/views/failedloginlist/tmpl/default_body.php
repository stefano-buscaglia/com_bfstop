<?php
defined('_JEXEC') or die('Restricted Access');
foreach ($this->items as $i => $item): ?>
<tr>
	<td><?php echo $item->id; ?></td>
	<td><?php echo $item->ipaddress; ?></td>
	<td><?php echo $item->logdate; ?></td>
	<td><?php echo $item->username; ?></td>
	<td><?php echo $item->error; ?></td>
	<td><?php echo $item->origin; /* TODO: get origin name */ ?></td>
</tr>
<?php endforeach;
