# folded/history

Manipulate the browser history in your web app.

[![Packagist License](https://img.shields.io/packagist/l/folded/history)](https://github.com/folded-php/history/blob/master/LICENSE) [![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/folded/history)](https://github.com/folded-php/history/blob/master/composer.json#L14) [![Packagist Version](https://img.shields.io/packagist/v/folded/history)](https://packagist.org/packages/folded/history) [![Build Status](https://travis-ci.com/folded-php/history.svg?branch=master)](https://travis-ci.com/folded-php/history) [![Maintainability](https://api.codeclimate.com/v1/badges/388dfdab788e0321f001/maintainability)](https://codeclimate.com/github/folded-php/history/maintainability)

## Summary

- [About](#about)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Examples](#examples)
- [Version support](#version-support)

## About

I created this library to be able to easily come back to the browsed page after editing a resource. The possibility are endless with this package, which is easy to integrate as it is loosely coupled.

Folded is a constellation of packages to help you setting up a web app easily, using ready to plug in packages.

- [folded/config](https://github.com/folded-php/config): Configuration utilities for your PHP web app.
- [folded/exception](https://github.com/folded-php/exception): Various kind of exception to throw for your web app.
- [folded/http](https://github.com/folded-php/http): HTTP utilities for your web app.
- [folded/orm](https://github.com/folded-php/orm): An ORM for you web app.
- [folded/routing](https://github.com/folded-php/routing): Routing functions for your PHP web app.
- [folded/request](https://github.com/folded-php/request): Request utilities, including a request validator, for your PHP web app.
- [folded/view](https://github.com/folded-php/view): View utilities for your PHP web app.

## Features

- Stores the GET requests, by making sure there is not duplicate if the user browse again the same URL
- Can check if an history index exist
- Can get an URL by its history index, or get all the urls in the history
- Uses the PHP session to store the history

## Requirements

- PHP version >= 7.4.0
- Composer installed

## Installation

- [1. Install the package](#1-install-the-package)
- [2. Add the bootstrap code](#2-add-the-bootstrap-code)

### 1. Install the package

In your root folder, run this command:

```bash
composer required folded/history
```

### 2. Add the bootstrap code

As early as possible, and by making sure the code is ran before your "controller" or "action" code, add this:

```php
use function Folded\addRequestedUrlToHistory;

session_start();

addRequestedUrlToHistory();
```

Every time your user browse an URL, it will get added if it matches a GET request.

## Examples

- [1. Get an history by its index](#1-get-an-history-by-its-index)
- [2. Get the last history](#2-get-the-last-history)
- [3. Get all the URLs in the history](#3-get-all-the-ur-ls-in-the-history)
- [4. Check if an index in the history is present](#4-check-if-an-index-in-the-history-is-present)

### 1. Get an history by its index

In this example, we will get the second last URL by its index in the history.

```php
use function Folded\getHistory;

echo getHistory(-1);
```

This history starts from 0, and to get the earlier URL, you need to use negative indexes.

- An history of 0 will get the last URL
- An history of 1 will get the second last URL
- An history of 2 will get the URL before the second last
- ...

### 2. Get the last history

In this example, we will not use any argument to get the last URL in the history.

```php
use function Folded\getHistory;

echo getHistory();
```

### 3. Get all the URLs in the history

In this example, we will get all the history as an array.

```php
use function Folded\getAllHistory;

$urls = getAllHistory();

foreach ($urls as $url) {
  echo $url;
}
```

### 4. Check if an index in the history is present

In this example, we will check if an url in the history at a specific index exists.

```php
use function Folded\hasHistory;

if (hasHistory(-1)) {
  echo "has history -1";
} else {
  echo "has not history -1";
}
```

## Version support

|        | 7.3 | 7.4 | 8.0 |
| ------ | --- | --- | --- |
| v0.1.0 | ❌  | ✔️  | ❓  |
