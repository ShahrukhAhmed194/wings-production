<?php

namespace App\Traits;

use App\Exports\CommonDataExporter;
use Illuminate\Support\Carbon;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Facades\CSV;
trait ReportTrait
{
    private function getPdfReport($ids = null, $model = null, $columns = [], $head = [], $total=[], $start_date=null, $end_date=null,$where=[]){
        $model = '\App\Models\\' . $model;
        if ($ids) {
            $modelDatas = $model::whereIn('id', $ids)->get();
        } else {
            $modelDatas = $model::query();
            if (isset($start_date)){
                $modelDatas->whereDate('created_at', '>=', $start_date);
            }
            if (isset($end_date)){
                $modelDatas->whereDate('created_at', '<=', $end_date);
            }
            if (count($where)) {
                foreach ($where as $w) $modelDatas->where($w['name'],$w['value']);
            }
            $modelDatas =$modelDatas->get();
        }
        $data = array();
        $cols = $columns;
        foreach ($modelDatas as $modelData) {
            $info = array();
            if (count($cols)) {
                foreach ($cols as $col) {
                    //$output = str_replace(['_', '.'], ' ', $col);
                    $output = $col;
                    $relations = explode('.', $col);
                    if (count($relations) > 1) {
                        $r = $modelData;
                        foreach ($relations as $relation) {
                            if (!empty($r) && $r->exists()) {
                                $r = $r->$relation;
                            }
                        }
                        $info[$output] = $r ?? '';
                    } else {
                        $info[$output] = $modelData[$col];
                    }
                }
            }
            $data[] = $info;
        }
        //total calculation
        if (count($total)){
            $info = array();
            if (count($cols)) {
                foreach ($cols as $col) {
                    if (in_array($col, $total)){
                        $info[$col] = $modelDatas->sum($col);
                    }else{
                        $info[$col] = null;
                    }
                }
            }
            $data[] = $info;
        }
        //Log::info($data);
        return collect($data);
    }

    public function commonDataExporter($model, $columns, $head, $total=[])
    {
        if (\request('ids')) {
            $ids = explode(',', \request('ids'));
        } else {
            $ids = null;
        }
        $start_date =null;
        $end_date =null;
        $where =[];
        if (\request('start_date')) $start_date = \request('start_date');
        if (\request('end_date')) $end_date = \request('end_date');
        if (\request('status') != '' ) {
            $status = \request('status');
            $where[]=[
                'name'=>'is_paid',
                'value'=>$status==1??0
            ];
        }
        if (\request('festival_id') ) {
            $where[]=[
                'name'=>'festival_id',
                'value'=>\request('festival_id')
            ];
        }
        if (\request('payment_type') ) {
            $where[]=[
                'name'=>'payment_type',
                'value'=>\request('payment_type')
            ];
        }
        if (\request('session') ) {
            $where[]=[
                'name'=>'session',
                'value'=>\request('session')
            ];
        }

        if (\request('format') === 'excel') {
            return Excel::download(new CommonDataExporter($ids, $model, $columns, $head, $total,$start_date,$end_date,$where), 'Festival_Member_Records_'. date("Y-m-d-H-i-s") .'.xlsx');

            //return (new CommonDataExporter($ids, $model, $columns, $head, $total,$start_date,$end_date,$where))
             //   ->download($model.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
        if (\request('format') === 'csv') {
            return Excel::download(new CommonDataExporter($ids, $model, $columns, $head, $total,$start_date,$end_date,$where), 'Festival_Member_Records_'. date("Y-m-d-H-i-s") .'.csv');
            //return (new CommonDataExporter($ids, $model, $columns, $head, $total,$start_date,$end_date,$where))
             //   ->download($model.'.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv',]);
        }
        $title = 'Reports';
        $title2 = '';
        $data = $this->getPdfReport($ids, $model, $columns, $head, $total,$start_date,$end_date,$where);
        $pdf = PDF::loadView('exporter.commonTablePdf',compact('title','title2','head','columns','data'));
        return $pdf->download($model.'.pdf');

        //return (new BookingDataExporter($ids, $model, $columns, $head, $total, 'is_active'))
        //   ->download($model.'.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

}
