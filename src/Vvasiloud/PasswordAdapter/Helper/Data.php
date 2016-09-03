<?php
/**
 * A Magento 2 module named Vvasiloud/PasswordAdapter
 * Copyright (C) 2016  
 * 
 * This file is part of Vvasiloud/PasswordAdapter.
 * 
 * Vvasiloud/PasswordAdapter is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
namespace Vvasiloud\PasswordAdapter\Helper;

use Magento\Framework\Module\ModuleListInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	const XML_PATH_ENABLED	= 'general/enabled';
	
	
	/**
     * @var ModuleListInterface
     */
    protected $_moduleList;
	
	/**
     * @param \Magento\Framework\App\Helper\Context $context
	 * @param ModuleListInterface $moduleList
     */
	public function __construct(\Magento\Framework\App\Helper\Context $context, ModuleListInterface $moduleList
	) {
		$this->_moduleList              = $moduleList;
		parent::__construct($context);
	}

    /**
     * @param $xmlPath
     * @param string $section
     *
     * @return string
     */
    public function getConfigPath(
        $xmlPath,
        $section = 'vvasiloud_passwordadapter'
    ) {
        return $section . '/' . $xmlPath;
    }
	
	 /**
     * Check if enabled
     *
     * @return string|null
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            $this->getConfigPath(self::XML_PATH_ENABLED),
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
	
	 /**
     * Show Extensions Version
     *
     * @return string|null
     */	
    public function getExtensionVersion()
    {
        $moduleCode = 'Vvasiloud_PasswordAdapter';
        $moduleInfo = $this->_moduleList->getOne($moduleCode);
        return $moduleInfo['setup_version'];
    }	
}