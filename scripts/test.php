<?php
/*
* Azamat Khankhodjaev
* 28.02.2021
*/
/**
 * The function converts a number from binary to decimal or decimal to binary
 * @param int or float $in_number
 * @param string $unit_type
 * This parameter can take two values "bin" or "dec"
 * @return int or string
 * For bin return string value
 * For dec return int
 * @throws InvalidArgumentException
 */
function number_to_bin_or_dec($in_number, $unit_type)
{
    $x = 0;
    if ($unit_type == "dec") {
        if ($in_number != (int)$in_number) {
            throw new \InvalidArgumentException('Number not binary');
        }

        $in_number = (string)$in_number;
        $num_len = strlen($in_number) - 1;


        for ($i = $num_len; $i >= 0; $i--) {
            $pos = $num_len - $i;
            $mantisa = substr($in_number, $pos, 1);
            if ($mantisa > 1) {
                throw new \InvalidArgumentException('Number not binary');
            }
            $exp = 2 ** $i;
            $x += ($mantisa * $exp);

        }
        return $x;
    } elseif ($unit_type == "bin") {
        $int_part = (int)$in_number;
        $s = "";

        while ($int_part >= 1) {
            $int_part = $int_part / 2;
            if ($int_part != (int)$int_part) {
                $s = "1{$s}";
                $int_part = (int)$int_part;
            } else {
                $s = "0{$s}";
            }
        }

        if ($in_number == (int)$in_number) {
            return $s;
        } else {
            $int_part = (int)$in_number;
            $fractional_part = $in_number - $int_part;
            $f_s = "";
            for ($i = 0; $i < 4; $i++) {
                $fractional_part = $fractional_part * 2;
                if ($fractional_part >= 1) {
                    $f_s .= "1";
                    $fractional_part -= 1;
                } else {
                    $f_s .= "0";
                }
            }
            return "$s.$f_s";
        }
    } else {
        throw new \InvalidArgumentException('Parameter unit_type can take two values "bin" or "dec"');
    }

}

print number_to_bin_or_dec("110010", "dec");
print PHP_EOL;
print number_to_bin_or_dec("44.101", "bin");

