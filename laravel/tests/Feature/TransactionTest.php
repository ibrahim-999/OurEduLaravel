<?php

namespace tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    //    ./vendor/bin/phpunit --filter TransactionTest::testTransaction
    public function testTransaction() {
        $response = $this->json('GET', '/api/v1/transactions');
        $response->assertStatus(200);
    }
    public function testTransactionStatusCode() {
        $response = $this->json('GET', '/api/v1/status-code?statusCode=authorized');
        $response->assertStatus(200);
    }
    public function testTransactionCurrency() {
        $response = $this->json('GET', '/api/v1/transaction-currency?currency=EUR');
        $response->assertStatus(200);
    }
    public function testUserCurrency() {
        $response = $this->json('GET', '/api/v1/user-currency?currency=USD');
        $response->assertStatus(200);
    }
    public function testTransactionAmountRange() {
        $response = $this->json('GET', '/api/v1/amount-range?amounteMin=280&amounteMax=500');
        $response->assertStatus(200);
    }
    public function testTransactionDateRange() {
        $response = $this->json('GET', '/api/v1/date-range?startDate=2018-11-30&endDate=2021-09-07');
        $response->assertStatus(200);
    }
    public function testUserDate() {
        $response = $this->json('GET', '/api/v1/user-date?created_at=02/08/2020');
        $response->assertStatus(200);
    }
    public function testExample() {
        $this->assertTrue(true);
    }
}
