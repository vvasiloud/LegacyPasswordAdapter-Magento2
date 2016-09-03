Legacy Password Adapter
==================

Migrate passwords from legacy systems (current version support only MD5) to Magento 2. 

<h2>Install:</h2>
-Install by Composer : You can install the module by Composer by running the following comange in your server

composer require vvasiloud/passwordadapter

-Install by uploading files:

Download packed as ".zip" file and unzip the extension to {{MAGENTO-ROOT}}/app/code/

Alternatively clone this repository by the following commands:

Use SSH: 
```bash
git clone git@github.com:vvasiloud/LegacyPasswordAdapter-Magento2.git
```

Use HTTPS: 
```bash
git clone https://github.com/vvasiloud/LegacyPasswordAdapter-Magento2.git
```

After install run the following command using SSH:
```bash
php bin/magento setup:upgrade
```

How to use?
-------------

1. Enable the extension from the Store/Configuration/Vvasiloud and set it to Enabled.

2. Import Customers using Magento Customer import (Main files) by adding 2 extra fields: pa_is_password_patched (with value 0) and pa_md5_hash (with md5 password hashes from the old system)

3. Try to login with user details. 
When a user will try to login it will compare the plaintext password MD5 has with imported MD5 hash.
If the match it will transform plaintext to Magento 2 password hash. 

Magento 2 Password Hash
-------
1. Community edition (CE) uses MD5 with salt 

2. Enterprise edition (EE) uses sha256 with salt

Support
-------
If you encounter any problems or bugs, please create an issue on [GitHub](https://github.com/vvasiloud/LegacyPasswordAdapter-Magento2/issues).

Contribution
------------
Any contribution is highly welcome. To provide any code open a [pull request on GitHub](https://github.com/vvasiloud/LegacyPasswordAdapter-Magento2/pulls).

Licence
-------
[GNU General Public License](http://www.gnu.org/licenses/)

Copyright
---------
(c) 2016 vvasiloud
