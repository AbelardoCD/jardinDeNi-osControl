$().ready(function () {

            $('#lblMsgError').hide();

            $("#loginform").validate({
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }

                },
                messages: {
                    username: {
                            required: "Debe ingresar su nombre de usuario"
                        },
                    password: {
                        required: "Debe ingresar su contraseña"
                        }
                }
                
            });

            $('#btn-login').click(function(){
                    console.log('intentando login');
                    //debugger;

                    if ($("#loginform").valid()) {
                    
                        var params = {};
                        params.id  = $('#username').val();
                        params.contrasena  = $('#password').val();

                        $.ajax({
                            data: params,
                            url: 'login.php',
                            type: 'POST',
                           
                            success: function (response) {
                            console.log(response);
                            var r = parseInt(response); 
                            if(response ==-1){
                                    $('#lblMsgError').show();
                               
                                 

                            }else{
                               // location.href='catalogos/alumno.php';
                               location.href='catalogos/alumnocalificaciones.php';
                               
                            }

                            }, 

                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log(textStatus + ": " + XMLHttpRequest.responseText);
                            }
                        });

                }

                });
                

        });