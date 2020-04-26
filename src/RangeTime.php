<?php

namespace Timerange;
class RangeTime
{
    public static $day = null;
    public static $formatTimestamp = false;
    public static $format = '';
    private static $instance = null;
    private $offset = 60 * 60 * 24;

    private function __construct()
    {
    }

    /**
     * @param null $year 要获取的年份 为空则表示当前年份，可以传入年份或数组例如[2018,2020]
     * @param bool $formatTimestamp 是否格式话时间戳 默认日期格式
     * @param string $format 格式化时间戳的格式 默认Y-m-d
     * @return RangeDate|null
     */
    static public function set($day = null, bool $formatTimestamp = false, $format = 'H:i')
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        $formatType = ['H','H:i','H:i:s'];
        if (!in_array($format, $formatType)) {
            throw new \Exception("The param format must in ['H','H:i','H:i:s']");
        }
        self::$day = $day ?? date('Y-m-d');
        self::$formatTimestamp = $formatTimestamp;
        self::$format = $format;
        return self::$instance;
    }

    /**
     * @param int $strat 从第几周开始计算
     * @return array|string
     */
    public function getHours($start = '00:00:00', array $between = [], array $except = [],int $gap = 3600)
    {
        $day = self::$day;
        if (empty($day)) {
            return 'Please set Date';
        }
        if (count($between) != 2) {
            throw new \Exception('The length between the parameters is greater than two');
        }
        $time = [];
        if (is_array($day)) {
            sort($day);
            foreach ($day as $v) {
                $time[$v] = $this->baseGetHours($v, $start, $gap, $between,$except);
            }
        } else {
            $time = $this->baseGetHours($day, $start, $gap,$between,$except);
        }
        return $time;
    }

    private function baseGetHours($day, $start, $gap, $between,$except)
    {
        $start = strtotime("{$day} $start");
        $end = strtotime($day)+$this->offset;
        $betweenTmp = [];
        if (!empty($between)) {
            sort($between);
            foreach ($between as $b) {
                $betweenTmp[] = strtotime("{$day} {$b}");
            }
        }
        $exceptTime = [];
        if (!empty($except)) {
            sort($except);
            foreach ($except as $e) {
                $exceptTime[] = strtotime("{$day} {$e}");
            }
        }
        $flag = true;
        $time = [];
        while ($flag) {
            $time['hours'][] = date(self::$format,$start);
            $time['info'][] = [
                'start' => self::$formatTimestamp ? date(self::$format,$start) : $start,
                'end' => self::$formatTimestamp ? date(self::$format,$start + $gap -1) : $start + ($start + $gap -1),
            ];
            $start += $gap;
            if ($start >= $end) {
                $flag = false;
            }
        }

        if (!empty($betweenTmp)) {
            foreach ($time['info'] as $k=>$t) {
                if (self::$format)
                $tmp = self::$formatTimestamp ? strtotime("{$day} {$t['start']}") : $t['start'];
                    if (!($tmp >= $betweenTmp[0] && $tmp <= $betweenTmp[1])) {
                    unset($time['hours'][$k]);
                    unset($time['info'][$k]);
                }
            }
        }
        if (!empty($exceptTime)) {
            foreach ($time['info'] as $k=>&$t) {
                $tmp = self::$formatTimestamp ? strtotime("{$day} {$t['start']}") : $t['start'];
                if (($tmp >= $exceptTime[0] && $tmp <= $exceptTime[1])) {
                    unset($time['hours'][$k]);
                    unset($time['info'][$k]);
                }
            }
        }
        return $time;
    }

    private function __clone()
    {
    }
}
