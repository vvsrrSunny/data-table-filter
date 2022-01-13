<?php

uses(Tests\TestCase::class)->in('Feature');
uses(Tests\TestCase::class)->in('Unit');

uses(Illuminate\Foundation\Testing\RefreshDatabase::class)->in('Feature');
uses(Illuminate\Foundation\Testing\DatabaseMigrations::class)->in('Unit');
