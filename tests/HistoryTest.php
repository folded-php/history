<?php

declare(strict_types = 1);

use Folded\History;
use Folded\Exceptions\HistoryNotFoundException;

session_start();

beforeEach(function (): void {
    History::clear();
});

it("should add GET URL to the history", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    History::addRequestedUrl();

    $histories = History::getAll();

    expect($histories[0])->toBe("/");
});

it("should not add POST URL to the history", function (): void {
    $_SERVER["REQUEST_METHOD"] = "POST";
    $_SERVER["REQUEST_URI"] = "/";

    History::addRequestedUrl();

    $histories = History::getAll();

    expect($histories)->toHaveCount(0);
});

it("should add multiple GET URLs to the history", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    History::addRequestedUrl();

    $_SERVER["REQUEST_URI"] = "/about";

    History::addRequestedUrl();

    $histories = History::getAll();

    expect($histories)->toBe(["/", "/about"]);
});

it("should not add duplicates GET URLs to the history", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    History::addRequestedUrl();
    History::addRequestedUrl();

    $histories = History::getAll();

    expect($histories)->toBe(["/"]);
});

it("should return false if there is no history at the specific index", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    History::addRequestedUrl();

    expect(History::has(-1))->toBeFalse();
});

it("should return true if the history listened something before", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    History::addRequestedUrl();

    $_SERVER["REQUEST_URI"] = "/about";

    History::addRequestedUrl();

    expect(History::has(-1))->toBeTrue();
});

it("should throw an exception if the history is not found at the index", function (): void {
    $this->expectException(HistoryNotFoundException::class);

    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_METHOD"] = "/";

    History::addRequestedUrl();

    expect(History::get(-1));
});

it("should set the index in the exception if the history is not found", function (): void {
    $index = -1;

    try {
        History::get($index);
    } catch (HistoryNotFoundException $exception) {
        expect($exception->getIndex())->toBe($index);
    }
});

it("should return the history if the index has the history", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    History::addRequestedUrl();

    $_SERVER["REQUEST_URI"] = "/about";

    History::addRequestedUrl();

    expect(History::get(-1))->tobe("/");
});

it("should return the last history by default", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    History::addRequestedUrl();

    $_SERVER["REQUEST_URI"] = "/about";

    History::addRequestedUrl();

    expect(History::get())->toBe("/about");
});
