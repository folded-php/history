<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\addRequestedUrlToHistory")) {
    /**
     * Add the current browsed URL to the history.
     *
     * @since 0.1.0
     *
     * @example
     * addRequestedUrlToHistory();
     */
    function addRequestedUrlToHistory(): void
    {
        History::addRequestedUrl();
    }
}
