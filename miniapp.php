<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * MAX mini-app gateway. Serves mini-app.html only when enabled in settings.
 *
 * @package     message_max
 * @copyright   2026 Alex Orlov <snickser@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_MOODLE_COOKIES', true);
define('NO_DEBUG_DISPLAY', true);

require_once(__DIR__ . '/../../../config.php'); // @codingStandardsIgnoreLine

$enabled = get_config('message_max', 'sitebotenableminiapp');
if (empty($enabled)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    echo get_string('miniappdisabled', 'message_max');
    die;
}

$htmlfile = __DIR__ . '/mini-app.html';
if (!is_readable($htmlfile)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Not found';
    die;
}

header('Content-Type: text/html; charset=utf-8');
readfile($htmlfile);
die;
