<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calendário Milenar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    </head>
    <body>
        <div class="container">
            <span hidden>
                {{$monthTime = App\Http\Controllers\CalendarioController::getMonthTime($time)}}
            </span>
    
            <header>
                <div class="row justify-content-between">
                    <div class="col-4">
                        <h3 class="p-4">
                            <a style="text-decoration: none" href="?month='{{App\Http\Controllers\CalendarioController::prevMonth($monthTime)}}'"> << </a>
                        </h3>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="p-4">
                            {{date("F Y", $monthTime)}}
                        </h3>
                    </div>
                    <div class="col-4 text-end">
                        <h3 class="p-4">
                            <a style="text-decoration: none" href="?month='{{App\Http\Controllers\CalendarioController::nextMonth($monthTime)}}'"> >> </a>
                        </h3>
                    </div>
                </div>
            </header>
            <div class="table-responsive table-sm">
                <table class="table table-bordered" id="postTable">
                    <thead>
                        <tr class="text-center">
                            <td>DOM</td>
                            <td>SEG</td>
                            <td>TER</td>
                            <td>QUA</td>
                            <td>QUI</td>
                            <td>SEX</td>
                            <td>SAB</td>
                        </tr>
                    </thead>
                    <span hidden>
                        {{$startDate = strtotime("last sunday", $monthTime)}}
                    </span>
                    <tbody>
                        @for ($row = 0; $row < 6; $row++)
                            <tr class="text-center">
                                @for ($column = 0; $column < 7; $column++)
                                    <span hidden>
                                        {{$dias = date('Y-m-d', $startDate)}}
                                    </span>
                                    @if (date('Y-m', $startDate) !== date('Y-m', $monthTime))
                                        <td style="height: 50px; width: 50px;" class="text-muted">
                                    @else
                                        <td style="height: 50px; width: 50px;">
                                    @endif
                                        Gre: {{date('j', $startDate)}}
                                        <br>
                                        
                                        <span hidden>
                                            @php
                                                //diferença de dias entre hoje e o ultimo dia do ciclo
                                                $qtde_dias = Carbon\Carbon::parse($dias)->diffInDays($last_day);

                                                //centena milenar ou maior
                                                $unidade = strlen($qtde_dias);

                                                $casa = substr($qtde_dias, 0, -3);

                                                //cria a quantidade de zeros a ser subtraido
                                                $quantidade_certa_zeros = '000';

                                                $qtde_mils = $casa . $quantidade_certa_zeros;
                                            @endphp
                                        </span>
                                        @if ($qtde_dias - $qtde_mils == 0)
                                            Mil: 1000
                                        @else
                                            Mil: {{$qtde_dias - $qtde_mils}}
                                        @endif
                                        
                                    </td>
                                    <span hidden>
                                        {{$startDate = strtotime('+1 day', $startDate)}}
                                    </span>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <div>
                    <h3 class="p-4">
                        <a style="text-decoration: none" href="?month='{{App\Http\Controllers\CalendarioController::thisMonth($today_time)}}'"> Hoje </a>
                    </h3>
                </div>
            </div>
        </div>
    </body>
</html>
