<?php


namespace App;


use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;

class Method
{

    /**
     * @throws Exception
     */
    public static function generateCode($length): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function MethodUse($search, $obj): Response|Application|ResponseFactory
    {

        $filterGroups = $search["searchCriteria"]["filter_groups"];

        foreach ($filterGroups as $filterGroup) {
            $isAND = true;
            foreach ($filterGroup["filters"] as $filter) {
                $obj = Method::applySearch($obj, $isAND, $filter["field"],
                    $filter["condition_type"], $filter["value"], "");
                $isAND = false;
            }
        }

        return response([
            'data' => $obj->get(),
            'criteria' => $filterGroups,
        ], 200);
    }

    /**
     * @param Builder $model The Eloquent model builder to change
     * @param bool $isAND If TRUE will execute an AND binding if FALSE will execute an OR binding
     * @param String $column The COLUMN to impose the condition
     *
     * Build an Eloquent object to be use and send back to the query builder
     * depending on the condition and type a specific where clause is applied
     * to the eloquent object and the value is returned at the end.
     *
     * @param String $condition The required condition to be executed
     * @param String $value The value from which we should choose
     * @param String $valueSecond Optional parameter to be used in RANGES manipulation
     *
     * @return Builder
     */
    public static function applySearch(Builder $model, bool $isAND, string $column, string $condition,
                                       string  $value, string $valueSecond): Builder
    {

        $conditions = ['eq', 'in', 'gt', 'gteq', 'like', 'lt', 'lteq', 'neq', 'nin', 'notnull',
            'null', 'from', 'to'];
        if (strcmp($condition, $conditions[0]) == 0) {
            if ($isAND)
                $model->where($column, '=', $value);
            else $model->orWhere($column, '=', $value);
        } else if (strcmp($condition, $conditions[1]) == 0) {
            if ($isAND)
                $model->whereIn($column, explode(',', $value));
            else $model->orWhereIn($column, explode(',', $value));
        } else if (strcmp($condition, $conditions[2]) == 0) {
            if ($isAND)
                $model->where($column, '>', $value);
            else $model->orWhere($column, '>', $value);
        } else if (strcmp($condition, $conditions[3]) == 0) {
            if ($isAND)
                $model->where($column, '>=', $value);
            else $model->orWhere($column, '>=', $value);
        } else if (strcmp($condition, $conditions[4]) == 0) {
            if ($isAND)
                $model->where($column, 'like', '%' . $value . '%');
            else $model->orWhere($column, 'like', '%' . $value . '%');
        } else if (strcmp($condition, $conditions[5]) == 0) {
            if ($isAND)
                $model->where($column, '<', $value);
            else $model->orWhere($column, '<', $value);
        } else if (strcmp($condition, $conditions[6]) == 0) {
            if ($isAND)
                $model->where($column, '<=', $value);
            else $model->orWhere($column, '<=', $value);
        } else if (strcmp($condition, $conditions[7]) == 0) {
            if ($isAND)
                $model->where($column, '<>', $value);
            else $model->orWhere($column, '<>', $value);
        } else if (strcmp($condition, $conditions[8]) == 0) {
            if ($isAND)
                $model->whereNotIn($column, explode(',', $value));
            else $model->orWhereNotIn($column, explode(',', $value));
        } else if (strcmp($condition, $conditions[9]) == 0) {
            if ($isAND)
                $model->whereNotNull($column);
            else $model->orWhereNotNull($column);
        } else if (strcmp($condition, $conditions[10]) == 0) {
            if ($isAND)
                $model->whereNull($column);
            else $model->orWhereNull($column);
        } else if (strcmp($condition, $conditions[11]) == 0) {
            if ($isAND)
                $model->whereBetween($column, [$value, $valueSecond]);
            else $model->orWhereBetween($column, [$value, $valueSecond]);
        }

        return $model;
    }
}
