<?php

namespace Drupal\payroll_reminder;

/**
 * Provides a pay date interface.
 *
 * @package Drupal\payroll_reminder
 */
interface PayDateInterface {

  // Const PAYROLL_DATE_FORMAT = 'payroll';.
  const PAYROLL_DATE_FORMAT = 'd/m/Y';

  /**
   * Get the pay date for a month.
   *
   * @param int $month
   *   The month to get the pay date for.
   * @param int $year
   *   The year to get the pay date for.
   *
   * @return string
   *   The pay date.
   */
  public function getPayDate(int $month, int $year): string;

}
