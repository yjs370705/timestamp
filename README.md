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
//时间段获取
$hours = RangeTime::set('2020-04-26',true)->getHours('8:30',['08:30','17:00'],['12:30','13:30'],3600);
```
set()参数：

1、设置年份，可以是四位数的年份也可以是一个数组[2020,2022]，意思是获取2020年到2022年的日期，不设为当前年

2、是否格式化时间戳，默认返回时间戳

3、格式化时间戳的格式，默认Y-m-d

getWeek()可以传入一个数字意思是从第几周开始

getYear()方法不需要传参数

getHours() 第一个参数为从几点开始，第二个参数为范围获取，第三个参数为排除哪几个时间段，第四个参数为间隔时间，默认一个小时

工作中经常要获取这些信息对数据进行分析，其他方法会慢慢进行完善；

PHP版本要求7.0及以上；

## 返回
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
}
$hours = RangeTime::set('2020-04-26',true)->getHours('8:30',['08:30','17:00'],['12:30','13:30'],3600);
//获取时间段返回格式
array(2) {
  ["hours"]=>
  array(7) {
    [0]=>
    string(5) "08:30"
    [1]=>
    string(5) "09:30"
    [2]=>
    string(5) "10:30"
    [3]=>
    string(5) "11:30"
    [6]=>
    string(5) "14:30"
    [7]=>
    string(5) "15:30"
    [8]=>
    string(5) "16:30"
  }
  ["info"]=>
  array(7) {
    [0]=>
    array(2) {
      ["start"]=>
      string(5) "08:30"
      ["end"]=>
      string(5) "09:29"
    }
    [1]=>
    array(2) {
      ["start"]=>
      string(5) "09:30"
      ["end"]=>
      string(5) "10:29"
    }
    [2]=>
    array(2) {
      ["start"]=>
      string(5) "10:30"
      ["end"]=>
      string(5) "11:29"
    }
    [3]=>
    array(2) {
      ["start"]=>
      string(5) "11:30"
      ["end"]=>
      string(5) "12:29"
    }
    [6]=>
    array(2) {
      ["start"]=>
      string(5) "14:30"
      ["end"]=>
      string(5) "15:29"
    }
    [7]=>
    array(2) {
      ["start"]=>
      string(5) "15:30"
      ["end"]=>
      string(5) "16:29"
    }
    [8]=>
    &array(2) {
      ["start"]=>
      string(5) "16:30"
      ["end"]=>
      string(5) "17:29"
    }
  }
}
```
## License


MIT