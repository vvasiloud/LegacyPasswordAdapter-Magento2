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

namespace Vvasiloud\PasswordAdapter\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\ModuleContextInterface; 
 
class InstallData implements InstallDataInterface {

	private $customerSetupFactory;

	public function __construct(
		CustomerSetupFactory $customerSetupFactory
	){
		$this->customerSetupFactory = $customerSetupFactory;
	}

	public function install(
		ModuleDataSetupInterface $setup,
		ModuleContextInterface $context
	){
		$customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

		$customerSetup->addAttribute('customer', 'pa_md5_hash', [
		    'type' => 'varchar',
		    'label' => 'MD5 password hash',
		    'input' => 'text',
		    'source' => '',
		    'required' => False,
		    'visible' => False,
		    'position' => 1000,
		    'system' => false,
		    'backend' => ''
		]);

		$customerSetup->addAttribute('customer', 'pa_is_password_patched', [
		    'type' => 'int',
		    'label' => 'Password Patched',
		    'input' => 'boolean',
		    'source' => '',
			'default' => 0,
		    'required' => False,
		    'visible' => False,
		    'position' => 1001,
		    'system' => false,
		    'backend' => ''
		]);
	}
}
