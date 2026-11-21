
<?php
declare(strict_types=1);

/**
 * ITCS333 A4 starter — implement the three pure validation functions.
 * They are unit-tested by the autograder (tests/UnitTest.php).
 */

function validate_required(string $v): bool
{
    return trim($v) !== '';
}

function validate_email(string $v): bool
{
    return filter_var($v, FILTER_VALIDATE_EMAIL) !== false;
}

function validate_length(string $v, int $min, int $max): bool
{
    return mb_strlen($v) >= $min && mb_strlen($v) <= $max;
}
t $min, int $max): bool
{
    // TODO: return true when mb_strlen($v) is within [$min, $max]
    return false;
}
