<?php

namespace Drupal\payroll_reminder\Commands;

use DateTime;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\payroll_reminder\Service\BonusPayDateService;
use Drupal\payroll_reminder\Service\CsvService;
use Drupal\payroll_reminder\Service\MonthlyPayDateService;
use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class PayrollReminderCommands extends DrushCommands {

  use StringTranslationTrait;

  /**
   * The monthly pay date service.
   *
   * @var \Drupal\payroll_reminder\Service\MonthlyPayDateService
   */
  private $monthlyPayDate;

  /**
   * The bonus pay date service.
   *
   * @var \Drupal\payroll_reminder\Service\BonusPayDateService
   */
  private $bonusPayDate;

  /**
   * The CSV custom service.
   *
   * @var \Drupal\payroll_reminder\Service\CsvService
   */
  private $csv;

  /**
   * Constructor for PayrollReminderCommands.
   */
  public function __construct(
    MonthlyPayDateService $monthly_pay_date,
    BonusPayDateService $bonus_pay_date,
    CsvService $csv
  ) {
    parent::__construct();
    $this->monthlyPayDate = $monthly_pay_date;
    $this->bonusPayDate = $bonus_pay_date;
    $this->csv = $csv;
  }

  /**
   * Export payroll reminder to csv.
   *
   * @param string $file_name
   *   The csv file name.
   *
   * @usage payroll_reminder:export export.csv
   *
   * @command payroll_reminder:export
   * @alias pr-export
   */
  public function export(string $file_name = 'reminder.csv') {
    $records[0] = [
      $this->t('Month'),
      $this->t('Salary date'),
      $this->t('Bonus date'),
    ];
    for ($i = (int) date('m'); $i <= 12; $i++) {
      $records[] = [
        DateTime::createFromFormat('!m', $i)->format('F'),
        $this->monthlyPayDate->getPayDate($i, date('Y')),
        $this->bonusPayDate->getPayDate($i, date('Y')),
      ];
    }

    $this->csv->exportToCsv($file_name, $records);

    $this->logger()->success($this->t('Reminder exported to /CSV/@file_name', [
      '@file_name' => $file_name,
    ]));
  }

}
