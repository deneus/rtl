<?php

namespace Drupal\payroll_reminder\Service;

use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Logger\LoggerChannelFactory;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\payroll_reminder\Helper\PayrollDateHelper;
use Drupal\payroll_reminder\PayDateAbstract;

/**
 * Provides a bonus pay date service.
 *
 * @package Drupal\payroll_reminder\Service
 *
 * On the 15th of every month bonuses are paid for the previous month, unless
 * that day is a weekend. In that case, they are paid the first Wednesday after
 * the 15th.
 */
class BonusPayDateService extends PayDateAbstract {

  use StringTranslationTrait;

  /**
   * The logger channel.
   *
   * @var \Drupal\Core\Logger\LoggerChannel
   */
  private $logger;

  /**
   * BonusPayDateService constructor.
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
    $date = PayrollDateHelper::getFifteenthOfMonth($month, $year);

    if ($date < new DrupalDateTime('NOW')) {
      $this->logger->debug($this->t('The bonus pay date is already passed for this month.'));
      return '-';
    }

    if (PayrollDateHelper::isWeekend($date)) {
      $this->logger->debug($this->t('15th of month is a weekend date.'));
      $date = PayrollDateHelper::getNextWednesday($date);
    }

    return $this->formatDate($date);
  }

}
