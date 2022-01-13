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

    $this->getJson(route('offices.index', ['offices' => 5]))
        ->assertOk()
        ->assertJson([
            'total' => 2,
        ]);

    $this->getJson(route('offices.index', ['offices' => 2]))
        ->assertOk()
        ->assertJson([
            'total' => 1,
        ]);
});
