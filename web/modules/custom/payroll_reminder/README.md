## Install the site
> composer install
>
> drush cim // to turn the custom module on.

##Run the command
> drush payroll_reminder:export <file_name>
>
The file will be saved in /CSV folder.

##Run the tests for the root directory
> .\vendor\bin\phpunit .\web\modules\custom\payroll_reminder\tests\src
