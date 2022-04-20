<?php

namespace Drupal\Tests\payroll_reminder\Unit;

use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\payroll_reminder\PayDateInterface;
use Drupal\payroll_reminder\Service\CsvService;
use Drupal\Tests\BrowserTestBase;

class CsvServiceTest extends BrowserTestBase{

  /**
   * {@inheritdoc }}
   */
  protected static $modules = ['payroll_reminder'];

  /**
   * {@inheritdoc }}
   */
  protected $defaultTheme = 'seven';

  /**
   * The bonus pay date service.
   *
   * @var \Drupal\payroll_reminder\Service\CsvService
   */
  protected $csv;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->csv = $this->container->get('payroll_reminder.csv');
  }

  public function testExportToCsv() {
    $file_name = 'unit_test.csv';
    $data = [
      ['cell 11, cell 12'],
      ['cell 21, cell 22'],
    ];
    $this->csv->exportToCsv($file_name, $data);

    $file = fopen(CsvService::PREFIX_PATH . $file_name, "r");
    $result = [];
    while (($line = fgetcsv($file)) !== FALSE) {
      $result[] = $line;
    }
    fclose($file);

    $this->assertCount(2, $result);
  }


}
