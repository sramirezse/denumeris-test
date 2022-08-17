<?php

namespace App\Http\Traits;
use App\Models\Student;
use Illuminate\Http\Request;

trait IndexTrait
{
    public function indexModel($request, $model, $relationShips = [], $selects = [])
    {
        $limit = $request->limit;
        $offset = $request->offset;
        // dd($model);
        $total = $model::count();
        $model = $model::orderBy('id', 'desc');
// dd($request->all());
        foreach ($request->search as $i => $search) {
            $search = json_decode($search);

            if ($search->value != '') {
                $field = strtolower($search->field);
                if ($search->field == 'from' || $search->field == 'to') {
                    if ($search->field == 'from') {
                        $to = $request->search[$i + 1];
                        $to = json_decode($to);
                        // dd($to, $search);
                        $model = $model->whereBetween('date', [$search->value, $to->value]);
                    } else {
                        $from = $request->search[$i - 1];
                        $from = json_decode($from);
                        $model = $model->whereBetween('date', [$from->value, $search->value]);
                    }
                } elseif (isset($search->relation)) {
                    $relation = strtolower($search->relation);

                    $model = $model->with($search->relation)->whereHas($relation, function ($q) use ($field, $search) {
                        $q->where($field, 'like', "%{$search->value}%");
                    });
                } elseif (isset($search->unique)) {
                    $model = $model->distinct($search->value);
                    $unique = $search->field;
                    // dd($unique,$model->get());
                } else {

                    $search = strtolower($search->value);
                    $model->where($field, 'like', "%{$search}%");
                }
                $total = $model->count();
            } elseif ($search->field == 'reports') {
                $limit = 0;
            } else {
                $limit = 10;
                // $limit = $request->limit;

            }
        }
        if ($relationShips != []) {
            // dd($model->get());
            $model = $model->with($relationShips);
        }
        if ($selects != []) {
            $model = $model->addSelect($selects);
        }
        if ($offset > 0) {
            $model->offset($offset);
        }
        if ($limit > 0) {
            $model = $model->limit($limit);
        }


        $model = $model->get();

        $arrayQuery = array('total' => $total, 'data' => $model);
        return $arrayQuery;
    }
    public function deleteModel(Request $request, $model) {
        $ids = $request->ids;
        // dd($ids);
        foreach($ids as $id){
            $model = $model::where('id', $id)->first();

            // dd($id, $model);
            $model->delete();
        }
        return $ids;

    }
}
