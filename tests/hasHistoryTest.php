<?php

declare(strict_types = 1);

use Folded\History;
use function Folded\addRequestedUrlToHistory;
use function Folded\hasHistory;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

beforeEach(function (): void {
    History::clear();
});

it("should return true if the history exists", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    addRequestedUrlToHistory();

    expect(hasHistory(0))->toBeTrue();
});
