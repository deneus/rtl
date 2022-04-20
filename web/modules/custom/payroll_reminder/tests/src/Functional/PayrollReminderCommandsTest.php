<?php

namespace Drupal\Tests\payroll_reminder\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;
use Drush\TestTraits\DrushTestTrait;

/**
 * Simple test to ensure that main page loads with module enabled.
 *
 * @group payroll_reminder
 */
class PayrollReminderCommandsTest extends BrowserTestBase {

  use DrushTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['payroll_reminder'];


  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'seven';


  public function testCommands() {
    $file_name = 'export_test.csv';
    $this->drush('payroll_reminder:export', [$file_name]);
    $messages = $this->getErrorOutput();
    $this->assertStringContainsString('Reminder exported', $messages);
    $this->assertStringContainsString($file_name, $file_name);
  }

}
