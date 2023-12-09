<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>
<style>
    * {
        margin: 0px;
        padding: 0px;
        font-family: "arial";
        font-size: 12px;
    }

    .pdf-header #img {
        width: 100%;
    }

    .pdf-header #about {
        width: 100%;
        font-size: 12pt;
    }

    .pdf-header #about h6,
    h4 {
        margin: 0px;
        padding: 0px;
    }

    .value {
        white-space: nowrap;
    }

    .content-wrapper {
        margin-left: 10px;
        width: 100%;
        text-align: center;
        /*border:solid thin #000;*/
    }

    .table-informations {
        border: solid 2px #000;
        font-size: 8pt;
        text-align: center;
        width: 100%;
    }

    td {
        padding: 0 5px;
    }

    .pdf-body {
        width: 100%;
    }

    .table-informations thead {
        text-align: center;
        background-color: #ccc;
    }

    .table-informations thead tr,
    .table-informations tfoot tr {
        border: solid 2px #000;
    }

    .table-informations .tfoot tr {
        border: solid 2px #000;
    }

    .table-informations thead tr th,
    .table-informations tfoot tr td {
        border-right: solid thin #000;
    }

    .table-informations .tfoot tr td {
        border-right: solid thin #000;
    }

    .exits {
        color: #ff0000;
    }

    .table-informations tbody tr td {
        border-right: solid thin #000;
        border-top: solid thin #000;
    }

    .table-abstract {
        margin-top: 15px;
        border: solid 2px #000;
        font-size: 8pt;
        text-align: center;
        width: 100%;
    }

    .table-abstract .head {
        border: solid 2px #000;
        text-align: center;
        background-color: #ccc;
    }

    .table-abstract td {
        border: solid thin #000;
    }

    .table-signature {
        margin-top: 50px;
        font-size: 10pt;
        text-align: center;
        width: 100%;
    }

    .term {
        margin-top: 0px;
        padding-top: 0px;
        font-size: 10pt;
    }

    .term table {
        font-size: 10pt;
    }

    .schedule {
        width: 100%;
        border: solid 2px #000;
    }

    .schedule #head {
        background-color: #ccc;
        border: solid 2px #000;
    }

    .schedule th {
        border: solid thin #000;
    }

    .schedule td {
        border: solid 1px #000;
    }
</style>
<div class="wrapper">
    {{-- Content Wrapper --}}
    <div class="content-wrapper">
        {{-- Content Header --}}
        <div class="content-header">
            <div class="pdf-header">
                <div>
                    <div style="width:32%;float:left;border:solid thin #fff;">

                    </div>
                    <div style="width:35%;float:left;border:solid 2px #fff;">
                        <img style="width:20%;" src="{{ url('storage/logos/assgapa.png') }}">
                    </div>

                </div>
                <div id="about" style="margin-top:0px; padding-top: 0px;">
                    <h5 style="margin-bottom:0px; padding-bottom: 0px;">{{ $config->title }}</h5>
                    <h6 style="margin-bottom:0px; padding-bottom: 0px;">
                        {{ $config->address . ' - ' . $config->city . '/' . $config->state . ', Fone/Fax: ' . $config->phone }}
                    </h6>
                    <h5 style="margin-bottom:0px; padding-bottom: 0px;"><strong>{{ $subtext }}</strong></h5>
                </div>
            </div>
        </div>
        {{-- Main Content --}}
        <div class="content">
            <div class="pdf-body">
                <table class="table-informations" cellspacing="0">
                    <thead >
                        <tr >
                            <th style="padding: 10px;">Cliente</th>
                            <th >JAN</th>
                            <th >FEV</th>
                            <th >MAR</th>
                            <th >ABR</th>
                            <th >MAI</th>
                            <th >JUN</th>
                            <th >JUL</th>
                            <th >AGO</th>
                            <th >SET</th>
                            <th >OUT</th>
                            <th >NOV</th>
                            <th >DEZ</th>
                          </tr>
                    </thead>
                    <tbody>
                     @php $tr=''; $totPart = 0; $cont = 0; $cat=''; @endphp
                    @foreach ($partners as $partner)
                    @php $cont+=1; @endphp
                        @if ($tr != $partner['color'])
                            @if ($totPart != 0)
                                <tr  style="background-color:#8a8989; border:solid 2px #000;">
                                    <td colspan="13" style="text-align: left;border:solid 2px #000;">
                                        TOTAL DE {{mb_strtoupper($cat, 'UTF-8')}} = {{$totPart}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="13">&nbsp;</td>
                                </tr>
                                @php $totPart = 0; @endphp
                            @endif

                            <tr  style="background-color:{{$partner['color']}}; text-align: center;">
                                <td colspan="13" >
                                    {{mb_strtoupper($partner['category'], 'UTF-8')}} ( R$  {{$partner['value']}} )
                                </td>
                            </tr>
                            @php $tr = $partner['color'];@endphp
                        @endif
                        @php $totPart+=1; @endphp
                        <tr>
                            <td style="text-align:left;">{{mb_strtoupper($partner['name'], 'UTF-8')}}</td>
                            @for ($m=1; $m < 13; $m++) @php $month=$year.'-'.sprintf("%02d",$m) @endphp

                                @if (array_key_exists($month, $partner))
                                @if ($partner[$month] == 'LB')
                                    <td style="background-color: #00ffff;">
                                @else
                                    <td style="background-color: #00ff73;">
                                @endif
                                    {{ $partner[$month] }}</td>
                                @else
                                    @if ($partner['registration_at'] > $month)
                                        <td style="background-color:#888;" ></td>
                                    @else
                                    <td ></td>
                                    @endif

                                @endif
                            @endfor
                        </tr>
                        @if ($cont == count($partners))
                            <tr  style="background-color:#8a8989; border:solid 2px #000;">
                                <td colspan="13" style="text-align: left;border:solid 2px #000;">
                                    TOTAL DE {{mb_strtoupper($partner['category'], 'UTF-8')}} = {{$totPart}}
                                </td>
                            </tr>
                        @endif
                        @php
                            $cat = $partner['category'];
                        @endphp

                    @endforeach

                    </tbody>

                </table>
                <table style="margin-top: 25px; width: 100%;">
                    <tr >
                        <td style="text-align: right;">Canoas, {{$today}}.</td>
                    </tr>
                </table>
                <table class="table-signature" >
                        <tr>
                            <td ><p style="border-top: solid thin #000; width:100%;">{{$config->president}}</p></td>
                            <td ><p style="border-top: solid thin #000; width:100%;">{{$config->financial}}</p></td>
                        </tr>
                        <tr>
                            <td >Presidente do {{$config->acronym}}</td>
                            <td> Financeiro do {{$config->acronym}}</td>
                        </tr>
                </table>

            </div>
        </div>
    </div>
</div>

</html>
