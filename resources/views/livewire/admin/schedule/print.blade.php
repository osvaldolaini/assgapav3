<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style>
*{
	margin: 0px;
	padding: 0px;
	font-family: "arial";
	font-size: 12px;
}
.pdf-header #img{
    width: 100%;
}
.pdf-header #about{
    width: 100%;
    font-size: 12pt;
}
.pdf-header #about h6, h4{
    margin: 0px;
	padding: 0px;
}
.value{
    white-space: nowrap;
}
.content-wrapper{
	margin-left: 10px;
	width:100%;
	text-align: center;
	/*border:solid thin #000;*/
}
.table-informations{
    border:solid 2px #000;
    font-size:8pt;
    text-align: center;
    width:100%;
}
td{
    padding: 0 5px;
}
.pdf-body{
    width:100%;
}
.table-informations thead{
    text-align: center;
    background-color: #ccc;
}
.table-informations thead tr , .table-informations tfoot tr{
    border:solid 2px #000;
}
.table-informations .tfoot tr{
    border:solid 2px #000;
}
.table-informations thead tr th , .table-informations tfoot tr td{
    border-right: solid thin #000;
}
.table-informations .tfoot tr td{
    border-right: solid thin #000;
}
.exits{
    color:#ff0000;
}
.table-informations tbody tr td{
    border-right: solid thin #000;
    border-top: solid thin #000;
}
.table-abstract{
    margin-top:15px;
    border:solid 2px #000;
    font-size:8pt;
    text-align: center;
    width:100%;
}
.table-abstract .head{
    border:solid 2px #000;
    text-align: center;
    background-color: #ccc;
}
.table-abstract td{
    border:solid thin #000;
}
.table-signature{
    margin-top:50px;
    font-size:10pt;
    text-align: center;
    width:100%;
}
.term{
    margin-top:0px;
    padding-top:0px;
    font-size: 10pt;
}
.term table{
font-size: 10pt;
}
.schedule{
    width:100%;
    border:solid 2px #000;
}
.schedule #head{
    background-color: #ccc;
    border:solid 2px #000;
}
.schedule th{
    border:solid thin #000;
}
.schedule td{
    border:solid 1px #000;
}


</style>
<div class="wrapper">
    {{-- Content Wrapper --}}
    <div class="content-wrapper">
        {{-- Content Header --}}
        <div class="content-header">
            <div class="pdf-header">
                <div >
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
                                <tr >
                                    <td><?= $installment->title; ?></td>
                                    <td>R$ {{ $installment->value }}</td>
                                    <td>
                                    @if ($installment->value == 1)
                                        {{ $installment->updated_at }}
                                    @else
                                        {{ $installment->installment_maturity_date }}
                                    @endif
                                    </td>
                                    <td>
                                        <?php if($installment->active!='0'){
                                            echo '<b>X</b>';
                                        }?>
                                    </td>
                                </tr>
                            <?php }?>
                        </table>
                        @endif
                    </div>
                        <div style="width:35%;float:left;border:solid 2px #fff;">
                            <img style="width:20%;" src="{{url('storage/logos/assgapa.png')}}">
                        </div>
                    @if (isset($contract_number))
                        <div style="width:20%;float:right;border:solid thin #fff;text-align:right;">{{$contract_number}}</div>
                    @endif
                </div>
                <div id="about" style="margin-top:0px; padding-top: 0px;">
                    <h5 style="margin-bottom:0px; padding-bottom: 0px;">{{$config->title}}</h5>
                    <h6 style="margin-bottom:0px; padding-bottom: 0px;">{{$config->address. ' - ' .$config->city.'/'.$config->state. ', Fone/Fax: '. $config->phone}}</h6>
                    <h5 style="margin-bottom:0px; padding-bottom: 0px;"><strong>{{$subtext}}</strong></h5>
                </div>
            </div>
        </div>
        {{-- Main Content --}}
        <div class="content">
            <div class="pdf-body">
                <!--Dados do cliente-->
                <table class='schedule' cellspacing="0" >
                    <tr id="head">
                        <th >Dia</th>
                        <th >Horário</th>
                        <th >Local</th>
                        <th >Locatário</th>
                        <th >Beneficiado</th>
                        <th >Motivo</th>
                    </tr>
                    @php
                        $d=0;
                    @endphp
                    @foreach ($data as $key)
                    @php
                        $d1 = $key->location_date;
                    @endphp
                    @if ($d != $d1)
                        <tr style="background-color: #ffff00;">
                            <td colspan="6" >{{$key->location_date}}</td>
                        </tr>
                    @endif
                        <tr  >
                            <td >{{$key->location_date}}</td>
                            <td >
                                @if ($key->ambiences->multiple)
                                    DAS {{ date('H:i',strtotime($key->location_hour_start)) }} ÀS {{ date('H:i',strtotime($key->location_hour_end)) }}
                                @endif
                            </td>
                            <td >{{mb_strtoupper($key->ambiences->title)}}</td>
                            <td >{{mb_strtoupper(($key->partners ? $key->partners->name : $key->partner))}}</td>
                            <td >{{mb_strtoupper($key->event_benefited)}}</td>
                            <td >{{mb_strtoupper(($key->reason ? $key->reason->title : $key->reason_event_id))}}</td>
                        </tr>
                        @php
                            $d = $d1;
                        @endphp
                    @endforeach

                </table>
                <table style="margin-top: 25px; width: 100%;">
                    <tr >
                        <td style="text-align: right;">Canoas,{{ $today }}.</td>
                    </tr>
                </table>
                <table class="table-signature" >
                    <tr>
                        <td style="text-align:left;">Canoas, {{ $today }}.</td>
                        <td style="border-top: solid thin #000;">{{ $responsible }}</td>
                    </tr>
                    <tr>
                        <td ></td>
                        <td>Diretor(a) da Secretaria</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

</html>




