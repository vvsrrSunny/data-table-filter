<?php


it('can view the business offices dashboard', function () {
    test()->get(route('business.index'))
        ->assertStatus(200)
        ->assertViewIs('dashboard');
});
