
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Styling -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600|Raleway:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href="clientarea/css/all.min.css?v=5a4e37" rel="stylesheet">
<link href="clientarea/css/hostwhmcs-style.css" rel="stylesheet">
<link href="clientarea/css/theme-color-11.css" rel="stylesheet">
<link href="clientarea/wizard/css/smart_wizard.css" rel="stylesheet" type="text/css" /> 
<link href="clientarea/wizard/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
<!-- Custom Styling -->
<link rel="stylesheet" href="clientarea/css/custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha256-xykLhwtLN4WyS7cpam2yiUOwr709tvF3N/r7+gOMxJw=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" integrity="sha256-vHGOIPxeMV4uIsqGDzob0M6Zl8PY5+nJh7m0hJhJXfg=" crossorigin="anonymous" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script type="text/javascript">
    var csrfToken = 'a90525ffe5008c8fbbb0c20c50f4146ffbb31c60',
        markdownGuide = 'Guía de Markdown',
        locale = 'es',
        saved = 'guardado',
        saving = 'guardando';
</script>
<script src="clientarea/js/scripts.min.js?v=5a4e37"></script>
<script>
<?php  
    
    use yii\helpers\Url;

    echo 'var baseurl = "'. Url::base('http').'"';  ?>
</script>


    

</head>
<body>
<!-- Preloader Start -->
<div id="preloader">
    <div class="preloader loading">
        <span class="slice"></span>
        <span class="slice"></span>
        <span class="slice"></span>
        <span class="slice"></span>
        <span class="slice"></span>
        <span class="slice"></span>
    </div>
</div>
<!-- Preloader End -->


<!-- Header Area Start -->
<header id="header">
    <!-- Header Navbar Start -->
    <nav class="header--navbar navbar navbar-fixed-top">
<!--         <section id="topNav">
            <div class="container">
                <ul class="logo-container">
                    <img alt="Kropsys" src="{{ url('/themes/default/img/logo.gif') }}"  height="32px">
                </ul>
                <ul class="top-nav">
                                                                <li>
                            <a href="#" data-toggle="popover" id="accountNotifications" data-placement="bottom">
                                Notificaciones
                                                                <b class="caret"></b>
                            </a>
                            <div id="accountNotificationsContent" class="hidden">
                                <ul class="client-alerts">
                                                                    <li class="none">
                                        No tiene notificaciones en este momento.
                                    </li>
                                                                </ul>
                            </div>
                        </li>
                        <li class="primary-action">
                            <a href="{{ route('auth/logout') }}" class="btn">
                                Salir
                            </a>
                        </li>
                    </ul>
            </div>
        </section>
 -->
        <div id="main-menu">
            <nav id="nav" class="navbar navbar-default navbar-main" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-nav">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="primary-nav">
                        <ul class="nav navbar-nav">
                                 
    <li menuItemName="Home" class="" id="Primary_Navbar-Home">
        <a href="#">
                        Área de Clientes
                                </a>
            </li>
     
<!-- 
    <li menuItemName="Open Ticket" class="" id="Primary_Navbar-Open_Ticket">
        <a href="{{ route('abrirticket')}}">
                        Abrir Ticket
                                </a>
            </li> -->
     
   <!--  <li menuItemName="Affiliates" class="" id="Primary_Navbar-Affiliates">
        <a href="/affiliates.php">
                        Invita y Gana
                                </a>
            </li> -->

                        </ul>
 
                    </div>
                </div>
            </nav>
        </div>
    </nav>
    <!-- Header Navbar End -->
</header>
<!-- Header Area End -->

<section id="main-body">
    <div class="container">
     <?php echo $content; ?>
    </div>
</section>

<!-- Footer Area Start -->
<footer id="footer">
    <div class="container">
        <!-- Footer Background Image Start -->
        <div class="footer--bg"></div>
        <!-- Footer Background Image End -->
        <div class="row">
            <!-- Footer Widget Start -->
            <div class="col-md-4 footer--widget">
                <!-- Footer About Widget Start -->
                <div class="footer--about">
                    <h2>Sobre nosotros</h2>
                    <p></p>
                </div>
                <!-- Footer About Widget End -->
            </div>
            <!-- Footer Widget End -->
            <!-- Footer Widget Start -->
            <div class="col-md-4 footer--widget">
                <!-- Footer Links Widget Start -->
                <div class="footer--links">
                    <h2>Links de utilidad</h2>
                    <ul>
                        <li><a href="#><i class="fa fm fa-angle-double-right"></i>Preguntas Frecuentes</a></li>
                        <li><a href="#"><i class="fa fm fa-angle-double-right"></i>Terminos de servicio</a></li>
                        <li><a href="#"><i class="fa fm fa-angle-double-right"></i>Privacidad</a></li>
                    </ul>
                </div>
                <!-- Footer Links Widget End -->
            </div>
            <!-- Footer Widget End -->
            <!-- Footer Widget Start -->
            <div class="col-md-4 footer--widget">
                <!-- Footer Contact Widget Start -->
                <div class="footer--contact">
                    <h2 id="contacto">Contacto</h2>
                    <!-- <a id="open_livechat" href="#" class="btn-block btn--primary btn--ripple"><i class="fa fm fa-comment"></i>LIVE CHAT</a> -->
                    <a href="mailto:soporte@kropsys.cl" class="btn-block btn--primary btn--ripple"><i class="fa fm fa-envelope"></i>soporte@kropsys.cl</a>
                    <a href="#" class="btn-block btn--primary btn--ripple"><i class="fa fm fa-facebook"></i>Facebook</a>
                </div>
                <!-- Footer Contact Widget End -->
            </div>
            <!-- Footer Widget End -->
        </div>
    </div>
    <!-- Footer Copyright Start -->
    <div class="footer--copyright text-center">
        <div class="container">
            <p>Copyright 2018 <a href="">KROPSYS LTDA</a>. All Rights Reserved.</p>
        </div>
    </div>
    <!-- Footer Copyright End -->
