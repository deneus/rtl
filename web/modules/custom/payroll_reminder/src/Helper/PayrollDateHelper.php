<?php

namespace Drupal\payroll_reminder\Helper;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Provides a payroll date helper.
 *
 * @package Drupal\payroll_reminder\Helper
 */
final class PayrollDateHelper {

  /**
   * Verify if the date is a weekend day.
   *
   * @param \Drupal\Core\Datetime\DrupalDateTime $date
   *   The date to verify.
   *
   * @return bool
   *   The result of the test.
   */
  public static function isWeekend(DrupalDateTime $date): bool {
    return $date->format('N') >= 6;
  }

  /**
   * Get the last day of the month.
   *
   * @param int $month
   *   The month to check for.
   * @param int $year
   *   The month to check for.
   *
   * @return \Drupal\Core\Datetime\DrupalDateTime
   *   The last of the month.
   */
  public static function getFifteenthOfMonth(int $month, int $year): DrupalDateTime {
    $date = new DrupalDateTime("01-{$month}-{$year}");
    $date->modify('+14 days');

    return $date;
  }

  /**
   * Get next wednesday friday.
   *
   * @param \Drupal\Core\Datetime\DrupalDateTime $date
   *   The last day of the month.
   *
   * @return \Drupal\Core\Datetime\DrupalDateTime
   *   The next wednesday.
   */
  public static function getNextWednesday(DrupalDateTime $date) : DrupalDateTime {
    return $date->modify('next wednesday');
  }

  /**
   * Get the last day of the month.
   *
   * @param int $month
   *   The month to check for.
   * @param int $year
   *   The month to check for.
   *
   * @return \Drupal\Core\Datetime\DrupalDateTime
   *   The last of the month.
   */
  public static function getLastDayOfMonth(int $month, int $year): DrupalDateTime {
    $date = new DrupalDateTime("01-{$month}-{$year}");
    $date->modify('last day of this month');

    return $date;
  }

  /**
   * Get previous friday.
   *
   * @param \Drupal\Core\Datetime\DrupalDateTime $date
   *   The last day of the month.
   *
   * @return \Drupal\Core\Datetime\DrupalDateTime
   *   The previous friday.
   */
  public static function getPreviousFriday(DrupalDateTime $date) : DrupalDateTime {
    return $date->modify('previous friday');
  }

}
