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
                    <thead>
                        <tr>
                            <th style="padding: 10px;">Index</th>
                            <th>Dia</th>
                            <th>Descrição</th>
                            <th>Recibo</th>
                            <th>Receitas</th>
                            <th class="exits">Despesas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: #888;">
                            <td>01</td>
                            <td>01</td>
                            <td style="text-align: justify;">SALDO DO MÊS ANTERIOR (INVENTÁRIO)</td>
                            <td>
                                XXXXX
                            </td>
                            <td>
                                @if ($transported > 0)
                                    {{ 'R$ ' . number_format($transported, 2, ',', '.') }}
                                @endif
                            </td>
                            <td class="exits">
                                @if ($transported < 0)
                                    {{ 'R$ ' . number_format($transported, 2, ',', '.') }}
                                @endif
                            </td>
                        </tr>
                        @php
                            $itens = 1;
                        @endphp
                        @foreach ($spendings as $received)
                            <tr style="{{ $received['color'] }}">
                                <td>{{ str_pad($itens += 1, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $received['paid_in'] }}</td>
                                <td style="text-align: justify;">
                                    {{ $received['title'] }}
                                </td>
                                <td>{{ $received['id'] }}</td>
                                <td>{{ $received['enter'] }}</td>
                                <td class="exits value">{{ $received['exits'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" style="background-color: #ccc; text-align:right;">TOTAL</td>
                            <td class="value">{{ $cashierValue }}</td>
                            <td class="exits value">{{ $billValue }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="background-color: #ccc; text-align:right;">TOTAL A TRANSPORTAR
                            </td>
                            <td class="value">{{ $total }}</td>
                        </tr>
                </table>
                <table style="margin-top: 25px; width: 100%;">
                    <tr>
                        <td style="text-align:right;">Canoas, {{ $today }}.</td>
                    </tr>
                </table>
                <table class="table-signature">
                    <tr>
                        <td>
                            <p style="border-top: solid thin #000; width:100%;">{{ $config->signature }}</p>
                        </td>
                        <td>
                            <p style="border-top: solid thin #000; width:100%;">{{ $config->financial }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Presidente do {{ $config->acronym }}</td>
                        <td> Financeiro do {{ $config->acronym }}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>

</html>
