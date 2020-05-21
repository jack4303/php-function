<?php
/**
 * Created by PhpStorm.
 * User: jack4303
 * Date: 2020-05-01
 * Time: 18:37
 */

/**
php.net array_reduce函数说明:

array_reduce — 用回调函数迭代地将数组简化为单一的值

说明
array_reduce ( array $array , callable $callback [, mixed $initial = NULL ] ) : mixed
array_reduce() 将回调函数 callback 迭代地作用到 array 数组中的每一个单元中，从而将数组简化为单一的值。

参数
array
输入的 array。

callback
callback ( mixed $carry , mixed $item ) : mixed
carry
携带上次迭代里的值； 如果本次迭代是第一次，那么这个值是 initial。

item
携带了本次迭代的值。

initial
如果指定了可选参数 initial，该参数将在处理开始前使用，或者当处理结束，数组为空时的最后一个结果。

返回值
返回结果值。

initial 参数，array_reduce() 返回 NULL。
 */

// ===================================  分割线 ========================================== //

/**
 * 仿array_reduce函数，实现与其一样的功能
 * @param array $array
 * @param callable $callback  callback ( mixed $carry , mixed $item ) : mixed
 * @param null $initial
 * @return mixed
 */
function mock_array_reduce(array $array , callable $callback, $initial = NULL)
{
    if (empty($array)) {
        return $initial;
    }

    $carry = $initial;
    foreach ($array as $item) {
        $carry = call_user_func($callback, $carry, $item);
    }
    return $carry;
}


// =================================== 测试 ========================================== //
// array_reduce的测试用例。直接copy php.net的用例

function sum($carry, $item)
{
    $carry += $item;
    return $carry;
}

function product($carry, $item)
{
    $carry *= $item;
    return $carry;
}

/**
 * 测试array_reduce，用来对比array_reduce和mock_array_reduce
 * @param callable $array_reduce
 */
function array_reduce_test(callable $array_reduce)
{
    $arr0 = array();
    $arr1 = array(2);
    $arr5 = array(1, 2, 3, 4, 5);

    var_dump($array_reduce($arr5, "sum")); // int(15)
    var_dump($array_reduce($arr1, "sum")); // int(2)
    var_dump($array_reduce($arr0, "sum", "No data to reduce")); // string(17) "No data to reduce"
    var_dump($array_reduce($arr1, "product"));   // int(0), 由于初始值默认为NULL，所以乘以其他数的结果为0
    var_dump($array_reduce($arr1, "product", 1));   // int(2)
    var_dump($array_reduce($arr5, "product", 10)); // int(1200), because: 10*1*2*3*4*5
}


echo "=============== array_reduce ===================<br/>";
array_reduce_test('array_reduce');

echo "<br/><br/>=============== mock_array_reduce =================== <br/>";
array_reduce_test('mock_array_reduce');

