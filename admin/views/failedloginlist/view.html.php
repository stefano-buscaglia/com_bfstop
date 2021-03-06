<?php
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class bfstopViewfailedloginlist extends JViewLegacy
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
		parent::display($tpl);
	}
	function getOriginName($origin)
	{
		return ($origin == 0) ? 'Frontend': 'Backend';
	}
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_BFSTOP_HEADING_FAILEDLOGINLIST'), 'bfstop');
	}
}
