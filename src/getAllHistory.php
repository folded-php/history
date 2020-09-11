<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("getAllHistory")) {
    /**
     * Get all the URLs stored in the history.
     *
     * @since 0.1.0
     *
     * @example
     * $urls = getAllHistory();
     *
     * foreach ($urls as $url) {
     *  echo $url;
     * }
     */
    function getAllHistory(): array
    {
        return History::getAll();
    }
}
