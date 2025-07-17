@php
$filter_year = ($filter_year??'') ? $filter_year : date('Y');
$filter_month = ($filter_month??'') ? $filter_month : date('m');
@endphp

<div class="attn-table">
<h2 style="text-align:center;">Attendance - {{date('F', mktime(0, 0, 0, $filter_month, 10))}} {{$filter_year}}</h2>
    <div class="year-drop-down">
        <select name="year" id="year">
            
            @for($i=date('Y'); $i<=2030; $i++)
                <option value="{{$i}}" {{$i == $filter_year ? 'selected':''}}>{{$i}}</option>
            @endfor
        </select>
    </div>

    <div class="month-drop-down">
        <select name="month" id="month">
            
            @for($month=1; $month<=12; $month++)
                <option value="{{str_pad($month, 2, '0', STR_PAD_LEFT)}}" {{$month == $filter_month ? 'selected':''}}>{{date('F',strtotime("$year-$month-01"))}}</option>
            @endfor
        </select>
    </div>

    <div class="get_result">
        <a href="javascript:void(0);" class="form-control get_filter_val">Get Result</a>
    </div>

    <div class="get_result">
        <a href="javascript:void(0);" class="form-control mark_attenence" data-href="{{route('attn.mark')}}">Mark Attendence</a>
    </div>
<table>
    <thead>
        <tr>
            <th><input type="checkbox" class="checked_all"></th>
            <th>S.No</th>
            <th class="sticky name">Name</th>
            <!-- Day headers: June 1 is Sunday in 2025 -->
            <?php
            $year = $filter_year;
            $month = $filter_month;
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            for($days = 1; $days <= $daysInMonth; $days++){
                $date = DateTime::createFromFormat('Y-n-j', "$year-$month-$days");
                $weekday = $date->format('D');
                ?>
                    <th class="sticky"><?= $weekday; ?><br><?= $days; ?></th>
                <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>

        
        @if(count($attn_data) > 0)
            @foreach($attn_data as $name=>$days)
                <tr>
                    <td><input type="checkbox" class="checked_box" value={{$days['attn_id']}} name="attn_id[]"></td>
                    <td>{{$loop->iteration}}</td>
                    <td class="name">{{$name}}</td>
                    @for($day=1; $day<=30; $day++)
                        @php
                        $status = $days[$day] ?? null;
                        @endphp

                        @if($status == 1)
                            <td class="present" style="color:#155724; background-color: #e8fdeb;">P</td>
                        @elseif($status == 2)
                            <td class="absent" style="color:#FF0000; background-color: #FFCCCB;">A</td>
                        @else
                            <td>-</td>
                        @endif
                    @endfor
                    
                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="31"> No Record Found</td>
        </tr>
        @endif
    </tbody>
</table>

</div>

<div style="width:600px; margin: auto 0 20px auto;">
    <h3 style="text-align:center; margin-top: 40px;">Monthly Attendance Summary – {{date('F', mktime(0, 0, 0, $filter_month, 10))}} {{$filter_year}}</h3>

    <table style="width:100%; margin: 0; border-collapse: collapse;" border="1">
        <thead>
            <tr>
                
                <th>S.No</th>
                <th>Name</th>
                <th>Total Present(In Days)</th>
                <th>Total Absent(In Days)</th>
                <th>CL Allotted(In Month)</th>
                <th>CL Remaining(In Month)</th>
            </tr>
        </thead>
        <tbody>
            @if(count($attn_summary) > 0)
                @foreach($attn_summary as $name=>$value)
                <tr>
                    
                    <td>{{$loop->iteration}}</td>
                    <td>{{$name}}</td>
                    <td>{{$value['present']??''}}</td>
                    <td>{{$value['absent']??''}}</td>
                    <td>{{$value['cl_alloted']??''}}</td>
                    <td>{{$value['remaining_cl']??6}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">No Record Found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>