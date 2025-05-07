<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>
<style>
    * {
        margin: 0px;
        padding: 0px;
        font-family: arial;
    }

    .receipt-body {
        margin-top: 20px;
        width: 100%;
    }

    .receipt-body table {
        width: 100%;
    }

    .receipt-body table td {
        border-bottom: solid thin #000;
    }

    .dashed {
        margin: 20px;
        border-bottom: dashed thin #000;
    }

    .receipt-head {
        padding: 1.5pt;
    }

    .imagem {
        width: 20%;
        float: left;
        border-right: solid thin #000;
        padding-right: 10px;
    }

    i {
        min-width: 100%;
        border-bottom: solid thin #000;
    }

    h6,
    h5,
    h4,
    h3,
    h2 {
        margin: 0px;
        padding: 0px;
    }

    p {
        font-size: 7pt;
        margin: 0px;
        padding: 0px;
    }

    .titulo {
        width: 50%;
        float: left;
        text-align: center;
    }

    .rec {
        font-weight: 400px;
        float: left;
        text-align: center;
    }

    .valor {
        margin-top: 10px;
        width: 100%;
        border: solid 1px #000;
        text-align: left;
        padding: 5px;
        float: bottom;
    }
</style>
<div class="receipt-head">
    <div class="imagem">
        <img src="{{ url('storage/logos/assgapa.png') }}">
    </div>
    <div class="titulo">
        <h5>
            {{ $config->title }}
        </h5>
        <h5 style="margin-bottom: 10px;">Chave PIX - CNPJ {{ $config->cnpj }}</h5>
        <p>{{ $config->address }} - {{ $config->city }} / {{ $config->state }} - CEP {{ $config->postalCode }}</p>

        <p>Contato(s): {{ $config->phone }}</p>
    </div>
    <div class="rec">
        <h2>RECIBO</h2>
        <h3>Nº <b>ASSG{{ str_pad($bill->id, 6, '0', STR_PAD_LEFT) }}PG</b></h3>
        <div class="valor">
            <h3>R$ {{ $bill->value }}</h3>
        </div>
    </div>
</div>
<div class="receipt-body">
    <table>
        <tr>
            <td colspan="3"><b>Pagamos à(ao):</b>
                @if ($bill->creditor_id != '')
                    {{ $bill->partner->name }}
                @else
                    {{ $bill->creditor }}
                @endif

            </td>
        </tr>
        <tr>
            <td colspan="3"><b>CPF / CNPJ:</b>
                @if ($bill->creditor_id != '')
                    @if ($bill->partner->pf_pj == 'pf')
                        {{ $bill->partner->cpf }}
                    @else
                        {{ $bill->partner->cnpj }}
                    @endif
                @else
                    {{ $bill->creditor_document }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="3"><b>Operador responsável:</b>
                @if ($bill->updated_by)
                    {{ mb_strtoupper($bill->updated_by) }}
                @else
                    {{ mb_strtoupper($bill->created_by) }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="width:40%;"><b>A importância de:</b> R$ {{ $bill->value }}</td>
            <td colspan="2"><b>Data:</b> {{ $bill->paid_in }}
                ( X )<b>PAGAMENTO</b> ( )<b>RECEBIMENTO</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>Referente à(ao):</b> {{ mb_strtoupper($bill->title) }}</td>
        </tr>
        <tr>
            <td colspan="2"><b>Assinatura:</b> </td>
            <td><b>Fone:</b>
                @if ($bill->creditor_id != '')
                    {{ $bill->partner->phone_first }}
                @endif

            </td>
        </tr>
    </table>
</div>
<div class="dashed"></div>
<div class="receipt-head">
    <div class="imagem">
        <img src="{{ url('storage/logos/assgapa.png') }}">
    </div>
    <div class="titulo">
        <h5>
            {{ $config->title }}
        </h5>
        <h5 style="margin-bottom: 10px;">CNPJ {{ $config->cnpj }}</h5>
        <p>{{ $config->address }} - {{ $config->city }} / {{ $config->state }} - CEP {{ $config->postalCode }}</p>

        <p>Contato(s): {{ $config->phone }}</p>
    </div>
    <div class="rec">
        <h2>RECIBO</h2>
        <h3>Nº <b>ASSG{{ str_pad($bill->id, 6, '0', STR_PAD_LEFT) }}PG</b></h3>
        <div class="valor">
            <h3>R$ {{ $bill->value }}</h3>
        </div>
    </div>
</div>
<div class="receipt-body">
    <table>
        <tr>
            <td colspan="3"><b>Pagamos à(ao):</b>
                @if ($bill->creditor_id != '')
                    {{ $bill->partner->name }}
                @else
                    {{ $bill->creditor }}
                @endif

            </td>
        </tr>
        <tr>
            <td colspan="3"><b>CPF / CNPJ:</b>
                @if ($bill->creditor_id != '')
                    @if ($bill->partner->pf_pj == 'pf')
                        {{ $bill->partner->cpf }}
                    @else
                        {{ $bill->partner->cnpj }}
                    @endif
                @else
                    {{ $bill->creditor_document }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="3"><b>Operador responsável:</b>
                @if ($bill->updated_by)
                    {{ mb_strtoupper($bill->updated_by) }}
                @else
                    {{ mb_strtoupper($bill->created_by) }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="width:40%;"><b>A importância de:</b> R$ {{ $bill->value }}</td>
            <td colspan="2"><b>Data:</b> {{ $bill->paid_in }}
                ( X )<b>PAGAMENTO</b> ( )<b>RECEBIMENTO</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>Referente à(ao):</b> {{ mb_strtoupper($bill->title) }}</td>
        </tr>
        <tr>
            <td colspan="2"><b>Assinatura:</b> </td>
            <td><b>Fone:</b>
                @if ($bill->creditor_id != '')
                    {{ $bill->partner->phone_first }}
                @endif
            </td>
        </tr>
    </table>
</div>

@if ($bill->updated_because)
    <div style="margin-top: 100px;">
        <h4>Alterações</h4>
        <p>
            {{ $bill->updated_because }}
        </p>
        <p>Alterado em: {{ $bill->updated_at }}, por: {{ $bill->updated_by }}.</p>
    </div>
@endif

</html>
