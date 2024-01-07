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
                <table class="table-informations" style="text-align:left;" cellspacing="0">
                    <thead >
                        <tr >
                            <th >Categoria</th>
                            <th >Recibo</th>
                            <th >Item</th>
                            <th >Valor</th>
                          </tr>
                    </thead>
                    <tbody>

                        @foreach ($spendings as $spendings)
                        <tr style="background-color: {{$spendings['color']}}">
                            <td style="border-right: solid thin #000;border-top: solid thin #000;" >
                                {{$spendings['category']}}
                            </td>
                            <td style="border-right: solid thin #000;border-top: solid thin #000;" >
                                {{str_pad($spendings['id'], 5, '0', STR_PAD_LEFT)}}
                            </td>
                            <td  style="border-right: solid thin #000;border-top: solid thin #000;">
                                {{$spendings['title']}}
                            </td>
                            <td class="value" style="border-right: solid thin #000;border-top: solid thin #000;">
                              {{$spendings['value']}}
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
                <table style="font-size:8pt; margin-left: 50%; margin-top: 20px;" width="50%" cellspacing="0">
                    <tr style="font-size:8pt;background-color: #ccc;">
                        <td style="border:solid 2px #000;" colspan="2">
                            Gastos por centro de custo
                        </td>
                    </tr>

                        @foreach ($categories as $category)
                          <tr style="border:solid thin #000; background-color:{{$category['color']}} ">
                            <td style="border:solid thin #000;">{{$category['category']}}</td>
                            <td class="value" style="border:solid thin #000;">{{'R$ '. number_format($category['val'],2,",",".")}}</td>
                          </tr>
                        @endforeach
                            <tr>
                                <td style="border:solid thin #000;">TOTAL</td>
                                <td class="value" style="border:solid thin #000;">{{$total}}</td>
                            </tr>
                </table>
                <table style="margin-top: 25px; width: 100%;">
                    <tr >
                        <td style="text-align: right;">Canoas, {{$today}}.</td>
                    </tr>
                </table>
                <table class="table-signature" >
                    <tr>
                        <td ><p style="border-top: solid thin #000; width:100%;">{{$config->signature}}</p></td>
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
