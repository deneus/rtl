<?php

namespace Drupal\Tests\payroll_reminder\Unit;

use Drupal\Tests\BrowserTestBase;

class BonusPayDateServiceTest extends BrowserTestBase{

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
   * @var \Drupal\payroll_reminder\Service\BonusPayDateService
   */
  protected $bonusPayDate;

  /**
   * The year to test with.
   *
   * @var int
   */
  private $year;


  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->bonusPayDate = $this->container->get('payroll_reminder.bonus_pay_date');

    // I probably would have used 2100 here, but 2023 is far away enough.
    $this->year = 2023;
  }

  public function testPastGetPayDate() {
    $value = $this->bonusPayDate->getPayDate(4, 2020);
    $this->assertEquals('-', $value);
  }

  public function testFifteenthOfMonthPayment() {
    $value = $this->bonusPayDate->getPayDate(2, $this->year);
    $this->assertEquals('15/02/2023', $value);
  }

  public function testNotFifteenthOfMonthPayment() {
    $value = $this->bonusPayDate->getPayDate(1, $this->year);
    $this->assertEquals('18/01/2023', $value);
  }

}
