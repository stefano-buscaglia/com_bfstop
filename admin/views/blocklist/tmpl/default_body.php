<?php
defined('_JEXEC') or die('Restricted Access');
foreach ($this->items as $i => $item): ?>
<tr>
	<td><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
	<td><?php echo $item->id; ?></td>
	<td><?php echo $item->ipaddress; ?></td>
	<td><?php echo $item->crdate; ?></td>
	<td><?php echo $this->convertDurationToReadable($item->duration); ?></td>
	<td><?php echo $this->getBlockedState($item); ?></td>
</tr>
<?php endforeach;
