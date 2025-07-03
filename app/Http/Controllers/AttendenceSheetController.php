<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendenceSheetController extends Controller
{
    //view
    public function attendence(Request $request)
    {

        $filter_year = date('Y');

        $filter_month = date('m');

        $filter_val = $filter_year.'-'.str_pad($filter_month, 2, '0', STR_PAD_LEFT);

        $attn_raw = \DB::table('krsnanusilanam_attn')
            ->select('attn_id','name', 'attn_date', 'attn_status')
            ->where('attn_for', '=', ''.$filter_val.'')
            ->groupBy('name', 'attn_date')
            ->orderBy('name')
            ->orderBy('attn_date', 'asc')
            ->get();

        $attn_data = [];

        foreach ($attn_raw as $record) {
            $day = \Carbon\Carbon::parse($record->attn_date)->day;
            $attn_data[$record->name][$day] = $record->attn_status;
            $attn_data[$record->name]['attn_id'] = $record->attn_id;
        }

        // get summary for particular user
        $attn_summary = [];
        foreach ($attn_raw as $record) {
            $name = $record->name ?? '';
            $status = $record->attn_status ?? '';

            if (!array_key_exists($name, $attn_summary)) {
                $attn_summary[$name] = [
                    'present' => 0,
                    'absent' => 0,
                    'cl_alloted' => 6
                ];
            }

            if ($status == 1) {
                $attn_summary[$name]['present'] += 1;
                // $attn_summary[$name]['remaining_cl'] = 6;
            } elseif ($status == 2) {
                $attn_summary[$name]['absent'] += 1;
                $attn_summary[$name]['remaining_cl'] = 6 - $attn_summary[$name]['absent'];
            }
        }

        return view('attn_table.krishna_anushilanam_attn', compact('attn_data', 'attn_summary', 'filter_year', 'filter_month'));
    }

    // attn filter
    public function filterByMonthYear(Request $request)
    {
        if ($request->method() == 'POST' && $request->ajax()) {
            if ($request->filter_val != '') {

                $ext_year_month = explode('-', $request->filter_val??'');

                $filter_year = $ext_year_month[0];

                $filter_month = $ext_year_month[1];

                $attn_raw = \DB::table('krsnanusilanam_attn')
                    ->select('attn_id','name', 'attn_date', 'attn_status')
                    ->where('attn_for', '=', ''.$request->filter_val.'')
                    ->groupBy('name', 'attn_date')
                    ->orderBy('name')
                    ->orderBy('attn_date', 'asc')
                    ->get();

                // dd($attn_raw->toRawSql());

                $attn_data = [];

                foreach ($attn_raw as $record) {
                    $day = \Carbon\Carbon::parse($record->attn_date)->day;
                    $attn_data[$record->name][$day] = $record->attn_status;
                    $attn_data[$record->name]['attn_id'] = $record->attn_id;
                    
                }

                // get summary for particular user
                $attn_summary = [];
                foreach ($attn_raw as $record) {
                    $name = $record->name ?? '';
                    $status = $record->attn_status ?? '';

                    if (!array_key_exists($name, $attn_summary)) {
                        $attn_summary[$name] = [
                            'present' => 0,
                            'absent' => 0,
                            'cl_alloted' => 6
                        ];
                    }

                    if ($status == 1) {
                        $attn_summary[$name]['present'] += 1;
                        // $attn_summary[$name]['remaining_cl'] = 6;
                    } elseif ($status == 2) {
                        $attn_summary[$name]['absent'] += 1;
                        $attn_summary[$name]['remaining_cl'] = 6 - $attn_summary[$name]['absent'];
                    }
                }

                $view = view('attn_table.krishna_anushilanam_attn', compact('attn_data', 'attn_summary', 'filter_year', 'filter_month'))->render();

                // return response()->json(['html'=>$view]);
                return sendAjaxResponse('success', null, $view);
            }
        }
    }
}
