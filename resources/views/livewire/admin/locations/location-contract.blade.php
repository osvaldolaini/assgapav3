<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>
<style>
    * {
        margin: 0px;
        padding: 0px;
        font-family: 'dejavusans';
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

    #contract {
        width: 100%;
        border: solid 2px #000;
    }

    #contract td {
        border: solid thin #000;
    }

    th {
        text-align: center;
        border: solid thin #000;
    }

    #clausula {
        text-align: justify;
        margin-top: 10px;
    }

    .contract {
        width: 100%;
        border: solid 2px #000;
    }

    .contract body {
        width: 100%;
    }

    .contract td {
        border: solid thin #000;
    }

    .table-signature {
        margin-top: 50px;
        font-size: 10pt;
        text-align: center;
        width: 100%;
    }

    #pag {
        text-align: center;
    }

    #pag td {
        border: solid thin #000;
        font-size: 6pt;
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
                        @if (isset($location->installments))
                            <table id="pag" cellspacing="0">
                                <tr>
                                    <td>Parcela</td>
                                    <td>Valor</td>
                                    <td>Vencimento</td>
                                    <td>Pago</td>
                                </tr>
                                <?php foreach ($location->installments as $installment) {?>
                                <tr>
                                    <td><?= $installment->title ?></td>
                                    <td>R$ {{ $installment->value }}</td>
                                    <td>
                                        @if ($installment->value == 1)
                                            {{ $installment->updated_at }}
                                        @else
                                            {{ $installment->installment_maturity_date }}
                                        @endif
                                    </td>
                                    <td>
                                        <?php if ($installment->active != '0') {
                                            echo '<b>X</b>';
                                        } ?>
                                    </td>
                                </tr>
                                <?php }?>
                            </table>
                        @endif
                    </div>
                    <div style="width:35%;float:left;border:solid 2px #fff;">
                        <img style="width:20%;" src="{{ url('storage/logos/assgapa.png') }}">
                    </div>
                    @if (isset($contract_number))
                        <div style="width:20%;float:right;border:solid thin #fff;text-align:right;">
                            {{ $contract_number }} -</div>
                    @endif
                </div>
                <div id="about" style="margin-top:0px; padding-top: 0px;">
                    <h5 style="margin-bottom:0px; padding-bottom: 0px;">{{ $config->title }}</h5>
                    <h6 style="margin-bottom:0px; padding-bottom: 0px;">
                        {{ $config->address . ' - ' . $config->city . '/' . $config->state . ', Fone/Fax: ' . $config->phone }}
                        {{ $config->whatsapp ? '- ' . $config->whatsapp : '' }}
                    </h6>
                    <h5 style="margin-bottom:0px; padding-bottom: 0px;"><strong>{{ $subtext }}</strong></h5>
                </div>
            </div>
        </div>
        {{-- Main Content --}}
        <div class="content">
            <div class="pdf-body">
                <table id='contract' cellspacing='0px'>
                    <tr>
                        <th colspan="5">Dados do Contratante</th>
                    </tr>
                    <tr>
                        <td colspan="4">Contratante: {{ $location->partners->name }}
                            @if ($location->partners->parent)
                                <br /> (<span
                                    style='font-size:8pt;'>Associado:{{ $location->partners->parent->name }}</span>)
                            @endif
                        </td>
                        <td>
                            {{ $location->partners->pf_pj == 'pf' ? 'CPF' : 'CNPJ' }}:
                            {{ $location->partners->pf_pj == 'pf' ? $location->partners->cpf : $location->partners->cnpj }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Sócio?:
                            @switch($location->partners->partner_category_master)
                                @case('Sócio')
                                    Sim
                                @break

                                @case('Não sócio')
                                    Não
                                @break

                                @case('Dependente')
                                    Dependente
                                @break
                            @endswitch
                        </td>
                        <td colspan="3">Categoria: {{ $location->partners->category->title }}</td>
                    </tr>
                    <tr>
                        <td>Identidade: {{ $location->partners->rg }}</td>
                        <td colspan="3">Email: {{ $location->partners->email }}</td>
                        <td>Contato: {{ $location->partners->phone_first }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Residente: {{ $location->partners->address }}
                            @if ($location->partners->end_num != '')
                                {{ ', ' . $location->partners->end_num }}
                            @endif
                        </td>
                        <td>Bairro: {{ $location->partners->dictrict }}</td>
                        <td>Cidade: {{ $location->partners->city }}</td>
                    </tr>
                    <tr>
                        <th colspan="5">Dados do Espaço</th>
                    </tr>
                    <tr>
                        <td colspan="4">Ambiente: {{ $location->ambiences->title }}</td>
                        <td>Capacidade: {{ $location->ambiences->capacity }} pessoa(s)</td>
                    </tr>
                    <tr>
                        <td colspan="2">Funcionamento final de semana:</td>
                        <td colspan="3">{{ $location->ambiences->time_weekend }}</td>
                    <tr>
                    <tr>
                        <td colspan="2">Funcionamento dias de semana:</td>
                        <td colspan="3">{{ $location->ambiences->time_week }}</td>
                    <tr>
                        <td colspan="2">Dia do evento: {{ $location->location_date }}</td>
                        <td colspan="3">Valor da locação: R$ {{ $location->value }}</td>
                        {{-- <td colspan="2">Valor caução: R$ {{ $location->deposit }}</td> --}}
                    </tr>

                    @if ($location->ambiences->multiple)
                        <tr>
                            <td colspan="2">Hora do início:
                                {{ date('H:i', strtotime($location->location_hour_start)) }}</td>
                            <td colspan="3">Hora do término:
                                {{ date('H:i', strtotime($location->location_hour_end)) }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Horário: {{ $location->loc_time }}</td>
                            <td colspan="2">Adicional: R$ {{ $location->value_extra }}</td>
                        </tr>
                    @endif
                    @if ($location->extras)
                        <tr>
                            <td colspan="2">
                                Segurança(s):
                                @if ($location->extras->qtd_security >= 1)
                                    ( {{ $location->extras->qtd_security }} ) R$ {{ $location->extras->security }}
                                @else
                                    Não
                                @endif
                            </td>
                            <td colspan="3">
                                Zelador(es):
                                @if ($location->extras->qtd_janitor >= 1)
                                    ( {{ $location->extras->qtd_janitor }} ) R$ {{ $location->extras->janitor }}
                                @else
                                    Não
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Brigadista(s):
                                @if ($location->extras->qtd_brigade >= 1)
                                    ( {{ $location->extras->qtd_brigade }} ) R$ {{ $location->extras->brigade }}
                                @else
                                    Não
                                @endif
                            </td>
                            <td colspan="3">
                                Brinquedos infláveis:
                                @if ($location->extras->qtd_inflatable >= 1)
                                    ( {{ $location->extras->qtd_inflatable }} ) R$ {{ $location->extras->inflatable }}
                                @else
                                    Não
                                @endif
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <td colspan="5">Motivo do evento:
                            {{ mb_strtoupper($location->reason_event_id ? $location->reason->title : $location->event_type) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Beneficiado do evento:
                            {{ mb_strtoupper($location->event_benefited) }}
                        </td>
                        <td colspan="2">Quantidade de convidados:
                            {{ $location->guests }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5">Obs: <?= $location->ambiences->obs ?>

                            @if ($location->obs)
                                <p style="color:#f00; margin-bottom:5px;">
                                    ** {{ $location->obs }}
                                </p>
                            @endif
                        </td>
                    </tr>

                    @if ($location->updated_because)
                        <tr>
                            <td colspan="5">Alteração de contrato: <?= $location->updated_because ?></td>
                        </tr>
                    @endif
                    @if ($location->cashback > 0)
                        <tr>
                            <th colspan="5">Cashback de indicação para</th>
                        </tr>
                        <tr>
                            <td colspan="3">Nome: <?= $location->indication->name ?></td>
                            <td colspan="2">Valor: R$ {{ $location->cashback }}</td>
                        </tr>
                    @endif
                </table>
                <div id="clausula">
                    {!! $location->ambiences->contract !!}
                </div>
                <table style="margin-top: 25px; width: 100%;">
                    <tr>
                        <td style="text-align: right;">Canoas, {{ $today }}.</td>
                    </tr>
                </table>
                <table class="table-signature" style="width: 100%;">
                    <tr>
                        <td>
                            <p style="border-top: solid thin #000; width:100%;">{{ $location->partners->name }}</p>
                        </td>
                        <td>
                            <p style="border-top: solid thin #000; width:100%;">{{ $responsible }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Contratante</td>
                        <td>Diretor</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>

</html>
