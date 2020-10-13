<?php

declare(strict_types = 1);

namespace Folded;

use Folded\Exceptions\HistoryNotFoundException;

/**
 * Represents the browser history, e.g. the URLs your user browse.
 *
 * @since 0.1.0
 */
final class History
{
    /**
     * The key in the $_SESSION array.
     *
     * @since 0.1.0
     */
    const SESSION_KEY = "__folded_history";

    /**
     * The current URL browsed by the user.
     *
     * @since 0.1.0
     */
    private static string $currentUrl = "";

    /**
     * The index that is being processed in the history.
     *
     * @since 0.1.0
     */
    private static int $index;

    /**
     * Add the current browsed URL to the history.
     *
     * @since 0.1.0
     *
     * @example
     * History::addRequestedUrl();
     */
    public static function addRequestedUrl(): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            return;
        }

        self::$currentUrl = $_SERVER["REQUEST_URI"];

        if (self::previousUrlIsIdentical()) {
            return;
        }

        if (!isset($_SESSION[self::SESSION_KEY]) || !is_array($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = [self::$currentUrl];
        } else {
            $_SESSION[self::SESSION_KEY][] = self::$currentUrl;
        }
    }

    /**
     * Clears the state of the object.
     * Useful for unit testsing.
     *
     * @since 0.1.0
     *
     * @example
     * History::clear();
     */
    public static function clear(): void
    {
        self::$currentUrl = "";

        unset($_SESSION[self::SESSION_KEY]);
    }

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
     * echo History::get(-1);
     */
    public static function get(int $index = 0): string
    {
        if (!self::has($index)) {
            throw (new HistoryNotFoundException("history index $index not found"))->setIndex($index);
        }

        self::$index = $index;

        return $_SESSION[self::SESSION_KEY][self::getIndex()];
    }

    /**
     * Get all the URLs stored in the history.
     *
     * @since 0.1.0
     *
     * @example
     * $urls = History::getAll();
     *
     * foreach ($urls as $url) {
     *  echo $url;
     * }
     */
    public static function getAll(): array
    {
        return $_SESSION[self::SESSION_KEY] ?? [];
    }

    /**
     * Returns true if the index is present in the history.
     *
     * @param int $index The index to check in the history.
     *
     * @since 0.1.0
     *
     * @example
     *
     * if (History::has(-1)) {
     *  echo "history has index -1";
     * } else {
     *  echo "history does not have index -1";
     * }
     */
    public static function has(int $index): bool
    {
        self::$index = $index;

        return isset($_SESSION[self::SESSION_KEY][self::getIndex()]);
    }

    /**
     * Convert an "history index" to a true array index.
     * Negatives index are being converted back to the normal array index.
     *
     * @since 0.1.0
     *
     * @example
     * self::$index = -1;
     * $arrayIndex = History::getIndex();
     */
    private static function getIndex(): int
    {
        return count($_SESSION[self::SESSION_KEY] ?? []) - (1 - self::$index);
    }

    /**
     * Returns true if the last URL stored in the history is the same as the current browsed URL.
     *
     * @since 0.1.0
     *
     * @example
     * if (History::previousUrlIsIdentical()) {
     *  echo "do not store this url";
     * } else {
     *  echo "store this url";
     * }
     */
    private static function previousUrlIsIdentical()
    {
        return self::has(0) && self::get(0) === self::$currentUrl;
    }
}
