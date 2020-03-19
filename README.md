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

2、是否格式化时间戳，默认不格式化

3、格式化时间戳的格式，默认Y-m-d

getWeek()可以传入一个数字意思是从第几周开始

getYear()方法不需要传参数

工作中经常要获取这些信息对数据进行分析，其他方法会慢慢进行完善；
## License

MIT