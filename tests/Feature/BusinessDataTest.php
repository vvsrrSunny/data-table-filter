<?php

use App\Models\BusinessData;
use Illuminate\Database\Eloquent\Factories\Sequence;

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

test('validation on square meter field\'s search range', function () {
    BusinessData::factory()->count(3)
        ->state(new Sequence(
            ['square_meters' => 150],
            ['square_meters' => 200],
            ['square_meters' => 500],
        ))->create();

    // asserting that the square meter's to value is required when square meter's from is provided
    $this->getJson(route('business.index', [
        'square_meters' => [
            'from' => 150
        ]
    ]))
        ->assertStatus(422)
        ->assertJson([
            'errors' => [
                'square_meters.to' => ['The square meters to field is required when square meters from is present.'],
            ],
        ]);

    // asserting that the square meter's from value is required when square meter's to is provided
    $this->getJson(route('business.index', [
        'square_meters' => [
            'to' => 150
        ]
    ]))
        ->assertStatus(422)
        ->assertJson([
            'errors' => [
                'square_meters.from' => ['The square meters from field is required when square meters to is present.'],
            ],
        ]);

    // asserting both the to and from in square meter must be number
    $this->getJson(route('business.index', [
        'square_meters' => [
            'from' => 'a string',
            'to' => 'a string',
        ]
    ]))
        ->assertStatus(422)
        ->assertJson([
            'errors' => [
                'square_meters.from' => ['The square meters from must be a number.'],
                'square_meters.to' => ['The square meters to must be a number.'],
            ],
        ]);

    // asserting that in range values must be logical
    $this->getJson(route('business.index', [
        'square_meters' => [
            'from' => 150,
            'to' => 100,
        ]
    ]))
        ->assertStatus(422)
        ->assertJson([
            'errors' => [
                'square_meters.to' => ['The square meters to must be greater than 150.'],
            ]
        ]);
});

test('can filter business data table based on the range of square meters', function () {
    BusinessData::factory()->count(3)
        ->state(new Sequence(
            ['square_meters' => 100],
            ['square_meters' => 250],
            ['square_meters' => 300],
        ))->create();

    $this->getJson(route('business.index', [
        'square_meters' => [
            'from' => 100,
            'to' => 300
        ]
    ]))
        ->assertOk()
        ->assertJson([
            'total' => 3,
        ]);

    $this->getJson(route('business.index', [
        'square_meters' => [
            'from' => 100,
            'to' => 155
        ]
    ]))
        ->assertOk()
        ->assertJson([
            'total' => 1,
        ]);

    $this->getJson(route('business.index', [
        'square_meters' => [
            'from' => 99,
            'to' => 255
        ]
    ]))
        ->assertOk()
        ->assertJson([
            'total' => 2,
        ]);
});

test('validation on price field\'s search range', function () {
    BusinessData::factory()->count(3)
        ->state(new Sequence(
            ['price' => 125],
            ['price' => 200],
            ['price' => 300],
        ))->create();

     // asserting that the price's to value is required when price's from is provided
    test()
        ->getJson(route('business.index', [
            'price' => [
                'from' => 125
            ]
        ]))
        ->assertStatus(422);

   // asserting that the price's from value is required when price's to is provided
    test()
        ->getJson(route('business.index', [
            'price' => [
                'to' => 125
            ]
        ]))
        ->assertStatus(422);

    // asserting both the to and from in price must be number
    test()
        ->getJson(route('business.index', [
            'price' => [
                'from' => 'a string',
                'to' => 'a string',
            ]
        ]))
        ->assertStatus(422);

    // asserting that in range values must be logical
    test()
        ->getJson(route('business.index', [
            'price' => [
                'from' => 125,
                'to' => 30
            ]
        ]))
        ->assertStatus(422);
});
