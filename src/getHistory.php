<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("getHistory")) {
    /**
     * Get the URL in the history at a given index.
     * Let it empty to get the last URL in the history.
     *
     * @param int $index The index to get in the history. Indexes goes from 0 to negative.
     *
     * @throws Folded\Exceptions\HistoryNotFoundException If the index is not found.
     *
     * @since 0.1.0
     *
     * @example
     * echo getHistory(-1);
     */
    function getHistory(int $index = 0): string
    {
        return History::get($index);
    }
}
