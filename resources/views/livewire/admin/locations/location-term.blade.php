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
    font-size: 10pt;
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

</style>
<div class="wrapper">
    {{-- Content Wrapper --}}
    <div class="content-wrapper">
        {{-- Content Header --}}
        <div class="content-header">
            <div class="pdf-header">
                <table style="width:100%">
                    <tr style="width:100%">
                        <td style="width:30%"><img style="width:5%;" src="{{url('storage/logos/assgapa.png')}}"></td>
                        <td style="width:55%;text-align:center">
                            <h2 style="margin-bottom:0px; padding-bottom: 0px;width:100%;text-align:center">
                                {{$config->acronym}}
                            </h2>
                        </td>
                        <td style="width:30%">
                            @if (isset($contract_number))
                            <div style="float:right;border:solid thin #fff;text-align:right;">
                                {{$contract_number}}
                            </div>
                        @endif
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        {{-- Main Content --}}
        <div class="content">
            <div class="pdf-body">
                <h5 style="margin:0px;padding:0px;">EVENTO DO DIA – {{ $location->location_date}} NO(A) {{ $location->ambiences->title}}</h5>
                <table class="MsoTableGrid" style="border-collapse:collapse; border:1pt solid black" cellspacing="0" border="1">
                    <tbody>
                        <tr>
                            <td colspan="8" style="vertical-align:top; width:549.4pt;text-align:center;">
                                <p style="margin-left:0cm; margin-right:0cm;">
                                    <span style="font-size:11pt">
                                        <span style="font-family: Calibri, sans-serif; font-size: 12px;">
                                            LOCATÁRIO: {{ $location->partners->name }}
                                        </span>
                                    </span>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="term" >
                    {!!  $location->ambiences->term !!}
                </div>
                <table style="margin-top: 5px; width: 100%;">
                    <tr >
                        <td style="text-align: right;">Canoas, {{$today}}.</td>
                    </tr>
                </table>
                <table class="table-signature" >
                        <tr>
                            <td ><p style="border-top: solid thin #000; width:100%;">{{$location->partners->name}}</p></td>
                            <td ><p style="border-top: solid thin #000; width:100%;">{{$responsible}}</p></td>
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




