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
            @php
                $car = 0;
                $pix = 0;
                $bol = 0;
            @endphp
            <div class="pdf-body">
                <table class="table-informations" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="padding: 10px;">Item</th>
                            <th>Tipo Locatário</th>
                            <th>Descrição</th>
                            <th>Recibo</th>
                            <th>Entradas</th>
                            <th class="exits">Saídas</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($receiveds as $received)
                            <tr style="{{ $received['paymentCategory'] }}">
                                <td>{{ $received['item'] }}</td>
                                <td>{{ $received['tenant'] }}</td>
                                <td style="text-align: justify;">
                                    @if ($received['form_payment'] == 'CAR')
                                        @php
                                            $car += $received['value'];
                                        @endphp
                                        <p><strong>Pagamento efetuado na maquininha.</strong></p>
                                    @endif

                                    @if ($received['form_payment'] == 'BOL')
                                        <p><strong>Pagamento efetuado com boleto.</strong></p>
                                        @php
                                            $bol += $received['value'];
                                        @endphp
                                    @endif

                                    @if ($received['form_payment'] == 'PIX')
                                        <p><strong>Pagamento efetuado com PIX.</strong></p>
                                        @php
                                            $pix += $received['value'];
                                        @endphp
                                    @endif

                                    {{ $received['title'] }}
                                </td>
                                <td>{{ $received['receipts'] }}</td>
                                <td>{{ $received['enter'] }}</td>
                                <td class="exits value"></td>
                            </tr>
                        @endforeach

                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $bill['item'] }}</td>
                                <td></td>
                                <td style="text-align: justify;">{{ $bill['title'] }}</td>
                                <td>{{ $bill['receipts'] }}</td>
                                <td></td>
                                <td class="exits value">{{ $bill['exit'] }}</td>
                            </tr>
                        @endforeach

                        <tr style="border:solid 2px #000;">
                            <td colspan="3" style="background-color: #ccc; "></td>
                            <td>TOTAL</td>
                            <td class="value">R$ {{ number_format($dayReceiveds, 2, ',', '.') }}</td>
                            <td class="exits value">R$ {{ number_format($dayBills, 2, ',', '.') }}</td>
                        </tr>
                </table>
                <table class="table-abstract" cellspacing="0">
                    <tr>
                        <td class="head" colspan="2">SEM EFEITO NO CAIXA</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">PAGAMENTOS COM PIX</td>
                        <td>R$ {{ number_format($pix, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">PAGAMENTOS COM BOLETO</td>
                        <td>R$ {{ number_format($bol, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">PAGAMENTOS COM MAQUININHA</td>
                        <td>R$ {{ number_format($car, 2, ',', '.') }}</td>
                    </tr>
                </table>
                <table class="table-abstract" cellspacing="0">
                    <tr>
                        <td class="head" colspan="2">RESUMO</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">SALDO DO DIA ANTERIOR</td>
                        @if ($oldBalance < 0)
                            <td style="font-style: bold;" class="exits value">
                            @else
                            <td style="font-style: bold;" class="value">
                        @endif
                        R$ {{ number_format($oldBalance, 2, ',', '.') }}
                    </tr>
                    <tr>
                        <td style="text-align:left;">TOTAL DE ENTRADAS</td>
                        <td class="value">R$ {{ number_format($dayReceiveds, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;" class="exits">TOTAL DE SAÍDAS</td>
                        <td class="exits value">R$ {{ number_format($dayBills, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;" class="exits">RECOLHIMENTO FINANCEIRO</td>
                        <td class="exits value">R$ {{ number_format($dayCashiers, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">SALDO DO DIA</td>
                        @if ($dayBalance < 0)
                            <td style="font-style: bold;" class="exits value">
                            @else
                            <td style="font-style: bold;" class="value">
                        @endif
                        R$ {{ number_format($dayBalance, 2, ',', '.') }}
                        </td>
                    </tr>
                </table>

                <table class="table-signature">
                    <tr>
                        <td style="text-align:left;">Canoas, {{ $today }}.</td>
                        <td style="border-top: solid thin #000;">{{ $responsible }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Diretor(a) da Secretaria</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

</html>
