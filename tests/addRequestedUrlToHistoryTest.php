<?php

declare(strict_types = 1);

use Folded\History;
use function Folded\getHistory;
use function Folded\addRequestedUrlToHistory;

beforeEach(function (): void {
    History::clear();
});

it("should add the requested url to the history", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    addRequestedUrlToHistory();

    expect(getHistory())->toBe("/");
});
