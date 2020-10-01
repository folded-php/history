<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("Folded\hasHistory")) {
    /**
     * Returns true if the index is present in the history.
     *
     * @param int $index The index to check in the history.
     *
     * @since 0.1.0
     *
     * @example
     *
     * if (hasHistory(-1)) {
     *  echo "history has index -1";
     * } else {
     *  echo "history does not have index -1";
     * }
     */
    function hasHistory(int $index): bool
    {
        return History::has($index);
    }
}
