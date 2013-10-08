<?php

/** PANELS INTEGRATION
---------------------------------------------------------- */
// stolen from Panels Extra Layouts module - https://drupal.org/project/panels_extra_layouts

/**
 * The mapper function for computing the hash.
 *
 * @param $x integer
 *   The index of the content array.
 * @return integer
 *   The sum of all the 2nd digits in a given row of the content array.
 */
function megatron_get_digit($x) {
  // array_pop requires a variable. Doh no love for FP on PHP :(.
  $last_digit = sscanf($x, "%*1d%d");
  return empty($x) ? 0 : array_pop($last_digit);
} // panels_extra_layouts_adaptive_get_digit

/**
 * The hashing function is quite simple, hence imperfect. There are some
 * exceptions that are handled below to make the way the grid is filled
 * consistent.
 *
 * h(i) = \sum_{i}_{j = 1,n} get_digit(c(i,j))
 *
 * where i is the row number, j is the column number, c(i,j) is the content of
 * entry (i,j) of the content matrix and get_digit is a function that
 * returns m given a number nm, e.g., 41, returns 1.
 *
 * @param $indexes array
 *   The indexes of a given row of the content array.
 * @param $columns integer
 *   The number of columns in the current 'submatrix'.
 * @param $mapper_f string
 *   The mapper function name.
 *
 * @return integer
 *   The hash of a given row.
 */
function megatron_hash($indexes = array(), $columns = 3, $mapper_f) {
  // Bail out if there are no elements.
  if (empty($indexes)) return 0;
  // Count the number of elements in the given row.
  $n = count($indexes);
  // Compute the hash.
  $h = $n == 1 ?  1 : array_sum(array_map($mapper_f, $indexes));
  // For 4 columns there are a couple of special cases where the hash is
  // ambiguous.
  if ($h != 0 && $columns == 4) {
    // If we are in a special situation correct it. The hashing function is quite
    // naive. It's the sum of the column indexes in each row.
    // Some cases we get an incorrect value that needs to be corrected.
    if ($n == 2 && $h == 6) return 4;
    if ($n == 2 && ($h == 7 || ($h == 5 && megatron_get_digit($indexes[1]) == 3)))
      return 3;
  }
  return $h;
} // panels_extra_layouts_adaptive_hash
