<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style>
*{
  margin: 0px;
  padding:0px;
  font-family: arial;
}
.receipt-body{
	margin-top: 20px;
	width: 100%;
}
.receipt-body table{
	width: 100%;
}
.receipt-body table td{
	border-bottom: solid thin #000;
}
.dashed{
	  margin: 20px;
	border-bottom: dashed thin #000;
}
.receipt-head{
  padding:1.5pt;
}
.imagem{
	width:20%;
	float: left;
	border-right: solid thin #000;
	padding-right: 10px;
}
i{
	min-width: 100%;
	border-bottom: solid thin #000;
}
h6, h5, h4, h3, h2{
	margin: 0px;
  	padding:0px;
}
p{
	font-size: 7pt;
	margin:0px;
  	padding:0px;
}
.titulo{
	width:50%;
	float: left;
	text-align:center;
}
.rec{
	font-weight: 400px;
	float: left;
	text-align:center;
}
.valor{
	margin-top: 10px;
	width:100%;
	border: solid 1px #000;
	text-align:left;
	padding: 5px;
	float: bottom;
}


</style>
<div class="receipt-head">
    <div class="imagem">
        <img src="{{url('storage/logos/assgapa.png')}}">
    </div>
    <div class="titulo">
        <h5 >
            {{$config->title}}
        </h5>
        <h5 style="margin-bottom: 10px;">CNPJ {{$config->cnpj}}</h5>
        <p>{{$config->address}} - {{$config->city}} / {{$config->state}} - CEP {{$config->postalCode}}</p>

        <p>Contato(s): {{$config->phone}}</p>
    </div>
    <div class="rec">
        <h2>RECIBO</h2>
        <h3>Nº <b>ASSG{{str_pad($received->id, 6, '0', STR_PAD_LEFT)}}RC</b></h3>
        <div class="valor"><h3>R$ {{$received->value}}</h3></div>
    </div>
</div>
<div class="receipt-body">
    <table>
        <tr>
            <td colspan="3" ><b>Recebemos de:</b> {{mb_strtoupper($received->partners->name)}}</td>
        </tr>
        <tr>
            <td colspan="3"><b>Endereço:</b> {{mb_strtoupper($received->partners->address)}}, {{mb_strtoupper($received->partners->district)}} - {{mb_strtoupper($received->partners->city)}} / {{mb_strtoupper($received->partners->state)}} </td>
        </tr>
        <tr>
            <td colspan="3"><b>Operador responsável:</b>
                @if ($received->updated_by) {{mb_strtoupper($received->updated_by)}}
                @else
                    {{mb_strtoupper($received->created_by)}}
                @endif</td>
        </tr>
        <tr>
            <td style="width:40%;"><b>A importância de:</b> R$ {{$received->value}} </td>
            <td colspan="2"><b>Data:</b> {{$received->paid_in}}
            (  )<b>PAGAMENTO</b> ( X )<b>RECEBIMENTO</b></td>
        </tr>
        <tr>

            <td colspan="3"><b>Referente à(ao):</b> {{mb_strtoupper($received->title)}}
                @if ($received->location_id)
                - {{mb_strtoupper($received->location->ambiences->title)}}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Assinatura:</b> </td>
            <td ><b>Fone:</b> {{$received->partners->phone_first}}</td>
        </tr>

    </table>
</div>
<div class="dashed"></div>
<div class="receipt-head">
    <div class="imagem">
        <img src="{{url('storage/logos/assgapa.png')}}">
    </div>
    <div class="titulo">
        <h5 >
            {{$config->title}}
        </h5>
        <h5 style="margin-bottom: 10px;">CNPJ {{$config->cnpj}}</h5>
        <p>{{$config->address}} - {{$config->city}} / {{$config->state}} - CEP {{$config->postalCode}}</p>

        <p>Contato(s): {{$config->phone}}</p>
    </div>
    <div class="rec">
        <h2>RECIBO</h2>
        <h3>Nº <b>ASSG{{str_pad($received->id, 6, '0', STR_PAD_LEFT)}}RC</b></h3>
        <div class="valor"><h3>R$ {{$received->value}}</h3></div>
    </div>
</div>
<div class="receipt-body">
    <table>
        <tr>
            <td colspan="3" ><b>Recebemos de:</b> {{mb_strtoupper($received->partners->name)}}</td>
        </tr>
        <tr>
            <td colspan="3"><b>Endereço:</b> {{mb_strtoupper($received->partners->address)}}, {{mb_strtoupper($received->partners->district)}} - {{mb_strtoupper($received->partners->city)}} / {{mb_strtoupper($received->partners->state)}} </td>
        </tr>
        <tr>
            <td colspan="3"><b>Operador responsável:</b>
                @if ($received->updated_by) {{mb_strtoupper($received->updated_by)}}
                @else
                    {{mb_strtoupper($received->created_by)}}
                @endif</td>
        </tr>
        <tr>
            <td style="width:40%;"><b>A importância de:</b> R$ {{$received->value}} </td>
            <td colspan="2"><b>Data:</b> {{$received->paid_in}}
            (  )<b>PAGAMENTO</b> ( X )<b>RECEBIMENTO</b></td>
        </tr>
        <tr>

            <td colspan="3"><b>Referente à(ao):</b> {{mb_strtoupper($received->title)}}
                @if ($received->location_id)
                - {{mb_strtoupper($received->location->ambiences->title)}}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Assinatura:</b> </td>
            <td ><b>Fone:</b> {{$received->partners->phone_first}}</td>
        </tr>

    </table>
</div>
    {{-- @if($received->form_payment=='CAR') --}}
        <div style="border: dashed 1px #000; width: 6cm; height: 6cm; margin-top: 20px;">
            <h3 style="text-align: center;margin-top: 25%;">
                @if ($received->form_payment=='CAR')
                    Cole aqui o recibo da maquinhinha
                @endif
                @if ($received->form_payment=='BOL')
                    Pago com boleto
                @endif
                @if ($received->form_payment=='DIN')
                    Pago com dinheiro
                @endif
                @if ($received->form_payment=='PIX')
                    Pago com PIX
                @endif
            </h3>
        </div>
    {{-- @endif --}}
    @if($received->obs)
        <div style="margin-top: 10px;">
            <h4>*Observação</h4>
            <p>
                {{$received->obs}}
            </p>
        </div>
    @endif
    @if($received->updated_because)
        <div style="margin-top: 50px;">
            <h4>Alterações</h4>
            <p>
                {{$received->updated_because}}
            </p>
            <p>Alterado em: {{$received->updated_at}}, por: {{$received->updated_by}}.</p>
        </div>
    @endif

</html>
