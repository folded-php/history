<?php

declare(strict_types = 1);

use Folded\History;
use function Folded\getHistory;
use function Folded\addRequestedUrlToHistory;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

beforeEach(function (): void {
    History::clear();
});

it("should get the history", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    addRequestedUrlToHistory();

    expect(getHistory())->toBe("/");
});
