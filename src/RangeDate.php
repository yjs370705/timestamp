<?php

namespace Timerange;
class RangeDate
{
    public static $year = null;
    public static $formatTimestamp = false; //是否格式化时间戳
    public static $format = ''; //日期格式
    private static $instance = null;
    private $quarterNum = 4;
    private $offset = 60 * 60 * 24;

    private function __construct()
    {
    }

    /**
     * @param null $year 要获取的年份 为空则表示当前年份，可以传入年份或数组例如[2018,2020]
     * @param bool $formatTimestamp 是否格式话时间戳 默认返回时间戳
     * @param string $format 格式化时间戳的格式 默认Y-m-d
     * @return RangeDate|null
     */
    static public function set($year = null, bool $formatTimestamp = false, $format = 'Y-m-d')
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        self::$year = $year ?? date('Y');
        self::$formatTimestamp = $formatTimestamp;
        self::$format = $format;
        return self::$instance;
    }

    /**
     * 获取星期
     * @param int $strat 从第几周开始计算
     * @return array|string
     */
    public function getWeek($start = 1): array
    {
        $year = self::$year;
        if (empty($year)) {
            throw new \Exception('Please set Year');
        }
        $weekTime = [];
        if (is_array($year)) {
            sort($year);
            for ($i = $year[0]; $i <= $year[count($year) - 1]; $i++) {
                $weekTime[$i] = $this->baseWeek($i, $start);
            }
        } else {
            $weekTime = $this->baseWeek($year, $start);
        }
        return $weekTime;
    }

    private function baseWeek($year, $start): array
    {
        $allWeekInYear = date("W", mktime(0, 0, 0, 12, 28, $year));
        $week = [];
        for ($i = $start; $i <= $allWeekInYear; $i++) {
            if ($i < 10) {
                $i = "0{$i}";
            }
            $everyWeekStartTime = strtotime($year . 'W' . $i);
            $everyWeekEndTime = strtotime('+1 week -1day', $everyWeekStartTime) + $this->offset - 1;
            $week['date'][] = intval($i);
            $week['time_range'][intval($i)] = [
                'start' => self::$formatTimestamp ? date(self::$format, $everyWeekStartTime) : $everyWeekStartTime,
                'end' => self::$formatTimestamp ? date(self::$format, $everyWeekEndTime) : $everyWeekEndTime,
            ];
        }
        return $week;
    }

    /**
     * 获取月份
     * @param int $start
     * @return array
     */
    public function getMonth($start = 1): array
    {
        $year = self::$year;
        if (empty($year)) {
            return 'Please set Year';
        }

        $monthTime = [];
        if (is_array($year)) {
            sort($year);
            for ($i = $year[0]; $i <= $year[count($year) - 1]; $i++) {
                $monthTime[$i] = $this->baseMonth($i, $start);
            }
        } else {
            $monthTime = $this->baseMonth($year, $start);
        }
        return $monthTime;
    }

    private function baseMonth($year, $strat): array
    {
        $allMonth = date("m", mktime(0, 0, 0, 12, 31, $year));
        $month = [];
        for ($i = $strat; $i <= $allMonth; $i++) {
            if ($i < 10) {
                $i = "0{$i}";
            }
            $everyMonthStartTime = strtotime("{$year}-{$i}");
            $everyMonthEndTime = strtotime('+1 month', $everyMonthStartTime) - 1;
            $month['date'][] = intval($i);
            $month['time_range'][intval($i)] = [
                'start' => self::$formatTimestamp ? date(self::$format, $everyMonthStartTime) : $everyMonthStartTime,
                'end' => self::$formatTimestamp ? date(self::$format, $everyMonthEndTime) : $everyMonthEndTime,
            ];
        }
        return $month;
    }

    /**
     * 获取季度
     * @param int $start
     * @return array
     */
    public function getQuarter($start = 1): array
    {
        $year = self::$year;
        if (empty($year)) {
            return 'Please set quarter';
        }
        $quarterTime = [];
        if (is_array($year)) {
            sort($year);
            for ($i = $year[0]; $i <= $year[count($year) - 1]; $i++) {
                $quarterTime[$i] = $this->baseQuarter($i, $start);
            }
        } else {
            $quarterTime = $this->baseQuarter($year, $start);
        }
        return $quarterTime;
    }

    private function baseQuarter($year, $start): array
    {
        $quarterTime = [];
        for ($i = $start; $i <= $this->quarterNum; $i++) {
            $everyEndQuarter = $i * 3 + 1;
            if ($i < $everyEndQuarter) {
                $first = $everyEndQuarter - 3 == 0 ? 1 : $everyEndQuarter - 3;
                $everyQuarterStartTime = strtotime("{$year}-$first");
            }
            $everyQuarterEndTime = strtotime('+3 month', $everyQuarterStartTime) - 1;
            $quarterTime['date'][] = intval($i);
            $quarterTime['time_range'][intval($i)] = [
                'start' => self::$formatTimestamp ? date(self::$format, $everyQuarterStartTime) : $everyQuarterStartTime,
                'end' => self::$formatTimestamp ? date(self::$format, $everyQuarterEndTime) : $everyQuarterEndTime,
            ];
        }
        return $quarterTime;
    }

    /**
     * 获取年份
     * @return array
     */
    public function getYear(): array
    {
        $year = self::$year;
        if (empty($year)) {
            return 'Please set year';
        }
        $yearTime = [];
        if (is_array($year)) {
            sort($year);
            for ($i = $year[0]; $i <= $year[count($year) - 1]; $i++) {
                $yearTime[$i] = $this->baseYear($i);
            }
        } else {
            $yearTime = $this->baseYear($year);
        }
        return $yearTime;
    }

    private function baseYear($year): array
    {
        $yearTime = [];
        $yearStart = mktime(0, 0, 0, 1, 1, $year);
        $yearEnd = mktime(0, 0, 0, 12, 31, $year) + $this->offset - 1;
        $yearTime['date'] = $year;
        $yearTime['time_range'][$year] = [
            'start' => self::$formatTimestamp ? date(self::$format, $yearStart) : $yearStart,
            'end' => self::$formatTimestamp ? date(self::$format, $yearEnd) : $yearEnd
        ];
        return $yearTime;
    }

    private function __clone()
    {
    }
}
