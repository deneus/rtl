<?php

namespace Drupal\payroll_reminder\Service;

use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Logger\LoggerChannelFactory;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\payroll_reminder\Helper\PayrollDateHelper;
use Drupal\payroll_reminder\PayDateAbstract;

/**
 * Provides a monthly pay date service.
 *
 * @package Drupal\payroll_reminder\Service
 *
 * The base salaries are paid on the last day of the month unless that day is a
 * Saturday or a Sunday (weekend).
 */
class MonthlyPayDateService extends PayDateAbstract {

  use StringTranslationTrait;

  /**
   * The logger channel.
   *
   * @var \Drupal\Core\Logger\LoggerChannel
   */
  private $logger;

  /**
   * CsvService constructor.
   */
  public function __construct(
    LoggerChannelFactory $logger,
    DateFormatter $date_formatter
  ) {
    $this->logger = $logger->get('payroll_reminder');
    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inerhitDoc}
   */
  public function getPayDate(int $month, int $year): string {
    $date = PayrollDateHelper::getLastDayOfMonth($month, $year);

    if (PayrollDateHelper::isWeekend($date)) {
      $this->logger->debug($this->t('Last day of month is a weekend date.'));
      $date = PayrollDateHelper::getPreviousFriday($date);
    }

    return $this->formatDate($date);
  }

}
