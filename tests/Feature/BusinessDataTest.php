<?php

use App\Models\BusinessData;

test('can view the business offices dashboard', function () {
    $this->get(route('business.index'))
        ->assertStatus(200)
        ->assertViewIs('dashboard');
});

test('can get a listing of offices', function () {
    BusinessData::factory()->count(7)->create();

    $this->getJson(route('business.index'))
        ->assertOk()
        ->assertJson([
            'total' => 7,
            'per_page' => 5,
        ]);
});

test('can filter the business data table by name', function () {
    BusinessData::factory()->create(['name' => 'Perth Northbridge']);
    BusinessData::factory()->count(2)->create();

    // Can filter results
    $this->getJson(route('business.index', ['search' => 'Perth Northbridge']))
        ->assertOk()
        ->assertJson([
            'total' => 1,
            'data' => [
                [
                    'name' => 'Perth Northbridge'
                ]
            ]
        ]);

    // Works on a partial search
    $this->getJson(route('business.index', ['search' => 'Perth']))
        ->assertOk()
        ->assertJson([
            'total' => 1,
            'data' => [
                [
                    'name' => 'Perth Northbridge'
                ]
            ]
        ]);
});

test('can filter business data table by the number of offices', function () {
    BusinessData::factory()->create([
        'offices' => 5,
    ]);

    BusinessData::factory()->count(3)->create([
        'offices' => 10,
    ]);

    $this->getJson(route('business.index', ['offices' => 5]))
        ->assertOk()
        ->assertJson([
            'total' => 1,
            'data' => [
                [
                    'offices' => 5
                ]
            ]
        ]);

    $this->getJson(route('business.index', ['offices' => 10]))
        ->assertOk()
        ->assertJson([
            'total' => 3,
            'data' => [
                [
                    'offices' => 10
                ]
            ]
        ]);
});

test('can filter business data table by the number of tables', function () {
        BusinessData::factory()->create([
            'tables' => 5,
        ]);

        BusinessData::factory()->count(3)->create([
            'tables' => 10,
        ]);

        $this->getJson(route('business.index', ['tables' => 5]))
            ->assertOk()
            ->assertJson([
                'total' => 1,
                'data' => [
                    [
                        'tables' => 5
                    ]
                ]
            ]);

        $this->getJson(route('business.index', ['tables' => 10]))
            ->assertOk()
            ->assertJson([
                'total' => 3,
                'data' => [
                    [
                        'tables' => 10
                    ]
                ]
            ]);
});

test('validation of business data table inputs', function () {
        $this->getJson(route('business.index', [
            'search' => 'e&&**&',
            'offices' => 'A string',
            'tables' => 'A string',
        ]))
        ->assertStatus(422)
        ->assertJson([
            'errors' => [
                'offices' => ['The offices must be a number.'],
                'tables' => ['The tables must be a number.']
            ]
        ]);
});
