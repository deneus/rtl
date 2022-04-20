<?php

namespace Drupal\payroll_reminder;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Abstract class for pay date services.
 *
 * @package Drupal\payroll_reminder
 */
abstract class PayDateAbstract implements PayDateInterface {

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * Format the date to be displayed.
   *
   * @param \Drupal\Core\Datetime\DrupalDateTime $date
   *   The drupal date time object.
   *
   * @return string
   *   The date formatted as a string.
   */
  public function formatDate(DrupalDateTime $date): string {
    return $this->dateFormatter->format($date->getTimestamp(), 'custom', self::PAYROLL_DATE_FORMAT);
  }

}
