<?php
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class bfstopViewblocklist extends JViewLegacy
{
	function display($tpl = null) {
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$state            = $this->get('State');
		$this->sortColumn = $state->get('list.ordering');
		$this->sortDirection = $state->get('list.direction');
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		$this->addToolBar();
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_bfstop.sys', JPATH_ADMINISTRATOR);
		parent::display($tpl);
	}

	function getBlockedState($item)
	{
		if ($item->unblocked != null) {
			return JText::sprintf('UNBLOCKED_STATE', $item->unblocked);
		} else {
			if ($item->duration == 0) {
				return JText::_('BLOCKED_PERMANENTLY');
			} else {
				$blockedUntil = strtotime($item->crdate);
				$blockedUntil += $item->duration*60;
				$strDate = date('Y-m-d H:i:s', $blockedUntil);
				return ($blockedUntil < time())
					? JText::sprintf('BLOCK_EXPIRED_AT', $strDate)
					: JText::sprintf('BLOCKED_UNTIL', $strDate);
			}
		}
	}

	function convertDurationToReadable($duration)
	{
		if ($duration == 0) {
			return JText::_('BLOCK_UNLIMITED');
		} else if ($duration >= 1 && $duration <= 59) {
			return JText::_('BLOCK_'.$duration.'MINUTES');
		} else if ($duration == 60) {
			return JText::_('BLOCK_1HOUR');
		} else {
			return JText::_('BLOCK_'.($duration/60).'HOURS');
		}
	}

	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_BFSTOP_HEADING_BLOCKLIST'), 'bfstop');
		JToolBarHelper::divider();
		// batch unblock would require rewrite of unblock method to check
		// for selected lines
		JToolBarHelper::custom('blocklist.unblock', 'unpublish.png', 'unpublish_f2.png', 'COM_BFSTOP_UNBLOCK', true);
		JToolBarHelper::editList('block.edit');
		JToolBarHelper::addNew('block.add');
	}
}
