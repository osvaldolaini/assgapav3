<style>
    body {
        font-family: sans-serif;
        font-size: 10pt;
    }

    h1 {
        text-align: center;
        margin: 0;
        font-size: 18pt;
    }

    h2 {
        text-align: center;
        margin: 0 0 15px 0;
        font-size: 11pt;
        font-weight: normal;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 8px;
    }

    td {
        border: 1px solid #000;
        padding: 6px;
        vertical-align: top;
    }

    .section {
        background: #E6E6E6;
        font-weight: bold;
        text-transform: uppercase;
    }

    .line {
        margin-top: 18px;
        border-bottom: 1px solid #000;
        height: 16px;
    }

    .obs {
        height: 90px;
    }

    .assinatura {
        width: 42%;
        display: inline-block;
        text-align: center;
        margin-top: 60px;
    }

    .assinatura .line {
        margin-bottom: 5px;
    }
</style>
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
{{-- Content Header --}}
<div class="content-header">
    <div class="pdf-header">
        <div align="center">

            <div style="float:left;border:solid 2px #fff;" align="center">
                <img style="width:8%;" src="{{ url('storage/logos/assgapa.png') }}">
            </div>

        </div>
        <div id="about" style="margin-top:0px; padding-top: 0px;" align="center">
            <h5 style="margin-bottom:0px; padding-bottom: 0px;" align="center">{{ $config->title }}</h5>
            <h6 style="margin-bottom:0px; padding-bottom: 0px;" align="center">
                {{ $config->address . ' - ' . $config->city . '/' . $config->state . ', Fone: ' . $config->phone }}
                {{ $config->whatsapp ? ',Whatsapp: ' . $config->whatsapp : '' }}
            </h6>
            <h6 style="margin-bottom:0px; padding-bottom: 0px;" align="center">Chave PIX - CNPJ {{ $config->cnpj }}</h6>
            <H2 style="margin-bottom:0px; padding-bottom: 0px;">FICHA CADASTRAL</H2>
        </div>
    </div>
</div>
<h2></h2>
<table>

    <tr>
        <td>
            Nome Completo
            <div class="line"></div>
        </td>
    </tr>

</table>

<table>

    <tr>
        <td colspan="4" class="section">
            Dados Pessoais
        </td>
    </tr>

    <tr>

        <td>
            Nascimento
            <div class="line"></div>
        </td>



        <td>
            Sócio
            <div class="line"></div>
        </td>
        <td colspan="2">
            Categoria
            <div class="line"></div>
        </td>

    </tr>

    <tr>
        <td colspan="2">
            CPF / CNPJ
            <div class="line"></div>
        </td>
        <td colspan="2">
            RG
            <div class="line"></div>
        </td>


    </tr>

    <tr>



        <td colspan="2">
            SARAM
            <div class="line"></div>
        </td>

        <td colspan="2">
            Novo SARAM
            <div class="line"></div>
        </td>

    </tr>

</table>

<table>

    <tr>
        <td colspan="4" class="section">
            Contato
        </td>
    </tr>

    <tr>

        <td colspan="2">
            E-mail
            <div class="line"></div>
        </td>


        <td colspan="2">
            Celular
            <div class="line"></div>
        </td>

    </tr>

</table>

<table>

    <tr>
        <td colspan="4" class="section">
            Dados do Associado
        </td>
    </tr>

    <tr>

        <td colspan="2">
            Categoria
            <div class="line"></div>
        </td>

        <td>
            Desconto Folha: Sim ( ) / Não ( )
        </td>


        <td>
            Parentesco
            <div class="line"></div>
        </td>

    </tr>

    <tr>

        <td colspan="4">
            Responsável
            <div class="line"></div>
        </td>

    </tr>

</table>

<table>

    {{-- <tr>
        <td colspan="5" class="section">
            Datas
        </td>
    </tr>

    <tr>

        <td>
            Cadastro
            <div class="line"></div>
        </td>

        <td>
            Validade Carteirinha
            <div class="line"></div>
        </td>

        <td>
            Prazo Piscinas
            <div class="line"></div>
        </td>

        <td>
            Impressão
            <div class="line"></div>
        </td>

        <td>
            Carência
            <div class="line"></div>
        </td>

    </tr> --}}

</table>

<table>

    <tr>
        <td colspan="4" class="section">
            Endereço
        </td>
    </tr>

    <tr>

        <td>
            CEP
            <div class="line"></div>
        </td>

        <td colspan="2">
            Rua
            <div class="line"></div>
        </td>

        <td>
            Número
            <div class="line"></div>
        </td>

    </tr>

    <tr>

        <td>
            Bairro
            <div class="line"></div>
        </td>

        <td colspan="2">
            Cidade
            <div class="line"></div>
        </td>

        <td>
            UF
            <div class="line"></div>
        </td>

    </tr>

</table>

<table>

    <tr>
        <td class="section">
            Observações
        </td>
    </tr>

    <tr>
        <td class="obs">

        </td>
    </tr>

</table>


<div style="float:right" class="assinatura">
    <div class="line"></div>
    Associado
</div>
