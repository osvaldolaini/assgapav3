<!DOCTYPE html>
<html>
<head>
    <title>Carteirinhas</title>
</head>
<style>
    * {
    margin: 0px;
    padding: 0px;
    font-family: arial;
}

.carteirinha {
    width: 100%;
}

.cartao {
    width: 9cm;
    height: 6.4cm;
    margin-top: 0px;
    margin-left: 1px;
    margin-right: 1px;
    margin-bottom: 0.5cm;
    float: left;
    /*background-image: url('assets/css/img/logo.png');
  background-repeat: no-repeat;
  background-position: right bottom;
  background-image-opacity: 0.3;*/
}

.logo {
    margin-top: 0.125cm;
    margin-left: 0.125cm;
    width: 1.5cm;
    float: left;
}

.frente {
    margin-top: 0.125cm;
    margin-left: 0.125cm;
    width: 8.875cm;
    height: 6.275cm;
    float: left;
}

.verso {
    /*background-image: url('storage/images/logos/img2.png');*/
    background-repeat: no-repeat;
    background-position: right bottom;
    background-image-opacity: 0.3;
    margin-top: 0.125cm;
    margin-left: 0.125cm;
    width: 8.875cm;
    height: 6.275cm;
    float: left;
}

.dadosVerso {
    width: 8cm;
    height: 3cm;
    margin-left: 0.2cm;
    float: left;
}

.assinatura {
    width: 100%;
    height: 2cm;
    margin-left: 0.2cm;
    float: left;
}

p {
    padding: 0px;
    margin: 0px;
    font-size: 7pt;
    font-family: arial;
}

.cabecalho-frente {
    margin-top: 0.2cm;
    width: 99%;
    height: 1cm;
    text-align: center;
    font-family: arial;
    font-style: bold;
    font-size: 8pt;
    margin-bottom: 0.2cm;
}

.dados {
    width: 5.5cm;
    height: 2.175cm;
    margin-left: 0.125cm;
    float: left;
}

.dados td {
    font-family: arial;
    font-size: 8pt;
}

.foto {
    width: 2.5cm;
    height: 2.175cm;
    margin-left: 0.125cm;
    /*border:solid 1px #000;*/
    float: left;
}

.foto img {
    height: 100%;
}
</style>
<body>
    @foreach ($cards as $card)
        <div class="cartao" style="margin-top: 0px;">
            <div class="frente" style="border:double 0.2cm {{$card['color']}};  ">
                <img class="logo" src="{{url('storage/logos/assgapa.png')}}">
            <div class="cabecalho-frente">
                <strong> ASSOCIAÇÃO DE SUBOFICIAIS E SARGENTOS
                DA GUARNIÇÃO DE AERONÁUTICA
                DE PORTO ALEGRE</strong>
            </div>

                <div class="foto"><img style='width: 100%; height: 100%;' src="{{url('storage/partners/'.$card['image'])}}"></div>
                <div class="dados">
                    <table>
                        <tr><td colspan="2"><b>Nome:</b></td></tr>
                        <tr><td colspan="2">{{$card['name']}}</td></tr>
                        <tr><td width="60%;"><b>Categoria:</b></td><td><b>Nº:</b></td></tr>
                        <tr><td>{{$card['category']}}</td><td>{{$card['id']}}</td></tr>
                        <tr><td width="60%;"><b>CPF:</b></td><td><b>Nascimento:</b></td></tr>
                        <tr><td>{{$card['cpf']}}</td><td>{{$card['date_of_birth']}}</td></tr>
                    </table>

                </div>
                <p style="margin-left: 0.125cm; margin-top:3px;"><b>Emissão: </b> {{date( 'd/m/Y')}}</p>
                <p style="margin-left: 0.125cm; margin-top:3px;"><b>Validade: </b> {{ $card['validity_of_card']}}</p>
            </div>
        </div>
        <div class="cartao" style="margin-top: 0px;">
            <div class="verso" style="background-color:{{$card['color']}};  border:double 0.2cm {{$card['color']}};  ">
                <div class="dadosVerso">
                    <img style="height: 2cm;padding-top:5px;" src="{{url('storage/livewire-tmp/'.$card['qrcode'])}}">
                    <?php
                        if($card['responsavel'] !=''){
                            echo '<div style="font-family:arial;float: right;"><b>Responsável: </b> '.$card['responsavel'].'</div>';
                        }
                    ?>

                </div>
                <!-- Assinatura -->
                <div class="assinatura">
                    <div style="text-align:center; float: left; width:6cm; ">
                        <img style="height: 4cm;margin-top: 10px;" src="{{url('storage/logos/signature-3.png')}}">
                        <p style="margin-top: -25px; border-top: solid 0.8px #000;">Presidente do ASSGAPA</p>
                        <p style="text-decoration: uppercase;"><STRONG>{{ mb_strtoupper($config->president) }}</STRONG></p>
                    </div>
                    <div style="float: left;">
                        <img style="height: 3cm;" src="{{url('storage/logos/assgapa.png')}}">
                    </div>
                </div>
                <!-- Assinatura -->

            </div>

        </div>
    @endforeach


    <!-- Adicione mais conteúdo conforme necessário -->
</body>
</html>




