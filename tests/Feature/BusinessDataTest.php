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
    $this
        ->getJson(route('business.index', ['search' => 'Perth Northbridge']))
        ->assertOk()
        ->assertJson([
            'total' => 1,
        ]);

    // Works on a partial search
    $this
        ->getJson(route('business.index', ['search' => 'Perth']))
        ->assertOk()
        ->assertJson([
            'total' => 1,
        ]);
});
