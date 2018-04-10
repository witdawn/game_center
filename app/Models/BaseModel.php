<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Request;

/**
 * @package App\Models\Mongo
 * App\Models\Mongo\BaseModel
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    /**
     * 查询某个时间段创建的.
     *
     * @param $q
     * @param $startAt
     * @param $endAt
     *
     * @return mixed
     */
    public function scopeCreatedDuring($q, $startAt, $endAt)
    {
        return $q->where('created_at', '<=', new Carbon($endAt))->where('created_at', '>=', new Carbon($startAt));
    }

    /**
     * 查询当天创建的数据.
     *
     * @param $q
     *
     * @return mixed
     */
    public function scopeCreatedAtToday($q)
    {
        return $q->where('created_at', '<=', today()->endOfDay())->where('created_at', '>=', today());
    }

    /**
     * 查询某天的数据.
     *
     * @param        $q
     * @param        $field
     * @param Carbon $date
     *
     * @return mixed
     */
    public function scopeOneDay($q, $field, Carbon $date)
    {
        return $q->whereBetween($field, [$date->copy()->startOfDay(), $date->copy()->endOfDay()]);
    }

    /**
     * @param array $conditions
     * @param array $selects
     * @param array $scopes
     * @param null  $with
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public static function getList($conditions = [], $selects = ['*'], $scopes = [], $with = null)
    {
        $conditions = empty($conditions) ? Request::all() : $conditions;

        $query = static::query();
        //关联关系
        if (!empty($with))
            $query = $query->with($with);
        //作用域
        if (!empty($scopes)) {
            foreach ($scopes as $scope) {
                $query = $query->$scope();
            }
        }

        //条件搜索
        $query = static::advacedSearch($query, $conditions);

        //日期筛选
        $query = static::dateSearch($query, $conditions);

        //排序
        $query = static::orderSearch($query, $conditions);

        //分页
        if (array_has($conditions, 'page')) {
            $pageSize = Request::has('per_page') ? Request::input('per_page') : 10;
            $pageSize = Request::has('per_Page') ? Request::input('per_Page') : $pageSize;
            $pageSize = array_has($conditions, 'per_page') ? $conditions['per_page'] : $pageSize;
            $pageSize = array_has($conditions, 'per_Page') ? $conditions['per_Page'] : $pageSize;
            return $query->select($selects)->paginate((int)$pageSize);
        } else {
            return $query->select($selects)->get();
        }

    }

    //日期筛选
    private static function dateSearch($query, $conditions)
    {

        if (isset($conditions['date']) && is_array($conditions['date'])) {
            foreach ($conditions['date'] as $condition) {
                $query = $query->where($condition['field'], $condition['operator'], new Carbon($condition['value']));
            }
        }
        return $query;
    }

    //条件搜索
    private static function advacedSearch($query, $conditions)
    {
        if (isset($conditions['where']) && is_array($conditions['where'])) {
            foreach ($conditions['where'] as $condition) {
                if (array_has($condition, 'operator')) {
                    if ($condition['operator'] == 'in') {
                        $query = $query->whereIn($condition['field'], $condition['value']);
                    } else {
                        $query = $query->where($condition['field'], $condition['operator'], $condition['value']);
                    }
                } else {
                    $query = $query->where($condition['field'], $condition['value']);
                }
            }
        }
        return $query;
    }

    //排序
    private static function orderSearch($query, $conditions)
    {
        return (isset($conditions['order']) && $conditions['order']) ? $query->orderBy(array_get($conditions['order'], 'order',
            'created_at'), array_get($conditions['order'], 'direction', 'desc')) : $query->orderBy('created_at', 'desc');
    }
}
