<?php 
/**
 * @category   Vvasiloud
 * @package    Vvasiloud_PasswordAdapter
 * @author     Vasilis Vasiloudis <vvasiloud@gmail.com>
 * @website    http://vvasiloud.github.io
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */
namespace Vvasiloud\PasswordAdapter\Plugin\Magento\Customer\Model;
use Magento\Customer\Model\CustomerRegistry;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Encryption\EncryptorInterface as Encryptor;
use Magento\Framework\Exception\InvalidEmailOrPasswordException;
 
class AccountManagement {

	private $customerRegistry;
	private $customerRepository;
	private $dataHelper;
	private $encryptor;

   public function __construct(
        CustomerRegistry $customerRegistry,
        CustomerRepositoryInterface $customerRepository,
		Encryptor $encryptor,
		\Vvasiloud\PasswordAdapter\Helper\Data $dataHelper

    ) {
        $this->customerRegistry = $customerRegistry;
        $this->customerRepository = $customerRepository;
		$this->encryptor = $encryptor;
		$this->dataHelper = $dataHelper;
    }
	
	public function beforeAuthenticate(
		\Magento\Customer\Model\AccountManagement $subject,
		$username,
		$password
	){
		
		if($this->dataHelper->isEnabled()){
			$this->_authenticatePasswordRequest($username, $password);
		}
		
	}
	
	private function _authenticatePasswordRequest($username,$password){
			    
        try {
            $customer = $this->customerRepository->get($username);
        } catch (NoSuchEntityException $e) {
            throw new InvalidEmailOrPasswordException(__('Invalid login or password.'));
        }
		$paIsPasswordPatched = $customer->getCustomAttribute('pa_is_password_patched');
		$paMd5Hash = $customer->getCustomAttribute('pa_md5_hash');		
		
		if ( ($paIsPasswordPatched  && $paMd5Hash ) && ($paIsPasswordPatched->getValue() == '0'  && $paMd5Hash->getValue() != '')){
			if ($this->_authenticateMd5Password($customer, $password)){			
				$customer->setCustomAttribute('pa_is_password_patched', 1);
				$this->customerRegistry->retrieveSecureData($customer->getId())->setPasswordHash($this->createPasswordHash($password));
				$this->customerRepository->save($customer);
			}else{
				throw new InvalidEmailOrPasswordException(__('Invalid login or password.'));
			}
		} 
	}
	
    private function _authenticateMd5Password($customer,$password){
        if ($customer->getCustomAttribute('pa_md5_hash')->getValue() === md5($password)){
            return true;
        }
        return false;
    }
	
	protected function createPasswordHash($password)
    {
        return $this->encryptor->getHash($password, true);
    }
}
