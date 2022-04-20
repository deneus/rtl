<?php

namespace Drupal\Tests\payroll_reminder\Unit;

use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\payroll_reminder\PayDateInterface;
use Drupal\Tests\BrowserTestBase;

class MonthlyPayDateServiceTest extends BrowserTestBase{

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
   * @var \Drupal\payroll_reminder\Service\MonthlyPayDateService
   */
  protected $monthlyPayDate;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->monthlyPayDate = $this->container->get('payroll_reminder.monthly_pay_date');
    $this->monthlyPayDate = $this->container->get('payroll_reminder.monthly_pay_date');
  }


  public function testLastDayOfMonthPayment() {
    $value = $this->monthlyPayDate->getPayDate(5, 2022);
    $this->assertEquals('31/05/2022', $value);
  }

  public function testNotLastDayOfMonthPayment() {
    $value = $this->monthlyPayDate->getPayDate(4, 2022);
    $this->assertEquals('29/04/2022', $value);
  }

}
