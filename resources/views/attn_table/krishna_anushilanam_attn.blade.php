<?php
    $attn_status = [
        1 => '#e8fdeb',
        2 => '#FFCCCB'
    ];
?>

@php
$year = date('Y');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Krishna Anushilanam Attendence Sheet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    

    <script type="text/javascript">
        var baseUrl = {!! json_encode(url('/')) !!}
    </script>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
    
</head>
<body style="display: grid;min-height: 100vh;">

    <!-- Font Awesome Loader -->
<div id="loader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999; text-align:center; padding-top:200px;">
    <i class="fas fa-spinner fa-spin fa-3x"></i>
</div>


    <div class="attn_table">
        @include('attn_table.attn', ['attn_data'=>$attn_data, 'attn_summary'=>$attn_summary])
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<script src="{{asset('assets/custom.js')}}"></script>

</body>
</html>
