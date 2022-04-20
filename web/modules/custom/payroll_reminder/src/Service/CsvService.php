<?php

namespace Drupal\payroll_reminder\Service;

use Drupal\Core\Logger\LoggerChannelFactory;

/**
 * Provides a csv service.
 *
 * @package Drupal\payroll_reminder\Service
 */
class CsvService {

  const PREFIX_PATH = '../CSV/';

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
    LoggerChannelFactory $logger
  ) {
    $this->logger = $logger->get('payroll_reminder');
  }

  /**
   * Export to CSV.
   *
   * @param string $file_name
   *   The file name of the CSV.
   * @param array $records
   *   The array to store in the CSV file.
   *
   * @return void
   */
  public function exportToCsv(string $file_name, array $records): void {
    if (pathinfo($file_name, PATHINFO_EXTENSION) !== 'csv') {
      $file_name = $file_name . '.csv';
    }

    $fp = fopen(self::PREFIX_PATH . $file_name, 'w');

    foreach ($records as $record) {
      fputcsv($fp, $record, ';');
    }

    fclose($fp);
    $this->logger->debug('CSV file successfully created.');
  }

}
