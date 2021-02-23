<?php
function gauss($A, $x) {

for ($i=0; $i < count($A); $i++) {
    $A[$i][] = $x[$i];
}
$n = count($A);

for ($i=0; $i < $n; $i++) {
    $maxEl = abs($A[$i][$i]);
    $maxRow = $i;
    for ($k=$i+1; $k < $n; $k++) {
        if (abs($A[$k][$i]) > $maxEl) {
            $maxEl = abs($A[$k][$i]);
            $maxRow = $k;
        }
    }


    for ($k=$i; $k < $n+1; $k++) {
        $tmp = $A[$maxRow][$k];
        $A[$maxRow][$k] = $A[$i][$k];
        $A[$i][$k] = $tmp;
    }

    for ($k=$i+1; $k < $n; $k++) {
        $c = -$A[$k][$i]/$A[$i][$i];
        for ($j=$i; $j < $n+1; $j++) {
            if ($i==$j) {
                $A[$k][$j] = 0;
            } else {
                $A[$k][$j] += $c * $A[$i][$j];
            }
        }
    }
}

$x = array_fill(0, $n, 0);
for ($i=$n-1; $i > -1; $i--) {
    $x[$i] = $A[$i][$n]/$A[$i][$i];
    for ($k=$i-1; $k > -1; $k--) {
        $A[$k][$n] -= $A[$k][$i] * $x[$i];
    }
}
// be bold and return the $x vector in any case:
return $x;
}
$A = array(array(1,1,0),array(3,5,4),array(1,0,0));
$rhs = array(2,30,0);
print_r($A);
print_r($rhs);
$x=gauss($A,$rhs);
echo "solution vector:\n";
print_r($x);
?>