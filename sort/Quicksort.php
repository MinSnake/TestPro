<?php


class Quicksort
{

    public function index($arr)
    {
        if (count($arr) <= 1) {
            return $arr;
        }
        $flag = $arr[0];
        $left = array(); // 接收小于中间值
        $right = array();// 接收大于中间值
        for ($i = 1; $i < count($arr); $i++) {

            if ($flag < $arr[$i]) {
                $right[] = $arr[$i];
            } else {
                $left[] = $arr[$i];
            }
        }
        $left = $this->index($left);
        $right = $this->index($right);
        // 合并排序后的数据，别忘了合并中间值
        return array_merge($left, array($flag), $right);
    }

//    public function sort($arr)
//    {
//        $new_arr = $arr;
//        $count = count($arr);
//        $flag = $arr[$count - 1];
//        array_pop($new_arr);
//        $key_l = $this->getBig($flag, $new_arr);
//        $key_r = $this->getSmall($flag, $new_arr);
//        echo '找到左键：' . $key_l . '   |   ' . '找到右键：' . $key_r . PHP_EOL;
//        if ($key_l && $key_r) {
//            if ($key_l !== $key_r) {
//                echo '交换！' . PHP_EOL;
//                $temp = $arr[$key_l];
//                $arr[$key_l] = $arr[$key_r];
//                $arr[$key_r] = $temp;
//            } else {
//                //交换flag和key对应的值，进入第二阶段
//                $arr[$count - 1] = $arr[$key_l];
//                $arr[$key_l] = $flag;
//            }
//        }
//        return $arr;
//    }


//    public function getBig($flag, $arr)
//    {
//        foreach ($arr as $key => $item) {
//            if ($item > $flag) {
//                return $key;
//            }
//        }
//        return false;
//    }

//    public function getSmall($flag, $arr)
//    {
//        $arr = array_reverse($arr, true);
//        foreach ($arr as $key => $item) {
//            if ($item < $flag) {
//                return $key;
//            }
//        }
//        return false;
//    }

}

//$arr = [3, 5, 8, 1, 2, 9, 4, 7, 6];
//$quicksort = new Quicksort();
//$result = $quicksort->index($arr);
//echo '结果： ' . implode(",", $result) . PHP_EOL;


echo strtotime('2014-12-22 20:21:43');