<?php

declare(strict_types = 1);

use Folded\History;
use function Folded\getAllHistory;
use function Folded\addRequestedUrlToHistory;

beforeEach(function (): void {
    History::clear();
});

it("should get all the history", function (): void {
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/";

    addRequestedUrlToHistory();

    $_SERVER["REQUEST_URI"] = "/about";

    addRequestedUrlToHistory();

    expect(getAllHistory())->toBe(["/", "/about"]);
});