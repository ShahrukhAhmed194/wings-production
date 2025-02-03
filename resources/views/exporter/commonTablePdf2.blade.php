<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 8pt "Tahoma";
        }

        p, h2, h3, h4, h5, span {
            font-size: 15px;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 0;
            margin: 0;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }

            .print_section {
                display: none;
            }
        }

    </style>
</head>
<body>
<div class="page">
    <div class="container mt-3">
        {{--<img style="margin-left: 40%" src="{{ public_path('logo.png') }}" alt="" width="80px" height="80px"/>--}}
        <p style="margin-left:32%;margin-top:0;color:#247444">{{env('APP_NAME')}} </p>
        <div>
            <div>
                <h2>
                    <center>{{$title??''}}</center>
                </h2>
                <p class="mb-2">
                    <center>{{$title2 ??''}}</center>
                </p>
            </div>
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                <tr>
                    <th>SL</th>
                    @foreach($head as $key=>$cl)
                        <th>{{$cl??''}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key=>$dt)
                    <tr>
                        <td>{{$key+1}}</td>
                        @foreach($columns as $key2=>$cl)
                            @if($cl =='image')
                                <td>
                                    <img src="{{ $dt[$cl] ? public_path($dt[$cl]) : '' }}" width="50px" height="50px" alt=""/>
                                </td>
                            @else
                                <td>{!! $dt[$cl] ??'' !!}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
</body>
</html>
