<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style>
    *{
	margin: 0px;
	padding: 0px;
	font-family: 'dejavusans';
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
#contract{
	width:100%;
	border:solid 2px #000;
}
#contract td{
	border:solid thin #000;
}
th {
	text-align: center;
	border:solid thin #000;
}
#clausula{
	text-align: justify;
	margin-top: 10px;
}
.contract{
	width:100%;
	border:solid 2px #000;
}
.contract body{
	width:100%;
}
.contract td{
	border:solid thin #000;
}
.table-signature{
    margin-top:50px;
    font-size:10pt;
    text-align: center;
    width:100%;
}
#pag{
	text-align: center;
}
#pag td{
	border:solid thin #000;
	font-size: 6pt;
}
.body_td{
    border-right:solid thin #000;
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
                            <th style="padding: 10px;">Nº</th>
                            <th style="padding: 10px;">DATA</th>
                            <th >TIPO</th>
                            <th >NOME</th>
                            <th >CATEGORIA</th>
                            <th >DESC</th>
                            <th >VALOR</th>
                            <th >PAGAMENTO</th>
                            <th >ATENDENTE</th>
                          </tr>
                    </thead>
                    <tbody>
                        {{ $i=1}}
                        @foreach ($data as $pay)
                            <tr >
                                <td class="body_td">{{$i}}</td>
                                <td class="body_td">{{$pay->paid_in}}</td>
                                <td class="body_td">{{mb_strtoupper($pay->type)}}</td>
                                <td class="body_td">{{$pay->partners->name}}</td>
                                <td class="body_td">{{$pay->partners->category->title}}</td>
                                <td class="body_td">{{$pay->title}}</td>
                                <td class="body_td">{{$pay->value}}</td>
                                <td class="body_td">{{$pay->payment}}</td>
                                <td class="body_td">{{$pay->created_by}}</td>
                            </tr>
                            {{ $i++}}
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
                        <td style="text-align: right;"><p style="border-top: solid thin #000; width:100%;">{{$config->president}}</p></td>
                        <!--<td ><p style="border-top: solid thin #000; width:100%;">{{$config->financial}}</p></td>-->
                    </tr>
                        <tr>
                            <td style="text-align: right;">Presidente do {{$config->acronym}}</td>
                            <!--<td> Financeiro do {{$config->acronym}}</td>-->
                        </tr>
                </table>

            </div>
        </div>
    </div>
</div>

</html>




