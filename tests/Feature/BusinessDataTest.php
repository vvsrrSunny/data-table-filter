<?php

use App\Models\BusinessData;

it('can view the business offices dashboard', function () {
    test()->get(route('business.index'))
        ->assertStatus(200)
        ->assertViewIs('dashboard');
});

it('can get a listing of offices', function () {
    BusinessData::factory()->count(7)->create();

    test()
        ->getJson(route('business.index'))
        ->assertOk()
        ->assertJson([
            'total' => 7,
            'per_page' => 5,
        ]);
});
