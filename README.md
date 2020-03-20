<h1 align="center"> 日期获取 </h1>

<p align="center"> </p>


## 安装

```shell
$ composer require yjs/timerange -vvv
```

## 使用
```
//获取星期
$week = RangeDate::set(2020,true,'Y-m-d')->getWeek();
//获取月份
$month = RangeDate::set(2020,true,'Y-m-d H:i:s')->getMonth($start);
//获取季度
$quarter = RangeDate::set(2020,true,'Y-m-d')->getQuarter($start);
//年份
$week = RangeDate::set([2020,2022],true,'Y-m-d')->getYear();
```
set()参数：

1、设置年份，可以是四位数的年份也可以是一个数组[2020,2022]，意思是获取2020年到2022年的日期，不设为当前年

2、是否格式化时间戳，默认返回时间戳

3、格式化时间戳的格式，默认Y-m-d

getWeek()可以传入一个数字意思是从第几周开始

getYear()方法不需要传参数

工作中经常要获取这些信息对数据进行分析，其他方法会慢慢进行完善；

PHP版本要求7.0及以上；

##返回
```angular2
$month = RangeDate::set(2020,true,'Y-m-d')->getMonth();
//获取月份返回格式 其他类似
array(12) {
  [0]=>
  array(3) {
    ["month"]=>
    int(1) //月份
    ["start"]=>
    string(10) "2020-01-01"//每个月开始时间 当天零点
    ["end"]=>
    string(10) "2020-01-31" 每个月结束时间 当天的23:59:59
  }
  [1]=>
  array(3) {
    ["month"]=>
    int(2)
    ["start"]=>
    string(10) "2020-02-01"
    ["end"]=>
    string(10) "2020-02-29"
  }
  [2]=>
  array(3) {
    ["month"]=>
    int(3)
    ["start"]=>
    string(10) "2020-03-01"
    ["end"]=>
    string(10) "2020-03-31"
  }
  [3]=>
  array(3) {
    ["month"]=>
    int(4)
    ["start"]=>
    string(10) "2020-04-01"
    ["end"]=>
    string(10) "2020-04-30"
  }
  [4]=>
  array(3) {
    ["month"]=>
    int(5)
    ["start"]=>
    string(10) "2020-05-01"
    ["end"]=>
    string(10) "2020-05-31"
  }
  [5]=>
  array(3) {
    ["month"]=>
    int(6)
    ["start"]=>
    string(10) "2020-06-01"
    ["end"]=>
    string(10) "2020-06-30"
  }
  [6]=>
  array(3) {
    ["month"]=>
    int(7)
    ["start"]=>
    string(10) "2020-07-01"
    ["end"]=>
    string(10) "2020-07-31"
  }
  [7]=>
  array(3) {
    ["month"]=>
    int(8)
    ["start"]=>
    string(10) "2020-08-01"
    ["end"]=>
    string(10) "2020-08-31"
  }
  [8]=>
  array(3) {
    ["month"]=>
    int(9)
    ["start"]=>
    string(10) "2020-09-01"
    ["end"]=>
    string(10) "2020-09-30"
  }
  [9]=>
  array(3) {
    ["month"]=>
    int(10)
    ["start"]=>
    string(10) "2020-10-01"
    ["end"]=>
    string(10) "2020-10-31"
  }
  [10]=>
  array(3) {
    ["month"]=>
    int(11)
    ["start"]=>
    string(10) "2020-11-01"
    ["end"]=>
    string(10) "2020-11-30"
  }
  [11]=>
  array(3) {
    ["month"]=>
    int(12)
    ["start"]=>
    string(10) "2020-12-01"
    ["end"]=>
    string(10) "2020-12-31"
  }
}
```
## License


MIT