</footer>
<!-- Footer Area End -->
<script>
  var base_path = "" ; 
</script>
<script src="clientarea/js/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.2/validator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js" integrity="sha256-LddDRH6iUPqbp3x9ClMVGkVEvZTrIemrY613shJ/Jgw=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="clientarea/wizard/js/jquery.smartWizard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js" integrity="sha256-+9GoHuYQ1OC55y0cduYXuTPWAa211U2p0TwLgAAEOYc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/lang/summernote-es-ES.js" integrity="sha256-7X+/LlK66jemF5tJ2wUKgvI7FdBNt9h8xysmhsnat1w=" crossorigin="anonymous"></script>
<script src="clientarea/js/main.js"></script>


<div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Title</h4>
            </div>
            <div class="modal-body panel-body">
                Loading...
            </div>
            <div class="modal-footer panel-footer">
                <div class="pull-left loader">
                    <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary modal-submit">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal system-modal fade" id="modal-confirmar-ticket" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Title</h4>
            </div>
            <div class="modal-body panel-body">
                Loading...
            </div>
            <div class="modal-footer panel-footer">
                <div class="pull-left loader">
                    <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary modal-submit">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function(){

        $('textarea').summernote({
            lang: 'es-ES' 
        });

        $('#tipo').on('change', function(){
           $.post('index.php?r=areaclientes/default/dropdown-tipo',{tipo:$(this).val()}, function(res){
                 $('#asunto')
                 .empty()
                 .append(res);
           });
        });

        $('#icono-help').on('click', function(){
           $('#modal-info').modal('show');
         //  alert('ok');
        });

        $('#btn-search').on('click', function(){
           var input = $('#serial');

           if(input.val() != ''){
            $.post('index.php?r=areaclientes/default/check-serial',{serial : input.val() , _csrf : $('#_csrf').val()}, function(data){
                if(data.existe == true){
                      //  window.location.replace();
                     var modal =  $('#modal-confirmation').modal('show');
                     modal.find('#btn-confirm').attr("href", baseurl +'/index.php?r=areaclientes/default/generar-ticket&device='+input.val());
                     modal.find('#confirmation-1').html('<h3>'+data.centro+'<h3>');
                     modal.find('#confirmation-2').html("Ubicacion: "+data.impresora.ubicacion);

                }else{
                    toastr.warning('El Numero de serie ingresado no existe')
                }
            });
           } else{
            toastr.warning('Debe ingresar un numero de serie')
           }
        });
  
       $('.ajaxform').ajaxForm({
        beforeSend: function(xhr, settings){
            console.log(settings.data);
                       $('.loader').css('display', 'block');
                        var btn = $('.ajaxform').find('button.btn.btn-success');
                         btn.html('Enviado datos ...<i class="fa fa-refresh fa-spin"></i>');
                         
                        $(btn).prop("disabled",true);
                         $('#modal-confirmar-ticket').modal('show');
        },
        success: function(res){
            if(res.exito == true){
                toastr.success('Registrado con exito', '');
                //location.reload();
                $('.ajaxform').clearForm();    //Call the reset before the ajax call starts
               /* $(".selectpicker").val('default');
                $(".selectpicker").selectpicker("refresh");
                */
                $('.div-toggeable').toggle();
                if (res.OT!=false){

                  //  location.href=baseurl+ '/index.php?r=areaclientes/default/ver-ticket&ticket='+res.OT;
                }

               
            }else{
              var message = '';
                if(res.message){
                  console.log(res.message);
                  message = res.message;
                  toastr.error(message,'Hubo un problema al guardar, intentelo mas tarde...');
                }else{
                   toastr.error('Hubo un problema al guardar','');
                }
                
            }
        }, 
        complete(){
          $('.loader').css('display', 'none');
           var btn = $('.ajaxform').find('button.btn.btn-success');
          $(btn).prop("disabled",false);
        }
       });
});

</script>
<script>
    $.ajaxSetup({
        data: <?= \yii\helpers\Json::encode([
            \yii::$app->request->csrfParam => \yii::$app->request->csrfToken,
        ]) ?>
    });
</script>
</body>
</html>